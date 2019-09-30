<?php
//前台主要逻辑代码

namespace app\index\controller;

use \app\common\controller\Base;
use \app\common\model\ArticleCategory;
use app\common\model\Article;
use think\facade\Request;
use think\Db;
use app\common\model\Comment;
class Index extends Base
{
    //首页
    public function index()
    {
        //全局查询条件
        $map = [];//将所有的查询条件封装到这个数组中
        //条件1：
        $map[] = ['status', '=', 1];
        //搜索功能
        $keywords = Request::param('keywords');
        if (!empty($keywords)) {
            //条件2
            $map[] = ['title', 'like', '%' . $keywords . '%']; //like:模糊查询
        }
        //分类信息显示
        $cateId = Request::param('cate_id');
        //如果存在这个分类id
        if ($cateId) {
            //条件3：
            $map[] = ['cate_id', '=', $cateId];

            $res = ArticleCategory::get($cateId);
            $artList = Db::table('think_article')
                ->where($map)
                ->where('cate_id', $cateId)
                ->order('create_time', 'desc')
                ->paginate(3);
            $this->assign('cateName', $res->name);
        } else {
            $this->assign('cateName', '全部文章');

            $artList = Db::table('think_article')
                ->where($map)
                ->order('create_time', 'desc')
                ->paginate(3);
        }
        $this->assign('empty', '<h3>没有文章</h3>');
        $this->assign('artList', $artList);
        return $this->fetch('index', ['title' => '社区问答']);

    }

    //添加文章界面
    public function insert()
    {
        //1.登录才允许发布文章
        $this->isLogin();
        //2.设置页面标题
        $this->assign('title', '发布文章');
        //3.获取栏目的信息
        $cateList = ArticleCategory::all();
        //
        if (count($cateList) > 0) {
            //将查询到的信息赋值给模版
            $this->assign('cateList', $cateList);
        } else {
            $this->error('请先添加栏目!');
        }
        //4.渲染发布界面
        return $this->fetch();
    }

    //保存文章
    public function save()
    {
        //判断提交类型s
        if (Request::isPost()) {
            //获取用户提交信息
            $data = Request::post();
            //验证
            $res = $this->validate($data, 'app\common\validate\Article');
            if (true !== $res) {
                //验证失败
                echo '<script>alert("' . $res . '");history.back()</script>';
            } else {
                //验证成功
                //获取上传图片信息
                $file = Request::file('title_img');
                //校验文件信息，验证成功后再上传到服务器的指定目录,以public为起始目录
                $info = $file->validate([
                    'size' => 1000000,
                    'ext' => 'jpg,jpeg,png,gif',
                ])->move('uploads/');
                if ($info) {
                    $data['title_img'] = $info->getSaveName();
                } else {
                    $this->error($file->getError());
                }
                //将数据写到数据表中
                if (Article::create($data)) {
                    $this->success('文章发布成功', 'index/index');
                } else {
                    $this->error('文章发布失败');
                }
            }
        } else {
            $this->error('请求类型错误!');
        }
    }

    //详情页：阅读量，点赞量
    public function detail()
    {
        $artId = Request::param('id');

        $art = Article::get(function ($query) use ($artId) {
            $query->where('id', $artId)->setInc('pv');
        });


        if (!is_null($art)) {
            $this->assign('art', $art);
        }

        //添加评论
        $this->assign('commentList', Comment::all(function ($query) use ($artId) {
            $query->where('status', 1)//允许显示
            ->where('article_id', $artId)//当前文章的id
            ->order('create_time', 'desc');//最新评论放在最前面
        }));
        $this->assign('title', '详情页');
        return $this->fetch('detail');
    }

    //收藏
    public function fav()
    {
        if (!Request::isAjax()) {
            return ['status' => -1, 'message' => '请求类型错误！'];
        }
        //获取从前端传递过来的数据
        $data = Request::param();
        //判断用户是否登录
        if (empty($data['session_id'])) {
            return ['status' => -2, 'message' => '请登录后再收藏！！！'];
        }
        //查询条件
        $map[] = ['user_id', '=', $data['user_id']];
        $map[] = ['article_id', '=', $data['article_id']];

        $fav = Db::table('think_user_fav')->where($map)->find();
        if (is_null($fav)) {
            Db::table('think_user_fav')->data([
                'user_id' => $data['user_id'],
                'article_id' => $data['article_id']
            ])->insert();
            return ['status' => 1, 'message' => '收藏成功^__^'];
        } else {
            Db::table('think_user_fav')->where($map)->delete();
            return ['status' => 0, 'message' => '已取消收藏^__^'];
        }
    }

    //点赞
    public function ok()
    {
        if (!Request::isAjax()) {
            return ['status' => -1, 'message' => '请求类型错误！'];
        }
        //获取从前端传递过来的数据
        $data = Request::param();
        //判断用户是否登录
        if (empty($data['session_id'])) {
            return ['status' => -2, 'message' => '请登录后再点赞！！！'];
        }
        //查询条件
        $map[] = ['user_id', '=', $data['user_id']];
        $map[] = ['article_id', '=', $data['article_id']];

        $ok = Db::table('think_user_like')->where($map)->find();
        if (is_null($ok)) {
            Db::table('think_user_like')->data([
                'user_id' => $data['user_id'],
                'article_id' => $data['article_id']
            ])->insert();
            return ['status' => 1, 'message' => '点赞成功^__^'];
        }else {
            Db::table('think_user_like')->where($map)->delete();
            return ['status' => 0, 'message' => '已取消点赞^__^'];
        }
    }

    //评论
    public function insertComment()
    {
        if (Request::isAjax()) {
            //1. 获取到前台提交的评论
            $data = Request::param();
            //判断用户是否提交有用数据
            $res = $this->validate($data, 'app\common\validate\Comment');
            if (true !== $res) {
                //验证失败
                echo '<script>alert("' . $res . '");history.back()</script>';
            } elseif (Comment::create($data, true)) {
                //2.将用户留言保存到表中
                return ['status' => 1, 'message' => '评论发表成功^__^'];
            } else {
                return ['status' => 0, 'message' => '评论发表失败！'];
            }
            $this->error('请求类型错误!');
        }
        return $this->fetch('detail');

    }
}


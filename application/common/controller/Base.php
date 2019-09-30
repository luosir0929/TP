<?php
/**
 * 1. 公共控制器
 * 必须继承自think\Controller.php
 */

namespace app\common\controller;
use think\Controller;
use think\facade\Session;
use app\common\model\ArticleCategory;
use app\admin\common\model\Site;
use think\facade\Request;
use app\common\model\Article;
class Base extends Controller
{
    /**
     * 初始化方法
     * 创建常量，公共方法
     * 在所有的方法之前调用
     */
    protected function initialize()
    {
        //显示分类导航
        $this->showNav();
        //检测站点是否关闭
        $this->isOpen();

        //获取右侧热点数据
        $this->getHotArt();


    }

    //防止用户重复登录
    public function Logined()
    {
        if(Session::has('user_id')){
            $this->error('客官，您已经登录了哟！',url('index/index'));
        }
    }
    //检查是否登录
    public function isLogin()
    {
        if(!Session::has('user_id')){

            $this->error('客官，您是不是忘记登录啦~~',url('user/login'));
        }
    }
    //显示分类导航
    protected function showNav()
    {
        //1.查询分类表获取到所有分类信息
        $cateList = ArticleCategory::all(function($query){
            $query->where('status',1)->order('sort','asc');
        });
        //2.将分类信息赋值给模版，nav.html
        $this->assign('cateList',$cateList);
    }

    //站点管理
    //检测站点是否关闭
    public function isOpen()
    {
        //1.获取当前站点状态
        $isOpen = Site::where('status',1)->value('is_open');

        //2.如果站点已经关闭，我们只允许关闭前台，后台不允许关闭
        if($isOpen ==0 && Request::module()=='index'){
            //关闭网站
            $info = <<< 'INFO'
<body style="background-color:#333">
<h1 style="color: #eee;text-align: center;margin: 200px">站点维护中....</h1>
</body>
INFO;
            exit($info);

        }
    }

//检查注册是否关闭
    public function is_reg()
    {
        //1.当前注册状态
        $isReg = Site::where('status',1)->value('is_reg');


        //2.如果已经关闭，直接跳转到首页
        if($isReg == 0){
            $this->error('注册关闭！','index/index');
        }
    }

//根阅读量（pv）来获取内容
    public function getHotArt()
    {
        $hotArtList = Article::where('status',1)->order('pv','desc')->limit(15)->select();

        $this->assign('hotArtList',$hotArtList);

    }


}
<?php


namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Article as ArtModel;
use think\facade\Request;
use think\facade\Session;
use app\admin\common\model\Cate;
use think\Db;
class Article extends Base
{
    //文章管理的首页
    public function index()
    {
        //检查用户是否登录
        $this->isLogin();

        //登录后就直接跳转到文章管理界面
        return $this->fetch('artList');
    }

    //文章列表
    public function artList()
    {
        //1.检查用户是否登录
        $this->isLogin();
        //2.获取当前用户的id和级别
        $data['admin_id'] = Session::get('admin_id');
        $data['admin_level'] = Session::get('admin_level');
//        dump($data['admin_id']);
//        dump($data['admin_level']);



        //3.获取当前用户发布的文章
        $artList =  ArtModel::where('user_id', $data['admin_id'])->paginate(3);
        //4.如果是超级管理员，获取到所有的文章
        if($data['admin_level'] == 1){
            $artList =  ArtModel::where('status',1)->order('create_time','desc')->paginate(5);
//            var_dump($artList);

        }
        //5.设置模版变量
        $this->assign('title','文章管理');
        $this->assign('empty','<span style="color: red">没有文章</span>');
        $this->assign('artList',$artList);

        //6.渲染模版
        return $this->fetch('artList');




    }
    //渲染编辑分类的界面
    public function artEdit()
    {
        //1.获取到分类的id
        $cateId = Request::param('id');

        //2.根据主键查询要更新的分类信息
        $artInfo = ArtModel::where('id',$cateId)->find();

        //3.查询分类信息
        $cateList = Cate::all();
        //dump($artInfo);

        //3.设置模版变量
        $this->assign('title','编辑文章');
        $this->assign('cateList',$cateList);
        $this->assign('artInfo',$artInfo);

        //4.渲染模版
        return $this->fetch('artEdit');

    }

    //执行编辑保存操作
    public function doEdit()
    {
        //1.获取表单提交的信息
        $data = Request::param();

        //2.获取上传的图片信息
        //获取上传图片信息
        $file = Request::file('title_img');
        //校验文件信息，验证成功后再上传到服务器的指定目录,以public为起始目录
        $info = $file->validate([
            'size'=>500000000,
            'ext'=>'jpg,jpeg,png,gif',
        ])->move('uploads/');
        if($info){
            $data['title_img'] = $info->getSaveName();
        }else{
            $this->error($file->getError());
        }
        //将数据写到数据表中
        if(ArtModel::update($data)){
            $this->success('文章更新成功','artList');
        }else{
            $this->error('文章更新失败');
        }

    }

    //执行分类的删除操作
    public function doDelete()
    {
        //1.获取要删除的主键id
        $id = Request::param('id');

        //2.执行删除操作
        if(ArtModel::where('id',$id)->delete()){
            return $this->success('删除成功^__^','artList');
        }
        return $this->error('删除失败');
    }

    //添加分类操作
    //1.渲染添加页面
    public function cateAdd()
    {
        return $this->fetch('cateAdd',['title'=>'添加分类']);
    }
    //2.添加分类
    public function doAdd()
    {
        //获取到要添加的信息
        $data =  Request::param();
        //自定义验证规则
        $rule = [
            'name|名称'=>'require',
            'sort|排序'=>'require',
        ];
        //开始验证
        $res = $this->validate($data,$rule);
        if($res !== true){
            return "<script>alert('".$res."');history.back()</script>";
        }else{
            //2.执行新增斌判断是否成功
            if(CateModel::create($data)){
                $this->success('添加成功','cateList');
            }else{
                $this->error('新增失败');
            }

        }

    }
    //执行文章删除操作
    public function artDelete(){
        //1.获取要删除的主键id
        $id = Request::param('id');
        var_dump($id);

        //2.执行删除操作
        if(ArtModel::where('id',$id)->delete()){
            return $this->success('删除成功^__^','artList');
        }
        return $this->error('删除失败');
    }



}
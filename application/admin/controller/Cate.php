<?php


namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Cate extends Base
{
    //分类管理的首页
    public function index()
    {
        //检查用户是否登录
        $this->isLogin();

        //登录后就直接跳转到分类管理界面
        return $this->redirect('cateList');
    }

    //分类列表
    public function cateList()
    {
        //1.检查用户是否登录
        $this->isLogin();

        //2.获取到所有的分类
        $cateList = CateModel::where('status',1)->order('create_time','desc')->paginate(5);;

        //3.设置模版变量
        $this->assign('title','分类管理');
        $this->assign('empty','<span style="color: red">没有分类</span>');
        $this->assign('cateList',$cateList);

        //4.渲染模版
        return $this->fetch('cateList');

    }
    //渲染编辑分类的界面
    public function cateEdit()
    {
        //1.获取到分类的id
       $cateId = Request::param('id');

       //2.根据主键查询要更新的分类信息
        $cateInfo = CateModel::where('id',$cateId)->find();

        //3.设置模版变量
        $this->assign('title','编辑分类');

        $this->assign('cateInfo',$cateInfo);
        //4.渲染模版
        return $this->fetch('cateEdit');

    }
    //执行编辑操作
    public function doEdit()
    {
        //1.获取当前栏目的信息
        $data = Request::param();

        //2.取出更新主键
        $id = $data['id'];


        //3.删除主键字段，封装出要更新的字段数组
        unset($data['id']);

        //4.执行更新操作
        if(CateModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功^__^','cateList');
        }
        //6.更新失败
        return $this->error('没有更新或更新失败');
    }

    //执行分类的删除操作
    public function doDelete()
    {
        //1.获取要删除的主键id
        $id = Request::param('id');

        //2.执行删除操作
        if(CateModel::where('id',$id)->delete()){
            return $this->success('删除成功^__^','cateList');
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
            return "<script>alert('$res'),location(history.back())</script>";
        }else{
            //2.执行新增斌判断是否成功
            if(CateModel::create($data)){
                $this->success('添加成功','cateList');
            }else{
                $this->error('新增失败');
            }

        }

    }


}
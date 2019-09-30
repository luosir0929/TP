<?php


namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;
use think\Db;
class User extends Base
{
    //渲染登录界面
    public function login()
    {
        $this->assign('title','管理员登录');
        return $this->fetch('login');
    }
    //验证后台登录
    public function checkLogin()
    {
        $data = Request::param();
        //查询条件
        $map[] = ['email','=',$data['email']];
        $map[] = ['password','=',md5($data['password'])];
        //查询
        $result = UserModel::where($map)->find();
        if($result){
            Session::set('admin_id',$result['id']);
            Session::set('admin_name',$result['name']);
            Session::set('admin_level',$result['is_admin']); //是否是超级管理员
            $this->success('登录成功^__^',url('admin/user/userList'));
        }else{
            $this->error('登录失败');
        }

    }

    //退出登录
    public function logout()
    {
        //1.清除当前session
        Session::clear();
        //2.退出登录并跳转到登录界面
        return $this->success('退出登录成功！',url('admin/user/login'));

    }
    /**
     *  //用户列表：1.超级管理员可以查看所有用户，并有删除功能。
     * 2.普通用户只能查看个人信息
    */
    public function userList()
    {
        //1.获取当前用户的id和级别is_admin
        $data['admin_id'] = Session::get('admin_id');
        $data['admin_level'] = Session::get('admin_level');

        //2.获取当前用户信息
        $userList= UserModel::where('id',$data['admin_id'])->paginate(5);

        //3.如果是超级管理员，获取全部信息
        if($data['admin_level']==1){
            $userList = UserModel::where('status',1)->order('create_time','desc')->paginate(5);
        }
        //4.模版赋值
        $this->assign('title','用户管理');
        $this->assign('empty','<span style="color:red">没有任何数据</span>');
        $this->assign('userList',$userList);
        //5.渲染模版
        return $this->fetch('userList');

    }
    //渲染编辑用户的界面
    public function userEdit()
    {
        //1.获取要更新的用户主键
       $userId = Request::param('id');

       //2.根据主键进行查询
        $userInfo = UserModel::where('id',$userId)->find();

        //3.设置编辑界面的模版变量
        $this->assign('title','编辑用户');
        $this->assign('userInfo',$userInfo);

        //4.渲染出编辑界面
        return $this->fetch('userEdit');
    }

    //执行用户的编辑保存操作
    public function doEdit()
    {
        //1.获取当前用户提交的信息
        $data = Request::param();

        //2.取出主键
        $id = $data['id'];

        //3.将用户密码加密后再保存回去
        $data['password'] = md5($data['password']);

        //4.删除主键id
        unset($data['id']);

        //5.执行更新操作
        if(UserModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功^__^','userList');
        }
        //6.更新失败
        return $this->error('没有更新或更新失败');
    }

    //执行用户的删除操作
    public function doDelete()
    {
        //1.获取要删除的主键id
        $id = Request::param('id');
        var_dump($id);
        //2.执行删除操作
        if(UserModel::where('id',$id)->delete()){
            return $this->success('删除成功^__^','user/userList');
        }
        return $this->error('删除失败');
    }



}
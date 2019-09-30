<?php
//用户登陆注册校验控制器

namespace app\index\controller;
use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModel;
use think\facade\Session;
class User extends Base
{
    //注册页面
    public function reg()
    {
        //检查是否开启注册
        $this->is_reg();

        $this->assign('title','用户注册');
        return $this->fetch();
    }

//    public function insert()
//    {
//
//        //处理用户提交的信息
//        if (Request::isAjax()){
//            //使用模型来创建数据
//            //获取用户从表单提交的数据
//            $data = Request::except('password_confirm','post'); //过滤不需要写入数据库的字段
//            if(UserModel::create($data)){
//                return ['status' =>1,'message' =>'注册成功'];
//            }else{
//                return ['status' =>0,'message' =>'注册失败'];
//            }
//        }else{
//            $this->error('请求类型错误！','index/user/reg');
//        }
//    }
     public function insert()
     {
        //验证数据
         $data = Request::post();
         $rule = 'app\common\validate\User';//自定义验证规则
         //开始验证

         $res = $this->validate($data,$rule);
//         dump($data);
//         dump($res);

         if (true !== $res){   //false
             return "<script>alert('".$res."'),location(history.back())</script>";
         } else {
             if($user = UserModel::create($data)){
                 //注册成功后，实现自动登录
                 $res = UserModel::get($user->id);
                 Session::set('user_id',$res->id);
                 Session::set('user_name',$res->name);

                 return $this->success('注册成功！',url('index/index/index'));
             }else{
                 return $this->error('注册失败,请检查！',url('index/user/reg'));
             }
         }
         //$data1 = Request::except('password_confirm','post');

     }

     //用户登录
    public function login()
    {
        $this->Logined();
        return $this->fetch('login',['title'=>'用户登录']);
    }
    //用户登录验证与查询
    public function loginCheck()
    {
        $data = Request::post();
        $rule = [
            'email|邮箱'=>'require|email',
            'password|密码'=>'require|alphaNum',
        ];//自定义验证规则
        //开始验证

        $res = $this->validate($data,$rule);
//         dump($data);
//         dump($res);

        if (true !== $res){   //false
            return "<script>alert('$res'),location(history.back())</script>";
        } else {
            //执行查询
            $result = UserModel::get(function ($query) use ($data){
                $query->where('email',$data['email'])
                    ->where('password',md5($data['password']));
            });
            if(null == $result){
                return $this->error('邮箱或密码不正确，请检查！',url('index/user/login'));
            }else{
                //将用户的数据写到session中
                Session::set('user_id',$result->id);
                Session::set('user_name',$result->name);
                return $this->success('恭喜,登录成功！',url('index/index/index'));
            }

        }

    }

    //用户退出登录
    public function logout()
    {
//        Session::delete('user_id');
//        Session::delete('user_name');
        Session::clear();
        return $this->success('退出登录成功！',url('index/index'));

    }




}
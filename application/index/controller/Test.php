<?php
/**
 * 测试专用控制器
 */

namespace app\index\controller;
use app\common\model\User;
use app\common\controller\Base;
use app\common\model\Comments;
class Test extends Base
{
    //测试用户的验证器
    public function test1()
    {
        $data = [
            'name'   =>  'perter',
            'email'  =>  'perter@php.com',
            'mobile' =>  '12345678912',
            'password'=> '123abc',

        ];
        $rule  = 'app\common\validate\User';
        return $this ->validate($data,$rule);

    }

    public function test2()
    {
        dump(User::get(8));
    }
    public function test3()
    {
        dump(User::all());
    }
    public function test4()
    {
        return $this->fetch('test');
    }

    public function test5()
    {
        $this->assign('title','Hello World!');
        return $this->fetch('test');
    }


    public function index(){
        $num = Comments::count(); //获取评论总数
        $this->assign('num',$num);
        $data=$this->getCommlist();//获取评论列表
        $this->assign("commlist",$data);
        $this->display('index');
        return $this->fetch('test');
    }
    /**
     *添加评论
     */
    public function addComment(){
        $data=array();
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){
            $cm = json_decode($_POST["comment"],true);//通过第二个参数true，将json字符串转化为键值对数组
            $cm['create_time']=date('Y-m-d H:i:s',time());
            $id = Comments::add($cm);
            $cm["id"] = $id;
            $data = $cm;
            $num = Comments::count();//统计评论总数
            $data['num']= $num;
        }else{
            $data["error"] = "0";
        }
        echo json_encode($data);
    }
    /**
     *递归获取评论列表
     */
    protected function getCommlist($parent_id = 0,&$result = array()){
        $arr = Comments::where("parent_id",$parent_id)->order("create_time desc")->select();
        var_dump($arr);
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr=&$result[];
            $cm["children"] = $this->getCommlist($cm["id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }

}
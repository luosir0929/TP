<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        //校验用户是否登录
        $this->isLogin();

        return $this->fetch();
    }

}
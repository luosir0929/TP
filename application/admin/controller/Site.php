<?php


namespace app\admin\controller;

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Site as SiteModel;
use think\facade\Request;
use think\facade\Session;
class Site extends Base
{
    //1.站点的管理首页
    public function index()
    {
        //1.获取站点信息
        $siteInfo = SiteModel::get(['status'=>1]);
        //2. 模版赋值
        $this->assign('siteInfo',$siteInfo);

        //3.渲染模版
        return $this->fetch('index');

    }

    //保存站点的修改信息
    public function save()
    {
        //1.获取数据
        $data = Request::param();

        //2.更新
        if(SiteModel::update($data)){
            $this->success('更新成功^__^','index');
        }
            $this->error('更新失败！');
    }

}
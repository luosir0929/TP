<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;
// 应用公共文件
//根据用户的主键id查询用户名称
if(!function_exists('getUserName')){
    function getUserName($id)
    {
       return Db::table('think_user')->where('id',$id)->value('name');
    }
}
//过滤文章摘要
function getArtContent($content)
{
    //return mb_substr(strip_tags($content),0,50).'>>>';//返回部分截取字符串
    return mb_substr(strip_tags($content),0,100).'>>>';
}

if(!function_exists('getCateName')){
    function getCateName($cateId)
    {
        return Db::table('think_article_category')->where('id',$cateId)->value('name');
    }

}if(!function_exists('getSaveName')){
    function getSaveName($id)
    {
        return Db::table('think_article')->where('id',$id)->value('name');
    }
}
//文章详情页展示
function getArtContent1($content){
    return mb_substr(strip_tags($content),0);

}






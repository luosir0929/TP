<?php

/**
 * think_user表的用户模型
 */
namespace app\common\model;
use think\Model;

class User extends Model
{
    protected $pk='id'; //默认主键
    protected $autoWriteTimestamp = true; //自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    //protected $dateFormat = 'Y年m月d日'; //修改时间格式

    //状态获取器：明确当前表中的一些字段意义
    public function getStatusAttr($value)//$value：当前字段的值
    {
        $status = ['1'=>'启用','0'=>'禁用'];
        if($value == null){
            return $status[1];
        } else {
            return $status[$value];
        }


    }
    //身份获取器
    public function getIsAdminAttr($value)
    {
        $status = ['1'=>'管理员','0'=>'注册会员'];
        return $status[$value];
    }
    //修改器：用户向数据库中增加字段时能进行转换，例如，密码加密
    public function setPasswordAttr($value)
    {
        return md5($value);
        //return sha1($value);
    }



}
<?php


namespace app\common\model;
use think\Model;

class Comment extends Model
{
    protected $pk='id'; //默认主键
    protected $table='think_user_comments';
    protected $autoWriteTimestamp = true; //自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    //protected $dateFormat = 'Y年m月d日'; //修改时间格式
    //开启自动设置
    protected $auto=[];
    //仅仅新增的有效
    protected $insert=['create_time','status'=>1,'is_top'=>0,'is_hot'=>0];
    //仅仅更新的时候设置
    protected $update=['update_time'];

}
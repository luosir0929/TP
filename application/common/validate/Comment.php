<?php


namespace app\common\validate;
use think\Validate;

class Comment extends Validate
{
    protected $rule =[
        'content|文章内容'=>'require',
    ];

}
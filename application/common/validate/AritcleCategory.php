<?php

//栏目表验证规则
namespace app\common\validate;
use think\Validate;

class AritcleCategory extends Validate
{
    protected $rule =[
        'name|栏目名称' =>'require|length:3,20',

    ];

}
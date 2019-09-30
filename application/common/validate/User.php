<?php
/**
 * think_user表的验证器
 */

namespace app\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule =[
        'name|用户名' =>'require|length:5,20|unique:user',
        'email|邮箱'=>'require|email|unique:user',
        'mobile|手机号'=>'require|mobile|number|unique:user',
        'password|密码'=>'require|length:6,20|confirm',

    ];

//    protected $rule =[
//        'name|姓名' =>[
//            'require'   =>   'require',
//            'length'    =>   '5,20',
//            'alpanNum'=>  'alpanNum',
//        ],
//        'email|邮箱'=>[
//            'require'   =>   'require',
//            'email'     =>   'email',
//            'unique'    =>   'think_user' //该字段在该表中是唯一的
//        ],
//        'mobile|手机号'=>[
//            'require'   =>   'require',
//            'mobile'    =>   'mobile',
//            'unique'    =>   'think_user', //该字段在该表中是唯一的
//            'number'    =>   'number',
//        ],
//        'password|密码'=>[
//            'require'   =>   'require',
//            'length'    =>   '6,20',
//            'alpanNum'  =>   'alpanNum',
//            'confirm'   =>   'confirm',
//        ],
//    ];

}
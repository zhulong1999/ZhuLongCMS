<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 18:18
 */
namespace app\admin\model;
use think\Model;

class User extends Model
{
    protected $pk = 'mid';
    protected $table = 'cms_admin';

    public static function isdelete()
    {
        return self::where('isdelete',1);
    }

    /**
     * 后台登录
     * @param $user
     * @param $pass
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function login($user, $pass)
    {
        return self::isdelete()->where(['user'=>$user,'pass'=>$pass])->field('mid,user,pass,time,num')->find();
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 18:18
 */
namespace app\admin\model;
use think\Model;
use think\Session;

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

    /**
     * 退出登录
     * @return User
     */
    public static function out_login()
    {
        $mid = \session('admin')['mid'];
        $data['num'] = self::where('mid',$mid)->value('num') + 1;
        $data['time'] = time();
        $data['ip'] =request()->server()['SERVER_ADDR'];
        $out_login = self::where('mid',$mid)->update($data);
        return $out_login;
    }

    /**
     * 查询当前登录账号
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function sel()
    {
        $mid = \session('admin')['mid'];
        return self::where('mid',$mid)->find();
    }

    /**
     * 修改密码
     * @param $mid
     * @param $data
     * @return User
     */
    public static function alter($mid,$data)
    {
        return self::where('mid',$mid)->update($data);
    }

    /**
     * 初始化管理员
     * @param $data
     * @return int|string
     */
    public static function inst($data)
    {
        return self::insert($data);
    }

}
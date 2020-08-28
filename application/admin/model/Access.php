<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/26
 * Time: 18:36
 */
namespace app\admin\model;
use think\Model;

class Access extends Model
{
    protected $table = 'cms_access';
    public static function isdelete()
    {
        return self::where('isdelete',1);
    }
    public static function sort()
    {
        return self::isdelete()->order('id desc');
    }
    /**
     * 查询
     * @param $ip
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function sel($ip)
    {
        return self::sort()->paginate(10,false,['query'=>['ip'=>$ip]]);
    }

    /**
     * 搜索
     * @param $ip
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function search($ip)
    {
        return self::sort()
            ->where('ip','like',"%$ip%")
            ->paginate(10,false,['query'=>['ip'=>$ip]]);
    }

    /**
     * 删除
     * @param $arr
     * @return Access
     */
    public static function del_all($arr)
    {
        return self::whereIn('id',$arr)->update(['isdelete'=>0]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/26
 * Time: 15:15
 */

namespace app\admin\model;
use think\Model;

class Message extends Model
{
    protected $pk = 'mid';
    protected $table = 'cms_message';

    public static function isdelete()
    {
        return self::where('isdelete',1);
    }
    public static function sort()
    {
        return self::isdelete()->order('mid desc');
    }

    /**
     * 查询
     * @param $name
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function sel($name)
    {
        return self::sort()->paginate(10,false,['query'=>['name'=>$name]]);
    }


    /**
     * 搜索
     * @param $name
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function search($name)
    {
        return self::sort()
            ->where('name','like',"%$name%")
            ->whereOr('phone','like',"%$name%")
            ->paginate(10,false,['query'=>['name'=>$name]]);
    }

    /**
     * 删除
     * @param $arr
     * @return Message
     */
    public static function del_all($arr)
    {
        return self::whereIn('mid',$arr)->update(['isdelete'=>0]);
    }
}
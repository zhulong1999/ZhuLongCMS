<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/23
 * Time: 13:51
 */
namespace app\admin\model;
use think\Model;

class Column extends  Model
{
    protected $pk = 'cid';
    protected $table = 'cms_column';
    public static function isdelete()
    {
        return self::where('isdelete','<=',1);
    }
    public static function sort()
    {
        return self::isdelete()->order('sort asc,cid desc');
    }

    /**
     * 查询 栏目
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function sel()
    {
        return self::sort()->select();

    }

    /**
     * 修改栏目
     * @param $arr
     * @return Column
     */
    public static function alter($arr)
    {
        return self::where("cid",$arr['cid'])->update($arr);
    }

    /**
     * 栏目删除
     * @param $arr
     * @return Column
     */
    public static function del_all($arr)
    {
        return self::whereIn('cid',$arr)->update(['isdelete'=>2]);
    }


    /**
     * 修改排序
     * @param $cid
     * @param $sort
     * @return Column
     */
    public static function alter_sort($cid,$sort)
    {
        return self::isdelete()->where('cid',$cid)->update(['sort'=>$sort]);
    }

    /**
     * 修改状态
     * @param $cid
     * @param $isdelete
     * @return Column
     */
    public static function alter_status($cid,$isdelete)
    {
        return self::where('cid',$cid)->update(['isdelete'=>$isdelete]);
    }

    /**
     * 删除栏目
     * @param $cid
     * @return Column
     */
    public static function del($cid)
    {
        return self::where('cid',$cid)->update(['isdelete'=>2]);
    }

}
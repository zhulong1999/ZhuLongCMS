<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/26
 * Time: 13:06
 */
namespace app\admin\model;
use think\Model;

class Other extends  Model
{
    protected $table = 'cms_other';
    protected $pk = 'oid';
    public static function isdelete()
    {
        return self::where('isdelete',1);
    }
    public static function sort()
    {
        return self::isdelete()->order('sort asc,oid desc');
    }

    /**
     * 查询
     * @param int $type
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function sel($type = 1)
    {
        return self::sort()->where('type',$type)->paginate(10);
    }

    /**
     * 新增
     * @param $data
     * @return int|string
     */
    public static function inse($data)
    {
        return self::insert($data);
    }

    /**
     * 更新
     * @param $data
     * @return Other
     */
    public static function alter($data)
    {
        return self::where('oid',$data['oid'])->update($data);
    }

    /**
     * 修改排序
     * @param $oid
     * @param $sort
     * @return Other
     */
    public static function alter_sort($oid,$sort)
    {
        return self::isdelete()->where('oid',$oid)->update(['sort'=>$sort]);
    }

    /**
     * 删除
     * @param $arr
     * @return Other
     */
    public static function del_all($arr)
    {
        return self::whereIn('oid',$arr)->update(['isdelete'=>0]);
    }

}

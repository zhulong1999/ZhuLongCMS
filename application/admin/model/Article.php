<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/25
 * Time: 16:20
 */
namespace  app\admin\model;
use think\Model;

class Article extends Model
{
    protected $table = "cms_article";
    protected $pk = "aid";
    public static function isdelete()
    {
        return self::where('isdelete','<=',1);
    }
    public static function sort()
    {
        return self::isdelete()->order('sort asc,aid desc');
    }

    /**
     * 文章列表
     * @param $title
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function sel($title)
    {
        return self::sort()->paginate(10,false,['query'=>['info'=>$title]]);
    }

    /**
     * 搜索
     * @param $title
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function search($title)
    {
        return self::sort()->where('title','like',"%$title%")->paginate(10,false,['query'=>['info'=>$title]]);
    }

    /**
     * 修改状态
     * @param $aid
     * @param $isdelete
     * @return Article
     */
    public static function alter_status($aid,$isdelete)
    {
        return self::where('aid',$aid)->update(['isdelete'=>$isdelete]);
    }

    /**
     * 批量删除
     * @param $arr
     * @return Article
     */
    public static function del_all($arr)
    {
        return self::whereIn('aid',$arr)->update(['isdelete'=>2]);
    }

    /**
     * 修改排序
     * @param $aid
     * @param $sort
     * @return Article
     */
    public static function alter_sort($aid,$sort)
    {
        return self::isdelete()->where('aid',$aid)->update(['sort'=>$sort]);
    }

    /**
     * 修改文章
     * @param $arr
     * @return Article
     */
    public static function alter($arr)
    {
        return self::where("aid",$arr['aid'])->update($arr);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/22
 * Time: 23:38
 */
namespace app\admin\model;
use think\Model;
class Site extends Model
{
    protected $pk = 'cid';
    protected $table = 'cms_site';
    public static function isdelete()
    {
        return self::where('isdelete',1);
    }
    public static function inset($arr=[])
    {
        return self::isdelete()->where('cid','1000')->update($arr);
    }
}
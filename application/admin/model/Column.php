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
        return self::where('isdelete',1);
    }

    public static function sel()
    {
        return self::isdelete()->select();

    }

}
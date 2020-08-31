<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/28
 * Time: 19:37
 * 标签库
 */
namespace app\taglib;
use think\template\TagLib;
vendor('taglib.Db');
class Zl extends TagLib
{
    protected $tags = [
        //站点信息
        'site' =>['attr'=>'name','close'=>0],
        //父栏目标签
        'type' =>['attr' => 'num','close'=>1],
        //调用子栏目
        'type_son' =>['attr'=>'num,parentid','close'=>1],

    ];

    /**
     * 站点标签
     * @return string
     */
    public function tagSite($tag)
    {
        $name = $tag['name'];
        $html = '<?php ';
        $html .= 'echo \Db::site()["'.$name.'"];';
        $html .= ' ?>';
        return $html;
    }
    /**
     * 父栏目标签
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagType($tag,$content)
    {

        $num = $tag['num'];
        $html = '<?php ';
        $html .= '$__LIST__ = \Db::type('.$num.');';
        $html .= 'foreach($__LIST__ as $key=>$vo): ';
        $html .= '?>';
        $html .= $content;
        $html .='<?php endforeach; ?>';
        return $html;
    }

    /**
     * 调用子栏目
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagType_son($tag,$content)
    {
        $num = $tag['num'];
        $parentid = $tag['parentid'];
        $html = '<?php ';
        $html .= '$__LIST__ = \Db::parentType('.$num.','.$parentid.');';
        $html .= 'foreach($__LIST__ as $key=>$vo): ';
        $html .= '?>';
        $html .= $content;
        $html .='<?php endforeach; ?>';
        return $html;
    }
}
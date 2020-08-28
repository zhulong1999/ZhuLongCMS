<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * json返回
 * @param $status
 * @param $message
 * @param array $data
 * @return array
 */
function ajax($status,$message,$data=[])
{
    return array(
        "status"=>$status,
        "message"=>$message,
        "data"=>$data,
    );
}

/**
 * 栏目分类
 * @param $type
 * @return string
 */
function column_type($type)
{
    switch ($type)
    {
        case 1:
            $str = '内容页';
            break;
        case 2:
            $str = '列表页';
            break;
        case 3:
            $str = '图片列表页';
            break;
        default:
            $str = '暂无分类';
    }
    return $str;
}

/**
 * PHP扩展是否开启
 * @param $ext
 * @return string
 */
function is_open($ext)
{
    if (extension_loaded($ext)){
        return 'yes';
    }else{
        return 'on';
    }
}


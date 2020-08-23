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
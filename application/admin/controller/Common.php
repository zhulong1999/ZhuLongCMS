<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 18:51
 */
namespace app\admin\controller;
use think\Controller;
use think\Session;

class Common extends Controller
{
    public function _initialize()
    {
//        dump($_SERVER);

        $is_login = Session::has('admin');
        //判断是否登录
        if (!$is_login){
            $this->error('请登录!~~~~',url('User/login'));
        }

    }

    public function uploads()
    {

       $json = array();
        $file = request()->file('file');
        if ($file){
            $info = $file->move(ROOT_PATH.'public/'.DS.'uploads');
            if ($info){
               $json['status'] = 200;
               $json['message'] = "上传成功";
               $json['data'] = ["src"=>config('site_url').'/uploads/'.$info->getSaveName()];
            }else{
                $json['status'] = 500;
                $json['message'] = "上传失败";
                $json['data'] = "上传失败";$info->getError();
            }
        }
        return $json;
    }
}
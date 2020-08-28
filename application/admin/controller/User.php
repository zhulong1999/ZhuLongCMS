<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 17:10
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as model;
use think\Session;

class User extends Controller
{
    /**
     * 后台登录
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        if (request()->method() == 'POST'){
            $user = trim(request()->post('user'));
            $pass = md5(trim(request()->post('pass')));
            if ($user == '' or $pass == ''){
                $this->error('账号或密码不得为空');
            }
            $result = model::login($user,$pass);
            if ($result && !is_null($result)){
                session('admin',$result->toArray());
                $this->success('登录成功',url('Index/index'));
            }else{
                $this->error('账号或密码错误！');
            }
        }else{
            return view();
        }
    }

    /**
     * 退出登录
     */
    public function out_login()
    {
        $result = model::out_login();
        if ($result && $result >= 1){
            Session::destroy('admin');
            $this->success('退出成功',url('User/login'));
        }else{
            $this->error('退出失败1');
        }
    }

    /**
     * 修改密码
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function admin()
    {
        if (request()->method() == 'POST'){
            $mid = \session('admin')['mid'];
            $data['pass'] = md5(trim(request()->post('new_pass')));
            if (strlen(trim(request()->post('new_pass'))) < 6){
                $this->error('密码不能小于6位！');
            }
            $result = model::alter($mid,$data);
            if ($result && $result >= 1){
                $this->success('修改成功!');
            }else{
                $this->error('修改失败!');
            }
        }else{
            $data = model::sel();
            $this->assign('data',$data);
            return view('admin');
        }
    }
}
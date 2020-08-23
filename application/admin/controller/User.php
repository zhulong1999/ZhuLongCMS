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
}
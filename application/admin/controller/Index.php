<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 17:04
 */
namespace app\admin\controller;

use app\admin\model\Column;
use app\admin\model\Site;

class Index extends Common
{
    public function index(){
        return view('/index');
    }

    /**
     * 站点配置
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function site()
    {
        if (request()->method() == 'POST'){
            $req = request()->post();
            $data['site_name'] = trim($req['name']);
            $data['site_logo'] = trim($req['logo']);
            $data['site_keywords'] = trim($req['keywords']);
            $data['site_description'] = trim($req['description']);
            $result = Site::inset($data);
            if ($result && $result >= 1){
                $this->success('配置成功');
            }else{
                $this->error('配置失败');
            }
        }else{
            $result = Site::get(1000);
            $this->assign('site',$result);
            return view('/site');
        }

    }

    /**
     * 公司配置
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function company()
    {
        if (request()->method() == 'POST'){
            $req = request()->post();
            $data['company_name'] = trim($req['name']);
            $data['company_info'] = trim($req['info']);
            $data['company_code'] = trim($req['code']);
            $data['company_people'] = trim($req['people']);
            $data['company_qq'] = trim($req['qq']);
            $data['company_phone'] = trim($req['phone']);
            $data['company_fax'] = trim($req['fax']);
            $data['company_wechat'] = trim($req['wechat']);
            $data['company_email'] = trim($req['email']);
            $data['company_address'] = trim($req['address']);
            $result = Site::inset($data);
            if ($result && $result >= 1){
                $this->success('配置成功');
            }else{
                $this->error('配置失败');
            }
        }else{
            $result = Site::get(1000);
            $this->assign('company',$result);
            return view('/company');
        }
    }

    public function column()
    {
        if (request()->method() == 'post'){

        }else{
            $data = Column::sel();
            $this->assign('data',$data);
            return view('/column');
        }
    }
}



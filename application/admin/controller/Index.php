<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2020/8/21
 * Time: 17:04
 */
namespace app\admin\controller;

use app\admin\model\Access;
use app\admin\model\Article;
use app\admin\model\Column;
use app\admin\model\Message;
use app\admin\model\Other;
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

    /**
     * 添加栏目|栏目列表
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function column()
    {
        if (request()->method() == 'POST'){
            $data['title'] = trim(request()->post('title'));
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = time();
            $result = Column::create($data);
            if ($result && is_object($result)){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            $data = Column::sel();
            $this->assign('data',$data);
            return view('/column');
        }
    }

    /**
     * 修改栏目
     * @return array|\think\response\View
     * @throws \think\exception\DbException
     */
    public function column_alter()
    {
        if (request()->method() == 'POST'){
            $data =array_map(function($arr){
                return  trim($arr);
            }, request()->post());
            $result = Column::alter($data);
            if ($result && $result >= 1){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $cid = request()->get('cid');
            $data = Column::get($cid);
            $this->assign('data',$data);
            return view('/column_alter');
        }
    }
    /**
     * 栏目批量删除
     * @return array
     */
    public function column_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['cid']);
        $result = Column::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 栏目排序
     * @return array
     */
    public function column_alter_sort()
    {
        $cid = intval(request()->post('cid'));
        $sort = intval(request()->post('sort'));
        $result = Column::alter_sort($cid,$sort);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 修改栏目状态
     * @return array
     */
    public function column_alter_status()
    {
        $cid = intval(request()->post()['data'][0]);
        $status = intval(request()->post()['data'][1]) == 0?1:0;
        $result = Column::alter_status($cid,$status);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 添加子栏目
     * @return \think\response\View
     */
    public function column_add_child()
    {
        if (request()->method() == 'POST'){
            $data =array_map(function($arr){
                return  trim($arr);
            }, request()->post());
            $result = Column::create($data);
            if ($result && is_object($result)){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $this->assign('parentid',intval(request()->get('cid')));
            return view('/column_add_child');
        }
    }

    /**
     * 删除栏目
     * @return array
     */
    public function column_del()
    {
        $cid = intval(request()->post('cid'));
        $result = Column::del_all($cid);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 添加文章
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function article_add()
    {
        if (request()->method() =='POST'){
            $arr  = array_map(function($arr){
                return trim($arr);
            },request()->post());
            $data['title'] = $arr['title'];
            $data['keywords'] = $arr['keywords'];
            $data['description'] = $arr['description'];
            $data['content'] = $arr['content'];
            $data['sort'] = intval($arr['sort']);
            $data['picture'] = $arr['picture'];
            $data['typeid'] = intval($arr['typeid']);
            $data['type_title'] = $arr['type_title'];
            $data['parentid'] = intval($arr['parentid']);
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = strtotime($arr['time']);
            $result = Article::create($data);
            if ($result && is_object($result)){
                $this->success('新增成功');
            }else{
                $this->error('新增失败');
            }
        }else{
            $item = Column::where('isdelete',1)->order('sort asc,cid desc')->select();
            $this->assign('item',$item);

            return view('/article_add');
        }
    }

    /**
     * 文章列表
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function article_list()
    {
        $info = trim(request()->get('info'));
        if (!empty($info)){
            $list = Article::search($info);
        }else{
            $list = Article::sel($info);
        }
        $this->assign('url',url('Index/article_list'));
        $this->assign('page',$list->render());
        $this->assign('list',$list);
        $this->assign('title',$info);
        return view('/article_list');
    }

    /**
     * 修改文章状态
     * @return array
     */
    public function article_alter_status()
    {
        $aid = intval(request()->post()['data'][0]);
        $status = intval(request()->post()['data'][1]) == 0?1:0;
        $result = Article::alter_status($aid,$status);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 文章删除
     * @return array
     */
    public function article_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['aid']);
        $result = Article::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 文章删除
     * @return array
     */
    public function article_del()
    {
        $aid = intval(request()->post('aid'));
        $result = Article::del_all($aid);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 修改排序
     * @return array
     */
    public function article_alter_sort()
    {
        $aid = intval(request()->post('aid'));
        $sort = intval(request()->post('sort'));
        $result = Article::alter_sort($aid,$sort);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 修改文章
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function article_alter()
    {
        if (request()->method() =='POST'){
            $arr  = array_map(function($arr){
                return trim($arr);
            },request()->post());
            $data['aid'] = intval($arr['aid']);
            $data['title'] = $arr['title'];
            $data['keywords'] = $arr['keywords'];
            $data['description'] = $arr['description'];
            $data['content'] = $arr['content'];
            $data['sort'] = intval($arr['sort']);
            $data['picture'] = $arr['picture'];
            $data['typeid'] = intval($arr['typeid']);
            $data['type_title'] = $arr['type_title'];
            $data['parentid'] = intval($arr['parentid']);
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = strtotime($arr['time']);
            $result = Article::alter($data);
            if ($result && $result >= 1){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $aid = intval(request()->get('aid'));
            $item = Column::where('isdelete',1)->order('sort asc,cid desc')->select();
            $data = Article::where('aid',$aid)->find();
            $this->assign('item',$item);
            $this->assign('data',$data);
            return view('/article_alter');
        }
    }

    /**
     * 轮播图新增
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function banner_list()
    {
        if(request()->method() == 'POST'){
            $data['title'] = trim(request()->post('title'));
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = time();
            $result = Other::inse($data);
            if ($result && $result >= 1){
                $this->success('新增成功');
            }else{
                $this->error('新增失败');
            }
        }else{
            $list = Other::sel(1);
            $this->assign('list',$list);
            $this->assign('page',$list->render());
            return view('/banner_list');
        }
    }

    /**
     * 轮播图修改
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function banner_alter()
    {
        if(request()->method() == 'POST'){
            $data['oid'] = intval(request()->post('oid'));
            $data['picture'] = trim(request()->post('picture'));
            $data['title'] = trim(request()->post('title'));
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = time();
            $result = Other::alter($data);
            if ($result && $result >= 1){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $oid = intval(request()->get('oid'));
            $data = Other::get($oid);
            $this->assign('data',$data);
            $this->assign('oid',$oid);
            return view('/banner_alter');
        }
    }

    /**
     * 轮播图排序修改
     * @return array
     */
    public function banner_alter_sort()
    {
        $oid = intval(request()->post('oid'));
        $sort = intval(request()->post('sort'));
        $result = Other::alter_sort($oid,$sort);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 轮播图批量删除
     * @return array
     */
    public function banner_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['oid']);
        $result = Other::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 轮播图删除
     * @return array
     */
    public function banner_del()
    {
        $aid = intval(request()->post('oid'));
        $result = Other::del_all($aid);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 友情链接新增
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function link_list()
    {
        if(request()->method() == 'POST'){
            $data['title'] = trim(request()->post('title'));
            $data['type'] =2;
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = time();
            $result = Other::inse($data);
            if ($result && $result >= 1){
                $this->success('新增成功');
            }else{
                $this->error('新增失败');
            }
        }else{
            $list = Other::sel(2);
            $this->assign('list',$list);
            $this->assign('page',$list->render());
            return view('/link_list');
        }
    }

    /**
     * 友情链接修改
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function link_alter()
    {
        if(request()->method() == 'POST'){
            $data['oid'] = intval(request()->post('oid'));
            $data['url'] = trim(request()->post('url'));
            $data['title'] = trim(request()->post('title'));
            $data['put_id'] = session('admin')['mid'];
            $data['put_name'] = session('admin')['user'];
            $data['put_time'] = time();
            $result = Other::alter($data);
            if ($result && $result >= 1){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $oid = intval(request()->get('oid'));
            $data = Other::get($oid);
            $this->assign('data',$data);
            $this->assign('oid',$oid);
            return view('/link_alter');
        }
    }

    /**
     * 友情链接排序修改
     * @return array
     */
    public function link_alter_sort()
    {
        $oid = intval(request()->post('oid'));
        $sort = intval(request()->post('sort'));
        $result = Other::alter_sort($oid,$sort);
        if ($result && $result >=1){
            $json = ajax(200,'修改成功',$result);
        }else{
            $json = ajax(500,'修改失败');
        }
        return $json;
    }

    /**
     * 友情链接批量删除
     * @return array
     */
    public function link_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['oid']);
        $result = Other::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 友情链接删除
     * @return array
     */
    public function link_del()
    {
        $aid = intval(request()->post('oid'));
        $result = Other::del_all($aid);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 留言列表
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function message()
    {
        $name = trim(request()->get('name'));
        if (empty($name)){
            $list = Message::sel($name);
        }else{
            $list = Message::search($name);
        }
        $this->assign('name',$name);
        $this->assign('list',$list);
        $this->assign('page',$list->render());
        $this->assign('url',url('Index/message'));
        return view('/message');
    }

    /**
     * 留言删除
     * @return array
     */
    public function message_del()
    {
        $aid = intval(request()->post('mid'));
        $result = Message::del_all($aid);
        if ($result && $result >= 1) {
            $json = ajax(200, '删除成功', $result);
        } else {
            $json = ajax(500, '删除失败');
        }
        return $json;
    }

    /**
     * 留言批量删除
     * @return array
     */
    public function message_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['mid']);
        $result = Message::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    /**
     * 访问列表
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function access()
    {
        $ip = trim(request()->get('ip'));
        if (empty($ip)){
            $list = Access::sel($ip);
        }else{
            $list = Access::search($ip);
        }
        $this->assign('ip',$ip);
        $this->assign('list',$list);
        $this->assign('page',$list->render());
        $this->assign('url',url('Index/access'));
        return view('/access');
    }

    /**
     * 访问删除
     * @return array
     */
    public function access_del()
    {
        $aid = intval(request()->post('id'));
        $result = Access::del_all($aid);
        if ($result && $result >= 1) {
            $json = ajax(200, '删除成功', $result);
        } else {
            $json = ajax(500, '删除失败');
        }
        return $json;
    }

    /**
     * 访问批量删除
     * @return array
     */
    public function access_del_all()
    {
        $data = array_map(function($arr){
            return intval($arr);
        },request()->post()['id']);
        $result = Access::del_all($data);
        if ($result && $result >=1){
            $json = ajax(200,'删除成功',$result);
        }else{
            $json = ajax(500,'删除失败');
        }
        return $json;
    }

    public function system()
    {
        return view('/system');
    }

}



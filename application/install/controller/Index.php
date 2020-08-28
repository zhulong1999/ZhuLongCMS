<?php
namespace app\install\controller;

use app\admin\model\User;
use think\Controller;
use think\Db;
use think\Exception;

class Index extends Controller
{
    public function index()
    {
        return view('/index');
    }
    public function instal_two()
    {
        return view('/instal_two');
    }
    public function install_three()
    {
        return view('/instal_three');
    }
    public function instal_from(){
        if (request()->method() == 'POST'){
            $arr = array_map(function($arr){
                return trim($arr);
            },request()->post());
            $hostname = $arr['hostname'];
            $database = $arr['database'];
            $username = $arr['username'];
            $password = $arr['password'];
            $admin['user'] = $arr['user'];
            $admin['pass'] =md5( $arr['pass']);
            $admin['ip'] =request()->server()['SERVER_ADDR'];
            $admin['num'] = 1;
            $admin['time'] = time();
            $config = "
            <?php
                return [
                    // 数据库类型
                    'type'            => 'mysql',
                    // 服务器地址
                    'hostname'        => '$hostname',
                    // 数据库名
                    'database'        => '$database',
                    // 用户名
                    'username'        => '$username',
                    // 密码
                    'password'        => '$password',
                    // 端口
                    'hostport'        => '3306',
                    // 连接dsn
                    'dsn'             => '',
                    // 数据库连接参数
                    'params'          => [],
                    // 数据库编码默认采用utf8
                    'charset'         => 'utf8',
                    // 数据库表前缀
                    'prefix'          => 'cms_',
                    // 数据库调试模式
                    'debug'           => true,
                    // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
                    'deploy'          => 0,
                    // 数据库读写是否分离 主从式有效
                    'rw_separate'     => false,
                    // 读写分离后 主服务器数量
                    'master_num'      => 1,
                    // 指定从服务器序号
                    'slave_no'        => '',
                    // 是否严格检查字段是否存在
                    'fields_strict'   => true,
                    // 数据集返回类型
                    'resultset_type'  => 'array',
                    // 自动写入时间戳字段
                    'auto_timestamp'  => false,
                    // 时间字段取出后的默认时间格式
                    'datetime_format' => 'Y-m-d H:i:s',
                    // 是否需要进行SQL性能分析
                    'sql_explain'     => false,
                    // Builder类
                    'builder'         => '',
                    // Query类
                    'query'           => '\\think\\db\\Query',
                ];
            ";
           file_put_contents('../application/database.php',$config);
            Db::startTrans();//开启事务
            try{
                $sqlFile = json_decode(file_get_contents('.\zhulongCMS.json'));
                foreach ($sqlFile as $key=>$value){
                  Db::execute($value->sql);
                }
                User::inst($admin);
                return view('/instal__from');
                Db::commit();//提交事务
            }catch (Exception $e){
                Db::rollback();
                $code = $e->getCode();
                switch ($code){
                    case 10501:
                        $this->success('已安装！',url('/'));
                        break;
                    default:
                        $this->error('安装失败',url('Index/index'));
                }
            }


        }else{
            $this->error("非法访问！",url('Index/index'));
        }


    }
}

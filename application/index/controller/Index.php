<?php
namespace app\index\controller;
vendor('taglib.Db');
class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>😀</h1><p> ZhuLongCMS V1.0<br/><span style="font-size:30px">为企业网站开发的轻量级CMS后台管理系统</span></p><span style="font-size:22px;">[ V1.0 版本由 <a href="https://zhulong1999.github.io/" target="zhulong">燭龍工作室</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function demo()
    {
        return view('/demo');
    }
    public function demo1()
    {
        $list   = \Db::type(8);
        $aa=  $list;
       dump(json_encode($aa));
    }
}

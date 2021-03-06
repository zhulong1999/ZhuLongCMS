# ZhuLongCMS
> 使用ThinkPHP5开发的一款轻量级企业CMS后台管理系统可供个人或企业使用
>
> 燭龍博客：www.rick1999.top
>
> 燭龍工作室: www.zhulong1999.github.io

## 许可协议

版权所有燭龍工作室保留所有权利。

感谢您选燭龍工作室管理系统，燭龍工作室是目前国内最强大、最稳定的中小型门户网站建设解决方案之一，基于 PHP + MySQL 的技术开发

燭龍工作室的官方网址是： [爥龙工作室](https://zhulong1999.github.io/) 交流论坛：

为了使你正确并合法的使用本软件，请你在使用前务必阅读清楚下面的协议条款：

**一、本授权协议适用且仅适用于 版权所有燭龍工作室保留所有权利版本，官方对本授权协议的最终解释权。****二、协议许可的权利**

2、您可以在协议规定的约束和限制范围内修改，燭龍工作室源代码或界面风格以适应您的网站要求。

3、您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。

4、获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。

**二、协议规定的约束和限制**

1、未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目的或实现盈利的网站）。购买商业授权请登陆 [燭龍工作室](https://zhulong1999.github.io/) 了解最新说明。

2、未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。

3、不管你的网站是否整体使用 ，还是部份栏目使用，在你使用了燭龍工作室的网站主页上必须加上燭龍工作室的官方网址([燭龍工作室](https://zhulong1999.github.io/))的链接。

4、未经官方许可，禁止在燭龍工作室的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。

5、如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。

**三、有限担保和免责声明**

1、本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。

2、用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。

3、电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装 燭龍工作室即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。

4、如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。

**协议发布时间：** 2020年1月18日

**版本最新更新：** 2020年1月21日

## 安装系统：

1. 访问 当前URL/install
2. 阅读许可协议并同意
3. 开启相关PHP扩展或目录权限
4. 填写数据库相关信息并且设置管理员初始密码
5. 最后点击安装

## 进入系统

- 访问当前URL/admin
- 输入管理员账号 默（ 账号：admin 密码：admin123}
- 点击登录

# zhulongcms 数据字典

### cms_access访问表

| 字段名   | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注       |
| -------- | ------------ | ------ | -------- | -------- | ---------- |
| id       | bigint(20)   |        | NO       | 是       |            |
| ip       | varchar(50)  |        | YES      |          | ip         |
| num      | int(11)      |        | YES      |          | 访问次数   |
| view     | varchar(100) |        | YES      |          | 访问视图   |
| time     | int(11)      |        | YES      |          | 访问时间   |
| isdelete | int(11)      | 1      | YES      |          | 0删除1正常 |

### cms_admin管理员表

| 字段名   | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注            |
| -------- | ------------ | ------ | -------- | -------- | --------------- |
| mid      | bigint(20)   |        | NO       | 是       |                 |
| user     | varchar(50)  |        | NO       |          | 后台账号        |
| pass     | varchar(200) |        | YES      |          | 后台密码        |
| num      | int(11)      |        | YES      |          | 登录次数        |
| time     | int(11)      |        | YES      |          | 最后登录        |
| ip       | varchar(50)  |        | YES      |          | 登录ip          |
| isdelete | int(11)      | 1      | YES      |          | 0冻结1正常2删除 |

### cms_article文章表

| 字段名      | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注            |
| ----------- | ------------ | ------ | -------- | -------- | --------------- |
| aid         | bigint(20)   |        | NO       | 是       |                 |
| title       | varchar(50)  |        | YES      |          | 文章标题        |
| parentid    | int(11)      | 0      | YES      |          | 文章父栏目id    |
| typeid      | int(11)      |        | YES      |          | 文章子栏目id    |
| type_title  | varchar(50)  |        | YES      |          | 文章子栏目名称  |
| picture     | varchar(100) |        | YES      |          | 文章首图        |
| sort        | int(11)      |        | YES      |          | 文章排序        |
| keywords    | varchar(200) |        | YES      |          | 文章关键字      |
| description | varchar(500) |        | YES      |          | 文章描述        |
| content     | text         |        | YES      |          | 文章内容        |
| put_id      | int(11)      |        | YES      |          | 录入人id        |
| put_name    | varchar(20)  |        | YES      |          | 录入人          |
| put_time    | int(11)      |        | YES      |          | 录入时间        |
| isdelete    | int(11)      | 1      | YES      |          | 0冻结1正常2删除 |

### cms_column栏目表

| 字段名      | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注                               |
| ----------- | ------------ | ------ | -------- | -------- | ---------------------------------- |
| cid         | int(11)      |        | NO       | 是       |                                    |
| parentid    | int(11)      | 0      | YES      |          | 父级id 1父级                       |
| title       | varchar(20)  |        | YES      |          | 栏目标题                           |
| type        | int(11)      | 0      | YES      |          | 栏目类型 1内容页2列表页3图片列表页 |
| keywords    | varchar(100) |        | YES      |          | 栏目关键字                         |
| description | varchar(500) |        | YES      |          | 栏目描述                           |
| sort        | int(11)      |        | YES      |          | 栏目排序                           |
| put_id      | int(11)      |        | YES      |          | 录入人id                           |
| put_name    | varchar(20)  |        | YES      |          | 录入人                             |
| put_time    | int(11)      |        | YES      |          | 录入时间                           |
| isdelete    | int(11)      | 1      | YES      |          | 0冻结1正常2删除                    |

### cms_message留言表

| 字段名   | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注         |
| -------- | ------------ | ------ | -------- | -------- | ------------ |
| mid      | bigint(20)   |        | NO       | 是       |              |
| ip       | varchar(50)  |        | YES      |          |              |
| name     | varchar(100) |        | YES      |          | 留言名字     |
| phone    | varchar(100) |        | YES      |          | 留言电话号码 |
| message  | text         |        | YES      |          | 留言信息     |
| address  | varchar(200) |        | YES      |          | 留言地址     |
| sort     | int(11)      |        | YES      |          | 排序         |
| time     | int(11)      |        | YES      |          | 留言时间     |
| isdelete | int(11)      | 1      | YES      |          | 0删除1正常   |

### cms_other杂项表 友情链接or轮播图

| 字段名   | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注             |
| -------- | ------------ | ------ | -------- | -------- | ---------------- |
| oid      | bigint(20)   |        | NO       | 是       |                  |
| type     | int(11)      | 1      | YES      |          | 1轮播图2友情链接 |
| title    | varchar(100) |        | YES      |          | 标题             |
| url      | varchar(200) |        | YES      |          | 链接             |
| picture  | varchar(200) |        | YES      |          | 轮播图           |
| sort     | int(11)      |        | YES      |          | 排序             |
| put_id   | int(11)      |        | YES      |          | 录入人id         |
| put_name | varchar(100) |        | YES      |          | 录入人           |
| put_time | int(11)      |        | YES      |          | 录入时间         |
| isdelete | int(11)      | 1      | YES      |          | 0删除1正常       |

### cms_site公司站点信息表

| 字段名           | 数据类型     | 默认值 | 允许非空 | 自动递增 | 备注         |
| ---------------- | ------------ | ------ | -------- | -------- | ------------ |
| cid              | int(11)      |        | YES      |          |              |
| site_name        | varchar(100) |        | YES      |          | 站点名称     |
| site_logo        | varchar(200) |        | YES      |          | 站点logo     |
| site_keywords    | varchar(200) |        | YES      |          | 站点关键词   |
| site_description | varchar(500) |        | YES      |          | 站点描述     |
| company_name     | varchar(100) |        | YES      |          | 公司名称     |
| company_info     | text         |        | YES      |          | 公司信息     |
| company_code     | varchar(100) |        | YES      |          | 公司邮政编码 |
| company_people   | varchar(50)  |        | YES      |          | 公司联系人   |
| company_qq       | varchar(20)  |        | YES      |          | 公司qq       |
| company_phone    | varchar(20)  |        | YES      |          | 公司电话号码 |
| company_fax      | varchar(20)  |        | YES      |          | 公司传真     |
| company_wechat   | varchar(50)  |        | YES      |          | 公司微信     |
| company_email    | varchar(50)  |        | YES      |          | 公司邮箱     |
| company_address  | varchar(200) |        | YES      |          | 公司地址     |
| put_id           | int(11)      |        | YES      |          | 录入人id     |
| put_name         | varchar(50)  |        | YES      |          | 录入人name   |
| put_time         | int(11)      |        | YES      |          | 录入人时间   |
| isdelete         | int(11)      | 1      | YES      |          | 0删除1正常   |

## ZhuLongCMS教程

#### 站点标签

```php+HTML
//站点标签  格式 *name 必填
//站点标题  列如：site_name '标题'  site_keywords '站点关键字'
//ps：name的参数 可更具站点表来查询相关的字段
{Zl:site  name='site_name'/}
```

#### 栏目标签

```
//父栏目标签 格式 {Zl:type num='8'}{/zl:type}  *num必填 想要查询多少条栏目
//子栏目标签 格式 {Zl:type_son num='8' parentid='$vo["cid"]' }
//*num parentid 必填 parentid 父栏目id 格式 {$vo["cid"]}来填写
//实列
{Zl:type num='8'}
		//titlt 根据栏目表来写
        {$vo.title}--父
    <br>
    //遍历子栏目
        {Zl:type_son num='8' parentid='$vo["cid"]' }
       ----- {$vo.title}--子
        <br>
        {/Zl:type_son}
    {/Zl:type}

```


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $Title; ?> - <?php echo $Powered; ?></title>
        <link rel="stylesheet" href="./css/install.css?v=9.0" />
    </head>
    <body>
        <div class="wrap">
            <?php require './templates/header.php'; ?>
            <div class="section">
                <div class="main cc">
                    <pre class="pact" readonly="readonly">
HuiCMS内容管理系统使用协议
本通用后台为 <b><a href="http://t.qq.com/php200" target="_blank">@そ神僮な尛孓</a></b> 为QQ群：306078113 群友学习参考用，其中没有做过多数据过滤完全考虑和界面兼容处理，如果你将本通用后台使用于你自己的系统中，请自行处理（不过不会有太多的问题）。

<b>本系统包含以下功能：</b>

1、RBAC权限管理功能；
   便捷地对系统中用户进行权限分配，所以权限分配可以在一个页面分配完成。

2、会员管理版块；
   基本的会员新增、修改、删除，审核。  

3、第三方同步登录模块

4、备份、还原数据库，打包已备份sql文件
   备份数据量大时，系统会自动分隔备份成多个sql文件，每个sql文件头部记录了当前sql文件包含了那些表数据。支持其他软件导入的sql文件导入（支持导入>200M的sql文件，目前只测试过200M左右的sql文件，虽然支持但是还是不建议这么做）。

5、管理员登录日志及地区显示

6、可简单性的管理验证码

7、数据优化修复功能
   你可以轻松优化修复你的mysql数据库。

8、模块管理，自定义开发内容模块

9、菜单、菜单项管理，灵活的内容分配，可以指定菜单项绑定的内容，并支持无限级菜单项

<b>特别说明：</b>
1、本向导是直接拿 @永不言弃 的项目向导修改的；
2、后面界面设计是来自互联网，排版是本人完成的；
3、由于使用本后台系统出现任何安全问题、数据文件等其他其他与本人无关，请考虑后用。
4、需要打开REWRITE,配置虚拟主机

版权所有(c)2010-2013，<a href="http://www.huicms.cn" target="_blank" >www.huicms.cn</a> 保留所有权力。</a></pre>
                </div>
                <div class="bottom tac"> <a href="./index.php?step=2" class="btn">接 受</a> </div>
            </div>
        </div>
        <?php require './templates/footer.php'; ?>
    </body>
</html>
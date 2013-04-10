<?php
return array(
	//'配置项'=>'配置值'
    'APP_STATUS' => 'debug',                //调试模式
    'SHOW_PAGE_TRACE' => false,              // 显示页面Trace信息
    'URL_MODEL' => 2,                       //URL访问模式支持 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式);3 (兼容模式)
    'APP_GROUP_LIST' => 'Ucenter,Admin',    //项目分组设定
    'DEFAULT_GROUP'  => 'Ucenter',          //默认分组
    //类库
    'APP_AUTOLOAD_PATH' => '@.Common',
     //数据库信息
    'DB_TYPE' => 'mysql',                   // 数据库类型
    'DB_NAME' => 'huicms', // 数据库名
    'DB_HOST' => 'localhost',               // 服务器地址
    'DB_USER' => 'root',                    // 用户名
    'DB_PWD' => '123456',                   // 密码
    'DB_PORT' => 3306,                      // 端口
    'DB_PREFIX' => 'hui_',                   // 数据库表前缀
    //布局默认信息
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'layout',
    'DATA_CACHE_SUBDIR'=>true,
    'LANG_LIST' => 'zh-cn',                 // 允许切换的语言列表 用逗号分隔
    'DEFAULT_LANG'          =>'zh-cn',      //默认使用的语言包
    'DEFAULT_THEME'         =>'Default',    //默认模板
    'DATA_PATH_LEVEL'=>2
);
?>
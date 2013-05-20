<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = '新浪微薄登录';
    $modules[$i]['desc'] = '申请地址：http://open.sina.com.cn/';
    $modules[$i]['author'] = 'HUICMS研发团队';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array(
        array('name' => 'app_key', 'type' => 'text', 'value' => ''),
        array('name' => 'app_secret', 'type' => 'text', 'value' => '')
    );
    return;
}
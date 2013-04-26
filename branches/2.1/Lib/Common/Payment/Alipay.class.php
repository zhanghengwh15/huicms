<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = '支付宝';
    $modules[$i]['desc'] = '支付宝是国内领先的独立第三方支付平台，由阿里巴巴集团创办。致力于为中国电子商务提供“简单、安全、快速”的在线支付解决方案。<a href="http://fun.alipay.com/xtsz/phpcms.htm" target="_blank"><font color="red">立即在线申请</font></a>';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'HUICMS研发团队';
    $modules[$i]['website'] = 'http://www.alipay.com';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array(
        array('name' => 'alipay_account', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_key', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_partner', 'type' => 'text', 'value' => ''),
        array('name' => 'service_type', 'type' => 'select', 'value' => '0'),
    );
    return;
}
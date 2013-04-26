<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = '网银在线';
    $modules[$i]['desc'] = '网银在线与中国银行、中国工商银行、中国农业银行、中国建设银行、招商银行等国内各大银行，以及VISA、MasterCard、JCB等国际信用卡组织保持了长期、紧密、良好的合作关系。<a href="http://www.chinabank.com.cn" target="_blank"><font color="red">立即在线申请</font></a>';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '0';
    $modules[$i]['author'] = 'HUICMS研发团队';
    $modules[$i]['website'] = 'http://www.chinabank.com.cn';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array();
    return;
}
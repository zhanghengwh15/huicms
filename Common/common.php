<?php
/**
 * PHP发送请求
 * @author Terry <admin@huicms.cn>
 * @date 2013-05-14
 * @param string $url 请求地址
 */
function location($url){
	echo "<script language='javascript'>window.location.href='{$url}';</script>";
}

/**
 * PHP发送异步请求
 * @author Terry <admin@huicms.cn>
 * @date 2013-05-14
 * @param string $url 请求地址
 * @param array $param 请求参数
 * @param string $httpMethod 请求方法GET或者POST
 * @return boolean
 * @link http://www.thinkphp.cn/code/71.html
 */
function makeRequest($url, $param, $httpMethod = 'GET') {
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    if ($httpMethod == 'GET') {
        curl_setopt($oCurl, CURLOPT_URL, $url . "?" . http_build_query($param));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    } else {
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($param));
    }
    
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return FALSE;
    }
}
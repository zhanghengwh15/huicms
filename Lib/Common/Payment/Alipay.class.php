<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = '支付宝';
    $modules[$i]['desc'] = '支付宝是国内领先的独立第三方支付平台，由阿里巴巴集团创办。致力于为中国电子商务提供“简单、安全、快速”的在线支付解决方案。<a href="http://b.alipay.com/" target="_blank"><font color="red">立即在线申请</font></a>';
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
class Alipay{
    //默认支付宝接口类型
    private $alipay_method = "create_direct_pay_by_user";
    //支付宝合作伙伴ID号
    private $alipay_partner = "";
    //支付宝收款帐号
    private $alipay_account = "";
    //支付宝交易key
    private $alipay_key = "";
    //自定义支付单号
    private $pay_id = 0;
    
    /**
     * 初始化
     * @date 2013-05-14
     * @param int $int_payid 自定义支付配置ID
     * @param array $array_params 商家支付宝配置信息
     */
    public function __construct($int_payid, $array_params) {
        $this->alipay_method = $array_params["alipay_pay_method"];
        $this->alipay_partner = $array_params["alipay_partner"];
        $this->alipay_account = $array_params["alipay_account"];
        $this->alipay_key = $array_params["alipay_key"];
        $this->pay_id = $int_payid;
    }

}
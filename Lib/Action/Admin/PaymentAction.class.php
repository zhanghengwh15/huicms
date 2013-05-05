<?php
/**
 * 支付方式模块
 * @author Terry<admin@huicms.cn>
 * @date 2013-04-26
 */
class PaymentAction extends AdminAction{
    private $payment = '';
    public function _initialize() {
        parent::_initialize();
        $this->file_path = HCMS_PATH.'Lib'.DIRECTORY_SEPARATOR.'Common'.DIRECTORY_SEPARATOR.'Payment'.DIRECTORY_SEPARATOR;
        $this->payment = new Payment($this->file_path);
    }


    /**
     * 支付方式列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-04-26
     */
    public function index(){
        $list = $this->payment->getList();
//        echo "<pre>";print_r($list);exit;
        $this->assign("data",$list);
        $this->display();
    }
    
    /**
     * 安装及配置
     * @author Terry<admin@huicms.cn>
     * @date 2013-04-28
     */
    public function addPayment(){
        $ary_get = $this->_get();
        $list = $this->payment->getPayment($ary_get['id']);
        echo "<pre>";print_r($ary_get);exit;
        $this->display();
        
    }
    
}
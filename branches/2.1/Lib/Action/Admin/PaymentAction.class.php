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
        if(!empty($ary_get['type']) && isset($ary_get['type'])){
            $list = array();
            switch ($ary_get['type']){
                case 'install':
                    $list = $this->payment->getPayment($ary_get['code']);
                    extract($list);
                    break;
                case 'settings':
                    $list = M("Payment")->where(array('pay_id'=>$ary_get['id']))->find();
                    extract($list);
                    break;
            }
//            echo "<pre>";print_r($list);exit;
            $this->assign("list",$list);
            $this->display();
        }else{
            $this->error("操作有误，请重试...");
        }
    }
    
}
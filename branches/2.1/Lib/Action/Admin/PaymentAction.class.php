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
                    if(!empty($list) && is_array($list)){
                        $list['config'] = json_decode($list['pay_config'],true);
                    }
                    break;
            }
//            echo "<pre>";print_r($list);exit;
            $this->assign("list",$list);
            $this->display();
        }else{
            $this->error("操作有误，请重试...");
        }
    }
    
    /**
     * 安装及修改支付方式信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-09
     */
    public function doSavePayment(){
        $ary_post = $this->_post();
        $name = $this->getActionName();
        $ary_data = $this->payment->getPayment($ary_post['pay_code']);
        $config = $ary_data['config'];
        if(!empty($ary_post['config_name']) && is_array($ary_post['config_name'])){
            
        }
        foreach ($ary_post['config_name'] as $key => $value) {
            $config[$value]['value'] = trim($ary_post['config_value'][$key]);
        }
        $data = array();
        $data['name'] = $ary_post['name'];
        $data['pay_name'] = $ary_post['pay_name'];
        $data['pay_is_online'] = $ary_post['pay_is_online'];
        $data['pay_is_cod'] = $ary_post['pay_is_cod'];
        $data['pay_fee'] = $ary_post['pay_is_cod'] ? $ary_post['pay_fix'] : $ary_post['pay_rate'];
        $data['pay_order'] = $ary_post['pay_order'];
        $data['pay_status'] = '1';
        $data['pay_website'] = $ary_data['pay_website'];
        $data['pay_desc'] = $ary_post['pay_desc'];
        $data['pay_code'] = $ary_post['pay_code'];
        $data['pay_version'] = $ary_data['pay_version'];
        $data['pay_author'] = $ary_data['pay_author'];
        $data['pay_config'] = json_encode($config);
        
        $ary_result = D($name)->add($data);
        if(FALSE !== $ary_result){
            $this->success("安装成功");
        }else{
            $this->error("安装失败");
        }
    }
    
    /**
     * 卸载支付宝列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-09
     */
    public function doDelete(){
        $ary_get = $this->_get();
        if(!empty($ary_get['pay_id']) && isset($ary_get['pay_id'])){
            $name = $this->getActionName();
            $ary_result = D($name)->where(array('pay_id'=>$ary_get['pay_id']))->delete();
            if(FALSE !== $ary_result){
                $this->success("卸载成功");
            }else{
                $this->success("卸载失败");
            }
        }else{
            $this->error("数据存在错误");
        }
    }
}
<?php
/**
 * 第三方统一登陆模块
 * @author Terry<admin@huicms.cn>
 * @date 2013-05-13
 */
class OauthAction extends HomeAction{
    
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        
    }
    
    public function OtherLogin(){
        $ary_get = $this->_get();
        echo "<pre>";print_r($ary_get);exit;
    }
}
<?php
/**
 * 前台会员模块控制器
 *
 * @package Action
 * @subpackage Home
 * @stage 1.0
 * @author Terry <admin@huicms.cn>
 * @date 2013-05-28
 */
class UserAction extends HomeAction{
    
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $this->redirect(U('User/Login'));
    }
    
    public function Login(){
        
    }
    
    public function Register(){
        $this->display();
    }
    
    
}
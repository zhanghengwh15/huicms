<?php

class NavAction extends AdminAction{
    
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 导航列表
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-23
     */
    public function index(){
        
        $this->display();
        
    }
    
    /**
     * 添加导航
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-23
     */
    public function addNav(){
        
        $this->display();
        
    }
}

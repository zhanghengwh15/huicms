<?php
/**
 * 后台全局设置操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-4-18
 * 
 */
class SettingAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-18
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        
        $this->display();
        
    }
}
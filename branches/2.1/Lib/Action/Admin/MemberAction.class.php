<?php
/**
 * 会员模块
 * @author  Terry<admin@huicms.cn>
 * @date 2013-05-13
 */
class MemberAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-13
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 会员列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-13
     */
    public function index(){
        
        
        $this->display(); 
    }
}
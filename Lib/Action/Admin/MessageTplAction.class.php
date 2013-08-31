<?php
/**
 * 通知模版
 * @package Action
 * @subpackage MessageTpl
 * @author Terry
 * @since 7.2
 * @version 1.0
 * @date 2013-08-31
 */
class MessageTplAction extends AdminAction{
    
    /**
     * 控制器初始化
     * @author Terry <admin@huicms.cn>
     * @date 2013-08-31
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $name = $this->getActionName();
        $messagetpl = D($name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $messagetpl->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $messagetpl->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data", $ary_data);        
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
}

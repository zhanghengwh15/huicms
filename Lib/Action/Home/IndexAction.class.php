<?php
/**
 * 前台展厅控制器
 *
 * @package Action
 * @subpackage Home
 * @stage 1.0
 * @author Terry <admin@52sum.com>
 * @date 2013-04-15
 */
class IndexAction extends HomeAction{
    /**
     * 基类初始化操作
     * @author Terry <admin@52sum.com>
     * @date 2012-04-15
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $this->display();
    }
    
    public function demo(){
        $ary_title = array(
            'name'  =>  'toolss'
        );
        $this->assign("title",  $ary_title);
        $this->display();
    }
    
}
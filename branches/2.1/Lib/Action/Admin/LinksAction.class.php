<?php
/**
 * 后台友情链接模块操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-04-14
 * 
 */
class LinksAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function index() {
        $this->redirect(U('Admin/Links/pageList'));
    }
    
    /**
     * 角色列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-04-14
     */
    public function pageList(){
        
    }
    
    /**
     * 添加友情链接
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function addLinks(){
        $this->display();
    }
}
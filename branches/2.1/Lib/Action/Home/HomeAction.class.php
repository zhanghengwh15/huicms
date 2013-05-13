<?php
/**
 * 前台展厅控制器基类
 *
 * @package Action
 * @subpackage Home
 * @stage 1.0
 * @author Terry <admin@huicms.cn>
 * @date 2013-05-13
 */
abstract class HomeAction extends Action{
    
    /**
     * 基类初始化操作
     * @author Terry <admin@52sum.com>
     * @date 2012-04-15
     */
    public function _initialize() {
        import('ORG.Util.Page');
    }
}

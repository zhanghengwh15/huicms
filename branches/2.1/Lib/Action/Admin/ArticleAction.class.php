<?php
/**
 *
 * 文章模块操作
 *
 * @package      	HuiCms
 * @author          Terry QQ:466209365 <admin@52sum.com>
 * @copyright     	Copyright (c) 20012-2013  (http://www.huicms.cn)
 * @license         http://www.huicms.cn/license.txt
 * @version        	Huicms企业网站管理系统 v1.0 2013-04-14 huicms.cn $
 */
class ArticleAction extends AdminAction{
    
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 文章列表
     * @author Terry<admin@52sum.com>
     * @date 2013-07-02
     */
    public function index(){
        
        $this->display();
        
    }
    
    public function addArticle(){
        
        $this->display();
        
    }
}
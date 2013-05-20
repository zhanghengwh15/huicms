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
        $this->_title();        //获取网站标题信息
        $this->_oauth();        //获取登录授权
        if(!C('site_status')){
            header('Content-Type:text/html; charset=utf-8');
            exit(C('site_close'));
        }
        import('ORG.Util.Page');
    }
    
    public function _title(){
        //SEO
        $config = D("Config")->getCfgByModule("WEBSITE");
        $page_seo = json_decode($config['WEBSITE'],true);
//        echo "<pre>";print_r($page_seo);exit;
        C($page_seo);
        $this->assign($page_seo);
    }
    
    public function _oauth(){
        $oauth = D("Oauth")->where(array('status'=>'1'))->select();
        if(!empty($oauth) && is_array($oauth)){
            foreach($oauth as $key => $val){
                $oauth[$key]['type'] = strtolower($val['code']);
                
            }
        }
//        echo "<pre>";print_r($oauth);exit;
        $this->assign("oauth",$oauth);
    }
    
    public function _empty() {
        $this->_404();
    }
    
    protected function _404($url = '') {
        if ($url) {
            redirect($url);
        } else {
            send_http_status(404);
            $this->display(TMPL_PATH . '404.html');
            exit;
        }
    }
}

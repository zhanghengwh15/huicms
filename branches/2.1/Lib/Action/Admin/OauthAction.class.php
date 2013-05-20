<?php
class OauthAction extends AdminAction{
    
    private $oauth = '';
    
    public function _initialize() {
        parent::_initialize();
        $this->file_path = HCMS_PATH.'Lib'.DIRECTORY_SEPARATOR.'Common'.DIRECTORY_SEPARATOR.'Oauth'.DIRECTORY_SEPARATOR;
        $this->oauth = new Oauth($this->file_path);
    }
    
    public function index(){
        $list = $this->oauth->getList();
        $this->assign("data",$list);
        $this->display();
    }
    
    /**
     * 安装及配置
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-19
     */
    public function addOauth(){
        
        $ary_get = $this->_get();
//        echo "<pre>";print_r($ary_get);exit;
        if(!empty($ary_get['type']) && isset($ary_get['type'])){
            $list = array();
            switch ($ary_get['type']){
                case 'install':
                    $list = $this->oauth->getOauth($ary_get['code']);
                    extract($list);
                    break;
                case 'settings':
                    $list = M("Oauth")->where(array('id'=>$ary_get['id']))->find();
                    extract($list);
                    if(!empty($list) && is_array($list)){
                        $list['config'] = json_decode($list['config'],true);
                    }
                    break;
            }
//            echo "<pre>";print_r($list);exit;
            $this->assign("list",$list);
            $this->display();
        }else{
            $this->error("操作有误，请重试...");
        }
    }
}
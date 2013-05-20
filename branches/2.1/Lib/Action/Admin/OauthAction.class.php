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
            if(!empty($ary_get['type']) && $ary_get['type'] == 'settings'){
                $this->display("editOauth");
            }else{
                $this->display();
            }
            
        }else{
            $this->error("操作有误，请重试...");
        }
    }
    
    /**
     * 安装及修改登录接口信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-09
     */
    public function doSaveOauth(){
        $name = $this->getActionName();
        
        $ary_post = $this->_post();
        $ary_data = $this->oauth->getOauth($ary_post['code']);
        
        $config = array();
        if(!empty($ary_post['config_value']) && is_array($ary_post['config_value'])){
            foreach($ary_post['config_value'] as $key=>$val){
                $config[$ary_post['config_name'][$key]] = $val;
            }
        }
        $data = array();
        $data['name'] = $ary_post['name'];
        $data['order'] = "10";
        $data['status'] = '1';
        $data['description'] = $ary_post['description'];
        $data['code'] = $ary_post['code'];
        $data['version'] = $ary_data['version'];
        $data['author'] = $ary_data['author'];
        $data['config'] = json_encode($config);
        $msgstr = '';
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $ary_result = D($name)->where(array('id'=>$ary_post['id']))->data($data)->save();
            $msgstr = '编辑';
        }else{
            $ary_result = D($name)->add($data);
            $msgstr = '安装';
        }
        
        if(FALSE !== $ary_result){
            $this->success($msgstr ."成功");
        }else{
            $this->error($msgstr ."失败");
        }
    }
    
    
}
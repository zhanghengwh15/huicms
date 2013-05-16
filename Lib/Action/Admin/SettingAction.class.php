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
        $ary_data = D('Config')->getCfgByModule('WEBSITE');
        $config = json_decode($ary_data['WEBSITE'], true);
//        echo "<pre>";print_r($config);exit;
        $this->assign("config",$config);
        $this->display();
        
    }
    
    /**
     * 站点信息
     * @author  Terry<admin@52sum.com>
     * @date 2013-04-20
     */
    public function doSaveWebsite(){
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            $module = "WEBSITE";
            $key = "WEBSITE";
            $value = json_encode($ary_post);
            $desc = "站点信息配置";
            $config = D("Config")->setConfig($module,$key,$value,$desc);
            if(FALSE !== $config){
                $this->success("保存成功");
            }else{
                $this->error("保存失败");
            }
        }else{
            $this->error("数据有误");
        }
    }
}
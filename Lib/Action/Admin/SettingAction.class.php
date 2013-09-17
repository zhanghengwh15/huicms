<?php
/**
 * 后台全局设置操作ACTION
 * @author Terry<admin@huicms.cn>
 * @date 2013-4-18
 * 
 */
class SettingAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@huicms.cn>
     * @date 2013-04-18
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $data = array();
        $ary_request = $this->_request();
        //站点配置信息
        $webConf = D('Config')->getCfgByModule('WEBSITE');
        $config = json_decode($webConf['WEBSITE'], true);
        $data['webConf'] = $config;
        
        //验证码配置信息
        $vercodeConf = D('Config')->getCfgByModule('CODE_SET');
        if(!empty($vercodeConf) && is_array($vercodeConf)){
            $vercodeConf['RECODESIZE'] = json_decode($vercodeConf['RECODESIZE'],true);
            $vercodeConf['BACODESIZE'] = json_decode($vercodeConf['BACODESIZE'],true);
        }
        $data['vercode'] = $vercodeConf;
        
        //邮箱设置
        $mailConf = D('Config')->getCfgByModule('MAILSET');
        $ary_mailconf = json_decode($mailConf['MAILSET'], true);
        $data['mailconf'] = $ary_mailconf;
        $this->assign("filter",$ary_request);
        $this->assign($data);
        $this->display();
        
    }
    
    /**
     * 站点信息
     * @author  Terry<admin@huicms.cn>
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
                $this->success("保存成功",U("Admin/Setting/index",array('form_index'=>'web_conf')));
            }else{
                $this->error("保存失败");
            }
        }else{
            $this->error("数据有误");
        }
    }
    
    /**
     * 验证码配置
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-09
     */
    public function verCode(){
        $ary_data = D('Config')->getCfgByModule('CODE_SET');
        if(!empty($ary_data) && is_array($ary_data)){
            $ary_data['RECODESIZE'] = json_decode($ary_data['RECODESIZE'],true);
            $ary_data['BACODESIZE'] = json_decode($ary_data['BACODESIZE'],true);
        }
        $this->assign("config",$ary_data);
        $this->display();
    }
    
    public function doVerCode(){
        $ary_post = $this->_post();
        $SysSeting = D('Config');
        if(!isset($ary_post['MREGISTER']) && empty($ary_post['MREGISTER'])){
            $ary_post['MREGISTER'] = '0';
        }
        if(!isset($ary_post['RELOGIN']) && empty($ary_post['RELOGIN'])){
            $ary_post['RELOGIN'] = '0';
        }
        if(!isset($ary_post['BALOGIN']) && empty($ary_post['BALOGIN'])){
            $ary_post['BALOGIN'] = '0';
        }
        if(!isset($ary_post['REWIDTH']) && empty($ary_post['REWIDTH']) && intval($ary_post['REWIDTH']) =='0'){
            $ary_post['REWIDTH'] = '70';
        }
        if(!isset($ary_post['REHEIGHT']) && empty($ary_post['REHEIGHT']) && intval($ary_post['REHEIGHT']) =='0'){
            $ary_post['REHEIGHT'] = '30';
        }
        if(!isset($ary_post['BAWIDTH']) && empty($ary_post['BAWIDTH']) && intval($ary_post['BAWIDTH']) =='0'){
            $ary_post['BAWIDTH'] = '100';
        }
        if(!isset($ary_post['BAHEIGHT']) && empty($ary_post['BAHEIGHT']) && intval($ary_post['BAHEIGHT']) =='0'){
            $ary_post['BAHEIGHT'] = '38';
        }
        $recodesize = array(
            'width' => $ary_post['REWIDTH'],
            'height' => $ary_post['REHEIGHT']
        );
        $ary_post['RECODESIZE'] = json_encode($recodesize);
        $becodesize = array(
            'width' => $ary_post['BAWIDTH'],
            'height' => $ary_post['BAHEIGHT']
        );
        $ary_post['BACODESIZE'] = json_encode($becodesize);
//        echo "<pre>";print_r($ary_post);exit;
         if(
            $SysSeting->setConfig('CODE_SET', 'MREGISTER', $ary_post['MREGISTER'], '会员注册') &&
            $SysSeting->setConfig('CODE_SET', 'RELOGIN', $ary_post['RELOGIN'], '前台登陆') &&
            $SysSeting->setConfig('CODE_SET', 'BALOGIN', $ary_post['BALOGIN'], '后台登陆') && 
            $SysSeting->setConfig('CODE_SET', 'BUILDTYPE', $ary_post['BUILDTYPE'], '验证码生成类型') &&
            $SysSeting->setConfig('CODE_SET', 'EXPANDTYPE', $ary_post['EXPANDTYPE'], '选择验证码文件类型') &&
            $SysSeting->setConfig('CODE_SET', 'RECODESIZE', $ary_post['RECODESIZE'], '前台验证码图片大小') && 
            $SysSeting->setConfig('CODE_SET', 'BACODESIZE', $ary_post['BACODESIZE'], '后台验证码图片大小') &&
            $SysSeting->setConfig('CODE_SET', 'RECODENUMS', $ary_post['RECODENUMS'], '前台验证码字数') &&
            $SysSeting->setConfig('CODE_SET', 'BACODENUMS', $ary_post['BACODENUMS'], '后台验证码字数')
        ){
             $this->success("保存成功",U("Admin/Setting/index",array('form_index'=>'vercode_conf')));
        }else{
            $this->error('保存失败');
        }
    }
    
    /**
     * 邮箱设置
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-31
     */
    public function doMailConf(){
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            $module = "MAILSET";
            $key = "MAILSET";
            $value = json_encode($ary_post);
            $desc = "站点信息配置";
            $config = D("Config")->setConfig($module,$key,$value,$desc);
            if(FALSE !== $config){
                $this->success("保存成功",U("Admin/Setting/index",array('form_index'=>'mail_conf')));
            }else{
                $this->error("保存失败");
            }
        }else{
            $this->error("数据有误");
        }
    }
    
    /**
     * 测试邮件发送
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-31
     */
    public function testSendMail(){
        $ary_get = $this->_get();
        $smtp = new SendMail($ary_get);
        if($error = $smtp->getError()){
            $this->error($error);
        }else{
            if(!empty($ary_get['test_address'])){
                $title    = '邮件测试--HuiCMS内容管理系统';
                $content  = '这是一封测试邮件';
                if($smtp->send($ary_get['test_address'],$title,$content)){
                    $this->success("恭喜你！测试通过");
                }else{
                    $this->error("测试失败，请确认您的邮箱已经开启的smtp服务并且配置信息均填写正确");
                }
            }else{
                $this->error("测试邮件地址不能为空");
            }
            
        }
    }
}
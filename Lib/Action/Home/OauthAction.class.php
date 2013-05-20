<?php
/**
 * 第三方统一登陆模块
 * @author Terry<admin@huicms.cn>
 * @date 2013-05-13
 */
class OauthAction extends HomeAction{
    
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        
    }
    
    public function OtherLogin(){
        $ary_get = $this->_get();
        $ary_data = array();
        $ary_data['state'] = $_SESSION['state'] = md5(uniqid(rand(), TRUE));
        $ary_data['scope'] = $_SESSION['scope'] = "get_user_info,add_share,get_info,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo";
        $ary_data['response_type'] = "code";
        $url=str_replace('__APP__/','/','http://'.$_SERVER['HTTP_HOST'].U('Home/Oauth/OtherCallbackLogin',array('t'=>'qq')));
        $ary_data['redirect_uri'] = $url;
        $type = ucwords($ary_get['t']);
        $config = M("Oauth")->where(array('code'=>$type,'status'=>'1'))->find();
        $ary_config = json_decode($config['config'],true);
        $$ary_get['t'] = new $type($ary_config['app_key'],$ary_config['app_secret']);
        $loginUrl = $$ary_get['t']->getOauthUrl($ary_data);
        location($loginUrl);exit;
    }
    
    public function OtherCallbackLogin(){
        
        $ary_get = $this->_get();
        $type = ucwords($ary_get['t']);
        if($ary_get['state'] == $_SESSION['state']){
            //获取Access_Token
            $ary_data = array();
            $ary_data['code'] = $ary_get['code'];
            $url=str_replace('__APP__/','/','http://'.$_SERVER['HTTP_HOST'].U('Home/Oauth/OtherCallbackLogin',array('t'=>'qq')));
            $ary_data['redirect_uri'] = $url;
            $config = M("Oauth")->where(array('code'=>$type,'status'=>'1'))->find();
            $ary_config = json_decode($config['config'],true);
            $$ary_get['t'] = new $type($ary_config['app_key'],$ary_config['app_secret']);
            //$$ary_get['t'] = new $type('100421540','6962200fa1201fb8568ac4ffa4c63fbc');
//            echo "<pre>";print_r($ary_data);exit;
            $accessToken = $$ary_get['t']->getAccessToken($ary_data);
            if(!empty($accessToken) && is_array($accessToken)){
                session("userinfo",$accessToken);
                $this->success("登录成功",U('Home/Index/index'),3);
            }else{
                $this->error("登录失败",U('Home/Index/index'),3);
            }
        }else{
            $this->error("登录失败",U('Home/Index/index'),3);
        }
    }
    
    public function OtherLoginOut(){
        if(isset($_SESSION['userinfo'])){
            unset($_SESSION['userinfo']);
            unset($_SESSION);
            session_destroy();
            $this->success("登出成功", '',3);
        }else{
            $this->error("已经登出", '',3);
        }
        
    }
}
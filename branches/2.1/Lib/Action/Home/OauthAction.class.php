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
        $ary_data['scope'] = $_SESSION['scope'] = "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo";
        $ary_data['response_type'] = "code";
        $url=str_replace('__APP__/','/','http://'.$_SERVER['HTTP_HOST'].U('Home/Oauth/OtherCallbackLogin',array('t'=>'qq')));
        $ary_data['redirect_uri'] = $url;
        $type = ucwords($ary_get['t']);
        $$ary_get['t'] = new $type('100421540','6962200fa1201fb8568ac4ffa4c63fbc');
        $loginUrl = $$ary_get['t']->getOauthUrl($ary_data);
//        echo "<pre>";print_r($loginUrl);exit;
        //https://graph.qq.com/oauth2.0/authorize?state=5b532cd944838952344a80990740ffad&scope=get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo&response_type=code&redirect_uri=http%3A%2F%2Fcms21.net%2FHome%2FOauth%2FOtherCallbackLogin%2Ft%2Fqq&client_id=100421540
        //https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=100421540&redirect_uri=http%3A%2F%2Fhuicms.cn%2FHome%2FOauth%2FOtherCallbackLogin%2Ft%2Fqq&state=e71d267e086e9e310c9f5079d24956c1&scope=get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo
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
            $$ary_get['t'] = new $type('100421540','6962200fa1201fb8568ac4ffa4c63fbc');
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
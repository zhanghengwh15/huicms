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
        switch ($ary_get['t']){
            case 'qq':
                $_SESSION['state'] = md5(uniqid(rand(), TRUE));
                $_SESSION["scope"] = "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo";
                $url=str_replace('__APP__/','/','http://huicms.cn'.U('Home/Oauth/OtherCallbackLogin',array('t'=>'qq')));
                $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=100421540&redirect_uri=" . urlencode($url). "&state=" . $_SESSION['state']. "&scope=".$_SESSION["scope"];
                location($login_url);
                break;
        }
    }
    
    public function OtherCallbackLogin(){
        $ary_get = $this->_get();
        $type = ucwords($ary_get['t']);
        //$$ary_get['t'] = new $type();
        $get_user_info = "https://graph.qq.com/user/get_user_info?". "access_token=" . $_SESSION['access_token']. "&oauth_consumer_key=" . C('L.QQappid'). "&openid=" . $_SESSION["openid"]. "&format=json";
    }
}
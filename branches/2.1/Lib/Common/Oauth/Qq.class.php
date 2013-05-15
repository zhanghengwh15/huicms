<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = 'QQ登录';
    $modules[$i]['desc'] = '申请地址：http://connect.opensns.qq.com/';
    $modules[$i]['author'] = 'HUICMS研发团队';
    $modules[$i]['website'] = 'http://open.qq.com';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array(
        array('name' => 'app_key', 'type' => 'text', 'value' => ''),
        array('name' => 'app_secret', 'type' => 'text', 'value' => '')
    );
    return;
}
class Qq{
    
    private $str_url;
    private $str_appid;         //对接QQapi的appid
    public  $str_appkey;        //对接QQapi的appkey

    public function __construct($appid,$appkey) {
        $this->str_url = 'https://graph.qq.com/';
        $this->str_appid = $appid;
        $this->str_appkey = $appkey;
        
    }
    
    public function requestUrl($method, $ary_param=array()){
        $ary_param['response_type'] = 'code';
        $ary_param['client_id'] = $this->str_appid;
        $ary_param['redirect_uri']   = $ary_param['redirect_uri'];
        $ary_param['state']  = $ary_param['state'];
        $ary_param['scope'] = $ary_param['scope'];
        $this->str_url = $this->str_url.$method;
        return $this->str_url;
    }
    
    public function getOauthUrl($ary_param = array()){
        $ary_param['response_type'] = 'code';
        $ary_param['client_id'] = $this->str_appid;
        $ary_param['redirect_uri']   = urlencode($ary_param['redirect_uri']);
        $ary_param['state']  = $ary_param['state'];
        $ary_param['scope'] = $ary_param['scope'];
        $this->str_url = $this->str_url."oauth2.0/authorize?";
        if(!empty($ary_param) && is_array($ary_param)){
            $url = '';
            $count = count($ary_param);
            $i = '0';
            foreach ($ary_param as $ky=>$vl){
                $url .= $ky."=".$vl;
                $i ++;
                if($i != $count){
                    $url .= "&";
                }
            }
            $resultUrl = $this->str_url . $url;
        }
        return $resultUrl;
    }
    
    public function getAccessToken($ary_param = array()){
        $ary_param['grant_type'] = 'authorization_code';
        $ary_param['client_id'] = $this->str_appid;
        $ary_param['redirect_uri']   = urlencode($ary_param['redirect_uri']);
        $ary_param['client_secret']  = $this->str_appkey;
        $ary_param['code'] = $ary_param['code'];
        $this->str_url = $this->str_url."oauth2.0/token?";
        if(!empty($ary_param) && is_array($ary_param)){
            $url = '';
            $count = count($ary_param);
            $i = '0';
            foreach ($ary_param as $ky=>$vl){
                $url .= $ky."=".$vl;
                $i ++;
                if($i != $count){
                    $url .= "&";
                }
            }
            $resultUrl = $this->str_url . $url;
        }
        $response = file_get_contents($resultUrl);
        $params = array();
        parse_str($response, $params);
//        echo "<pre>";print_r($response);exit;
        $_SESSION["access_token"] = $params["access_token"];
        $user = $this->getOauthUser(array('access_token'=>$params['access_token']));
        $_SESSION["openid"] = $user['openid'];
        return $user;
    }
    
    public function getOauthUser($params = array()){
        $this->str_url = "https://graph.qq.com/oauth2.0/me?";
        $params['access_token'] = $params['access_token'];
        if(!empty($params) && is_array($params)){
            $url = '';
            $count = count($params);
            $i = '0';
            foreach ($params as $ky=>$vl){
                $url .= $ky."=".$vl;
                $i ++;
                if($i != $count){
                    $url .= "&";
                }
            }
            $resultUrl = $this->str_url . $url;
        }
        $str = file_get_contents($resultUrl);
        if (strpos($str, "callback") !== false){
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
        }
        
        $user = json_decode($str,true);
        $ary_user = $this->getUserInfo(array('openid'=>$user['openid'],'access_token'=>$params['access_token']));
        return $ary_user;
    }
    
    public function getUserInfo($params = array()){
        $params['oauth_consumer_key'] = $this->str_appid;
        $params['format'] = 'json';
        $this->str_url = "https://graph.qq.com/user/get_user_info?";
        if(!empty($params) && is_array($params)){
            $url = '';
            $count = count($params);
            $i = '0';
            foreach ($params as $ky=>$vl){
                $url .= $ky."=".$vl;
                $i ++;
                if($i != $count){
                    $url .= "&";
                }
            }
            $resultUrl = $this->str_url . $url;
        }
        $str = file_get_contents($resultUrl);
        $userinfo = json_decode($str,true);
        return $userinfo;
    }
}

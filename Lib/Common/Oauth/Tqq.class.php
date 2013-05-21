<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = 'QQ微博登录';
    $modules[$i]['desc'] = '申请地址：http://open.t.qq.com/';
    $modules[$i]['author'] = 'HuiCms研发团队';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array(
        array('name' => 'app_key', 'type' => 'text', 'value' => ''),
        array('name' => 'app_secret', 'type' => 'text', 'value' => '')
    );
    return;
}
class Tqq{
    
    private $str_url;
    private $str_appid;         //对接QQapi的appid
    public  $str_appkey;        //对接QQapi的appkey
    
    public function __construct($appid,$appkey) {
        $this->str_url = 'https://open.t.qq.com/';
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
        $this->str_url = $this->str_url."cgi-bin/oauth2/authorize?";
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
        $this->str_url = $this->str_url."cgi-bin/oauth2/access_token?";
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
//        echo "<pre>";print_r($resultUrl);exit;
        $response = file_get_contents($resultUrl);
        $params = array();
        parse_str($response, $params);
//        echo "<pre>";print_r($response);exit;
        $_SESSION["access_token"] = $params["access_token"];
        $user = $this->getOauthUser(array('access_token'=>$params['access_token']));
        $_SESSION["openid"] = $user['openid'];
        return $user;
    }
}
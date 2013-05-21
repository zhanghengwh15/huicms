<?php
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.class.php');
    $modules[$i]['name'] = '新浪微薄登录';
    $modules[$i]['desc'] = '申请地址：http://open.weibo.com/';
    $modules[$i]['author'] = 'HUICMS研发团队';
    $modules[$i]['version'] = '1.0';
    $modules[$i]['config'] = array(
        array('name' => 'app_key', 'type' => 'text', 'value' => ''),
        array('name' => 'app_secret', 'type' => 'text', 'value' => '')
    );
    return;
}
class Sina{
    
    private $str_url;
    private $str_appid;         //对接QQapi的appid
    public  $str_appkey;        //对接QQapi的appkey
    
    public function __construct($appid,$appkey) {
        $this->str_url = 'https://api.weibo.com/';
        $this->str_appid = $appid;
        $this->str_appkey = $appkey;
        
    }
    
    public function requestUrl($method, $ary_param=array()){
        $ary_param['response_type'] = 'code';
        $ary_param['client_id'] = $this->str_appid;
        $ary_param['redirect_uri']   = $ary_param['redirect_uri'];
        $ary_param['scope'] = $ary_param['scope'];
        $this->str_url = $this->str_url.$method;
        return $this->str_url;
    }
    
    public function getOauthUrl($ary_param = array()){
        $ary_param['response_type'] = 'code';
        $ary_param['client_id'] = $this->str_appid;
        $ary_param['redirect_uri']   = urlencode($ary_param['redirect_uri']);
        $ary_param['scope'] = $ary_param['scope'];
        $this->str_url = $this->str_url."oauth2/authorize?";
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
        $ary_param['redirect_uri']   = $ary_param['redirect_uri'];
        $ary_param['client_secret']  = $this->str_appkey;
        $ary_param['code'] = $ary_param['code'];
        $ary_param['method'] = "oauth2/get_oauth2_token";
        $response = makeRequest($this->str_url, $ary_param,"GET");
        $params = json_decode($response,true);
        $_SESSION["access_token"] = $params["access_token"];
        $user = $this->getOauthUser($params);
        $_SESSION["openid"] = $user['uid'];
        return $user;
    }
    
    public function getUserInfo($params = array()){
        $params['appkey'] = $this->str_appid;
        $params['uid'] = $params['uid'];
        $params['create_at'] = $params['create_at'];
        $params['expire_in'] = $params['expire_in'];
        $params['method'] = 'oauth2/get_token_info';
        $response = makeRequest($this->str_url, $params,"GET");
        $userinfo = json_decode($response,true);
        return $userinfo;
    }
}
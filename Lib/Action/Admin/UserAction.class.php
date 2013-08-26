<?php
class UserAction extends Action{
    
    public function _initialize() {
        $langSet = C('DEFAULT_LANG');
        // 读取当前模块语言包
		if (is_file(LANG_PATH . $langSet . '/' . MODULE_NAME . '.php')){
			L(include LANG_PATH . $langSet . '/' . MODULE_NAME . '.php');
        }
    }
    
    /**
     * 后台登录默认控制器，需要重定向到登录页
     * @author Terry<admin@huicms.cn>
     * @date 2013-03-21
     */
    public function index() {
        $this->redirect(U('Admin/User/pageLogin'));
    }
    
    /**
     * 后台登录页面
     * @author Terry<admin@huicms.cn>
     * @date 2013-03-21
     */
    public function pageLogin() {
        $code = D('Config')->getCfgByModule('CODE_SET');
        $this->assign("code",$code);
        $this->display("Login");
    }
    
    /**
     * 验证码
     * @author Terry <admin@huicms.cn>
     * @date 2013-03-23
     */
    public function verify() {
        import('ORG.Util.Image');
        $ary_data = D('Config')->getCfgByModule('CODE_SET');
        if(!empty($ary_data) && is_array($ary_data)){
            $ary_data['RECODESIZE'] = json_decode($ary_data['RECODESIZE'],true);
            $ary_data['BACODESIZE'] = json_decode($ary_data['BACODESIZE'],true);
        }
        if(!empty($ary_data['BUILDTYPE']) && $ary_data['BUILDTYPE'] == '4'){
            Image::GBVerify(
                $ary_data['BACODENUMS'], 
                $ary_data['EXPANDTYPE'], 
                $ary_data['BACODESIZE']['width'], 
                $ary_data['BACODESIZE']['height'], 
                'simhei.ttf',
                'code'
            );
        }else{
            Image::buildImageVerify(
                $ary_data['BACODENUMS'], 
                $ary_data['BUILDTYPE'], 
                $ary_data['EXPANDTYPE'], 
                $ary_data['BACODESIZE']['width'], 
                $ary_data['BACODESIZE']['height'], 
                'code'
            );
        }
//        Image::buildImageVerify(6, 1, 'png', 100, 38, 'code');
    }
    
    /**
     * 后台安全退出，销毁session
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-03-26
     * @modifiy Terry <wanghui@guanyisoft.com>
     */
    public function doLogout() {
        if(isset($_SESSION[C('USER_AUTH_KEY')])){
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success(L('LOGOUT_SUCCESS'), U('Admin/User/pageLogin'));
        }else{
            $this->error(L('BEEN_LOGOUT'),U('Admin/User/pageLogin'));
        }
    }
    
    /**
     * 用户登陆操作
     * @author Terry <admin@huicms.cn>
     * @date 2013-3-23
     */
    public function doLogin(){
        $ary_post = $this->_post();
        $code= D('Config')->getCfgByModule('CODE_SET');
        if (empty($ary_post['username'])) {
            $this->error(L('PlEASE_USERNAME'));
        } else if (empty($ary_post['passwd'])) {
            $this->error(L('PlEASE_PASSWD'));
        } 
        if(!empty($code['BALOGIN']) && $code['BALOGIN'] == '1'){
            if(empty($ary_post['code']) || trim($ary_post['code']) == "验证码"){
                $this->error(L('PlEASE_CODE'));
            }
        }
        //生成认证条件
        $map = array();
        // 支持使用绑定帐号登录
        $map['u_name'] = $ary_post['username'];
        $map["u_status"] = array('gt' , 0);
        $verify = session("code");
        if(!empty($code['BALOGIN']) && $code['BALOGIN'] == '1'){
            if ($verify != md5($ary_post['code'])) {
                $this->error(L('CODE_ERROR'));
            }
        }
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $exitTime = $admin_access['EXPIRED_TIME'];
        $rbac = new Arbac();
        import('ORG.Util.Session');
        $auth_info = $rbac->authenticate($map);
        
        if (empty($auth_info)) {
            $this->error(L('ACCOUNT_EXIT_DISABLED'));
        } else {
            if ($auth_info['u_passwd'] != md5($ary_post['passwd'])) {
                $this->error(L('PASSWD_ERROR'));
            }
            Session::setExpire(time() + $exitTime * 60);
            $_SESSION[C('USER_AUTH_KEY')] = $auth_info['u_id'];
            $_SESSION['admin_name'] = $auth_info['u_name'];
            $_SESSION['pic'] = $auth_info['u_photo'];
            $_SESSION['last_time'] = $auth_info['u_lastlogin_time'];
            $_SESSION['u_countlog'] = $auth_info['u_countlog'];
            if ($auth_info['u_name'] == $admin_access['SYS_ADMIN']) {
                $_SESSION[C('ADMIN_AUTH_KEY')] = true;
            }
            //保存登录信息
            $admin = M(C('USER_AUTH_MODEL'));
            $ip = get_client_ip();
            $time = date("Y-m-d H:i:s");
            $data = array();
            $data['u_lastlogin_time'] = $time;
            $data['u_countlog'] = array('exp', 'u_countlog + 1');
            $data['u_ip'] = $ip;
            $_SESSION['ip'] = $ip;
            $admin->where(array('u_name'=>$ary_post['username']))->save($data);
            // 缓存访问权限
            $rbac->saveAccessList();
            $ary_data = array();
            $admin_log = M("AdminLog");
            $ary_data['u_id'] = $auth_info['u_id'];
            $ary_data['u_name'] = $auth_info['u_name'];
            $ary_data['log_ip'] = $ip;
            $ary_data['log_create'] = $time;
            $admin_log->add($ary_data);
            //将菜单控制台写入COOKIE
            $rolenav = M('RoleNav')->field('id')->where(array('name'=>'控制台'))->find();
            cookie("nav_id",$rolenav['id']);
            $this->success(L('LOGIN_SUCCESS'));
        }
    }
    
}

<?php

/**
 * 后台基类
 *
 * @subpackage Admin
 * @package Action
 * @stage 1.0
 * @author Terry<wanghui@guanyisoft.com>
 * @date 2013-3-25
 * @copyright Copyright (C) 2012, Shanghai Huicms Co., Ltd.
 */
abstract class AdminAction extends Action{
    
    /**
     * 基类初始化操作
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-3-25
     */
    public function _initialize() {
        $langSet = C('DEFAULT_LANG');
//        echo "<pre>";print_r(MODULE_NAME);exit;
        // 读取当前模块语言包
		if (is_file(LANG_PATH . $langSet . '/' . MODULE_NAME . '.php')){
			L(include LANG_PATH . $langSet . '/' . MODULE_NAME . '.php');
        }
        //判断用户是否登陆
        $this->doCheckLogin();
        import('ORG.Util.Session');
        $this->assign("uid",session("admin"));
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        if (intval($admin_access['EXPIRED_TIME']) > 0 && Session::isExpired()) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
        }
        if (intval($admin_access['EXPIRED_TIME']) > 0) {
            Session::setExpire(time() + $admin_access['EXPIRED_TIME'] * 60);
        }
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            $rbac = new Arbac();
            if (!$rbac->AccessDecision()) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }
        import('ORG.Util.Page');
    }
    
    /**
     * 判断用户是否登陆
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-3-25
     */
    public function doCheckLogin(){
        //todo 此处要做登录判断
        if (!session("Admin")) {
            $this->error(L('NO_LOGIN'), U('Admin/User/pageLogin'));
        } else {
            $this->admin = session("Admin");
        }
    }
    
    
    
}
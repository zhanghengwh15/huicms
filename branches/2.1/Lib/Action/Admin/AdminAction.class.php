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
     * 顶部大栏目
     * @var array
     */
    private $tops = array();
    
    /**
     * 左侧各级菜单
     * @var array
     */
    private $menus = array();
    
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
        $bm = array();
        $bm['url']    = MODULE_NAME;
        $bm['module']    = L(MODULE_NAME);
        $bm['action']    = L(MODULE_NAME.'_'.ACTION_NAME);
        $this->assign ('breadcrumbs',$bm);
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
        $this->getTop();
        $menuid = intval($_GET['menuid']);
        
		if(empty($menuid)) $menuid = cookie('nav_id');
		if(!empty($menuid)){
			$this->getMenus($menuid);
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
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
//            $this->redirect(U('Admin/User/pageLogin'));
            $this->error(L('NO_LOGIN'), U('Admin/User/pageLogin'));
        }
    }    
    
    /**
     * 获取顶部导航信息
     * @author Terry<admin@52sum.com>
     * @date 2013-04-03
     */
    public function getTop(){
        $tops = D('RoleNav')->where('status=1')->field('id,name')->order("sort ASC")->select();
        $this->tops = $tops;
        $this->assign('tops', $tops);
    }
    
    /**
     * 获取左侧菜单信息
     * @author Terry<admin@52sum.com>
     * @date 2013-04-03
     */
    public function getMenus($menuid){
        $id = intval($menuid);
        $menus = array();
        if(false){
            $menus = $_SESSION['menu_' . $id . '_' . $_SESSION[C('USER_AUTH_KEY')]];
        }else{
//            if ($id == 0)
//                $id = D("RoleNav")->where('status=1')->order("sort ASC,id ASC")->getField('id');
            $where = array();
            $where['status'] = 1;
            $where['nav_id'] = $menuid;
            $where['is_show'] = 1;
            $where['auth_type'] = 0;
            $no_modules = explode(',', strtoupper(C('NOT_AUTH_MODULE')));
            $access_list = $_SESSION['_ACCESS_LIST'];
            $node_list = D("RoleNode")->where($where)->field('id,action,action_name,module,module_name')->order(array('sort'=>'ASC'))->select();
            
            foreach ($node_list as $key => $node) {
                $menus[$node['module']]['nodes'][] = $node;
                $menus[$node['module']]['name'] = $node['module_name'];
                if ((isset($access_list[strtoupper($node['module'])]['MODULE']) || isset($access_list[strtoupper($node['module'])][strtoupper($node['action'])])) || $_SESSION['administrator'] || in_array(strtoupper($node['module']), $no_modules)) {
                    $menus[$node['module']]['nodes'][] = $node;
                    $menus[$node['module']]['name'] = $node['module_name'];
                }
            }
//            echo "<pre>";print_r($menus);exit;
            $_SESSION['menu_' . $id . '_' . $_SESSION[C('USER_AUTH_KEY')]] = $menus;
            $this->menus = $menus;
//            echo "<pre>";print_r($menus);exit;
            $this->assign("menus",$menus);
            return $menus;
        }
    }
}
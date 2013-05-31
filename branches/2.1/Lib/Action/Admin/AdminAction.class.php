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
    protected $_name = '';
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
        $this->_name = $this->getActionName();
        $langSet = C('DEFAULT_LANG');
        //读取公共语言包
        L(include LANG_PATH . $langSet . '/Common.php');
        
        // 读取当前模块语言包
		if (is_file(LANG_PATH . $langSet . '/' . MODULE_NAME . '.php')){
			L(include LANG_PATH . $langSet . '/' . MODULE_NAME . '.php');
        }
        //判断用户是否登陆
        $this->doCheckLogin();
        $ary_get = $this->_get();
        $module = cookie("module");
        $action = cookie("action");
        if(!empty($module) && !empty($action)){
            $module = cookie("module");
            $action = cookie("action");
        }else{
            $module = $ary_get['_URL_'][1];
            $action = $ary_get['_URL_'][2];
        }
        $navid = cookie("nav_id");
        $navname = D("RoleNav")->where(array('id'=>$navid))->find();
        session("navname",$navname['name']);
        $rolenav = M('RoleNav')->field(C('DB_PREFIX').'role_nav.name,'.C('DB_PREFIX').'role_node.*')
                          ->join(C('DB_PREFIX').'role_node ON '.C('DB_PREFIX').'role_nav.id = '.C('DB_PREFIX').'role_node.`nav_id`')
                          ->where(C('DB_PREFIX').'role_nav.id =  "'.  $navid.'" AND '.C('DB_PREFIX').'role_node.`action` =  "'.$action.'" AND '.C('DB_PREFIX').'role_node.`module` =  "'.$module.'"')
                          ->find();
//        echo M('RoleNav')->getLastSql();exit;
//        echo "<pre>";print_r($navid);exit;
        if(!empty($rolenav) && is_array($rolenav)){
            cookie("menuid",$rolenav['id']);
        }
        $rolenav['url']    = MODULE_NAME;
//        if(!empty($ary_get['_URL_'][1]) && isset($ary_get['_URL_'][1])){
//            
//            $module = $ary_get['_URL_'][1];
//            $action = $ary_get['_URL_'][2];
//            $navid = cookie('nav_id');
//            if(empty($navid)){
//                $data = M('RoleNav')->where(array('name'=>'控制台'))->find();
//                cookie('nav_id',$data['id']);
//                cookie('module',$module);
//                cookie('action',$action);
//                $navid = $data['id'];
//            }
//        }else{
//            $modules = cookie('module');
//            $actions = cookie('action');
////            echo $modules;
//            if(!empty($modules) && !empty($actions)){
//                $module = cookie('module');
//                $action = cookie('action');
//                $navid = cookie('nav_id');
//            }else{
//                $data = M('RoleNav')->where(array('name'=>'控制台'))->find();
//                $module = "Index";
//                $action = "index";
//                $navid = $data['id'];
//            }
//        }
//        $bm = M('RoleNav')->field(C('DB_PREFIX').'role_nav.name,'.C('DB_PREFIX').'role_node.*')
//                          ->join(C('DB_PREFIX').'role_node ON '.C('DB_PREFIX').'role_nav.id = '.C('DB_PREFIX').'role_node.`nav_id`')
//                          ->where(C('DB_PREFIX').'role_nav.id =  "'.  $navid.'" AND '.C('DB_PREFIX').'role_node.`action` =  "'.$action.'" AND '.C('DB_PREFIX').'role_node.`module` =  "'.$module.'"')
//                          ->find();
//        $bm['url']    = MODULE_NAME;
        $this->assign ('breadcrumbs',$rolenav);
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
        $this->getMenus($navid);
        import('ORG.Util.Page');
    }
    
    /**
     * 判断用户是否登陆
     * @author Terry<wanghui@huicms.com>
     * @date 2013-3-25
     */
    public function doCheckLogin(){
        //todo 此处要做登录判断
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
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
        $where = array();
        $where['status'] = '1';
        $where['nav_id'] = $menuid;
        $where['is_show'] = '1';
        $where['auth_type'] = 0;
        $no_modules = explode(',', strtoupper(C('NOT_AUTH_MODULE')));
        $access_list = $_SESSION['_ACCESS_LIST'];
        $node_list = D("RoleNode")->where($where)->field('id,action,action_name,module,module_name,nav_id')->order(array('sort'=>'ASC'))->select();
        if(!empty($node_list) && is_array($node_list)){
            foreach ($node_list as $key => $node) {
                $menus[$node['module']]['nodes'][] = array_unique($node);
                $menus[$node['module']]['name'] = $node['module_name'];
                if ((isset($access_list[strtoupper($node['module'])]['MODULE']) 
                    || isset($access_list[strtoupper($node['module'])][strtoupper($node['action'])])) 
                    || $_SESSION['administrator'] || in_array(strtoupper($node['module']), $no_modules)) 
                {
                    if(!in_array($node['id'], $menus[$node['module']]['nodes'][$key])){
                        $menus[$node['module']]['nodes'][] = array_unique($node);
                    }
                    $menus[$node['module']]['name'] = $node['module_name'];
                }
            }
        }
        $_SESSION['menu_' . $id . '_' . $_SESSION[C('USER_AUTH_KEY')]] = $menus;
        $this->menus = $menus;
        $this->assign("menus",$menus);
        return $menus;
    }
    
    /**
     * 删除友情链接
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-16
     */
    public function doDelete(){
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                $this->success("删除成功");
            } else {
                $this->error("删除失败");
            }
        } else {
            $this->error("请选择删除的对象");
        }
    }
    
    /**
     * 后台统一分页
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-31
     */
    public function _Page($count, $pagesize){
        $page = new Page($count, $pagesize);
        $page->setConfig("header","条");
        $page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        return $page;
    }
}
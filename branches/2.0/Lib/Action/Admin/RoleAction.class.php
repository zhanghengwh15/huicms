<?php
/**
 * 后台角色操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-04-01
 * 
 */
class RoleAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function index() {
        $this->redirect(U('Admin/Role/pageList'));
    }
    
    /**
     * 角色列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-04-01
     */
    public function pageList() {
        $name = $this->getActionName();
        $role = D($name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $role->where()->count();
        $obj_page = new Page($count, $ary_get['pageall']);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li style="heigth:23px;line-height:23px;padding-top:8px;">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        $page = $obj_page->newshow();
        $ary_data = $role->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 添加角色
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function addRole() {
        //取出模块授权
        $modules = D("RoleNode")->where("status = 1 and auth_type = 1")->select();
        if (!empty($modules) && is_array($modules)) {
            foreach ($modules as $key => $val) {
                $actions = D("RoleNode")->where("status=1 and auth_type = 0 and module='" . $val['module'] . "'")->select();
                if (!empty($actions) && is_array($actions)) {
                    $modules[$key]['actions'] = $actions;
                }
            }
        }
        $this->assign('access_list', $modules);
//        echo "<pre>";print_r($modules);exit;
        $this->display();
    }
    
    /**
     * 处理添加角色
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function doAdd() {
        $name = $this->getActionName();
        $role = D($name);
        $roleAccess = M("RoleAccess");
        $data = $role->create();
        if (false === $data = $role->create()) {
            $this->error($role->getError());
        }
        $role->startTrans();
        //保存当前数据对象
        $list = $role->add($data);
        if (false !== $list) {
            $node_ids = $this->_request("access_node");
            if (!empty($node_ids) && is_array($node_ids)) {
                foreach ($node_ids as $node_id) {
                    $access['role_id'] = $list;
                    $access['node_id'] = $node_id;
                    $ary_result = $roleAccess->add($access);
                    if(FALSE === $ary_result){
                        $role->rollback();//不成功，回滚
                        $this->error("数据添加失败");
                    }
                }
                $role->commit();//成功
                $this->success("数据添加成功");
            } else {
                $role->rollback();//不成功，回滚
                $this->error("请选择控制权限");
            }
        } else {
            $role->rollback();//不成功，回滚
            $this->error("数据添加失败");
        }
    }
    
    /**
     * 编辑角色
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-04-01
     */
    public function editRole() {
        $name = $this->getActionName();
        $role = D($name);
        $ary_get = $this->_get();
        $vo = $role->getById($ary_get['id']);
        $this->assign("vo", $vo);
        $roleAccess = M("RoleAccess");
        $role_access = $roleAccess->field("node_id")->where("role_id=" . $ary_get['id'])->select();
        
        $node_ids = array();
        if (!empty($role_access) && is_array($role_access)) {
            foreach ($role_access as $access) {
                array_push($node_ids, $access['node_id']);
            }
        }
        //取出模块授权
        $modules = D("RoleNode")->where("status = 1 and auth_type = 1")->select();
        if (!empty($modules) && is_array($modules)) {
            foreach ($modules as $k => $v) {
                $actions = D("RoleNode")->where("status=1 and auth_type = 0 and module='" . $v['module'] . "'")->select();
                if ($actions) {
                    $modules[$k]['actions'] = $actions;
                }
            }
            //echo "<pre>";print_r($modules);
            foreach ($modules as $mk => $module) {
                if (in_array($module['id'], $node_ids)) {
                    $modules[$mk]['checked'] = true;
                } else {
                    $modules[$mk]['checked'] = false;
                }
                foreach ($module['actions'] as $ak => $action) {
                    $checkall = true;

                    if (in_array($action['id'], $node_ids)) {
                        $modules[$mk]['actions'][$ak]['checked'] = true;
                    } else {
                        $checkall = false;
                        $modules[$mk]['actions'][$ak]['checked'] = false;
                    }
                }

                if ($checkall) {
                    $modules[$mk]['checkall'] = true;
                } else {
                    $modules[$mk]['checkall'] = false;
                }
            }
        }
        $this->assign('access_list', $modules);
        $this->assign('role', $vo);
        $this->display();
    }
    
    /**
     * 处理编辑角色
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function doEdit(){
        $ary_request = $this->_request();
        $name = $this->getActionName();
        $role = D($name);
        $roleAccess = M("RoleAccess");
        $data = $role->create();
        if (false === $data = $role->create()) {
            $this->error($role->getError());
        }
//        echo "<pre>";print_r($ary_request);exit;
        $where = array();
        $where['id'] = array("NEQ",$ary_request['id']);
        $where['name']     = $ary_request["name"];
        $count = $role->where($where)->count();
        if($count > 0){
            $this->error("更新的角色已经存在");
        }
        //保存当前数据对象
        $list = $role->where(array('id'=>$ary_request['id']))->save($data);
        if(false !== $list){
            $roleAccess->where(array('role_id'=>$ary_request['id']))->delete();
            $node_ids = $ary_request['access_node'];
            if (!empty($node_ids) && is_array($node_ids)) {
                foreach ($node_ids as $node_id) {
                    $access['role_id'] = $ary_request['id'];
                    $access['node_id'] = $node_id;
                    $ary_result = $roleAccess->add($access);
                    if(FALSE === $ary_result){
                        $role->rollback();//不成功，回滚
                        $this->error("数据更新失败");
                    }
                    
                }
                $this->success("更新成功");
            } else {
                $this->error("请选择控制权限");
            }
        }else{
            $this->error("更新失败");
        }
    }
    
    /**
     * 判断用户组名称是否存在
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     * @return string 存在在返回字符串 否则返回FALSE
     */
    public function checkRoleName(){
        $ary_get = $this->_get();
        $name = $this->getActionName();
        $role = D($name);
        $ary_data = $role->where(array('name'=>$ary_get['name']))->find();
        if(!empty($ary_data) && is_array($ary_data)){
            $this->ajaxReturn("该用户组名称已经存在");
        }else{
            $this->ajaxReturn(true);
        }
    }
    
    /**
     * 校验角色编辑时，角色名称是否存在
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function checkEditName(){
        $name = $this->getActionName();
        $ary_get = $this->_get();
        $where = array();
        $where['id'] = array("NEQ",intval($ary_get['id']));
        $where['name'] = $ary_get['name'];
        $count = D($name)->where($where)->count();
        if(intval($count) > 0){
            $this->ajaxReturn('该角色已存在！');
        }else{
            $this->ajaxReturn(true);
        }
    }
    
    /**
     * 角色启用/停用
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function doEditStatus(){
        $ary_request = $this->_request();
        if(!empty($ary_request) && is_array($ary_request)){
            $name = $this->getActionName();
            $role = D($name);
            $ary_data = array();
            $str_msg = '';
            if(intval($ary_request['val']) > 0 ){
                $str_msg = '启用';
            }else{
                $str_msg = '停用';
                
                $where = array();
                $where[C('DB_PREFIX').'admin.role_id']     = $ary_request["id"];
                $where[C('DB_PREFIX').'admin.u_status']     = '1';
                $count = $role->join(" ".C('DB_PREFIX')."admin on ".C('DB_PREFIX')."admin.role_id=".C('DB_PREFIX')."role.id")->where($where)->count();
//                echo "<pre>";print_r($role->getLastSql());exit;
                if($count > 0){
                    $this->error("角色已经被使用，不可停用");
                }
            }
            $ary_data[$ary_request['field']]    = $ary_request['val'];
            //保存当前数据对象
            $list = $role->where(array('id'=>$ary_request['id']))->save($ary_data);
            if(FALSE !== $list){
                 $this->success($str_msg."成功");
            }else{
                 $this->error($str_msg."失败");
            }
        }else{
            $this->error("编辑失败");
        }
    }
    
    public function doDelete(){
        $id = intval($this->_get('id'));
        $name = $this->getActionName();
        $role = D($name);
        if(!empty($id) && $id > 0){
            $where = array();
            $where[C('DB_PREFIX').'admin.role_id']     = $id;
            $where[C('DB_PREFIX').'admin.u_status']     = '1';
            $count = $role->join(" ".C('DB_PREFIX')."admin on ".C('DB_PREFIX')."admin.role_id=".C('DB_PREFIX')."role.id")->where($where)->count();
            if($count > 0){
                IS_AJAX && $this->ajaxReturn(0, "角色已经被使用，不可删除");
                $this->error("角色已经被使用，不可删除");
            }
            //保存当前数据对象
            $list = $role->where(array('id'=>$id))->delete();
            if(false !== $list){
                M("RoleAccess")->where(array('role_id'=>$id))->delete();
                IS_AJAX && $this->ajaxReturn(1, "删除成功");
                $this->success("删除成功");
            }else{
                IS_AJAX && $this->ajaxReturn(0, "删除失败");
                $this->success("删除失败");
            }
        }else{
            IS_AJAX && $this->ajaxReturn(0, "数据错误");
            $this->error("数据错误");
        }
    }
}
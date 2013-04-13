<?php
/**
 * 后台管理节点操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-4-1
 * 
 */
class RoleNodeAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 节点列表
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function pageList(){
        $name = $this->getActionName();
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = D($name)->where()->count();
        $obj_page = new Page($count, $ary_get['pageall']);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        $page = $obj_page->newshow();
        $ary_data = D($name)->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("filter",$ary_get);
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->display();
    }

    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function index() {
        $this->redirect(U('Admin/RoleNode/pageList'));
    }
    
    /**
     * 添加节点
     * @author Terry<admin@52sum.com>
     * @date 2013-04-01
     */
    public function addRoleNode(){
        $rolenav = D("RoleNav");
        $ary_rolenav = $rolenav->where(array('status'=>'1'))->select();
        $this->assign("rolenav",$ary_rolenav);
        $this->display();
    }
    
    /**
     * 处理节点
     * @author Terry<admin@52sum.com>
     * @date 2013-04-01
     */
    public function saveRoleNode(){
        $ary_post = $this->_post();
        $name = $this->getActionName();
        $model = D($name);
        if (false === $data = $model->create()) {
            $this->error($model->getError());
        }
        if ($data['module_name'] == '') {
            $data['module_name'] = $data['module'];
        }
        if ($ary_post['module'] == "" && $ary_post['action'] != "") {
            $data['auth_type'] = 2;
        } elseif ($ary_post['module'] != "" && $ary_post['action'] == "") {
            $data['auth_type'] = 1;
        } else {
            $data['auth_type'] = 0;
        }
        $count = D($name)->where(array('module' => $ary_post['module'], 'action' => $ary_post['action']))->count();
        if ($count > 0) {
            $this->error("添加的节点已经存在");
        }
        //保存当前数据
        $list = $model->add($data);
        if (false !== $list) {
            $this->success("节点添加成功");
        } else {
            $this->error("节点添加失败");
        }
    }
    
    /**
     * 编辑节点
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function editRoleNode() {
        $node_id = intval($this->_get("id"));
        $name = $this->getActionName();
        $vo = D($name)->getById($node_id);
        $rolenav = D("RoleNav");
        $ary_rolenav = $rolenav->where(array('status'=>'1'))->select();
        $this->assign("vo", $vo);
        $this->assign("rolenav",$ary_rolenav);
        $this->display();
    }
    
    /**
     * 处理编辑节点
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function doEdit() {
        $ary_request = $this->_request();
        $roleNode = $this->getActionName();
        $model = D($roleNode);
        $data = $model->create();
        if (false === $data = $model->create()) {
            $this->error($model->getError());
        }
        if (!empty($data) && is_array($data)) {
            if ($data['module_name'] == '') {
                $data['module_name'] = $data['module'];
            }
            if ($ary_request['module'] == "" && $ary_request['action'] != "") {
                $data['auth_type'] = 2;
            } elseif ($ary_request['module'] != "" && $ary_request['action'] == "") {
                $data['auth_type'] = 1;
            } else {
                $data['auth_type'] = 0;
            }
            $where = array();
            $where['module']   = $ary_request['module'];
            $where['action']   = $ary_request['action'];
            $where['id']   = array('NEQ',$ary_request['id']);
            $count = D($roleNode)->where($where)->count();
//            echo "<pre>";echo D($roleNode)->getLastSql();exit;
            if ($count > 0) {
                $this->error("添加的节点已经存在");
            }
            //保存当前数据
            $list = $model->where(array('id' => $ary_request['id']))->save($data);
            if (false !== $list) {
                $this->success("节点编辑成功");
            } else {
                $this->error("节点编辑失败");
            }
        } else {
            $this->error("数据错误");
        }
    }
    
    /**
     * 更改菜单状态
     * @author Terry<admin@52sum.com>
     * @date 2013-04-01
     */
    public function doEditStatus(){
        $ary_request = $this->_request();
        if(!empty($ary_request) && is_array($ary_request)){
            $name = $this->getActionName();
            $model = D($name);
            $ary_data = array();
            $str_msg = '';
            if(intval($ary_request['val']) > 0 ){
                $str_msg = '启用';
            }else{
                $str_msg = '停用';
                
                $where = array();
                $where[C('DB_PREFIX').'role_node.id']     = $ary_request["id"];
                $where[C('DB_PREFIX').'role.status']     = '1';
                $count = $model
                        ->join(" ".C('DB_PREFIX')."role_access on ".C('DB_PREFIX')."role_access.node_id=".C('DB_PREFIX')."role_node.id")
                        ->join(" ".C('DB_PREFIX')."role on ".C('DB_PREFIX')."role_access.role_id=".C('DB_PREFIX')."role.id")
                        ->where($where)->count();
                //echo $model->getLastSql();exit;
                if($count > 0){
                    $this->error("节点已经被使用，不可停用");
                }
            }
            $ary_data[$ary_request['field']]    = $ary_request['val'];
            //保存当前数据对象
            $list = $model->where(array('id'=>$ary_request['id']))->save($ary_data);
            if(false !== $list){
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
        $model = D($name);
        if(!empty($id) && $id > 0){
            $where = array();
                $where[C('DB_PREFIX').'role_node.id']     = $id;
                $where[C('DB_PREFIX').'role.status']     = '1';
                $count = $model
                        ->join(" ".C('DB_PREFIX')."role_access on ".C('DB_PREFIX')."role_access.node_id=".C('DB_PREFIX')."role_node.id")
                        ->join(" ".C('DB_PREFIX')."role on ".C('DB_PREFIX')."role_access.role_id=".C('DB_PREFIX')."role.id")
                        ->where($where)->count();
            if($count > 0){
                IS_AJAX && $this->ajaxReturn(0, "节点已经被使用，不可删除");
                $this->error("节点已经被使用，不可删除");
            }
            //保存当前数据对象
            $list = $model->where(array('id'=>$id))->delete();
            if(false !== $list){
                M("RoleAccess")->where(array('node_id'=>$id))->delete();
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
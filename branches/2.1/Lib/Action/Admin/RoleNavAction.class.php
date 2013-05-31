<?php
/**
 * 后台管理菜单操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-3-29
 * 
 */
class RoleNavAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-03-29
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-03-27
     */
    public function index() {
        
        $rolenav = D("RoleNav");
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $rolenav->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $rolenav->where()->order('sort ASC')->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data",$ary_data);
        $this->assign("filter",$ary_get);
        $this->assign("page",$page);
        $this->display();
//        $this->redirect(U('Admin/RoleNav/pageList'));
    }
    
    /**
     * 菜单列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-01-22
     */
    public function pageList(){
        $rolenav = D("RoleNav");
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $rolenav->where()->count();
        
        $obj_page = new Page($count, $ary_get['pageall']);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        $page = $obj_page->newshow();
        
        $ary_data = $rolenav->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data",$ary_data);
        $this->assign("filter",$ary_get);
        $this->assign("page",$page);
        $this->display();
    }
    
    /**
     * 添加菜单
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function addRoleNav(){
        $this->display();
    }
    
    /**
     * 保存菜单
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function saveRoleNav(){
        $rolenav = D("RoleNav");
        $ary_post = $this->_post();
        if(!empty($ary_post['name']) && isset($ary_post['name'])){
            $ary_post['sort'] = $this->_post('sort', 'htmlspecialchars', 10);
            if(!empty($ary_post['id']) && isset($ary_post['id'])){
                $id = $ary_post['id'];
                unset($ary_post['id']);
                $ary_reslut = $rolenav->where(array('id'=>$id))->data($ary_post)->save();
                if(FALSE !== $ary_reslut){
                    $this->success("更新成功");
                }else{
                    $this->error("更新失败");
                }
            }else{
                $ary_reslut = $rolenav->add($ary_post);
                if(FALSE !== $ary_reslut){
                    $this->success("添加成功");
                }else{
                    $this->error("添加失败");
                }
            }
        }else{
            $this->error("菜单不能为空！");
        }
    }
    
    /**
     * 校验菜单唯一性
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function checkName(){
        $rolenav = D("RoleNav");
        $ary_get = $this->_get();
        if(!empty($ary_get['name']) && isset($ary_get['name'])){
            if(!empty($ary_get['id']) && isset($ary_get['id'])){
                $where = array();
                $where['name'] = $ary_get['name'];
                $where['id'] = array("neq",$ary_get['id']);
                $ary_result = $rolenav->where($where)->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("菜单已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }else{
                $ary_result = $rolenav->where(array('name'=>$ary_get['name']))->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("菜单已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }
        }else{
            $this->ajaxReturn("菜单不能为空");
        }
    }
    
    /**
     * 删除菜单
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function doDelete(){
        $ary_get = $this->_get();
        if(!empty($ary_get['id']) && isset($ary_get['id'])){
            $rolenav = D("RoleNav");
            $ary_result = $rolenav->where(array('id'=>$ary_get['id']))->delete();
            if(FALSE !== $ary_result){
                $this->success("删除成功");
            }  else {
                $this->error("删除失败");
            }
        }else{
            $this->error("菜单不存在");
        }
    }
    
    /**
     * 修改菜单
     * @author Terry<admin@52sum.com>
     * @date 2013-3-26
     * 
     */
    public function editRoleNav(){
        $ary_get = $this->_get();
        if(!empty($ary_get['id']) && isset($ary_get['id'])){
            $rolenav = D("RoleNav");
            $where = array();
            $where['id'] = $ary_get['id'];
            $ary_rolenav = $rolenav->where($where)->find();
//            echo "<pre>";print_r($ary_rolenav);exit;
        }else{
            $this->error("菜单不存在，请重试！");
        }
        $this->assign("data",$ary_rolenav);
        $this->display();
    }
    
    /**
     * 更改菜单状态
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function doEditStatus(){
        $ary_post = $this->_post();
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $rolenav = D("RoleNav");
            $data = array();
            $data[$ary_post['field']] = $ary_post['val'];
            $ary_result = $rolenav->where(array('id'=>$ary_post['id']))->data($data)->save();
            if(FALSE !== $ary_result){
                if(!empty($ary_post['val']) && $ary_post['val'] == '1'){
                    $this->success("启用成功");
                }else{
                    $this->success("禁用成功");
                }
            }  else {
                if(!empty($ary_post['val']) && $ary_post['val'] == '1'){
                    $this->success("启用失败");
                }else{
                    $this->success("禁用失败");
                }
            }
        }else{
            $this->error("菜单不存在");
        }
    }
}

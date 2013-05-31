<?php

class NavAction extends AdminAction{
    
    private $name;


    public function _initialize() {
        parent::_initialize();
        $this->name = $this->_name;
    }
    
    /**
     * 导航列表
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-23
     */
    public function index(){
        
        $name = $this->_name;
        
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        
        $count = D($name)->where()->count();
        
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        
        $page = $obj_page->newshow();
        
        $data = D($name)->order('`order` DESC')->limit($obj_page->firstRow, $obj_page->listRows)->select();
        
//        echo D($name)->getLastSql();
        
        $this->assign("page",$page);
        
//        echo "<pre>";print_r($data);exit;
        
        $this->assign("data",$data);
        
        $this->display();
        
    }
    
    /**
     * 添加导航
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-23
     */
    public function addNav(){
        
        $this->display();
        
    }
    
    /**
     * 编辑导航
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-28
     */
    public function editNav(){
        $ary_get = $this->_get();
        if(!empty($ary_get['id']) && isset($ary_get['id'])){
            $ary_result = D($this->_name)->where(array('id'=>$ary_get['id']))->find();
            if(!empty($ary_result) && is_array($ary_result)){
                $this->assign("data",$ary_result);
                $this->display();
            }else{
                $this->error("数据有误");
            }
        }else{
            $this->error("操作有误,请重试...");
        }
    }
    
    /**
     * 校验导航名称是否重复
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-28
     */
    public function checkName(){
        $ary_get = $this->_get();
        if(!empty($ary_get['name']) && isset($ary_get['name'])){
            if(!empty($ary_get['id']) && isset($ary_get['id'])){
                $where = array();
                $where['name'] = $ary_get['name'];
                $where['id'] = array("neq",$ary_get['id']);
                $ary_result = D($this->_name)->where($where)->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("导航已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }else{
                $ary_result = D($this->_name)->where(array('name'=>$ary_get['name']))->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("导航已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }
        }else{
            $this->ajaxReturn("导航名称不能为空");
        }
    }

    /**
     * 处理添加导航
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-28
     */
    public function doSaveNav(){
        $action = D($this->_name);
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            if(!empty($ary_post['id']) && isset($ary_post['id'])){
                $where = array();
                $where['id'] = $ary_post['id'];
                unset($ary_post['id']);
                $ary_post['update_time'] = date("Y-m-d H:i:s");
                $ary_result = $action->where($where)->data($ary_post)->save();
                if(FALSE !== $ary_result){
                    $this->success("修改成功");
                }else{
                    $this->error("修改失败");
                }
            }else{
                $ary_post['create_time'] = date("Y-m-d H:i:s");
                $ary_result = $action->add($ary_post);
                if(FALSE !== $ary_result){
                    $this->success("添加成功",U("Admin/Nav/index"),5);
                }else{
                    $this->error("添加失败");
                }
            }
        }else{
            $this->error("数据不能为空");
        }
        
    }
    
    /**
     * 处理是否启用及停用
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-23
     */
    public function doEditStatus(){
        
        $ary_get = $this->_request();
        
//        echo "<pre>";print_r($ary_get);exit;
        
        $ary_result = D($this->name)->where(array('id'=>$ary_get['id']))->data(array($ary_get['field']=>$ary_get['val']))->save();
        
        if(FALSE !== $ary_result){
            
            $this->success("操作成功");
            
        }else{
            
            $this->error("操作失败");
            
        }
        
    }
}

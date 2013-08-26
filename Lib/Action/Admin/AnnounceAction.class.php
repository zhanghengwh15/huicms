<?php
// +----------------------------------------------------------------------
// | Huicms [ 让我们一起开发内容管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.huicms.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Terry <admin@huicms.cn>
// +----------------------------------------------------------------------
/**
 * 后台公告模块操作ACTION
 * @author Terry<admin@huicms.cn>
 * @date 2013-06-18
 * 
 */
class AnnounceAction extends AdminAction{
    
    private $name;

    public function _initialize() {
        parent::_initialize();
        $this->name = $this->_name;
    }
    
    /**
     * 公告列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-18
     */
    public function index(){
        $ary_get = $this->_get();
        $action = D($this->name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $action->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $where = array();
        $ary_data = $action->where($where)->limit($obj_page->firstRow, $obj_page->listRows)->order('`order` DESC')->select();
        $this->assign("page",$page);
        $this->assign("data",$ary_data);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 更改公告状态
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-15
     */
    public function doEditStatus(){
        $ary_post = $this->_post();
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $system = M($this->name);
            $data = array();
            $data[$ary_post['field']] = $ary_post['val'];
            $ary_result = $system->where(array('id'=>$ary_post['id']))->data($data)->save();
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
            $this->error("公告不存在");
        }
    }
    
    /**
     * 添加公告
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-18
     */
    public function addAnnounce(){
        
        $this->display();
    }
    
    public function editAnnounce(){
        $ary_get = $this->_get();
        $data = D($this->name)->where(array('id'=>$ary_get['id']))->find();
        $this->assign("data",$data);
        $this->display();
    }
    
    public function doSaveAnnounce(){
        $ary_post = $this->_post();
        $action = D($this->name);
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $id = $ary_post['id'];
            unset($ary_post['id']);
            $ary_post['update_time'] = date("Y-m-d H:i:s");
            $ary_result = $action->where(array('id'=>$id))->data($ary_post)->save();
            if(FALSE != $ary_result){
                $this->success("更新公告成功",U('Admin/Announce/index'));
            }else{
                $this->error("更新公告失败");
            }
        }else{
            $ary_post['create_time'] = date("Y-m-d H:i:s");
            $ary_result = $action->add($ary_post);
            if(FALSE != $ary_result){
                $this->success("公告添加成功",U('Admin/Announce/index'));
            }else{
                $this->error("公告添加失败");
            }
        }
        
    }
}
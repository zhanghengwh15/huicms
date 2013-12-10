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
 * 后台文章分类模块操作ACTION
 * @author Terry<admin@huicms.cn>
 * @date 2013-06-18
 * 
 */
class ArticleCategoryAction extends AdminAction{
    
    private $name;

    public function _initialize() {
        parent::_initialize();
        $this->name = "Category";
    }
    
    /**
     * 文章分类列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-15
     */
    public function index(){
        $category = D($this->name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $category->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $where = array();
        $where['pid'] = '0';
        $ary_data = $category->where($where)->limit($obj_page->firstRow, $obj_page->listRows)->order('`order` DESC')->select();
        if(!empty($ary_data) && is_array($ary_data)){
            $data = array();
            foreach($ary_data as $ky=>$vl){
                $data = $category->where(array('pid'=>$vl['id']))->find();
                if(!empty($data) && is_array($data)){
                    $ary_data[$ky]['count'] = '1';
                }
            }
//            echo "<pre>";print_r($ary_data);exit;
        }
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 更改分类状态
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
            $this->error("分类不存在");
        }
    }
    
    /**
     * 显示子级分类
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-16
     */
    public function doCategoryUnfold(){
        $ary_post = $this->_post();
        $category = D($this->name);
        $data = $category->where(array('pid'=>$ary_post['pid']))->select();
        echo json_encode($data);exit;
    }
    
    /**
     * 删除操作
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-16
     */
    public function doDelete(){
        $mod = D($this->name);
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
     * 添加文章分类
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-30
     */
    public function add(){
        $category = $this->getSelect();
        $this->assign("category",$category);
        $this->display();
    }
    
    /**
     * 保存文章分类
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-30
     */
    public function doAdd(){
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            $module = D($this->name);
            $ary_post['create_time'] = date("Y-m-d H:i:s");
            $ary_result = $module->add($ary_post);
            if(FALSE !== $ary_result){
                $this->success("新增成功",'/Admin/'.MODULE_NAME.'/');
            }else{
                $this->error("新增失败");
            }
        }else{
            $this->error("数据有误，请重试……");
        }
    }
    
    /**
     * 编辑文章分类
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-30
     */
    public function edit(){
        $mod = D($this->name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            $ary_data = $mod -> where(array($pk=>$ids))->find();
            $category = $this->getSelect($ids,$ary_data['pid']);
            $this->assign('data',$ary_data);
            $this->assign("category",$category);
            $this->display();
        }else{
            $this->error("请选择需要编辑的对象");
        }
    }
    
    /**
     * 更新文章分类
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-30
     */
    public function doEdit(){
        $mod = D($this->name);
        $pk = $mod->getPk();
        $field = $mod->getDbFields();
        $ary_request = $this->_request();
        $id = $ary_request[$pk];
        unset($ary_request[$pk]);
        if($id){
            $where = array();
            $where[$pk] = array('NEQ',$id);
            $where[$field[1]] = $ary_request[$field[1]];
            $ary_data = $mod ->where($where)->find();
            if(!empty($ary_data) && is_array($ary_data)){
                $this->error("名称已存在");
            }else{
                $ary_request['update_time'] = date("Y-m-d H:i:s");
                $ary_res = $mod ->where(array($pk=>$id))->data($ary_request)->save();
                if(FALSE !== $ary_res){
                    $this->success("编辑成功");
                }else{
                    $this->error("编辑失败");
                }
            }
        }else{
            $this->error("请选择需要编辑的对象");
        }
    }
    
    /**
     * 校验分类名称是否重复
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-28
     */
    public function checkName(){
        $ary_get = $this->_get();
        if(!empty($ary_get['title']) && isset($ary_get['title'])){
            if(!empty($ary_get['id']) && isset($ary_get['id'])){
                $where = array();
                $where['title'] = $ary_get['title'];
                $where['id'] = array("neq",$ary_get['id']);
                $ary_result = D($this->name)->where($where)->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("分类已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }else{
                $ary_result = D($this->name)->where(array('title'=>$ary_get['title']))->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("分类已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }
        }else{
            $this->ajaxReturn("分类名称不能为空");
        }
    }
    
    /**
     * 分类下拉函数
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    private function getSelect($currentid, $selectedid =0, $showzerovalue = 1, $selectname = 'pid'){
        $strHtml = '<select name="' . $selectname . '" class="select rounded">';
        if($showzerovalue){
            $strHtml .= '<option value="0">一级栏目</option>';
        }
        $where = array();
        $where['status'] = '1';
        $ary_category = D("Category")->where($where)->order('`order` desc')->select();
        $strHtml .= $this->getOption($ary_category, $currentid, $selectedid);
        $strHtml .= '</select>';
        return $strHtml;
    }
    
    /**
     * 分类选项列表函数
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    private function getOption($category, $currentid = 0, $selectedid = 0, $pid = 0, $sublevelmarker = ''){
        if($pid) $sublevelmarker .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        
        foreach($category as $value){
            if($pid == $value['pid'] AND $value['id'] != $currentid){
                $strHtml .= '<option ';
                if(!$pid){
                    $strHtml .= 'style="font-weight:bold;"';
                }
                $strHtml .= 'value="' . $value['id'] . '"';
                if($selectedid == $value['id']){
                    $strHtml .= 'selected';
                }else{
                    $strHtml .= '';
                }
                $strHtml .= '>' . $sublevelmarker . $value['title'] .'</option>';
                $strHtml .= $this->getOption($category, $currentid, $selectedid, $value['id'], $sublevelmarker);
            }
        }
        
        return $strHtml;
    }
}

<?php
// +----------------------------------------------------------------------
// | Huicms [ 让我们一起开发内容管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.huicms.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Terry <admin@52sum.com>
// +----------------------------------------------------------------------
/**
 * 后台文章分类模块操作ACTION
 * @author Terry<admin@52sum.com>
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
     * @author Terry<admin@52sum.com>
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
    
    
}

<?php
/**
 *
 * 文章模块操作
 *
 * @package             HuiCms
 * @author              Terry QQ:466209365 <admin@huicms.cn>
 * @copyright           Copyright (c) 20012-2013  (http://www.huicms.cn)
 * @license             http://www.huicms.cn/license.txt
 * @version             Huicms企业网站管理系统 v1.0 2013-04-14 huicms.cn $
 */
class ArticleAction extends AdminAction {

    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 文章列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-07-02
     */
    public function index() {
        $action = D($this->_name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $where = array();
        $count = $action->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        
        $ary_data = $action
                        ->field(C("DB_PREFIX")."category.title as cat_title,".C("DB_PREFIX")."article.*,".C("DB_PREFIX")."admin.u_name as author_name")
                        ->join(C("DB_PREFIX")."category ON ".C("DB_PREFIX")."category.id=".C("DB_PREFIX")."article.cid")
                        ->join(C("DB_PREFIX")."admin ON ".C("DB_PREFIX")."admin.u_id=".C("DB_PREFIX")."article.uid")
                        ->where($where)->limit($obj_page->firstRow, $obj_page->listRows)->order(C("DB_PREFIX").'article.`update_time` DESC')->select();
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->display();
    }

    /**
     * 添加文章
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    public function addArticle() {
        $category = $this->getSelect();
        $this->assign("category",$category);
        $this->display();
    }

    /**
     * 保存文章
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    public function doAdd(){
        $ary_post = $this->_post();
        
        if(!empty($ary_post) && is_array($ary_post)){
            $module = D($this->_name);
            $ary_post['create_time'] = date("Y-m-d H:i:s");
            $ary_post['uid'] = $_SESSION[C('USER_AUTH_KEY')];
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
     * 更新文章状态
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    public function edit(){
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            $ary_data = $mod -> where(array($pk=>$ids))->find();
            $category = $this->getSelect($ary_data['cid']);
            $this->assign('data',$ary_data);
            $this->assign("category",$category);
            $this->display();
        }else{
            $this->error("请选择需要编辑的对象");
        }
    }
    
    public function doEdit(){
        $mod = D($this->_name);
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
                $ary_request['uid'] = $_SESSION[C('USER_AUTH_KEY')];
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
     * 更改文章状态
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
     */
    public function doEditStatus(){
        $ary_post = $this->_post();
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $mod = D($this->_name);
            $data = array();
            $data[$ary_post['field']] = $ary_post['val'];
            $ary_result = $mod->where(array('id'=>$ary_post['id']))->data($data)->save();
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
            $this->error("该信息不存在");
        }
    }

    /**
     * 删除操作
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-10
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
    
    private function getSelect($selectedid =0, $selectname = 'cid'){
        $sReturn = '<select name="' . $selectname . '" validate="{ selected:true}"><option value="0">-- 请选择 --</option>';
        $ary_category = D("Category")->where()->order('`order` desc')->select();
        $sReturn .= $this->getOptions($ary_category, $selectedid);
        $sReturn .= '</select>';
        return $sReturn;
    }

    private function getOptions($category, $selectedid = 0, $pid = 0, $sublevelmarker = ''){
        if($pid) $sublevelmarker .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        foreach($category as $value){
            if($pid == $value['pid']){
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
                $strHtml .= $this->getOptions($category, $selectedid, $value['id'], $sublevelmarker);
            }
        }

        return $strHtml;
    }
    
}
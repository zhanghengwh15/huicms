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
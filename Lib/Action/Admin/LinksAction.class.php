<?php
/**
 * 后台友情链接模块操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-04-14
 * 
 */
class LinksAction extends AdminAction{
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function index() {
//        $this->redirect(U('Admin/Links/pageList'));
        $name = $this->getActionName();
        $action = D($name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $action->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $action->where()->limit($obj_page->firstRow, $obj_page->listRows)->order(array('order'=>'desc'))->select();
//        echo $action->getLastSql();exit;
        if(!empty($ary_data) && is_array($ary_data)){
            foreach($ary_data as $key=>$val){
                $ary_data[$key]['image_path'] = str_replace("/Public/Lib/ueditor/php/../../../", "", str_replace("//", "/", $val['image_path']));
            }
        }
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 角色列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-04-14
     */
    public function pageList(){
        $name = $this->getActionName();
        $action = D($name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $action->where()->count();
        $obj_page = new Page($count, $ary_get['pageall']);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        $page = $obj_page->newshow();
        $ary_data = $action->where()->limit($obj_page->firstRow, $obj_page->listRows)->order(array('order'=>'desc'))->select();
//        echo $action->getLastSql();exit;
        if(!empty($ary_data) && is_array($ary_data)){
            foreach($ary_data as $key=>$val){
                $ary_data[$key]['image_path'] = str_replace("/Public/Lib/ueditor/php/../../../", "", str_replace("//", "/", $val['image_path']));
            }
        }
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 添加友情链接
     * @author Terry <admin@52sum.com>
     * @date 2013-04-14
     */
    public function addLinks(){
        $this->display();
    }
    
    /**
     * 处理友情链接添加
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-04-14
     */
    public function doSaveLinks(){
        $name = $this->getActionName();
        $action = D($name);
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            if(!empty($ary_post['id']) && isset($ary_post['id'])){
                $where = array();
                $where['id'] = $ary_post['id'];
                unset($ary_post['id']);
                $ary_post['update_time'] = date("Y-m-d H:i:s");
//                echo "<pre>";print_r($ary_post);exit;
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
                    $this->success("添加成功");
                }else{
                    $this->error("添加失败");
                }
            }
        }else{
            $this->error("数据不能为空");
        }
    }
    
    /**
     * 编辑友情链接
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-04-14
     * 
     */
    public function editLinks(){
        $name = $this->getActionName();
        $action = D($name);
        $ary_get = $this->_get();
        if(!empty($ary_get['id']) && isset($ary_get['id'])){
            $ary_data = $action->where(array('id'=>$ary_get['id']))->find();
            if(!empty($ary_data) && is_array($ary_data)){
                $ary_data['image_path'] = str_replace("/Public/Lib/ueditor/php/../../../", "", str_replace("//", "/", $ary_data['image_path']));
                $this->assign("data",$ary_data);
//                echo "<pre>";print_r($ary_data);exit;
                $this->display();
            }else{
                $this->error("未获取到数据");
            }
        }else{
            $this->error("数据有误");
        }
    }
    
    
}
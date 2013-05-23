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
        
        $obj_page = new Pager($count, $ary_get['pageall']);
        
        $obj_page->setConfig("header","条");
        
        $obj_page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        
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

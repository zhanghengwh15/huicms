<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends AdminAction {
    public function index(){
        $this->display();
//        $this->redirect(U('Admin/Index/welcomePage'));
    }
    
    public function test(){
        echo "<pre>";print_r("222");exit;
    }
    
    public function demo(){
        $this->display();
    }
    
    public function form(){
        $this->display();
    }
}
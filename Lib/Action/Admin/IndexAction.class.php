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
    
    /**
     * 后台地图
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-04-18
     * 
     */
    public function map(){
        $list = array();
        $rolenav = D('RoleNav')->where(array('status'=>'1'))->order('sort ASC')->select();
        if(!empty($rolenav) && is_array($rolenav)){
            foreach ($rolenav as $v) {
                $where = array();
                $where['nav_id'] = $v['id'];
                $where['status'] = '1';
                $where['action'] = array('EQ','');
                $v['sub'] = D("RoleNode")->where($where)->select();
                if(!empty($v['sub']) && is_array($v['sub'])){
                    foreach ($v['sub'] as $key=>$sv) {
                        $ary_where = array();
                        $ary_where['nav_id'] = $v['id'];
                        $ary_where['module_name'] = array('EQ',$sv['module_name']);
                        $ary_where['action'] = array('NEQ','');
                        $ary_where['action_name'] = array('notlike',array('%编辑%','%删除%'),'AND');
                        $ary_where['status'] = '1';
                        $v['sub'][$key]['sub'] = D("RoleNode")->where($ary_where)->select();
                    }
                    $list[] = $v;
                }
            }
        }
        $this->assign("data",$list);
        $this->display();
    }

    public function getLeftMenu(){
        layout(false);
        $ary_post = $this->_post();
        if(!empty($ary_post['nav_id']) && intval($ary_post['nav_id']) > 0){
            $menus = $this->getMenus($ary_post['nav_id']);
            $this->assign("menus", $menus);
            $this->display("Common:incMenu");
        }
    }
}
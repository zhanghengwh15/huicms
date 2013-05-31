<?php
/**
 * 后台留言操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-04-16
 */
class MessageAction extends AdminAction{
    
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-01
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        import('ORG.Net.IpLocation');// 导入IpLocation类
        $Ip = new IpLocation(); // 实例化类
        $name = $this->getActionName();
        $message = D($name);
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = $message->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $message->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        if(!empty($ary_data) && is_array($ary_data)){
            foreach ($ary_data as $k=>$v){
                $ary_data[$k]['ip_location'] = $Ip->getlocation($v['log_ip']);
            }
        }
        $this->assign("data", $ary_data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display();
    }
    
    /**
     * 更新留言审核状态
     * @author Terry<admin@52sum.com>
     * @date 2013-04-16
     */
    public function doEditAudit(){
        
    }
    
    /**
     * 删除留言
     * @author Terry<admin@52sum.com>
     * @date 2013-04-16
     */
    public function doDelete(){
        $ary_get = $this->_get();
        $name = $this->getActionName();
        $message = D($name);
        if(!empty($ary_get['id']) && isset($ary_get['id'])){
            $ary_result = $message->where(array('id'=>$ary_get['id']))->delete();
            if(FALSE != $ary_result){
                $this->success("留言删除成功");
            }else{
                $this->error("留言删除失败");
            }
        }else{
            $this->error("留言数据有误,请重试...");
        }
    }
}
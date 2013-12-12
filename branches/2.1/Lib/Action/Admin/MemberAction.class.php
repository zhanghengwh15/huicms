<?php
/**
 * 会员模块
 * @author  Terry<admin@huicms.cn>
 * @date 2013-05-13
 */
class MemberAction extends AdminAction{
    
    protected $name;

    /**
     * 控制器初始化
     * @author Terry <admin@huicms.cn>
     * @date 2013-05-13
     */
    public function _initialize() {
        parent::_initialize();
        $this->name = "Members";
    }
    
    /**
     * 会员列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-13
     */
    public function index(){
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $count = D($this->name)->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $data = D($this->name)->field(C("DB_PREFIX")."members.*,".C("DB_PREFIX")."member_level.ml_name")
                    ->join(C("DB_PREFIX")."member_level ON ".C("DB_PREFIX")."members.ml_id=".C("DB_PREFIX")."member_level.ml_id")
                    ->where()
                    ->select();
//        $data = D($this->name)->where()->select();
        $this->assign("data",$data);
        $this->assign("page", $page);
        $this->assign("filter",$ary_get);
        $this->display(); 
    }
    
    /**
     * 添加会员
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-01
     */
    public function addMember(){
        $ary_mLevel = D("MemberLevel")->where(array('ml_status'=>'1'))->select();
        $this->assign("mLevel",$ary_mLevel);
        $this->display();
    }
    
    /**
     * 编辑会员信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-01
     */
    public function editMember(){
        $ary_get = $this->_get();
        if(!empty($ary_get['mid']) && isset($ary_get['mid'])){
            $data = D($this->name)->where(array('m_id'=>$ary_get['mid']))->find();
            $city_data = D("City")->getCityLastInfo($data['c_id']);
            $ary_mLevel = D("MemberLevel")->where(array('ml_status'=>'1'))->select();
            $this->assign("mLevel",$ary_mLevel);
            $this->assign("data",$data);
            $this->assign("region",$city_data);
            $this->display();
        }else{
            $this->error("数据有误");
        }
    }
    
    /**
     * 处理会员信息
     * @author Terry<admin@huicms.cm>
     * @date 2013-06-01
     */
    public function doSaveMember(){
        $ary_post = $this->_post();
        $ary_member = D($this->name)->where(array('m_id'=>$ary_post['m_id']))->find();
        if(empty($ary_member) && !is_array($ary_member)){
            $this->error("该会员不存在");
        }
        
        if(md5($ary_post['m_passwd']) != md5($ary_post['confirm_password'])){
            $this->error("两次密码不一致");
        }
        unset($ary_post['confirm_password']);
        if(!empty($ary_post['m_passwd'])){
            $ary_post['m_passwd']   = md5(trim($ary_post['m_passwd']));
        }else{
            unset($ary_post['m_passwd']);
        }
        $mid = $ary_post['m_id'];
        unset($ary_post['m_id']);
        $ary_post['m_enteruser'] = isset($ary_post['m_enteruser']) ? '1' : '0';
        $c_id = '';
        if(empty($ary_post['region1'])){
            if(empty($ary_post['city'])){
                $c_id = $ary_post['province'];
            }else{
                $c_id = $ary_post['city'];
                
            }
        }else{
            $c_id = $ary_post['region1'];
            
        }
        unset($ary_post['region1']);
        unset($ary_post['city']);
        unset($ary_post['province']);
        $ary_post['c_id'] = $c_id;
        $ary_post['m_update_time'] = date("Y-m-d H:i:s");
        $ary_result = D($this->name)->where(array('m_id'=>$mid))->data($ary_post)->save();
//        echo "<pre>";print_r(D($this->name)->getLastSql());exit;
        if(FALSE !== $ary_result){
            $this->success("会员更新成功");
        }else{
            $this->error("会员更新失败");
        }
    }
    
    /**
     * 新增会员信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-12
     */
    public function doAdd(){
        $ary_post = $this->_post();
        if(md5($ary_post['m_passwd']) != md5($ary_post['confirm_password'])){
            $this->error("两次密码不一致");
        }
        unset($ary_post['confirm_password']);
        if(!empty($ary_post['m_passwd'])){
            $ary_post['m_passwd']   = md5(trim($ary_post['m_passwd']));
        }else{
            unset($ary_post['m_passwd']);
        }
        $ary_post['m_enteruser'] = isset($ary_post['m_enteruser']) ? '1' : '0';
        $c_id = '';
        if(empty($ary_post['region1'])){
            if(empty($ary_post['city'])){
                $c_id = $ary_post['province'];
            }else{
                $c_id = $ary_post['city'];
                
            }
        }else{
            $c_id = $ary_post['region1'];
            
        }
        unset($ary_post['region1']);
        unset($ary_post['city']);
        unset($ary_post['province']);
        $ary_post['c_id'] = $c_id;  
        $ary_post['m_reg_time']  = date("Y-m-d H:i:s");
        $ary_result = D($this->name)->add($ary_post);
        if(FALSE !== $ary_result){
            $this->success("会员新增成功",U('Admin/Member/index'));
        }else{
            $this->error("会员新增失败");
        }
        
    }
    
    /**
     * 删除会员操作
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
     * 审核会员
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-02
     */
    public function doEditStatus(){
        $ary_res = array('success'=>'0','msg'=>'操作失败','data'=>array(),'errCode'=>'');
        $ary_post = $this->_post();
        if(!empty($ary_post['m_id']) && isset($ary_post['m_id'])){
            $m_status = $ary_post['m_status'] ? 0 : 1;
            $m_str = $ary_post['m_status'] ? '未审核' : '已审核';
            $ary_result = D($this->name)->where(array('m_id'=>$ary_post['m_id']))->data(array('m_status'=>$m_status))->save();
            if(FALSE != $ary_result){
                $ary_res['success'] = '1';
                $ary_res['data'] = array(
                    'statusMsg' => $m_str,
                    'status'    => $m_status
                );
                $ary_res['msg'] = '操作成功';
            }else{
                $ary_res['errCode'] = '10002';
            }
        }else{
            $ary_res['errCode'] = '10001';
            $ary_res['msg'] = '会员不存在';
        }
        echo json_encode($ary_res);exit;
    }
    
    /**
     * 异步获取 区域数据
     * @author Terry<admin@huicms.cn>
     * @date 2013-12-11
     */
    public function cityRegionOptions() {
        if (!isset($_POST["parent_id"]) || !is_numeric($_POST["parent_id"]) || $_POST["parent_id"] <= 0) {
                echo json_encode(array("status" => false, "data" => array(), "message" => "父级区域ID不合法"));
                exit;
        }
        $int_parent_id = $_POST["parent_id"];
        $array_result = D("City")->where(array("parent_id" => $int_parent_id,'status'=>'1'))->order(array("order" => "asc"))->getField("id,name");
        if (false === $array_result) {
                echo json_encode(array("status" => false, "data" => array(),'sql'=>D("City")->getLastSql(), "message" => "无法获取区域数据"));
                exit;
        }
        echo json_encode(array("status" => true, "data" => $array_result,'sql'=>D("City")->getLastSql(), "message" => "success"));
        exit;
    }
    
    /**
     * 校验会员名称是否重复
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-28
     */
    public function checkName(){
        $ary_get = $this->_get();
        if(!empty($ary_get['m_name']) && isset($ary_get['m_name'])){
            if(!empty($ary_get['m_id']) && isset($ary_get['m_id'])){
                $where = array();
                $where['name'] = $ary_get['m_name'];
                $where['m_id'] = array("neq",$ary_get['m_id']);
                $ary_result = D($this->name)->where($where)->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("会员名称已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }else{
                $ary_result = D($this->name)->where(array('m_name'=>$ary_get['m_name']))->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("会员名称已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }
        }else{
            $this->ajaxReturn("会员名称不能为空");
        }
        
    }
    
}
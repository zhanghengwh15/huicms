<?php
/**
 * 管理员操作类
 * @author Terry<admin@52sum.com>
 * @date 2013-3-26
 * 
 */
class SystemAction extends AdminAction{
    /**
     * 修改管理员登录密码
     * @author Terry <admin@52sum.com>
     * @date 2013-3-26
     */
    public function pageEditAdminPasswd(){
        $data = array(
            'name'  => session("admin_name"),
            'id'    => session("admin")
        );
        $this->assign("data",$data);
        $this->display();
    }
    
    /**
     * 处理修改密码
     * @author Terry<admin@52sum.com>
     * @date 2013-3-26
     * 
     */
    public function doEditPasswd(){
        $ary_post = $this->_post();
        $admin = M("Admin");
        if(!empty($ary_post['u_id']) && intval($ary_post['u_id']) > 0){
            $data = $admin->where(array('u_id'=>$ary_post['u_id']))->find();
            if($data['u_passwd'] != md5($ary_post['old_passwd'])){
                $this->error("旧密码不正确");
            }else{
                $where= array();
                $system = D("System");
                $where['u_id']  = $ary_post['u_id'];
                $ary_data = array();
                $ary_data['u_passwd']    = md5($ary_post['u_passwd']);
                $ary_res = $system->saveUpdateAdmin($ary_data,$where);
                if($ary_res){
                    unset($_SESSION[C('USER_AUTH_KEY')]);
                    unset($_SESSION);
                    session_destroy();
                    $this->success('修改成功',U('Admin/User/pageLogin'));
                    
                }else{
                    $this->error("修改失败");
                }
            }
        }else{
            $this->error("参数错误");
        }
    }
    
    /**
     * 修改管理员信息
     * @author Terry<admin@52sum.com>
     * @date 2013-3-26
     * 
     */
    public function pageEditAdmin(){
        $uid = (int) $this->_get('uid', 'htmlspecialchars', 0);
        if(!empty($uid) && $uid > 0){
            $system = D("System");
            $ary_result = $system->getFindAdmin($uid);
        }else{
            $this->error("用户不存在，请重试！");
        }
        $this->assign("data",$ary_result);
        //echo '<pre>';print_r($ary_get);exit;
        $this->display();
    }
    
}
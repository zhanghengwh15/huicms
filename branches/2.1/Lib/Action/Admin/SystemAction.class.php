<?php
/**
 * 管理员操作类
 * @author Terry<admin@52sum.com>
 * @date 2013-3-26
 * 
 */
class SystemAction extends AdminAction{
    
    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-03-27
     */
    public function _initialize() {
        parent::_initialize();
    }
    
    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-03-27
     */
    public function index() {
        $ary_get = $this->_get();
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $admin = M("admin");
        $count = $admin->join( C("DB_PREFIX")."role ON ".C("DB_PREFIX")."admin.role_id=".C("DB_PREFIX")."role.id")->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $admin->join( C("DB_PREFIX")."role ON ".C("DB_PREFIX")."admin.role_id=".C("DB_PREFIX")."role.id")->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data",$ary_data);
        $this->assign("admin",$admin_access);
        $this->assign("filter",$ary_get);
//        echo "<pre>";print_r($admin_access);exit;
        $this->assign("page",$page);
        $this->display();
//        $this->redirect(U('Admin/System/pageList'));
    }
    
    /**
     * 管理员列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-01-22
     */
    public function pageList(){
        $ary_get = $this->_get();
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $admin = M("admin");
        $count = $admin->join( C("DB_PREFIX")."role ON ".C("DB_PREFIX")."admin.role_id=".C("DB_PREFIX")."role.id")->where()->count();
        $obj_page = new Page($count, $ary_get['pageall']);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li class="pageSelect">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
        $page = $obj_page->newshow();
        $ary_data = $admin->join( C("DB_PREFIX")."role ON ".C("DB_PREFIX")."admin.role_id=".C("DB_PREFIX")."role.id")->where()->limit($obj_page->firstRow, $obj_page->listRows)->select();
        $this->assign("data",$ary_data);
        $this->assign("admin",$admin_access);
        $this->assign("filter",$ary_get);
//        echo "<pre>";print_r($admin_access);exit;
        $this->assign("page",$page);
        $this->display();
    }
    
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
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $uid = (int) $this->_get('uid', 'htmlspecialchars', 0);
        if(!empty($uid) && $uid > 0){
            $system = D("System");
            $ary_result = $system->getFindAdmin($uid);
            $role = D("Role");
            $ary_role = $role->where(array('status'=>'1'))->select();
        }else{
            $this->error("用户不存在，请重试！");
        }
        $this->assign("admin",$admin_access);
        $this->assign("data",$ary_result);
        $this->assign("role",$ary_role);
        $this->display();
    }
    
    /**
     * 处理修改管理员资料
     * @author Terry<admin@52sum.com>
     * @date 2013-3-27
     * 
     */
    public function doEditAdmin(){
        $system = D("System");
        $ary_post = $this->_post();
        if(empty($ary_post['u_id']) && !isset($ary_post['u_id'])){
            $this->error("管理员信息不存在");
        }
        if(!empty($ary_post['u_photo']) && isset($ary_post['u_photo'])){
            $ary_post['u_photo'] = str_replace("/Public/Lib/ueditor/php/../../../", "", str_replace('//',"/",$ary_post['u_photo']));
        }
        $photo = $_FILES['u_photo']['name'];
        if(!empty($photo)){
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();     // 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Public/upload/photo/';// 设置附件上传目录
            if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				$ary_post['u_photo'] = '/Public/upload/photo/' . $info[0]['savename'];
			}
        }
        unset($ary_post['confirm_password']);
        if(!empty($ary_post['u_password'])){
            $ary_post['u_passwd']   = md5(trim($ary_post['u_password']));
        }
        $ary_post['u_update_time']  = date("Y-m-d H:i:s");
        $ary_result = $system->doEditAdmin($ary_post);
        if(FALSE !== $ary_result){
            if(!empty($ary_post['u_photo']) && isset($ary_post['u_photo'])){
                session("pic",$ary_post['u_photo']);
            }
            $this->success("管理员信息更新成功");
        }else{
            $this->error("管理员信息更新失败");
        }
    }
    
    /**
     * 添加管理员信息
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function pageAddAdmin(){
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $role = D("Role");
        $ary_role = $role->where(array('status'=>'1'))->select();
        $this->assign("admin",$admin_access);
        $this->assign("role",$ary_role);
        $this->display();
    }

    /**
     * 保存管理员信息
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function doSaveAdmin(){
        $system = D("System");
        $ary_post = $this->_post();
        $photo = $_FILES['u_photo']['name'];
        if(!empty($photo)){
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();     // 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Public/upload/photo/';// 设置附件上传目录
            if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				$ary_post['u_photo'] = '/Public/upload/photo/' . $info[0]['savename'];
			}
        }
        unset($ary_post['confirm_password']);
        if(!empty($ary_post['u_password'])){
            $ary_post['u_passwd']   = md5(trim($ary_post['u_password']));
        }
        $ary_post['u_create_time']  = date("Y-m-d H:i:s");
        $ary_result = $system->doEditAdmin($ary_post);
        if(FALSE !== $ary_result){
            if(!empty($ary_post['u_photo']) && isset($ary_post['u_photo'])){
                session("pic",$ary_post['u_photo']);
            }
            $this->success("添加管理员成功");
        }else{
            $this->error("添加管理员失败");
        }
    }
    
    /**
     * 校验管理员唯一性
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function checkName(){
        $system = M("Admin");
        $ary_get = $this->_get();
        if(!empty($ary_get['u_name']) && isset($ary_get['u_name'])){
            if(!empty($ary_get['uid']) && isset($ary_get['uid'])){
                $where = array();
                $where['u_name'] = $ary_get['u_name'];
                $where['u_id'] = array("neq",$ary_get['uid']);
                $ary_result = $system->where($where)->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("用户名已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }else{
                $ary_result = $system->where(array('u_name'=>$ary_get['u_name']))->find();
                if(!empty($ary_result) && is_array($ary_result)){
                    $this->ajaxReturn("用户名已存在");
                }else{
                    $this->ajaxReturn(true);
                }
            }
        }else{
            $this->ajaxReturn("用户名不能为空");
        }
        
        
    }
    
    /**
     * 删除管理员
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function doDelete(){
        $ary_get = $this->_get();
        if(!empty($ary_get['uid']) && isset($ary_get['uid'])){
            $system = M("Admin");
            $ary_result = $system->where(array('u_id'=>$ary_get['uid']))->delete();
            if(FALSE !== $ary_result){
                $this->success("管理员删除成功");
            }  else {
                $this->error("管理员删除失败");
            }
        }else{
            $this->error("管理员不存在");
        }
    }
    
    /**
     * 更改管理员状态
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function doEditStatus(){
        $ary_post = $this->_post();
        if(!empty($ary_post['id']) && isset($ary_post['id'])){
            $system = M("Admin");
            $data = array();
            $data[$ary_post['field']] = $ary_post['val'];
            $ary_result = $system->where(array('u_id'=>$ary_post['id']))->data($data)->save();
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
            $this->error("管理员不存在");
        }
    }
    
    /**
     * 管理员登陆日志
     * @author Terry<admin@52sum.com>
     * @date 2013-3-29
     */
    public function pageLogList(){
        $ary_get = $this->_get();
        $ary_get['pageall'] = $this->_get('pageall', 'htmlspecialchars', 10);
        $adminlog = M("AdminLog");
        import('ORG.Net.IpLocation');// 导入IpLocation类
        $Ip = new IpLocation(); // 实例化类
        $count = $adminlog->where()->count();
        $obj_page = $this->_Page($count, $ary_get['pageall']);
        $page = $obj_page->newshow();
        $ary_data = $adminlog->where()->limit($obj_page->firstRow, $obj_page->listRows)->order('log_create desc')->select();
        if(!empty($ary_data) && is_array($ary_data)){
            foreach ($ary_data as $k=>$v){
                $ary_data[$k]['ip_location'] = $Ip->getlocation($v['log_ip']);
            }
        }
        $this->assign("data",$ary_data);
        $this->assign("filter",$ary_get);
        $this->assign("page",$page);
        $this->display();
    }
    
    
    public function doUploadAdmin(){
        $this->display();
    }
}
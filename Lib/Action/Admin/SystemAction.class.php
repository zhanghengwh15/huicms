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
        $this->redirect(U('Admin/System/pageList'));
    }
    
    /**
     * 管理员列表
     * @author Terry <wanghui@guanyisoft.com>
     * @date 2013-01-22
     */
    public function pageList(){
        $ary_get = $this->_get();
        $pagesize = $this->_get('pageall', 'htmlspecialchars', 10);
        $admin_access = D('Config')->getCfgByModule('ADMIN_ACCESS');
        $admin = M("admin");
        $count = $admin->join( C("DB_PREFIX")."role ON ".C("DB_PREFIX")."admin.role_id=".C("DB_PREFIX")."role.id")->where()->count();
        $obj_page = new Page($count, $pagesize);
        $obj_page->setConfig("header","条");
        $obj_page->setConfig('theme','<li style="heigth:23px;line-height:23px;padding-top:8px;">共%totalRow%%header%&nbsp;%nowPage%/%totalPage%页&nbsp;%first%&nbsp;%upPage%&nbsp;%prePage%&nbsp;%linkPage%&nbsp;%nextPage%&nbsp;%downPage%&nbsp;%end%</li>');
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
//        echo '<pre>';print_r($ary_result);exit;
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
        $ary_post['u_update_time']  = date("Y-m-d H:i:s");
        $ary_result = $system->doEditAdmin($ary_post);
        if(FALSE !== $ary_result){
            if(!empty($ary_post['u_photo']) && isset($ary_post['u_photo'])){
                session("pic",$ary_post['u_photo']);
            }
            $this->success("管理员信息修改成功");
        }else{
            $this->error("管理员信息修改失败");
        }
    }
    
    public function doUploadAdmin(){
        $this->display();
    }
}
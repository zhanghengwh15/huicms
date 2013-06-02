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
        $data = D($this->name)->where()->select();
        $this->assign("data",$data);
        $this->display(); 
    }
    
    /**
     * 添加会员
     * @author Terry<admin@huicms.cn>
     * @date 2013-06-01
     */
    public function addMember(){
        
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
//            echo "<pre>";print_r($data);exit;
            $this->assign("data",$data);
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
        if(empty($ary_post['m_id']) && !isset($ary_post['m_id'])){
            $this->error("该会员不存在");
        }
        if(!empty($ary_post['m_pic']) && isset($ary_post['m_pic'])){
            $ary_post['m_pic'] = str_replace("/Public/Lib/ueditor/php/../../../", "", str_replace('//',"/",$ary_post['m_pic']));
        }
        $photo = $_FILES['m_pic']['name'];
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
				$ary_post['m_pic'] = '/Public/upload/photo/' . $info[0]['savename'];
			}
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
        $ary_result = D($this->name)->where(array('m_id'=>$mid))->data($ary_post)->save();
        if(FALSE !== $ary_result){
            if(!empty($ary_post['u_photo']) && isset($ary_post['u_photo'])){
                session("pic",$ary_post['u_photo']);
            }
            $this->success("会员更新成功");
        }else{
            $this->error("会员更新失败");
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
}
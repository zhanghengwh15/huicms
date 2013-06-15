<?php
/**
 * 前台会员模块控制器
 *
 * @package Action
 * @subpackage Home
 * @stage 1.0
 * @author Terry <admin@huicms.cn>
 * @date 2013-05-28
 */
class UserAction extends HomeAction{
    public $name = 'Members';

    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $this->redirect(U('User/Login'));
    }
    
    public function Login(){
        $code = D('Config')->getCfgByModule('CODE_SET');
        $this->assign("code",$code);
        $this->display();
    }
    
    public function Register(){
        $code = D('Config')->getCfgByModule('CODE_SET');
        $this->assign("code",$code);
        $this->display();
    }
    
    /**
     * 处理用户注册信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-30
     */
    public function doRegister(){
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            if(md5($ary_post['m_passwd']) != md5($ary_post['repassword'])){
                $this->error("两次密码不相同");
            }else{
                $ip = get_client_ip();
                $ary_data = array(
                    'm_name'        =>  $ary_post['m_name'],
                    'm_email'       =>  trim($ary_post['m_email']),
                    'm_nickname'    =>  trim($ary_post['m_nickname']),
                    'm_passwd'      =>  md5($ary_post['m_passwd']),
                    'm_reg_time'    =>  date("Y-m-d H:i:s"),
                    'm_reg_ip'      =>  $ip,
                    'm_sex'         =>  $ary_post['m_sex']
                );
                $ary_result = D($this->name)->add($ary_data);
                if(FALSE !== $ary_result){
                    $this->success("注册成功",'/',3);
                }else{
                    $this->error("会员注册失败");
                }
            }
        }else{
            $this->error("数据有误");
        }
    }
    
    /**
     * 验证码
     * @author Terry <admin@52sum.com>
     * @date 2013-03-23
     */
    public function Verify() {
        
        import('ORG.Util.Image');
        $ary_data = D('Config')->getCfgByModule('CODE_SET');
        if(!empty($ary_data) && is_array($ary_data)){
            $ary_data['RECODESIZE'] = json_decode($ary_data['RECODESIZE'],true);
            $ary_data['BACODESIZE'] = json_decode($ary_data['BACODESIZE'],true);
        }
//        echo "<pre>";print_r($ary_data);exit;
        if(!empty($ary_data['BUILDTYPE']) && $ary_data['BUILDTYPE'] == '4'){
            Image::GBVerify(
                $ary_data['RECODENUMS'], 
                $ary_data['EXPANDTYPE'], 
                $ary_data['RECODESIZE']['width'], 
                $ary_data['RECODESIZE']['height'], 
                'simhei.ttf',
                'av'
            );
        }else{
            Image::buildImageVerify(
                $ary_data['RECODENUMS'], 
                $ary_data['BUILDTYPE'], 
                $ary_data['EXPANDTYPE'], 
                $ary_data['RECODESIZE']['width'], 
                $ary_data['RECODESIZE']['height'], 
                'av'
            );
        }
        
    }
    
    public function checkName(){
        $ary_get = $this->_get();
        $modules = D($this->name);
        if(!empty($ary_get['field']) && isset($ary_get['field'])){
            $str = '';
            switch ($ary_get['field']){
                case "m_name":
                    $str = '用户名';
                    break;
                case "m_email":
                    $str = '邮箱';
                    break;
               default:
                    $str = '用户名';
                    break;
            }
            $ary_data = $modules->where(array($ary_get['field']=>$ary_get[$ary_get['field']]))->find();
            if(!empty($ary_data) && is_array($ary_data)){
                $this->ajaxReturn($str."太热门了,已被抢注,换一个吧!");
            }else{
                $this->ajaxReturn(true);
            }
        }else{
            $this->ajaxReturn("操作超时,请重试...");
        }
        
    }
    
    public function checkVerify(){
        $ary_get = $this->_get();
        $code = session("av");
        if($code != md5($ary_get['verify'])){
            $this->ajaxReturn("验证码错误");
        }else{
            $this->ajaxReturn(true);
        }
    }
    
    public function doLogin(){
        $ary_post = $this->_post();
        if(!empty($ary_post) && is_array($ary_post)){
            $ary_result = D($this->name)->where(array('m_name'=>$ary_post['user'],'m_passwd'=>md5($ary_post['passwd'])))->find();
            if(!empty($ary_result) && is_array($ary_result)){
                $ary_data = array(
                    'm_login_ip'    =>  get_client_ip(),
                    'm_login_time'  =>  date('Y-m-d H:i:s')
                );
                D($this->name)->where(array('m_id'=>$ary_result['m_id']))->data($ary_data)->save();
                $ary_result['nickname'] = $ary_result['m_name'];
                $ary_result['figureurl'] = $ary_result['m_pic'];
                session("userinfo",$ary_result);
                $this->success("登录成功");
            }else{
                $this->error("用户名不存在或者密码错误");
            }
        }else{
            $this->error("请输入用户名及密码");
        }
    }
}
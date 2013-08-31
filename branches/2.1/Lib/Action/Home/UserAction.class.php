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
     * @author Terry <admin@huicms.cn>
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
        $code = D('Config')->getCfgByModule('CODE_SET');
        $this->assign("code",$code);
        if(isset($ary_post['verify'])){
            if(empty($ary_post['verify'])){
                $this->error("验证码不能为空");
            }
            if($_SESSION['av'] != md5($ary_post['verify'])){
                $this->error("验证码不正确，请重新输入");
            }
        }
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
                if($this->isAjax()){
                    $this->success("登录成功");
                }else{
                    $this->success("登录成功","/",3);
                }
            }else{
                $this->error("用户名不存在或者密码错误");
            }
        }else{
            $this->error("请输入用户名及密码");
        }
    }
    
    /**
     * 授权成功，用户没用绑定账号
     * @author Terry<wanghui@guanyisoft.com>
     * @date 2013-08-10
     */
    public function bindAccount(){
        
        $this->display();
        
        
        
        
    }
    
    /**
     * 忘记密码
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-11
     */
    public function getPassword(){
        if(IS_POST){
            $ary_post = $this->_post();
            if($_SESSION['av'] == md5($ary_post['verify'])){
//                $mailConf = D('Config')->getCfgByModule('MAILSET');
//                $ary_mailconf = json_decode($mailConf['MAILSET'], true);
                $smtp = new SendMail();
                $ary_member = D($this->name)->where(array("m_name"=>$ary_post['username'],'m_email'=>$ary_post['email']))->find();
                if(!empty($ary_member) && is_array($ary_member)){
                    $title    = '找回密码';
                    $tpl_data = array();
                    $tpl_data['username'] = $ary_member['m_name'];
                    //生成随机码
                    $time = time();
                    $activation = md5($ary_member['m_reg_time'] . substr($ary_member['m_passwd'], 10) . $time);
                    $url_args = array('username'=>$ary_member['m_name'], 'activation'=>$activation, 't'=>$time);
                    $tpl_data['reset_url'] = U('User/resetPwd', $url_args, '', '', true);
                    $content = D("MessageTpl")->getMailInfo("findpwd",$tpl_data);
                    if($smtp->send($ary_member['m_email'],$title,$content)){
                        $this->success("找回密码邮件已经发送到您的邮箱，请查看邮件继续操作");
                    }else{
                        $this->error("邮件发送失败，请联系管理员");
                    }
                }else{
                    $this->error("用户不存在，请重试...");
                }
            }else{
                $this->error("验证码有误……");
            }
        }else{
            $this->display();
        }  
    }
    
    /**
     * 重置密码
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-31
     */
    public function resetPwd(){

        //检测链接合法性
        $username = $this->_get('username', 'trim');
        $activation = $this->_get('activation', 'trim');
        $t = $this->_get('t', 'intval');
        if (!$username || !$activation || !$t) {
            $this->redirect('/');
        }
        //判断是否已经过期
        $time = time();
        if(($time - $t) > 3600){
            $this->error("链接已过期，提交后请在1小时内修改，请重新找回密码！", U('User/getPassword'));
        }
        //验证用户
        $member = D('Members')->field('m_id,m_reg_time,m_passwd')->where(array('m_name'=>$username))->find();
        if(empty($member) && !is_array($member)){
            $this->error($username."不存在", "/");
        }
        if ($activation != md5($member['m_reg_time'] . substr($member['m_passwd'], 10) . $t)) {
            $this->error("找回密码链接有误，请核对！", "/");
        }
        $this->assign("data",$member);
        $this->display();
    }
    
    /**
     * 重置密码处理
     * @author Terry<admin@huicms.cn>
     * @date 2013-08-31
     */
    public function doSetPwd(){
        $ary_post = $this->_post();
        if($_SESSION['av'] != md5($ary_post['verify'])){
            $this->error("验证码输入有误");
        }
        $ary_res = D('Members')->where(array('m_id'=>$ary_post['m_id']))->data(array('m_passwd'=>md5($ary_post['passwd']),'m_reg_time'=>date("Y-m-d H:i:s")))->save();
//        echo "<pre>";print_r(D('Members')->getLastSql());exit;
        if(FALSE !== $ary_res){
            $this->success("密码重置成功",U('User/Login'));
        }else{
            $this->error("密码重置失败，请重试...");
        }
    }
}
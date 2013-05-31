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
        
    }
    
    public function Register(){
        $this->display();
    }
    
    /**
     * 处理用户登录信息
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-30
     */
    public function doRegister(){
        $ary_post = $this->_post();
        echo "<pre>";print_r($ary_post);exit;
    }
    
    /**
     * 验证码
     * @author Terry <admin@52sum.com>
     * @date 2013-03-23
     */
    public function Verify() {
        import('ORG.Util.Image');
        Image::buildImageVerify(4, 0, 'png', 70, 30, 'av');
    }
    
    public function checkName(){
        $ary_get = $this->_get();
        $modules = D($this->name);
        if(!empty($ary_get['field']) && isset($ary_get['field'])){
            $ary_data = $modules->where(array($ary_get['field']=>$ary_get['m_name']))->find();
            if(!empty($ary_data) && is_array($ary_data)){
                $this->ajaxReturn("用户名太热门了,已被抢注,换一个吧!");
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
}
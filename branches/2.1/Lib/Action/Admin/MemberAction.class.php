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
}
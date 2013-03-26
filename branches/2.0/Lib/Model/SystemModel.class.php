<?php
/**
 * 管理员模型
 * @package Model
 *
 * @author Terry <admin@52sum.com>
 * @date 2013-3-26
 */
class SystemModel extends Model{
    private $table_admin;

    public function _initialize() {
        parent::_initialize();
        $this->table_admin = M('Admin');
    }
    
    /**
     * 更新管理员信息
     * @author Terry <admin@52sum.com>
     * @date 2013-3-26
     * @param array $ary_result 更新数据
     * @param array $ary_where 对应更新条件
     * @return boolean 成功true 失败返回false 
     */
    public function saveUpdateAdmin($ary_result,$ary_where){
        if(!empty($ary_result) && is_array($ary_result)){
            $ary_res = $this->table_admin->where($ary_where)->data($ary_result)->save();
            if($ary_res){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

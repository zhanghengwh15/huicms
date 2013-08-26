<?php
/**
 * 管理员模型
 * @package Model
 *
 * @author Terry <admin@huicms.cn>
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
     * @author Terry <admin@huicms.cn>
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
    
    /**
     * 获取管理员信息
     * @author Terry <admin@huicms.cn>
     * @date 2013-3-26
     * @param int $uid 管理员ID
     * @return array $ary_result
     */
    public function getFindAdmin($uid){
        $ary_reslut = array();
        if(!empty($uid) && (int)$uid > 0){
            $ary_reslut = $this->table_admin->where(array('u_id'=>$uid))->find();
            if(!empty($ary_reslut) && is_array($ary_reslut)){
                unset($ary_reslut['u_passwd']);
            }
        }
        return $ary_reslut;
    }
    
    /**
     * 更新管理员信息
     * @author Terry <admin@huicms.cn>
     * @date 2013-3-27
     * @param array $param 
     * @return boolean 成功true 失败返回false 
     */
    public function doEditAdmin($param=array()){
        if(!empty($param['u_id']) && isset($param['u_id'])){
            $uid = $param['u_id'];
            $ary_result = $this->table_admin->where(array('u_id'=>$uid))->data($param)->save();
        }else{
            $ary_result = $this->table_admin->add($param);
        }
        if(FALSE !== $ary_result){
            return true;
        }else{
            return false;
        }
    }
}

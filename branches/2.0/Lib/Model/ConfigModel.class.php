<?php
/**
 * 系统配置模型
 * @package Model
 * @version 1.0
 * @author Terry <admin@52sum.com>
 * @date 2013-3-25
 */
class ConfigModel extends Model{

    /**
     * 从系统配置表中取出模块相关配置
     * @author Terry <admin@52sum.com>
     * @date 2013-3-25
     * @return array
     */
    public function getCfgByModule($module_name){
        $result = $this->field(array('c_key','c_value'))->where(array('c_module'=>$module_name))->select();
        $return = array();
        foreach($result as $v){
            $return[$v['c_key']] = $v['c_value'];
        }
        
        return $return;
    }
}
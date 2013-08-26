<?php
/**
 * 系统配置模型
 * @package Model
 * @version 1.0
 * @author Terry <admin@huicms.cn>
 * @date 2013-3-25
 */
class ConfigModel extends Model{

    /**
     * 从系统配置表中取出模块相关配置
     * @author Terry <admin@huicms.cn>
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
    
    /**
     * 保存配置
     * @author Terry<admin@huicms.cn>
     * @date 2013-05-14
     * @param string $module 配置项分组
     * @param string $key 配置项
     * @param string $value 配置值
     * @param string $desc 配置项描述，为空则不修改描述。修改配置项时一般不用修改描述的
     */
    public function setConfig($module,$key,$value,$desc=''){
    	$cfg = $this->where(array('c_module'=>$module,'c_key'=>$key))->find();
    	if($cfg){
    		$data = array(
    			'c_id' => $cfg['c_id'],
    			'c_module' => $module,
    			'c_key' => $key,
    			'c_value' => $value,
    			'c_value_desc' => $desc,
    			'c_update_time' => date('Y-m-d H:i:s'),
    		);
            if(empty($desc)){
                unset($data['sc_value_desc']);
            }
    		return $this->data($data)->save();
    	}else{
    		$data = array(
    			'c_module' => $module,
    			'c_key' => $key,
    			'c_value' => $value,
    			'c_value_desc' => $desc,
    			'c_create_time' => date('Y-m-d H:i:s')
    		);
            if(empty($desc)){
                unset($data['sc_value_desc']);
            }
//            $this->data($data)->add();
//            echo "<pre>";print_r($this->getLastSql());exit;
    		return $this->data($data)->add();
    	}
    }
}
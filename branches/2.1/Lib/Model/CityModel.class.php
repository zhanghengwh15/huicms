<?php
/**
 * 区域模型类
 * @package Model
 * @version 1.0
 * @author Terry <admin@huicms.cn>
 * @date 2013-12-10
 */
class CityModel extends Model {

    /**
     * 根据最后一级的行政区域ID
     *
     * @param int $c_id 区域的最后一级ID
     * 
     * @return array 返回一个数组：array("province"=>'',"city"=>"","region"=>"")
     * @author Terry <admin@huicms.cn>
     * @version 1.0
     * @modify 2013-12-11
     */
    public function getCityLastInfo($c_id){
        
        $array_result = array("province"=>'',"city"=>"","region"=>"");
        $ary_region = $this->where(array("id"=>$c_id,"status"=>1))->find();
        if(empty($ary_region)){
            //如果没有找到，则需要重新选择
            return $array_result;
        }
        
        $array_result['region'] = $ary_region['id'];
        $ary_city = $this->where(array("id"=>$ary_region['parent_id'],"status"=>1))->find();
        
        if(empty($ary_city)){
            //如果没有找到，则需要重新选择
            return array("province"=>'',"city"=>"","region"=>"");
        }
        $array_result['city'] = $ary_city['id'];
        
        $ary_province = $this->where(array("id"=>$ary_city['parent_id'],"status"=>1))->find();
        if(empty($ary_province)){
            //如果没有找到，则需要重新选择
            return array("province"=>'',"city"=>"","region"=>"");
        }
        $array_result['province'] = $ary_province['id'];
        return $array_result;
    }

}
<?php
/**
 * @author Terry <admin@52sum.com>
 * @date 2013-04-01
 * @return array 认证数组
 */
$authoritys = array();
//不需要认证的模板中的操作
/*
 * $authoritys['no'] = array(
 *      'System'        //不需要认证的模块名
 *      'pageEditAdminPasswd'       //对应模块下的方法名
 * )
 */
$authoritys['no']['System']['pageLogList'] = 1;
$authoritys['no']['System']['pageEditAdminPasswd'] = 1;
$authoritys['no']['System']['pageList'] = 1;
$authoritys['no']['Links']['pageList'] = 1;
$authoritys['no']['RoleNav']['pageList'] = 1;
$authoritys['no']['RoleNav']['checkName'] = 1;
$authoritys['no']['System']['checkName'] = 1;
$authoritys['no']['Role']['pageList'] = 1;
$authoritys['no']['RoleNode']['pageList'] = 1;
$authoritys['no']['System']['checkName'] = 1;
$authoritys['no']['System']['checkEditName'] = 1;
$authoritys['no']['Role']['checkRoleName'] = 1;
$authoritys['no']['Role']['checkEditName'] = 1;
?>


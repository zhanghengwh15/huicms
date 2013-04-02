<?php

/**
 * 简单代码量工作分析
 *
 * @package
 * @stage 7.0
 * @author zuojianghua <zuojianghua@guanyisoft.com>
 * @date 2013-11-25
 * @copyright Copyright (C) 2013, Shanghai GuanYiSoft Co., Ltd.
 */
set_time_limit(0);
error_reporting(E_ALL);
putenv('LANG=en_US.UTF-8');
### require_once 'test.php';
### 参数设置 ##################################################################

$svnname = 'zuojh';
$svnpass = '888888';
$svnurl = 'https://fx.guanyisoft.com/shopplus';
$svncmd = 'sudo /usr/bin/svn';
$reg = '`\.php|\.html|\.htm|\.xml|\.css|\.js|\.txt$`i';
//$svncmd = 'C:\Code\svn\bin\svn.exe';
//$sudoconfig = '/data/www/fx7/works.conf';
##############################################################################

$act = isset($_GET['act']) ? htmlspecialchars($_GET['act']) : '';
switch ($act) {
    //更新统计信息
    case 'refresh':
        $updateStart = isset($_GET['updateStart']) ? htmlspecialchars($_GET['updateStart']) : date("Y-m-d");
        $updateEnd = isset($_GET['updateEnd']) ? htmlspecialchars($_GET['updateEnd']) : date("Y-m-d");
        $start = date('Y-m-d', strtotime($updateStart) - 86400 * 2);
        $end = date('Y-m-d', strtotime($updateEnd) + 86400 * 2);

        //如果有缓存则读取缓存，否则生成缓存
        $tmpFilePath = dirname(__FILE__) . '/tmp/' . md5($svnurl . $start . $end) . '.svnlog';

        if (file_exists($tmpFilePath)) {
            $fileContent = file_get_contents($tmpFilePath);
            echo json_encode(array(
                'status' => 0,
                'result' => simplexml_load_string($fileContent)
            ));
        } else {
            $result = svnlog($svnurl, $svnname, $svnpass, $start, $end);
            file_put_contents($tmpFilePath, $result['result']);
            $result['result'] = simplexml_load_string($result['result']);
            echo json_encode($result);
        }
        break;
    case 'diff':
        $version = isset($_GET['version']) ? htmlspecialchars($_GET['version']) : 0;
        $url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : '';
        $result = svndiff($svnurl, $svnname, $svnpass, $version, $url);
        if ($result[status] == 0) {
            //查找修订日志成功
            //print_r($result[result]);
            $count = analyzeSvnDiff($result[result]);
            echo json_encode(array(
                'status' => $result[status],
                'result' => $count
            ));
        } else {
            //查找失败。可能是新增的文件
            if (false !== strstr($result[result][0], '版本库位置不在版本') && preg_match($reg, $url)) {
                $count = analyzeSvnNew($svnurl, $svnname, $svnpass, $version, $url);
                echo json_encode(array(
                    'status' => 0,
                    'result' => $count
                ));
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'result' => 0
                ));
            }
            //print_r($result);
        }
        break;
    default :
        //$result = svnlog($svnurl, $svnname, $svnpass, $sudoconfig);
        //print_r($result);
        //$xml = simplexml_load_string($testStr);
        //print_r($xml);exit;
        /*
          foreach($xml->logentry as $rev){
          print_r($rev);
          }
         *
         */
        //echo json_encode($xml);
        break;
}

### 方法库 ####################################################################
/**
 * 以XML格式获取SVN修改日志
 * @author zuojianghua<zuojianghua@gmail.com>
 * @date 2013-02-27
 * @param string $svnurl svn仓库地址
 * @param string $svnname svn用户名
 * @param string $svnpass svn密码
 * @return array 返回由执行状态status和执行结果result组成的数组
 */

function svnlog($svnurl, $svnname, $svnpass, $start, $end) {
    global $svncmd;
    $command = $svncmd . " log $svnurl -r {" . $end . "}:{" . $start . "} -v --xml --username $svnname --password $svnpass --non-interactive 2>&1";
    //$command = "sudo /usr/bin/svn log $svnurl -l 100 -v --xml --username $svnname --password $svnpass --non-interactive 2>&1 <$sudoconfig";
    //$command = "sudo /usr/bin/svn log $svnurl -l 100 -v --xml --username $svnname --password $svnpass --non-interactive /data/www/fx7/works.log <$sudoconfig";
    $output = '';
    $status = 0;
    exec($command, $output, $status);
    $output = implode("\n", $output) . "\n";
    return array('status' => $status, 'result' => $output);
}

/**
 * 获取某版本某文件的修订日志
 * @author zuojianghua<zuojianghua@gmail.com>
 * @date 2013-02-28
 * @param string $svnurl svn仓库地址
 * @param string $svnname svn用户名
 * @param string $svnpass svn密码
 * @param string $version 版本号
 * @param string $url 修订的文件路径
 * @return array 返回由执行状态status和执行结果result组成的数组
 */
function svndiff($svnurl, $svnname, $svnpass, $version, $url) {
    global $svncmd;
    $last = $version - 1;
    $command = $svncmd . " diff -r " . $last . ":$version " . $svnurl . $url . " --username $svnname --password $svnpass 2>&1";
    $output = '';
    $status = 0;
    exec($command, $output, $status);
    //$output = implode("\n", $output) . "\n";
    return array('status' => $status, 'result' => $output);
}

/**
 * 获取某文件本次修订的代码工作量
 * @author zuojianghua<zuojianghua@gmail.com>
 * @date 2013-02-28
 * @param array $ary_log SVN修订记录数组
 * @return int 返回代码工作量行数
 */
function analyzeSvnDiff($ary_log) {
    $count = 0;
    foreach ($ary_log as $line => $str) {
        if ($str[0] == '+' && $str[1] != '+') {
            $count++;
        }
        if ($str[0] == '-' && $str[1] != '-' && $ary_log[$line + 1] != '+') {
            $count++;
        }
    }
    return $count;
}

/**
 * 统计SVN中新增文件的代码行数
 * @author zuojianghua<zuojianghua@gmail.com>
 * @date 2013-03-02
 * @param string $svnurl SVN地址
 * @param string $url SVN文件路径
 * @return int 返回新增文件的代码行数
 */
function analyzeSvnNew($svnurl, $svnname, $svnpass, $version, $url) {
    global $svncmd;

    $tmpName = dirname(__FILE__) . '/tmp/' . md5($svnurl . $url . $version) . '.svnfile';
    if (!file_exists($tmpName)) {
        $command = $svncmd . " export -r " . $version . " " . $svnurl . $url . " " . $tmpName . " --username $svnname --password $svnpass 2>&1";
        exec($command);
    }

    $content = file_get_contents($tmpName);
    $contentAry = explode("\n", $content);
    return count($contentAry);
}
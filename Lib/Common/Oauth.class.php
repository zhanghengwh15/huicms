<?php

/**
 * 登陆接口
 * @author Terry<admin@huicms.cn>
 * @date 2013-05-19
 */
class Oauth {

    private $file_path = '';

    public function __construct($file_path) {
        $this->file_path = $file_path;
    }

    /**
     * 获取支付类型列表
     * @author Terry<admin@huicms.cn>
     * @date 2013-04-26
     */
    public function getList() {
        $list = $this->getOauth();
        $install = $this->installOauth();
        if (is_array($list)) {
            foreach ($list as $code => $valoauth) {
                if (isset($install[$code])) {
                    $install[$code]['description'] = $list[$code]['description'];
                    unset($list[$code]);
                }
            }
        }
        $all = @array_merge($install, $list);
        return array('data' => $all,
            array(
                'all' => count($all),
                'install' => count($install)
            )
        );
    }

    public function getOauth($code = '') {
        $modules = $this->readOauth($this->file_path);
        foreach ($modules as $valoauth) {
            if (!empty($code) || $valoauth['code']) {
                $config = array();
                foreach ($valoauth['config'] as $conf) {
                    $name = $conf['name'];
                    $conf['name'] = L($name);
                    if ($conf['type'] == 'select') {
                        $conf['range'] = L($name . '_range');
                    }
                    $config[$name] = $conf;
                }
            }
//            echo "<pre>";print_r($modules);exit;
            $oauth_info[$valoauth['code']] = array(
                "id" => 0,
                "code" => $valoauth['code'],
                "name" => $valoauth['name'],
                "config" => $config,
                "description" => '',
                "status" => '0',
                "author" => $valoauth['author'],
                "version" => $valoauth['version']
            );
        }
        if (empty($code)) {
            return $oauth_info;
        } else {
            return $oauth_info[$code];
        }
    }

    public function installOauth($code = '') {
        if (empty($code)) {
            $intallpayment = array();
            $result = M("Oauth")->select();
            foreach ($result as $r) {
                $r['code'] = ucwords($r['code']);
                $intallpayment[$r['code']] = $r;
            }
            return $intallpayment;
        } else {
            return M("Oauth")->where(array('code' => ucwords($code)))->find();
        }
    }

    /**
     * 读取插件目录中插件列表
     * @param unknown_type $directory
     */
    public function readOauth($directory = ".") {
        $dir = @opendir($directory);
        $set_modules = true;
        $modules = array();
        while (($file = @readdir($dir)) !== false) {
            if (preg_match("/^[A-Z]{1}.*?\\.class.php\$/", $file)) {
                include_once( $directory . DIRECTORY_SEPARATOR . $file );
            }
        }
        @closedir($dir);
        foreach ($modules as $key => $value) {
            asort($modules[$key]);
        }
        asort($modules);
        return $modules;
    }

}
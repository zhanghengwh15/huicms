<?php

/**
 * 支付方式类
 * @author Terry<admin@huicms.cn>
 * @date 2013-04-26
 */
class Payment {

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
        $list = $this->getPayment();
        $install = $this->installPayment();
        if (is_array($list)) {
            foreach ($list as $code => $payment) {
                if (isset($install[$code])) {
                    $install[$code]['pay_desc'] = $list[$code]['pay_desc'];
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

    public function getPayment($code = '') {
        $modules = $this->readPayment($this->file_path);
        foreach ($modules as $payment) {
            if (!empty($code) || $payment['code']) {
                $config = array();
                foreach ($payment['config'] as $conf) {
                    $name = $conf['name'];
                    $conf['name'] = L($name);
                    if ($conf['type'] == 'select') {
                        $conf['range'] = L($name . '_range');
                    }
                    $config[$name] = $conf;
                }
            }
//            echo "<pre>";print_r($modules);exit;
            $payment_info[$payment['code']] = array(
                "pay_id" => 0,
                "pay_code" => $payment['code'],
                "pay_name" => $payment['name'],
                "pay_desc" => $payment['desc'],
                "pay_fee" => '0',
                "config" => $config,
                "pay_is_cod" => $payment['is_cod'],
                "pay_is_online" => $payment['is_online'],
                "pay_status" => '0',
                "pay_order" => "",
                "pay_author" => $payment['author'],
                "pay_website" => $payment['website'],
                "pay_version" => $payment['version']
            );
        }
        if (empty($code)) {
            return $payment_info;
        } else {
            return $payment_info[$code];
        }
    }

    public function installPayment($code = '') {
        if (empty($code)) {
            $intallpayment = array();
            $result = M("Payment")->select();
            foreach ($result as $r) {
                $r['pay_code'] = ucwords($r['pay_code']);
                $intallpayment[$r['pay_code']] = $r;
            }
            return $intallpayment;
        } else {
            return M("Payment")->where(array('pay_code' => ucwords($code)))->find();
        }
    }

    /**
     * 读取插件目录中插件列表
     * @param unknown_type $directory
     */
    public function readPayment($directory = ".") {
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
<?php

/**
 * 后台数据模块操作ACTION
 * @author Terry<admin@52sum.com>
 * @date 2013-04-18
 * 
 */
class DatabaseAction extends AdminAction {

    /**
     * 控制器初始化
     * @author Terry <admin@52sum.com>
     * @date 2013-04-18
     */
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 默认控制器
     * @author Terry <admin@52sum.com>
     * @date 2013-04-18
     */
    public function backup() {
        //获得当前服务器上传最大限制作为分卷大小
        $allow_max_size = $this->_return_bytes(@ini_get('upload_max_filesize'));
        $this->assign('sizelimit', $allow_max_size / 1024);
        $this->assign('backup_name', $this->_make_backup_name());
        //显示所有数据表
        $tables = M()->db()->getTables();
        $this->assign('tables', $tables);
        $this->display();
    }

    /**
     * 保存数据
     * @author Terry <admin@52sum.com>
     * @date 2013-04-18
     */
    public function doSaveBackup(){
        $ary_post = $this->_post();
        echo "<pre>";print_r($ary_post);exit;
    }
    
    /**
     * 将G M K转换为字节
     *
     * @param string $val
     * @author Terry<admin@52sum.com>
     * @date 2013-04-18
     * @return int
     */
    private function _return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }

    /**
     * 生成备份文件夹名称
     * @author Terry<admin@52sum.com>
     * @date 2013-04-18
     */
    private function _make_backup_name() {
        $backup_path = APP_PATH.'Public/database/backup/';
        $today = date('Ymd_', time());
        $today_backup = array(); //保存今天已经备份过的
        if (is_dir($backup_path)) {
            if ($handle = opendir($backup_path)) {
                while (($file = readdir($handle)) !== false) {
                    if ($file{0} != '.' && filetype($backup_path . $file) == 'dir') {
                        if (strpos($file, $today) === 0) {
                            $no = intval(str_replace($today, '', $file)); //当天的编号
                            if ($no) {
                                $today_backup[] = $no;
                            }
                        }
                    }
                }
            }
        }
        if ($today_backup) {
            $today .= max($today_backup) + 1;
        } else {
            $today .= '1';
        }
        return $today;
    }

}
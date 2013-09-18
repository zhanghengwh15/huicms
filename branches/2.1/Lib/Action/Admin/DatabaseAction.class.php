<?php

/**
 * 后台数据模块操作ACTION
 * @author Terry<admin@huicms.cn>
 * @date 2013-04-18
 * 
 */
class DatabaseAction extends AdminAction {

    /**
     * 控制器初始化
     * @author Terry <admin@huicms.cn>
     * @date 2013-04-18
     */
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 默认控制器
     * @author Terry <admin@huicms.cn>
     * @date 2013-04-18
     */
    public function backup() {
        //获得当前服务器上传最大限制作为分卷大小
        $allow_max_size = $this->_return_bytes(@ini_get('upload_max_filesize'));
        $this->assign('sizelimit', $allow_max_size / 1024);
        $this->assign('backup_name', $this->_make_backup_name());
        //显示所有数据表
        $str_sql = "SHOW TABLE STATUS;";
        $tables = D($this->_name)->query($str_sql);
//        echo "<pre>";print_r($tables);exit;
        $Data_length = '';
        if(!empty($tables) && is_array($tables)){
            foreach($tables as $table){
                $Data_length += $table['Data_length'];
            }
        }
        $this->assign("data_length",$Data_length);
        $this->assign('tables', $tables);
        $this->display();
    }

    /**
     * 查看表结构
     * @author Terry<admin@huicms.cn>
     * @date 2013-09-18
     */
    public function getDbStruct(){
        $tbname = $this->_get('tbname', 'htmlspecialchars,trim', '');
        //获取表结构
        $str_sql = "SHOW FULL COLUMNS FROM `".$tbname."`";
        $ary_struct = D($this->_name)->query($str_sql);
        $this->assign("struct",$ary_struct);
        $this->display();
    }
    
    /*
     * 修复/优化表
     * @author Terry<admin@huicms.cn>
     * @date 2013-09-18
     */
    public function doDbOperations(){
        $tbname = $this->_post('tbname', 'htmlspecialchars,trim', '');
        $db_action = $this->_post('action', 'htmlspecialchars,trim', '');
        $action = !empty($db_action) ? $db_action : 'REPAIR';
        //判断该表是否存在
        $action_msg = $action == 'REPAIR' ? '修复' : '优化';
        $str_sql = "SHOW FULL COLUMNS FROM `".$tbname."`";
        $ary_table = D($this->_name)->query($str_sql);
        if(!empty($ary_table) && is_array($ary_table)){
            $sql = $action." TABLE `".$tbname."`";
            $ary_result = D($this->_name)->query($sql);
            if(FALSE !== $ary_result){
                $this->success($action_msg ."成功");
            }else{
                $this->error($action_msg."失败");
            }
        }else{
            $this->error("该表不存在，请重试...");
        }
    }

    /**
     * 保存数据
     * @author Terry <admin@huicms.cn>
     * @date 2013-04-18
     */
    public function doSaveBackup(){
        $ary_post = $this->_post();
        if(IS_POST || isset($ary_post['datasubmit'])){
            $sizelimit = isset($ary_post['sizelimit']) && abs(intval($ary_post['sizelimit'])) ? abs(intval($ary_post['sizelimit'])) : $this->error("每个分卷文件大小有误");
            $filename = isset($ary_post['backup_name']) && trim($ary_post['backup_name']) ?
                    trim($ary_post['backup_name']) : $this->error("文件名不能为空");
            $backup_path = APP_PATH.'Public/database/backup/';
            $backup_tables = isset($_POST['backup_tables']) && $_POST['backup_tables'] ? $_POST['backup_tables'] :
                    $this->error("请选择需要备份的表");
            if (is_dir($backup_path . $filename)){
                $this->error($filename . "目录不存在");
            }
            mkdir(APP_PATH . $backup_path . $filename);
        }else{
            $this->error("备份数据有误,请重试...");
        }
    }
    
    /**
     * 将G M K转换为字节
     *
     * @param string $val
     * @author Terry<admin@huicms.cn>
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
     * @author Terry<admin@huicms.cn>
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
<?php
/**
 * 通知设置Model
 * @package Model
 * @author Terry <admin@huicms.cn>
 * @date 2013-08-31
 */
class MessageTplModel extends Model{
    
    /**
     * 获取邮件模板内容
     * @author Terry<admin@huicms.cn>
     */
    public function getMailInfo($alias, $data = array()) {
        return $this->_fetch_tpl($alias, $data, 'mail');
    }
    
    /**
     * 获取模板文件
     * @author Terry<admin@huicms.cn>
     */
    private function _get_tplfile($alias, $type) {
        layout(false);
        return "./Public/data/" . $type . '_tpl/' . $alias . '.html';
    }

    private function _fetch_tpl($alias, $data, $type) {
        $tpl_file = $this->_get_tplfile($alias, $type);
        if (!is_file($tpl_file)) {
            return false;
        }
        $website = D('Config')->getCfgByModule('WEBSITE');
        $config = json_decode($website['WEBSITE'], true);
        $tpl_data = array(
            'site_name' => $config['site_name'],
            'send_time' => date('Y-m-d H:i:s'),
        );
        $tpl_data = array_merge($tpl_data, $data);
        //实例化视图类
        $view = Think::instance('View');
        //模板变量传值
        $view->assign($tpl_data);
        return $view->fetch($tpl_file);
    }
}
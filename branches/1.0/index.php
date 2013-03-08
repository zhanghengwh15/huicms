<?php
@date_default_timezone_set('PRC');
define( "ROOTPATH", dirname(__FILE__)."/" );
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/kernel');
require(SP_PATH."/System.class.php");
$str_base_url = HttpHandler::get_base_url();
$str_base_url .= $str_base_url[strlen($str_base_url)-1]=="/" ? "" : "/";
define( "WEB_ROOT", $str_base_url );
define("REWRITED", $GLOBALS['G_SP']['rewrite']);
$rewrite = '';
if(TRUE === $GLOBALS['G_SP']['rewrite']){
    $rewrite =WEB_ROOT.'index.php';
}
define("WEB_ENTRY", $rewrite);
spRun();
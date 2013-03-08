<?php

class MainAction extends Action {

    public function Index() {
        //$this->jump("http://www.baidu.com",3);exit;
        //echo "<pre>";echo ROOTPATH;exit;
        //echo "Enjoy, Speed of PHP!";
        $title = "显示模板，这里使用的模板是根目";
        $this->title = $title;
        $this->display("index.html"); // 显示模板，这里使用的模板是根目
    }

    public function Test() {
        echo $this->spArgs('id')."<br>";
        die('Ucenter Test');
        $y = "2012";
        $m = "10";
        $time = date("t",  mktime(0,0,0,$m,1,$y));
        echo $time;
    }

    public function Login() {
	echo "<pre>";print_r($_SESSION);exit;
    }

}

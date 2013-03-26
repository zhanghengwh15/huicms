<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Huicms管理后台</title>
    <link href="__PUBLIC__/Admin/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/Admin/css/wysiwyg.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/Admin/css/styles.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src='__PUBLIC__/Lib/jquery/js/jquery-1.8.3.js'></script>
</head>
    <body id="homepage">
        <div id="header">
            <a href="" title=""><img src="__PUBLIC__/Admin/images/cp_logo.png" alt="Control Panel" class="logo" /></a>
            <div id="searcharea">
                <p class="left smltxt"><a href="#" title="">Advanced</a></p>
                <input type="text" class="searchbox" value="Search control panel..." onclick="if (this.value =='Search control panel...'){this.value=''}"/>
                <input type="submit" value="Search" class="searchbtn" />
            </div>
        </div>

        <!--面包屑导航-->
<div id="breadcrumb">
    <ul>	
        <li><img src="__PUBLIC__/Admin/images/icons/icon_breadcrumb.png" alt="Location" /></li>
        <li><strong>Location:</strong></li>
        <li><a href="#" title="">Sub Section</a></li>
        <li>/</li>
        <li class="current">Control Panel</li>
    </ul>
</div>
        <!-- Top Breadcrumb End -->

        <!-- Right Side/Main Content Start -->
        <div id="rightside">
            <div class="contentcontainer">
    <div class="headings alt">
        <h2>修改密码</h2>
    </div>
    <div class="contentbox">
        <form action="<?php echo U('Admin/System/doEditPasswd');?>" method="post">
            <p>
                <label for="textfield"><strong>旧密码:</strong></label>
                <input type="password" id="textfield" class="inputbox" name="old_passwd" required /> <br />
                <span class="smltxt"></span>
            </p>
            <p>
                <label for="textfield"><span><strong>新密码:</strong></span></label>
                <input type="password" id="errorbox" class="inputbox" name="u_passwd" required /><br />
                <span class="smltxt red"></span>
            </p>
            <p>
                <label for="textfield"><span><strong>确认密码:</strong></span></label>
                <input type="password" id="correctbox" class="inputbox" name="confirm_passwd" required />
            </p>
            <input type="hidden" value="<?php echo ($data["id"]); ?>" name="u_id">
            <input type="submit" value="Submit" class="btn" /> 
        </form>         
    </div>
</div>
        </div>
        <!-- Right Side/Main Content End -->

        <!-- 左边菜单栏 -->
        <div id="leftside">
    <div class="user">
        <img src="__PUBLIC__/Admin/images/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
        <p>登陆者:</p>
        <p class="username"><?php echo (session('admin_name')); ?></p>
        <p class="userbtn"><a href="<?php echo U('Admin/System/pageEditAdminPasswd');?>" title="">修改密码</a></p>
        <p class="userbtn"><a href="<?php echo U('Admin/User/doLogout');?>" title="退出">退出</a></p>
    </div>
    <div class="notifications">
        <p class="notifycount"><a href="" title="" class="notifypop">10</a></p>
        <p><a href="" title="" class="notifypop">New Notifications</a></p>
        <p class="smltxt">(Click to open notifications)</p>
    </div>
    
    <ul id="nav">
        <li>
            <ul class="navigation">
                <li class="heading selected">Current Section</li>
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
            </ul>
        </li>
        <li>
            <a class="collapsed heading">Section Heading</a>
            <ul class="navigation">
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
            </ul>
        </li>
        <li>
            <a class="expanded heading">Section Heading</a>
            <ul class="navigation">
<!--                 class="likelogin"-->
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
                <li><a href="#" title="">Section link here</a></li>
            </ul>
        </li>            
    </ul>
</div>
        <!-- 左边菜单栏 -->

        
        <script type='text/javascript' src='__PUBLIC__/Admin/js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='__PUBLIC__/Admin/js/visualize.jQuery.js'></script>
        <script type="text/javascript" src='__PUBLIC__/Admin/js/functions.js'></script>

        <!--[if IE 6]>
        <script type='text/javascript' src='__PUBLIC__/Admin/js/png_fix.js'></script>
        <script type='text/javascript'>
          DD_belatedPNG.fix('img, .notifycount, .selected');
        </script>
        <![endif]--> 
    </body>
</html>
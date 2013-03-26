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
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)): ?><h1>:)</h1>
<p class="success"><?php echo($message); ?></p>
<?php else: ?>
<h1>:(</h1>
<p class="error"><?php echo($error); ?></p><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
        </div>
        <!-- Right Side/Main Content End -->

        <!-- 左边菜单栏 -->
        <div id="leftside">
    <div class="user">
        <img src="__PUBLIC__/Admin/images/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
        <p>登陆者:</p>
        <p class="username"><?php echo (session('admin_name')); ?></p>
        <p class="userbtn"><a href="javascript:void(0);" title="">修改密码</a></p>
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
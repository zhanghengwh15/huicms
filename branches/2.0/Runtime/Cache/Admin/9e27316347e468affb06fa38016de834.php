<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆页</title>
<link href="__PUBLIC__/Admin/css/layout.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/Admin/css/login.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/Lib/jquery/js/jquery-1.8.3.js"></script>
<link href="__PUBLIC__/Admin/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="logincontainer">
    	<div id="loginbox">
        	<div id="loginheader">
<!--            	<img src="__PUBLIC__/Admin/images/cp_logo_login.png" alt="Control Panel Login" />-->
            </div>
            
            <div id="innerlogin">
            	<form method="post" action="<?php echo U('Admin/User/doLogin');?>" id="login">
                	<p>用户名:</p>
                	<input type="text" class="logininput" name="username" />
                    <p>密&nbsp;&nbsp;码:</p>
                	<input type="password" class="logininput" name="passwd" />
                    <p>验证码:</p>
                    <span class="verify">
                        <input type="text" class="logincode" name="code" id="code" />
                        <img id="verify" src="<?php echo U('Admin/User/verify');?>" class="changeVerify" style="cursor: pointer;" title="点击更新验证码" />
                    </span>
                    
                   	<input type="submit" class="loginbtn" value="登陆" /><br />
<!--                    <p><a href="javascript:void(0);" title="忘记密码?">忘记密码</a></p>-->
                </form>
                
                <div id="resultMsg" style="display:none;"></div>
            </div>
            
        </div>
        <img src="__PUBLIC__/Admin/images/login_fade.png" alt="Fade" />
        <script>
            $(document).ready(function(){
                var timer;
                $(".changeVerify").click(function(){
                    clearTimeout(timer);
                    $('#verify').attr('src','<?php echo U("Admin/User/verify");?>'+'?r='+Math.random());
                });
                
                $("#login").submit(function(){
                    login();
                    return false;
                });
                
                $("#code").keypress(function(){
                    $(this).val($(this).val().toUpperCase());
                })
                
                $("#code").blur(function(){
                    $(this).val($(this).val().toUpperCase());
                })
                
            });
            
            function login(){
                $("#resultMsg").stop().removeClass('ajaxerror').addClass('loading').html("提交请求中，请稍候...").show();
                var url = "<?php echo U('Admin/User/doLogin');?>";
                var data = $("#login").serialize();
                $.ajax({
                    url:url,
                    cache:false,
                    dataType:"json",
                    data:data,
                    type:"POST",
                    error:function(){
                        $("#resultMsg").addClass('ajaxerror').html("AJAX请求发生错误！").show().fadeOut(5000);
                    },
                    success:function(msgObj){
                        $("#resultMsg").hide();
                        if(msgObj.status == '1'){
                            window.location.href = "<?php echo U('Admin/Index/index');?>";
                        }else{
                            $("#resultMsg").addClass('ajaxerror').html(msgObj.info).show().fadeOut(5000);
                            fleshVerify();
                        }
                    }
                });
            }
            
            function fleshVerify(){
                var time = new Date().getTime();
                $("#verify").attr('src',"<?php echo U('Admin/User/verify');?>?r="+time);
            }
            
            
        </script>
        
    </div>
</body>
</html>
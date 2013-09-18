/*
 * 框架布局设置
 */
function setFrameworkLayout() {
    window_width = $(window).width();
    window_height = $(window).height();
    //设置头部
    $('.head').css({
        'width':window_width-0,
        'height':'91px'
    });
    var content_height = window_height-0;
    $('.contentBox').css({
        'width':window_width-0
    }).height(content_height).css({
        'float':'left'
    });
    $('.sidebar').width(161).height(content_height-14).css({
        'float':'left',
        'overflow':'hidden'
    });
    $('.leftside').width(161).height(content_height-0).css({
        'float':'left',
        'overflow':'hidden'
    });
    var right_width = window_width - 141;
    $('.rightcontent').width(right_width-25).height(content_height-102).css({
        'float':'right',
        'overflow-x':'hidden',
        'overflow-y':'auto'
    });
    $('#sliderNavBox').width(161).height(content_height-100).css({
        'float':'left',
        'overflow-y':'auto',
        'overflow-x':'hidden'
    });
}
$(function() {
    $('body').css({
        'padding':0,
        'margin':0,
        'float':'none',
        'width':'100%',
        'overflow':'hidden'
    });
    setFrameworkLayout();
    framework_layout_timeout_id = window.setInterval('setFrameworkLayout()', 500);
})

$(document).ready(function () {
    $('span.bar-btn').click(function () {
        $('ul.bar-list').toggle('fast');
    });
});

$(document).ready(function(){
    $('.list tr:odd').addClass('odd');  
    $('.list tr:even').addClass('even');
    $('.list tr').hover( 
        function(){
            $(this).addClass('activity'); 
        },
        function(){
            $(this).removeClass('activity'); 
        }
        );
});

$(document).ready(function(){
    $('.title2div').hover(
        function(){
            title = this.title;
            this.title = '';
            $(this).css('cursor','pointer'); 
            $('body').append('<div id="titlediv_jq" class="title_div rouned">'+title+'</div>');
            var win_width = document.documentElement.clientWidth ? document.documentElement.clientWidth : (window.innerWidth ? window.innerWidth : (document.body.clientWidth ? document.body.clientWidth : 1024));
            var width = $('#titlediv_jq').width();
            var x = $(this).offset().left;
            var left = x < (win_width/2) ? x+$(this).width() : x-width;
            var top = $(this).offset().top + $(this).height(); 
            $('#titlediv_jq').css({
                'top':top+"px",
                "left":left+"px",
                "opacity":'0'
            });
            $('#titlediv_jq').animate({
                opacity:'0.9'
            },600); 
        },
        function(){
            this.title = title; 
            $('#titlediv_jq').remove(); 
        }		
        );
    
});

$(document).ready(function(){
    $.metadata.setType("attr","validate");
});

$(document).ready(function(){   
    $(".formvalidate").validate({
        errorElement: "span",
        errorClass: "errormsg",
        success:"valid"
    });   
});

$(document).ready(function(){
    (function (d) {
        d['lock'] = true;
        d['fixed'] = true;
        d['okValue'] = '确定';
        d['cancelValue'] = '取消';
        d['title'] = '提示消息';
    })($.dialog.defaults);

});

function bindAdminMenu(){
    $("[nc_type='parentli']").click(function(){
        var key = $(this).attr('dataparam');
        if($(this).find("dd").css("display")=="none"){
            $("[nc_type='"+key+"']").slideDown("fast");
            $(this).find('dt').css("background-position","-322px -170px");
            $(this).find("dd").show();
        }else{
            $("[nc_type='"+key+"']").slideUp("fast");
            $(this).find('dt').css("background-position","-483px -170px");
            $(this).find("dd").hide();
        }
    });
}

 
    

$(function(){
    bindAdminMenu();
})

/**
 * 全选与取消全选
 * 将全选的checkbox的class设为checkAll.列表中的checkbox的class设为checkSon
 * @author Terry<admin@huicms.cn>
 * @date 2013-03-28
 */
$(document).ready(function(){
    /*全选与取消*/
    $('#checkboxall').click(function(){
        if($(this).attr('checked')=='checked'){
            $('.checkSon').attr('checked','checked');
        }else{
            $('.checkSon').removeAttr('checked');
        }
    });
    
    if($('.list').length) {
        
        var checkAll = $('input.checkAll');
        $.each(checkAll,function(){
            var check_all = $(this), check_items;
            //分组各纵横项
            var check_all_direction = check_all.data('direction');
            check_items = $('input.checkSon[data-'+ check_all_direction +'id="'+ check_all.data('checklist') +'"]');
            //点击全选框
            check_all.change(function (e) {
                var check_wrap = check_all.parents('.tbList'); //当前操作区域所有复选框的父标签（重用考虑）

                if ($(this).attr('checked')) {
                    //全选状态
                    check_items.attr('checked', true);

                    //所有项都被选中
                    if( check_wrap.find('input.checkSon').length === check_wrap.find('input.checkSon:checked').length) {
                        check_wrap.find(checkAll).attr('checked', true);
                    }

                } else {
                    //非全选状态
                    check_items.removeAttr('checked');

                    //另一方向的全选框取消全选状态
                    var direction_invert = check_all_direction === 'x' ? 'y' : 'x';
                    check_wrap.find($('input.checkAll[data-direction="'+ direction_invert +'"]')).removeAttr('checked');
                }

            });
            
            //点击非全选时判断是否全部勾选
            check_items.change(function(){

                if($(this).attr('checked')) {

                    if(check_items.filter(':checked').length === check_items.length) {
                        //已选择和未选择的复选框数相等
                        check_all.attr('checked', true);
                    }

                }else{
                    check_all.removeAttr('checked');
                }

            });
        });
    }
    
    
    
    $(".module-item").change(function(){
        var parent = $(this).parent().parent().parent().parent();
        if(this.checked)
        {
            $('.select-all,.action-item',parent).attr({
                'disabled':true,
                'checked':false
            });
        }
        else
        {
            $('.select-all,.action-item',parent).attr({
                'disabled':false
            });
        }
    });
    $(".select-all").change(function(){
        var parent = $(this).parent().parent().parent();
        if(this.checked)
        {
            $('.action-item',parent).attr({
                'checked':true
            });
        }
        else
        {
            $('.action-item',parent).attr({
                'checked':false
            });
        }
    });

    $(".action-item").change(function(){
        var parent = $(this).parent().parent().parent();
        if($(".action-item:not([checked])",parent).length == 0)
        {
            $('.select-all',parent).attr({
                'checked':true
            });
        }
        else
        {
            $('.select-all',parent).attr({
                'checked':false
            });
        }
    });
    
})

//判断是否是第一次登陆后台
$(document).ready(function(){
    if($.cookie('module') != null){
    //		openItem($.cookie('nav_id')+','+$.cookie('module')+','+$.cookie('action'));
    }else{
        $('#mainMenu>ul').first().css('display','block');
        //第一次进入后台时，默认定到欢迎界面
        $('#item_welcome').addClass('selected');			
    }
});

function openItem(menu){
    var str = menu.split(',');
    var op = str[0];
    try{
        var module = str[1];
        var action = str[2];
        var id = str[3];
    }catch(ex){}
    if (typeof(module)=='undefined'){
        var nav = menu;
    }
    $('.actived').removeClass('actived');
    $('#nav_'+nav).addClass('actived');
    $('.selected').removeClass('selected');	
    $('#mainMenu ul').css('display','none');
    $('#sort_menu').css('display','block');
    //    var first_obj = $('#sort_menu>li>dl>dd>ol>li:eq(1)').find('a').attr("name");
    if (typeof(module)=='undefined'){
        //顶部菜单事件
        html = $('#sort_menu>li>dl>dd>ol>li').first().html();
        var first_obj = $('#sort_menu>li>dl>dd>ol>li:eq(1)').find('a').attr("name");
        first_obj = $('#sort_menu>li>dl>dd>ol>li').first().children('a');
        $(first_obj).addClass('selected');
        $.cookie('nav_id',null);	
        $.cookie('nav_id',op);
    }else{
        $.cookie('module',null);
        $.cookie('module',module);
        $.cookie('action',null);	
        $.cookie('action',action);
        $.cookie('id',null);
        $.cookie('id',id);
        $.cookie('nav_id',null);
        $.cookie('nav_id',op);
        $("#item_"+op).addClass('selected');//使用name，不使用ID，因为ID有重复的
        $("a[name='item_"+op+"']").addClass('selected');
    }
    var url = '/Admin/'+module+'/'+action;
    if (typeof(module)!='undefined'){
        window.location.href=url;
    }else{
        window.location.reload();
    }
}   


/**
 * 定义提示信息
 * @author Terry<admin@huicms.cn>
 * @date 2013-04-16
 */
function showMsg(flag,msg,content,send){
    var img_class = '';
    if(flag){
        img_class = 'success';
    }else{
        img_class = 'error';
    }
    if(typeof(send) == 'undefined'){
        send = 5;
    }
    $.dialog({
        title:msg, 
        width:'200px',
        height:'200px',
        content:'<h2>' +content +'</h2>', 
        resize: false,
        drag: false,
        init: function () {
            var that = this, i = send;
            var fn = function () {
                that.title(msg + '<font color="red">'+i+'</font>' + '秒后关闭');
                !i && that.close();
                i --;
            };
            timer = setInterval(fn, 1000);
            fn();
        },
        close: function () {
            clearInterval(timer);
        },
        
        icon:img_class,
        lock:true
    })
}

$(document).ready(function(){
    //后台地图
    $('#adminMap').live('click', function(){
        var title = $(this).attr('title');
        var data_uri = $(this).attr('data-uri');
        $.dialog({
            id:'admin_map', 
            title:title, 
            padding:'',
            resize: false,
            drag: false,
            width:'50%', 
            lock:true
        });
        var dialog = $.dialog.get('admin_map');
        $.get(data_uri, function(html){
            dialog.content(html);
        });
    });
});

//后台统一提示信息
function showMessage(status,msg,url,time){
    var str;
    var status = parseInt(status);
    
    if(status == '2'){
        str = 'warning';        //警告
    }else if(status == '0'){
        str = 'error';        //失败信息
    }else{
        str = 'succeed';        //成功信息
    }
    var time = parseInt(time)?parseInt(time):1;
    var times = time;
    time = time*1000;
    $.dialog({
        title:"消息",
        padding:'0px',
        content:'<div class="showMessage">\n\
                    <div class="aui_iconBg">\n\
                        <img src="../../Public/Lib/artdialog/skins/icons/'+str+'.png" class="images" />\n\
                    </div>\n\
                    <div class="aui_content" style="margin: 22px 15px 22px 5px;">\n\
                        <b style="color:#666;">'+msg+'</b>\n\
                    </div>\n\
                </div>',
        time:time             
    });
    if(status == 1){
        var i = times;
        var timer = setInterval(function () {
            i--;
            if (i === 0) {
                clearInterval(timer);
                $.dialog({
                    title:false,
                    initialize:function(){
                        location.href = url;
                        return false;
                    }
                });
            };
        }, 1000);
    }
    return false;
}

//后台列表分类展开
$(document).ready(function(){
    $("img[data-type='show']").live('click',function(){
        var status = $(this).attr("data-status");
        if(status == 'open'){
            var tr = $(this).parent('td').parent('tr');
			var id = $(this).attr('data-id');
            var uri = "/Admin/ArticleCategory/doCategoryUnfold";
//            alert(uri);return false;
			var obj = $(this);
			$(this).attr('data-status','none');
            $.ajax({
                url:uri,
                cache:false,
                dataType:'json',
                type:'POST',
                data:{pid:id},
                success:function(msgObj){
                    var str='';
//                    alert(msgObj.length);return false;
                    for(var i = 0; i < msgObj.length; i++){
                        str += "<tr class='"+tr.attr('class')+" row_"+id+"' id=list_"+msgObj[i].id+">";
                            str += '<td class="align-center">';
                                str += '<input type="checkbox" data-xid="checkSon_x" class="checkSon" name="checkall" value="'+msgObj[i].id+'">';
                            str += '</td>';
                            str += '<td class="align-center">';
                                str += '<div class="button-group">';
                                    str += '<a title="编辑" alt="编辑" class="button danger icon pill edit" href="/Admin/ArticleCategory/editArticleCategory/id/1.html"></a>';
                                    str += '<a title="删除" class="button danger icon pill remove doDel" data-acttype="ajax" data-msg="确定要删除“<font color=\'red\'>'+msgObj[i].title+'</font>”吗？" val="'+msgObj[i].id+'" data-uri="/Admin/ArticleCategory/doDelete/id/'+msgObj[i].id+'.html" href="javascript:void(0);"></a>';
                                str += '</div>';
                            str += '</td>';
                            str += '<td class="align-center">'+msgObj[i].title+'</td>';
                            str += '<td class="align-center">'+msgObj[i].alias+'</td>';
                            str += '<td class="align-center">'+msgObj[i].description+'</td>';
                            str += '<td class="align-center">'+msgObj[i].order+'</td>';
                            str += '<td class="align-center">';
                            if(msgObj[i].status == '1'){
                                str += '<img title="启用" alt="启用" src="/Public/Admin/images/icons/icon_1.png" data-value="1" data-field="status" style="cursor: pointer;" data-id="'+msgObj[i].id+'" class="pointer">';
                            }else{
                                str += '<img title="停用" alt="停用" src="/Public/Admin/images/icons/icon_0.png" data-value="0" data-field="status" style="cursor: pointer;" data-id="'+msgObj[i].id+'" class="pointer">';
                            }
                            str += '</td>';
                            str += '<td class="align-center">'+msgObj[i].create_time+'</td>';
                            str += '<td class="align-center">'+msgObj[i].update_time+'</td>';
                        str += '</tr>';
                    }
                    tr.after(str);
                    obj.attr('data-status','close');
					obj.attr('src',obj.attr('src').replace("tr_unfold","tr_shrink"));
					$("img[data-type='show']").unbind('click');
                    $('.doDel').unbind('click');
                }
            });
        }
        if(status == 'close'){
			$(".row_"+$(this).attr('data-id')).remove();
			$(this).attr('src',$(this).attr('src').replace("tr_shrink","tr_unfold"));
			$(this).attr('data-status','open');
		}
    });
    
    
    
});
$(document).ready(function(){
    $('.datetime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        todayBtn: true,
        autoclose: true,
        pickerPosition: "bottom-left"
    });
});

/**
 * 提示信息
 * @author Terry<admin@huicms.cn>
 * @date 2013-09-11
 */
function showTips(status,msg,time){
    if(time == ''){
        time =  2;
    }
    var str_status = '';
    if(status){
        str_status = '1';
        msg = "<font color='green'>"+msg+"</font>";
    }else{
        msg = "<font color='red'>"+msg+"</font>";
        str_status = '3';
    }
    layer.msg(msg, time, str_status);
    return false;
}

/**
 * 鼠标经过显示左侧菜单
 * @author Terry<admin@huicms.cn>
 * @date 2013-09-09
 */
 $(document).ready(function(){
    $("#nav ul li").hover(function(){
        var nav_id = $(this).attr("nav");
        if(isNaN(nav_id)){
            layer.msg('参数有误,请重试', 2, 3);
        }else{
            $.ajax({
                url:'/Admin/Index/getLeftMenu',
                cache:false,
                dataType:"html",
                type:"POST",
                data:{"nav_id":nav_id},
                success:function(msgObj){
                    $("#left_menu").html(msgObj);
                }
            });
        }
    },function(){});

 });
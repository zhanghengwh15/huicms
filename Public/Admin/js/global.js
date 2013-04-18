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
        errorClass: "errormsg"
    });   
});

(function (config) {
    config['lock'] = true;
    config['fixed'] = true;
    config['okVal'] = 'Ok';
    config['cancelVal'] = 'Cancel';
// [more..]
})(art.dialog.defaults);

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
 * @author Terry<admin@52sum.com>
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
    if (typeof(module)=='undefined'){var nav = menu;}
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
        $.cookie('nav_id',op);
    }else{
        $.cookie('module',module);
		$.cookie('action',action);
        $.cookie('id',id);
		$.cookie('nav_id',op);
        $("#item_"+op).addClass('selected');//使用name，不使用ID，因为ID有重复的
        $("a[name='item_"+op+"']").addClass('selected');
    }
    
//    window.location.reload();return false;
//    alert(action);return false;
    var url = '/Admin/'+module+'/'+action;
    if (typeof(module)!='undefined'){
        window.location.href=url;
    }else{
        window.location.reload();
    }
}   


/**
 * 定义提示信息
 * @author Terry<admin@52sum.com>
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
    art.dialog({
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
        art.dialog({id:'admin_map', title:title, padding:'',resize: false,drag: false,width:'50%', lock:true});
        var dialog = art.dialog.get('admin_map');
        $.get(data_uri, function(html){
            dialog.content(html);
        });
    });
});


/*
 * 框架布局设置
 */
function setFrameworkLayout() {
    window_width = $(window).width();
    window_height = $(window).height();
    //设置头部
    $('.header').css({
        'width':window_width-0,
        'height':'70px'
    });
    var content_height = window_height-0;
    $('.contentBox').css({
        'width':window_width-0
    }).height(content_height).css({
        'float':'left'
    });
    $('.sidebar').width(225).height(content_height-14).css({
        'float':'left',
        'overflow':'hidden'
    });
    $('.leftside').width(225).height(content_height-80).css({
        'float':'left',
        'overflow':'hidden'
    });
    var right_width = window_width - 220;
    $('.breadcrumb').width(right_width-40).height(35).css({
        'float':'left'
    });
    $('.rightside').width(right_width-45).height(content_height-102).css({
        'float':'left',
        'overflow-x':'hidden',
        'overflow-y':'auto'
    });
    $('#sliderNavBox').width(225).height(content_height-250).css({
        'float':'left',
        'overflow-y':'auto',
        'overflow-x':'hidden',
        'margin-top':'10px'
    });
}

$(function() {
    $('body, .main').css({
        'padding':0,
        'margin':0,
        'float':'left',
        'width':'100%',
        'overflow':'hidden'
    });
    setFrameworkLayout();
    framework_layout_timeout_id = window.setInterval('setFrameworkLayout()', 500);
})

/**
 * 鼠标悬浮在左侧导航，上下移动菜单
 * @author Terry <admin@52sum.com>
 * @date 2013-03-27
 */
//$(document).ready(function(){
//    var settime;
//    $("#sliderNavBox").mousemove(function(e){
//        var mTop = (($("#sliderNavBox").height() - $("#sliderNavBoxInner").height() ) / $("#sliderNavBox").height())*(e.pageY - $("#sliderNavBox").position().top);
//        mTop = (mTop>0)?0:mTop;
//        $('#sliderNavBoxInner').css("margin-top",mTop);
//    });
//    $("#sliderNavBox").hover(function(){
//        clearTimeout(settime);
//    },function(){
//        settime = setTimeout(function(){
//            $('#sliderNavBoxInner').animate({
//                marginTop:0
//            }, 'normal');
//        },10000);
//    });
//});

/**
 * 表单验证插件设置
 * @author Terry<admin@52sum.com>
 * @date 2013-03-27
 */
$(document).ready(function(){
    $.metadata.setType("attr","validate");
});

$(document).ready(function(){   
    $(".formvalidate").validate({
        errorElement: "span",
        errorClass: "errormsg"
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
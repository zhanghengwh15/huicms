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
    $('.rightside').width(right_width-45).height(content_height-52).css({
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
        errorElement: "label",
        errorClass: "errorbox",
        errorPlacement: function(error, element) {
            if ( element.is(":radio") ){
                error.appendTo( element.next() );  //这里就可以写自己想放的位置了，用after，appendTo什么的
            }else if( element.is(":checkbox") ){
                error.appendTo ( element.next() );
            }else{
                error.appendTo( element.next() );
            }
        }
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
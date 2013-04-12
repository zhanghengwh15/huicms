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

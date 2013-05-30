$.fn.smartFloat = function () {
    var position = function (element) {
        var top = element.position().top, pos = element.css("position");
        var window_width = $(window).width();
        $(window).scroll(function () {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        width:window_width,
                        top: 0
                    });
                } else {
                    element.css({
                        top: scrolls
                    });
                }
            } else {
                element.css({
                    position: pos,
                    top: top
                });
            }
        });
    };
    return $(this).each(function () {
        position($(this));
    });
};
//绑定
            
$(document).ready(function(){
    $("#header").smartFloat();
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
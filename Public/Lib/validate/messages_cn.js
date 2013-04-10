/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: CN
 */
jQuery.extend(jQuery.validator.messages, {
    required: "必填字段",
    remote: "请修正该字段",
    email: "请输入正确格式的电子邮件",
    url: "请输入合法的网址",
    date: "请输入合法的日期",
    dateISO: "请输入合法的日期 (ISO).",
    number: "请输入合法的数字",
    digits: "只能输入整数",
    creditcard: "请输入合法的信用卡号",
    equalTo: "请再次输入相同的值",
    accept: "请输入拥有合法后缀名的字符串",
    maxlength: jQuery.validator.format("请输入一个长度最多是 {0} 的字符串"),
    minlength: jQuery.validator.format("请输入一个长度最少是 {0} 的字符串"),
    rangelength: jQuery.validator.format("请输入一个长度介于 {0} 和 {1} 之间的字符串"),
    range: jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
    max: jQuery.validator.format("请输入一个最大为 {0} 的值"),
    min: jQuery.validator.format("请输入一个最小为 {0} 的值")
});


$.validator.addMethod("username",
    function(value) {
        var p=/^[0-9a-z_A-Z\u4e00-\u9fa5]+$/;
        return p.exec(value)?true:false;
    },
    "只能由英文字母、数字、中文和下划线组成");
$.validator.addMethod("path",
    function(value) {
        var p=/^[0-9a-zA-Z_]+$/;
        return (p.exec(value)||value=='')?true:false;
    },
    "只能由英文字母、数字组成");
$.validator.addMethod("isMobile", function(value, element) {
    var length = value.length;
    return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
}, "请正确填写您的手机号码");
$.validator.addMethod("isPhone", function(value, element) {
    var tel = /^(\d{3,4}-?)?\d{7,9}$/g;
    return this.optional(element) || (tel.test(value));
}, "请正确填写您的电话号码");
$.validator.addMethod("isZipCode", function(value, element) {
    var tel = /^[0-9]{6}$/;
    return this.optional(element) || (tel.test(value));
}, "请正确填写您的邮政编码");

$.validator.addMethod("selected",
    function(value) {

        return (value==''||value==0)?false:true;
    }, "请选择");

$.validator.addMethod("isCheck", function(value, element) {
    var reg =  /^[^\'?,`~():;!@#$%^&*<>+=\\\][\]\{\}]*$/ ;
    return this.optional(element) || (reg.test(value));
}, "请正确填写参数");
$.validator.addMethod("isCheck2", function(value, element) {
    var reg =  /^[^\',`~:;!@#$%^&*<>+=\\\][\]\{\}]*$/ ;
    return this.optional(element) || (reg.test(value));
}, "请正确填写参数");

$.validator.addMethod("isDate", function(value, element){
	var ereg = /^(\d{1,4})(-|\/)(\d{1,2})(-|\/)(\d{1,2})$/;
	var r = value.match(ereg);
	if (r == null) {
		return false;
	}
	var d = new Date(r[1], r[3] - 1, r[5]);
	var result = (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[5]);
	return this.optional(element) || (result);
}, "请输入正确的日期");
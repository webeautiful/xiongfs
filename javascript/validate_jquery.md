---
#JQuery插件之validate.js

###基本需求
* 引入适当版本的jquery库 [*jquery-1.9.0.min.js*](http://jquery.com/download/)
* 引入validate插件

[官方地址](http://jqueryvalidation.org/)    [DEMOS](http://jqueryvalidation.org/files/demo/)

###默认验证规则(rules)和默认提示(messages)

|序号|规则/提示名|规则值|默认提示信息|解释|
|----|-----------|------|------------|----|
|1|required|true|"This field is required."|必输字段(判空)|
|2|remote|"check.php"|Please fix this field.|使用ajax方法调用check.php验证输入值|
|3|maxlength|5|$.validator.format("Please enter no more than {0} characters.")|输入长度最多是5的字符串(汉字算一个字符)|
|4|email|true|Please enter a valid email address.|必须输入正确格式的电子邮件|
|5|url|true|Please enter a valid URL.|必须输入正确格式的网址|
|6|date|true|Please enter a valid date.|必须输入正确格式的日期|
|7|dateISO|true|Please enter a valid date (ISO).|必须输入正确格式的日期(ISO)，例如：2014-05-07，2014/05/07 只验证格式，不验证有效性|
|8|number|true|Please enter a valid number.|必须输入合法的数字(负数,小数)|
|9|digits|true|Please enter only digits.|必须输入整数|
|10|creditcard|?|Please enter a valid credit card number.|必须输入合法的信用卡号|
|11|equalTo|"#field"|Please enter the same value again.|输入值必须和#field相同|
|12|accept|?|Please enter a value with a valid extension.|输入拥有合法后缀名的字符串(上传文件的后缀)|
|13|minlength|10|$.validator.format("Please enter at least {0} characters.")|输入长度最小是10的字符串(汉字算一个字符)|
|14|rangelength|[5,10]|$.validator.format("Please enter a value between {0} and {1} characters long.")|输入长度必须介于 5 和 10 之间的字符串")(汉字算一个字符)|
|15|range|[5,10]|$.validator.format("Please enter a value between {0} and {1}.")|输入值必须介于 5 和 10 之间|
|16|max|5|$.validator.format("Please enter a value less than or equal to {0}.")|输入值不能大于5|
|17|min|10|$.validator.format("Please enter a value greater than or equal to {0}.")|输入值不能小于10|

######特别说明 - ajax验证规则

validate插件的异步验证

    remote:{
                type:'post',//发送请求方式,若省略默认发送get请求
                url:'/index.php/diary/tag_category_list/ajaxCheck',//url地址
                dataType:'json',//发送的请求数据类型text/json等
                data:{
                    cateid:function(){return $('#cateid').val();},
                    tagname:function(){return $('#tagname').val();}
                },//若省略此项,默认传参句柄为元素name属性,值为value
                dataFilter:function(data){//接收返回数据
                    if(data == 1)
                    {
                        return true;//验证通过
                    }else
                    {
                        return false;//显示错误提示信息
                    }
            }

jquery库的异步验证

    $.ajax({
        type:"post",//默认发送get请求
        async:true,//是否异步
        url:"check.php",//请求地址
        dataType:'text',//发送请求数据的类型,text/json等
        data:"key1=val1&key2=val2",//发送的请求数据
        success:function(data){}//data接收ajax响应返回的数据
    });

###验证的触发方式
|触发方式|默认值|描述|
|--------|------|----|
|onsubmit|true|提交时验证|
|onfocusout|true|失去焦点时验证(不包括checkbox,radio)|
|onkeyup|true|敲击键盘时验证|
|onclick|true|鼠标点击时验证(一般验证checkbox,radio)|
|focusInvalid|true|提交表单后,未通过验证的表单(指第一个或提交之前获得焦点的未通过验证的表单)会获得焦点|
|focusCleanup|false|未通过验证的元素获得焦点时,并移除错误提示(避免和focusInvalid一起使用)|

###使用方式
####将校验规则写到js代码中
格式

    <script type="text/javascript">
        $(document).ready(function(){//也可用$(function(){
            $('#formId').validate({
                rules:{
                    验证元素name属性1:{
                        验证规则1:规则值1,
                        验证规则2:规则值2,
                            ....等
                    },
                    验证元素name属性2:{},
                       ...
                       ...
                    验证元素name属性n:{}
                },
                messages:{
                    验证元素name属性1:{
                        验证规则1:自定义提示1,
                        验证规则2:自定义提示2,
                            ....等
                    },
                    验证元素name属性2:{},
                       ...
                       ...
                    验证元素name属性n:{}
                }
            });
        });
    </script>

####validator对象的方法

为一个页面多个表单提交,设置统一的默认值(setDefaults)

    $.validator.setDefaults({
        debug:true
    });

###validate设置项

自定义错误提示的显示位置

    $('#form').validate({
        errorElement:'em',//错误信息的html标签,默认为label标签
        errorPlacement:function(error,element){
            error.appendTo(error.next());//将提示信息定位到input框的下一个兄弟元素(DOM)
        }
    });

自定义表单提交前的动作

    $('#form').validate({
        submitHandler:function(form){
            if(confirm('请确定保存标签设置')) form.submit();//发送在验证已通过之后,弹出确认框,决定是否执行提交表单操作
        }
    });

##自定义验证规则
######添加自定义校验(addMethod)

    格式:$.validator.addMethod(rule,func,msg);
    rule:自定义验证规则的名字(独一无二,避免规则冲突)
    func:该验证规则的处理函数
    msg:自定义的提示信息

######自定义验证规则的常见类型

中文验证

    jQuery.validator.addMethod("chinese", function(value, element) {
            var chinese = /^[\u4e00-\u9fa5]+$/;
            return this.optional(element) || (chinese.test(value));
        }, "只能输入中文");

字符验证

    jQuery.validator.addMethod("userName", function(value, element) {
          return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
      }, "用户名只能包括中文字、英文字母、数字和下划线");

手机号码验证

    jQuery.validator.addMethod("isMobile", function(value, element) {
            var length = value.length;
            return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/.test(value));
        }, "请正确填写您的手机号码");

电话号码验证

    jQuery.validator.addMethod("isPhone", function(value, element) {
            var tel = /^(\d{3,4}-?)?\d{7,9}$/g;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的电话号码");

邮政编码验证

    jQuery.validator.addMethod("isZipCode", function(value, element) {
            var tel = /^[0-9]{6}$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的邮政编码");


##参考文档

---

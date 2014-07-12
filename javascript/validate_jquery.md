---
#JQuery插件之validate.js
[官方地址](http://jqueryvalidation.org/)    [DEMOS](http://jqueryvalidation.org/files/demo/)

###基本需求
* 引入适当版本的jquery库 [*jquery-1.9.0.min.js*](http://jquery.com/download/)
* 引入validate插件

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

```javascript
remote:{
            type:'post',//发送请求方式,若省略默认发送get请求
            url:'/index.php/diary/tag_category_list/ajaxCheck',//url地址
            dataType:'json',//发送的请求数据类型,text/json等(有待进一步确认!!!)
            data:{
                cateid:function(){return $('#cateid').val();},
                tagname:function(){return $('#tagname').val();}
            },//若省略此项,默认传参句柄为验证元素的name属性,值为value
            dataFilter:function(data){//接收返回数据
                if(data == 1)
                {
                    return true;//验证通过
                }else
                {
                    return false;//显示错误提示信息
                }
        }
```

jquery库的异步验证

```javascript
$.ajax({
    type:"post",//默认发送get请求
    async:false,//发送同步请求.默认为true,异步请求
    url:"check.php",//请求地址
    //dataType:'text',//预期服务器返回的数据类型,text/json等
    data:"key1=val1&key2=val2",//发送的请求数据,text/json均可
    success:function(data){}//data接收ajax响应返回的数据
});
```

注意:当a标签发生点击事件时,要做ajax验证,则href属性值应设为:

    'javascript:void(0)'

###验证的触发方式(事件)
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

自定义验证通过后,表单提交前的动作

    $('#form').validate({
        submitHandler:function(form){
            if(confirm('请确定保存标签设置')) form.submit();//弹出确认框,决定是否执行提交表单操作
        }
    });//onsubmit="javascript:if(!confirm('请确定保存标签设置')) return false;"

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

// 手机号码验证

    jQuery.validator.addMethod("isMobile", function(value, element) {
                var length = value.length;
                var mobile =  /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;
                return this.optional(element) || (length == 11 && mobile.test(value));
        }, "请正确填写您的手机号码");

电话号码验证

    jQuery.validator.addMethod("isPhone", function(value, element) {
            var tel = /^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的电话号码");

邮政编码验证

    jQuery.validator.addMethod("isZipCode", function(value, element) {
            var tel = /^[0-9]{6}$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的邮政编码");

QQ号码验证

    jQuery.validator.addMethod("qq", function(value, element) {
            var tel = /^[1-9]\d{4,9}$/;
            return this.optional(element) || (tel.test(value));
        }, "qq号码格式错误");

IP地址验证

    jQuery.validator.addMethod("ip", function(value, element) {
            var ip = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
            return this.optional(element) || (ip.test(value) && (RegExp.$1 < 256 && RegExp.$2 < 256 && RegExp.$3 < 256 && RegExp.$4 < 256));
        }, "Ip地址格式错误");

字母和数字的验证

    jQuery.validator.addMethod("chrnum", function(value, element) {
            var chrnum = /^([a-zA-Z0-9]+)$/;
            return this.optional(element) || (chrnum.test(value));
        }, "只能输入数字和字母(字符A-Z, a-z, 0-9)");

######原生js
浏览器不支持string对象的trim方法的处理
```javascript
if(typeof String.prototype.trim == 'undefined')
{
    String.prototype.trim = function()
    {
        return this.replace(/^\s\s*/,'').replace(/\s\s*$/,'');
    }
}
```

#####提示语的样式与定位
当表单默认显示黄色字体的提示(ts),验证不可为空/标签分类名称已存在时,提示语包含如下

    <!-- 初始化页面时斜体,黄色背景显示:标签只能输入中文-->
    <span id='hintmsg'><em><span class="ts">标签只能输入中文</span></em></span>

验证脚本如下:
```javascript
<script type="text/javascript">
$(function(){
    //自定义验证规则:中文验证
    jQuery.validator.addMethod("chinese", function(value, element) {
        var chinese = /^[\u4e00-\u9fa5]+$/;
        return this.optional(element) || (chinese.test(value));
    }, "只能输入中文");

    //验证添加标签分类
    $('#form').validate({
        debug:true,
        errorElement:'em',
        errorPlacement:function(error,element){
                $('#hintmsg').html('');//清空默认值
                error.appendTo('#hintmsg');
        },//自定义错误信息提示位置
        //验证规则
        rules:{
            'category':{
                required:true,
                chinese:true,
                remote:{
                    url:'/index.php/diary/tag_category_list/ajaxCheck',//url地址
                    type:'post',//发送方式
                    dataType:'text',//请求数据类型text/json等
                    dataFilter:function(data){//接收返回数据
                        if(data == 1)
                        {
                            return true;//验证通过
                        }else
                        {
                            return false;//显示错误提示信息
                        }
                    }
                }
            }
        },
        //错误提示信息
        messages:{
            'category':{
                required:'<span class="tsr">不可为空</span>',//红色字体(tsr)显示
                chinese:'<span class="ts">标签只能输入中文<span>',//黄色字体(ts)显示
                remote:'<span class="tsr">标签分类名称已存在</span>'//红色字体(tsr)显示
            },
        }
    });
});
</script>
```

##参考文档

---

---
#JQuery插件之validate.js
[官方地址](http://jqueryvalidation.org/)    [DEMOS](http://jqueryvalidation.org/files/demo/)

##基本需求
* 引入适当版本的jquery库
* 引入validate插件


###默认验证规则(rules)和默认提示(messages)

|序号|规则/提示名|规则值|默认提示信息|解释|
|----|-----------|------|------------|----|
|1|required|true|"This field is required."|必输字段|
|2|remote|"check.php"|Please fix this field.|使用ajax方法调用check.php验证输入值|
|3|email|true|Please enter a valid email address.|必须输入正确格式的电子邮件|
|4|url|true|Please enter a valid URL.|必须输入正确格式的网址|
|5|date|true|Please enter a valid date.|必须输入正确格式的日期|
|6|dateISO|true|Please enter a valid date (ISO).|必须输入正确格式的日期(ISO)，例如：2014-05-07，2014/05/07 只验证格式，不验证有效性|
|7|number|true|Please enter a valid number.|必须输入合法的数字(负数,小数)|
|8|digits|true|Please enter only digits.|必须输入整数|
|9|creditcard|?|Please enter a valid credit card number.|必须输入合法的信用卡号|
|10|equalTo|"#field"|Please enter the same value again.|输入值必须和#field相同|
|11|accept|?|Please enter a value with a valid extension.|输入拥有合法后缀名的字符串(上传文件的后缀)|
|12|maxlength|5|$.validator.format("Please enter no more than {0} characters.")|输入长度最多是5的字符串(汉字算一个字符)|
|13|minlength|10|$.validator.format("Please enter at least {0} characters.")|输入长度最小是10的字符串(汉字算一个字符)|
|14|rangelength|[5,10]|$.validator.format("Please enter a value between {0} and {1} characters long.")|输入长度必须介于 5 和 10 之间的字符串")(汉字算一个字符)|
|15|range|[5,10]|$.validator.format("Please enter a value between {0} and {1}.")|输入值必须介于 5 和 10 之间|
|16|max|5|$.validator.format("Please enter a value less than or equal to {0}.")|输入值不能大于5|
|17|min|10|$.validator.format("Please enter a value greater than or equal to {0}.")|输入值不能小于10|

###使用方式
####将校验规则写到js代码中
格式

    <script type="text/javascript">
        $(function(){
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

##参考文档

---

#时间选择插件 -- My97 DatePicker
测试版本:4.7  
插件的引入:

    <script src="/static/js/My97DatePicker/WdatePicker.js"></script>

##使用方法
[演示&文档](http://www.my97.net/dp/demo/index.htm)

######设置最小日期比id为d4321的input框日期大三天
```javascript
<input type="text" class="Wdate" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:3});}'})"/>
```

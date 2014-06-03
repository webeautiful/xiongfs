---
#JQuery插件之uploadify
[官方下载](http://www.uploadify.com/download/)  
[中文文档](http://www.yauld.cn/uploadifydoc/)

##部署
- [x] jquery框架
- [x] Flash Player 9.0以上
- [x] uploadify插件(自带[SWFObject](http://code.google.com/p/swfobject/))

##属性

**swf**

描述:定义flash插件uploadify.swf的路径

**uploader**

描述:定义服务器端处理上传数据脚本文件的路径

**overrideEvents**

desc:方便重写Uploadify事件.其值是由事件名组成的数组,纳入该数组的事件将根据以下条件语句跳过默认事件的执行

```javascript
var settings = this.settings;
if ($.inArray('onSelect', settings.overrideEvents) < 0)
{
    /**code block  默认执行的代码片段**/
}
```

**queueSizeLimit**

desc:在弹出的选择上传文件对话框中点击'确定'后,验证单次选择的图片数量是否超限。该选项不限制上传文件数量,限制上传文件数量，使用uploadlimit选项。如果单词上传的文件数量超过此限制值，则触发onSelectError事件  
默认值:(integer)999

**fileSizeLimit**

desc:上传文件大小限制.值为0,表示不限制上传文件大小;值为string,允许使用(B,MB,GB)为单位,默认使用KB为单位.当超过限定值时,将触发onSelectError事件  

**uploadLimit**

desc:定义上传文件总数累计不超过的数量.用来限制可上传文件的总数,当超过该限定值时，将触发 onUploadError事件  
默认值:(integer)999

##事件
**onSelectError**

desc:选择文件的类型/尺寸/数量不符合限定条件时触发,默认操作会弹出alert框

参数:
* file -- 错误的文件对象
+ errorCode - 错误码
    - QUEUE_LIMIT_EXCEEDED:-100(上传队列中文件数量限制,数量由queueSizeLimit属性设置)
    - FILE_EXCEEDS_SIZE_LIMIT:-110(文件尺寸超限,尺寸由fileSizeLimit属性设置)
    - ZERO_BYTE_FILE:-120(0大小文件)
    - INVALID_FILETYPE:-130(文件类型不在设置的范围内,类型由fileTypeExts属性设置,若fileTypeExts属性限制了上传文件的类型,则在弹出的选择对话框中只会显示符合条件的文件类型)
* errorMsg -- 表示超过限制的错误信息

**onDialogOpen**

desc:

**onDialogClose**

desc:

|事件|描 述|默认操作|参数|
|----|-----|--------|----|
|onUploadStart|上传队列中每一个文件被上传之前的瞬间触发|向checkExisting属性指向的php处理程序发送ajax请求,验证上传文件是否重名,弹出confirm框|file:正准备上传的文件对象|
|onUploadSuccess|每上传成功一个文件,就触发一次该事件|显示' - Complete'|file:上传成功的文件对象;data:uploader属性指向的php处理程序返回的值;response:服务器端响应状态,true为上传成功,false为上传失败;|
|onUploadError|每上传失败一个文件,就触发一次该事件||file:上传失败的文件对象;errorCode:错误码;errorMsg:返回的错误信息;errorString:错误的详细信息;|
|onSelect|每添加一个文件至上传队列时触发该事件||file:添加至上传队列的文件对象|
|onQueueComplete|队列中的所有文件被处理完成时触发该事件|||

疑问:18个事件发生的先后顺序?

##方法

|方法|功能描述|
|----|--------|
|cancel|取消当前上传|
|upload|上传指定文件或队列中的所有文件|

##研究
* 上传按钮的样式可以自定义
* 自动上传
* 上传后进度条不隐藏

1.选择文件后(onSelectError)

* 上传的文件类型,用属性'fileTypeExts' : '\*.jpg;\*.jpeg;\*.png;\*.gif'控制,使用该属性后,当选择要上传的文件时只显示符合条件的文件类型
* 图片不能超过5张,用属性'queueSizeLimit':'5'控制,默认错误提示:L701

2.

* 上传中...
* 上传成功
* 上传失败

3.
默认生成的上传进度条:
```HTML
<div id="SWFUpload_0_0" class="uploadify-queue-item">
    <div class="cancel">
        <a href="javascript:$('#file_upload').uploadify('cancel', 'SWFUpload_0_0')">X</a>
    </div>
    <span class="fileName">test.png (0KB)</span><span class="data"></span>
    <div class="uploadify-progress">
        <div class="uploadify-progress-bar">
        <!--Progress Bar-->
        </div>
    </div>
</div>
```
实际项目中自定义模板
```html
<div id="${fileID}" class="uploadify-queue-item">
    <div class="cancel">
        <a href="javascript:$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\')">X</a>
    </div>
    <span class="fileName">${fileName} (${fileSize})</span><span class="data"></span>
    <div class="uploadify-progress">
        <div class="uploadify-progress-bar">
        <!--Progress Bar-->
        </div>
    </div>
</div>
```
注意:默认模板位于uploadify.js的L657

调用用户自定义的事件处理程序:
```javascript
if (settings.onDestroy) settings.onDestroy.call(this);
```

文件已存在上传队列中:
The file named "test.png" is already in the queue.Do you want to replace the existing item in the queue?

The upload limit has been reached (The upload limit has been reached.).

##数据结构

*jq_uploadify*

|字段|类型|说明|可否为空|默认值|备注|
|----|----|----|--------|------|----|
|id|int|主键|否|||
|type|tinyint|类型|否|1|1:属性;2:方法;3:事件 |

---

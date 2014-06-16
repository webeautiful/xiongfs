---
#JQuery插件之uploadify
[官方下载](http://www.uploadify.com/download/)  
[中文文档](http://www.yauld.cn/uploadifydoc/)

##部署
- [x] jquery框架
- [x] Flash Player 9.0以上
- [x] uploadify插件v3.2.1(自带[SWFObject](http://code.google.com/p/swfobject/))

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
**removeCompleted**

desc:设置上传队列是否自动移除.默认上传完成后,上传条3s后自动消失;设置为false,则调用cancel方法时才会消失

**removeTimeout**

desc:设置上传完成后从上传队列中移除的时间

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

desc:对话框关闭时，如果有错误信息则会弹出alert框提示;通过errorEvents属性可以跳过alert的默认程序段，并可通过自定义onDialogClose事件，可以自定义错误提示形式

**onUploadStart**

desc:上传队列中每一个文件被上传之前的瞬间触发.默认向checkExisting属性指向的php处理程序发送ajax请求,验证上传文件是否重名,会弹出confirm框.
modified: 添加了errorEvents属性控制错误可用自定义方式显示

Arguments:
* file -- 正准备上传的文件对象

**onUploadSuccess**

desc:每上传成功一个文件,就触发一次该事件。默认显示' - Complete'

Arguments:
* file -- 上传成功的文件对象
* data -- uploader属性指向的处理程序返回的值
* response -- 服务器端响应状态,true为上传成功,false为上传失败;

**onUploadError**

desc:每上传失败一个文件,就触发一次该事件。

Arguments:
* file -- 上传失败的文件对象
* errorCode -- 错误码
* errorMsg -- 返回的错误信息
* errorString -- 错误信息的详细描述

|事件|描 述|默认操作|参数|
|----|-----|--------|----|
|onSelect|每添加一个文件至上传队列时触发该事件||file:添加至上传队列的文件对象|
|onQueueComplete|队列中的所有文件被处理完成时触发该事件|||

file对象

* file.id
* file.size
* file.name
* file.filestatus
* file.uploaded
* file.status

疑问:18个事件发生的先后顺序?onSelect>onSelectError>onUploadStart>onUploadSuccess>onUploadError

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

* 上传中...(onUploadStart)
* 上传成功(onUploadSuccess)
* 上传失败(onUploadError)

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
默认上传模板(位于onSelect中):
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

onDialogClose事件的L605
Some files were not added to the queue:
The file "tux-joker_1280.png" exceeds the size limit

##自定义属性和事件
**buttonTemplate**

default:false
desc:uploadify插件默认的按钮的兼容性不好,通过定义该属性可以直接使用实际项目提供的按钮样式

##数据结构

*jq_uploadify*

|字段|类型|说明|可否为空|默认值|备注|
|----|----|----|--------|------|----|
|id|int(11)|主键|否|||
|type|tinyint(3)|类型|否|1|1:属性;2:方法;3:事件 |
|desc|varchar(255)|描述|否|''||
|defalut|varchar(100)|默认值|''||

---

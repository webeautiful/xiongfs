---
#JQuery插件之uploadify
[官方下载](http://www.uploadify.com/download/)  
[中文文档](http://www.yauld.cn/uploadifydoc/)

##部署
- [x] jquery框架
- [x] Flash Player
- [x] uploadify插件

##属性

|方法|描 述|
|----|-----|
|swf|定义flash插件uploadify.swf的路径|
|uploader|定义服务器端处理上传数据脚本文件的路径|
|overrideEvents|是数组而非对象,该数组中事件将不会执行默认事件|

##事件

|事件|描 述|默认操作|参数|
|----|-----|--------|----|
|onSelectError|选择文件返回错误时触发|弹出alert框|file:错误的文件对象;errorCode:错误码{QUEUE_LIMIT_EXCEEDED:-100,FILE_EXCEEDS_SIZE_LIMIT:-110,ZERO_BYTE_FILE:-120,INVALID_FILETYPE:-130},errorMsg:表示超过限制的错误码值|
|onUploadStart|上传队列中每一个文件被上传之前的瞬间触发|向checkExisting属性指向的php处理程序发送ajax请求,验证上传文件是否重名,弹出confirm框|file:正准备上传的文件对象|
|onUploadSuccess|每上传成功一个文件,就触发一次该事件|显示' - Complete'|file:上传成功的文件对象;data:uploader属性指向的php处理程序返回的值;response:服务器端响应状态,true为上传成功,false为上传失败;|
|onUploadError|每上传失败一个文件,就触发一次该事件||file:上传失败的文件对象;errorCode:错误码;errorMsg:返回的错误信息;errorString:错误的详细信息;|
|onQueueComplete|队列中的所有文件被处理完成时触发该事件|||

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

---

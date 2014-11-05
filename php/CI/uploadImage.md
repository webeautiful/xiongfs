图片上传
===
###生成缩略图

使用CI自带的[图片处理类](http://codeigniter.org.cn/user_guide/libraries/image_lib.html)

```php
/*
* 生成缩略图
*
* @param:
* - $prefix       - string   缩略图前缀标识
* - $suffix       - string   缩略图前缀标识
* - $width        - integer  缩略图宽
* - $height       - integer  缩略图高
* - $sourceImgLoc - string   原图路径及名称
* - $thumbImgLoc  - string   指定缩略图生成位置及命名(可选参数)
*
*/
private function _createThumb($prefix='',$suffix='_thumb',$width='',$height='',$sourceImgLoc='',$thumbImgLoc='')
{
    $config = array(
        'create_thumb'=>TRUE,//为true时，创建缩略图功能可用
        'thumb2_marker'=>$prefix,//缩略图前缀标识
        'thumb_marker'=>$suffix,//缩略图后缀标识
        'width'=>$width,//缩略图宽
        'height'=>$height,//缩略图高
        'source_image'=>$sourceImgLoc,//原图位置
        'new_image'=>$thumbImgLoc//生成的缩略图位置及命名
    );
    $this->load->library('image_lib');
    $this->image_lib->initialize($config);
    return $this->image_lib->resize();
}
```
###递归删除目录
```php
/*
* 递归删除目录
*
* $dir - 目录路径,如:/home/svn/image/img_group/2014/0619-520/,先删除0619-520目录下所有目录或普通文件,然后删除0619-520目录
*
*/
private function _deleteDir($dir)
{
    if(!$handle=@opendir($dir))
    {//检测要打开目录是否存在
        die("没有该目录");
    }
    while(false!==($file=readdir($handle)))
    {
        if($file !== "." && $file !== "..")
        {//排除当前目录与父级目录
            $file=rtrim($dir,'/').'/'.$file;
            if(is_dir($file))
            {
                $this->_deletedir($file);
            }
            else
            {
                if(@unlink($file))
                {
                    echo"文件<b>$file</b>删除成功。<br>";
                }
                else
                {
                    echo"文件<b>$file</b>删除失败!<br>";
                }
            }
        }
    }
    if(@rmdir($dir))
    {
      echo"目录<b>$dir</b>删除成功了。<br>\n";
    }
    else
    {
      echo"目录<b>$dir</b>删除失败！<br>\n";
    }
}
```

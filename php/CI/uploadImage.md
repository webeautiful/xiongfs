图片上传
===
###生成缩略图

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


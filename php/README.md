***
### php 库
####php生成二维码的方法

* 使用php QRcode类库生成二维码 [`项目地址`](http://phpqrcode.sourceforge.net/)  [`源码下载`](http://sourceforge.net/projects/phpqrcode/)

##资料o
[TIPI](http://www.php-internals.com/book/)

第一次在实际项目中用到递归

```php
/*
* 递归分类名
*
* @int - $typeId 分类表主键
* @string - $return 返回值初始化
* @int - $flag - 标识符:1.添加时 2.关联时;控制分类排列的格式
*/
private function _recursive($typeId,$return='',$flag)
{
    $cate = $this->pCate->getOne(intval($typeId),'pt_fid,pt_name');
    if($cate['pt_fid'] == 0)
    {
        if($flag === 1)
        {
            $return = trim($cate['pt_name'].'|'.$return,'|');
        }
        else
        {
            $return = trim($cate['pt_name'].'<br />'.$return,'<br />');
        }
        return $return;
    }
    else
    {
        if($flag === 1)
        {
            $return = $cate['pt_name'].'|'.$return;
        }
        else
        {
            $return = $cate['pt_name'].'<br />'.$return;
        }
        return $this->_recursive($cate['pt_fid'],$return,$flag);
    }
}
```

***

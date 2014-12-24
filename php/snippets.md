Code Snippets
============
生成日志文件
```php
function createLog($shareId,$showId)
{
    $file = "./log/sale_gift_check.log";
    $time = date('Y-m-d H:i:s');
    $content = '程序执行时间:'.$time.' '.$shareId.' '.$showId."\r\n";
    $fp = fopen($file,"a");
    fwrite($fp,$content);
    fclose($fp);
}
```

php随机产生5个字母(用于上传文件重命名)
```php
function getRandStr()
{
    $chars = array_merge(range('a','z'),range('A','Z'));//合并数组
    shuffle($chars);//将数组打乱
    $randKeys = array_rand($chars,5);//从数组中随机取5个字母，返回他们的键值组成的数组
    shuffle($chars);//再次打乱数组
    $str = '';
    foreach($randKeys as $key)
    {
        $str .= $chars[$key];
    }
    return $str;
}
```

mis下根据k代码,获取品牌名称
```php
/*
* 根据k代码,获取品牌名称
* @notice:品牌名称用逗号隔开
*
*/
function brandName($kid)
{
    global $db;
    //merchant_info表取主键
    $sql = 'SELECT merchant_id FROM merchant_info where merchant_kid = "'.$kid.'"';
    $row = $db->fetch_assoc($db->query($sql));
    $merId = intval($row['merchant_id']);
    //merchant_brand_relation表
    $relSql = 'SELECT * FROM merchant_brand_relation where mb_merchant = '.$merId;
    $rows = $db->result($db->query($relSql));
    $brand = array();
    foreach($rows as $v)
    {
        //merchant_brand表
        $brandSql = 'SELECT brand_name FROM merchant_brand where brand_id = '.intval($v['mb_brand']);
        $res =  $db->fetch_assoc($db->query($brandSql));
        array_push($brand,$res['brand_name']);
    }
    return implode(',',$brand);
}
```


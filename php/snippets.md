Code Snippets
============
生成日志文件
```php
function createLog($shareId,$showId)
{
    $file = "./log/sale_gift_check.log";
    $content = '程序执行时间:'.$time.' '.$shareId.' '.$showId."\r\n";
    $time = date('Y-m-d H:i:s');
    $fp = fopen($file,"a");
    fwrite($fp,$content);
    fclose($fp);
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


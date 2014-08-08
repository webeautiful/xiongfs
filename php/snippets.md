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

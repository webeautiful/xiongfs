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

#####抽奖程序概率计算

######方法二
```php
方法一
$proArr = array(1=>30,2=>6,3=>30,4=>1,5=>30,6=>3);//奖项=>概率

$czId = '';//抽到的奖项id
//概率数组的总概率精度
$proSum = array_sum($proArr);
//概率数组循环
foreach ($proArr as $key=>$proCur) {
    $randNum = mt_rand(1, $proSum);
    if ($randNum <= $proCur) {
        $czId = $key;
        break;
    } else {
        $proSum -= $proCur;
    }
}
unset ($proArr);
```

######方法二
```php
//摸奖
$proArr = array(1=>30,2=>6,3=>30,4=>1,5=>30,6=>3);//奖项=>概率

$cjbox = array();
foreach($proArr as $in=>$jl){
    for($i=0;$i<$jl;$i++){
        $cjbox[] = $in;
    }
}
$proSum = count($cjbox);
shuffle($cjbox);
$randNum = mt_rand(0,$proSum-1);
$czId = $cjbox[$randNum];
unset($proArr,$cjbox);
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


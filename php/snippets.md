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

##### 抽奖程序概率计算

###### 方法一
```php
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

###### 方法二
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

人性化显示时间

example1:

```php
function humanizedTime($time) {
    $rtime = date("m-d H:i",$time);
    //$htime = date("H:i",$time);
    $time = time() - $time;
    if ($time < 60) {
        $str = '刚刚';
    }
    elseif ($time < 60 * 60) {
        $min = floor($time/60);
        $str = $min.'分钟前';
    }
    elseif ($time < 60 * 60 * 24) {
        $h = floor($time/(60*60));
        $str = $h.'小时前';
    }
    elseif ($time < 60 * 60 * 24 * 3) {
        $d = floor($time/(60*60*24));
        if($d==1) $str = '昨天 '.$rtime;
        else $str = '前天 '.$rtime;
    }
    else {
        $str = $rtime;
    }
    return $str;
}
```

example2:

```php
function ay_time($pptime){
    $ggtime = time() - $pptime;
    if ($ggtime >= 0 and $ggtime < 10) { return "刚刚"; }
    if ($ggtime >= 10 and $ggtime < 60) { return "10秒前"; }
    if ($ggtime >= 60 and $ggtime < 300) { return "1分钟前"; }
    if ($ggtime >= 300 and $ggtime < 1800) { return "5分钟前"; }
    if ($ggtime >= 1800 and $ggtime < 3600*24) { return "半小时前"; }
    if ($ggtime >= 3600*24 and $ggtime < 3600*24*2) { return "1天前"; }
    if ($ggtime >= 3600*24*2 and $ggtime < 3600*24*3) { return "2天前"; }
    if ($ggtime >= 3600*24*3 and $ggtime < 3600*24*4) { return "3天前"; }
    if ($ggtime >= 3600*24*4 and $ggtime < 3600*24*5) { return "4天前"; }
    if ($ggtime >= 3600*24*5 and $ggtime < 3600*24*6) { return "5天前"; }
    if ($ggtime >= 3600*24*6 and $ggtime < 3600*24*7) { return "6天前"; }
    if ($ggtime >= 3600*24*7 and $ggtime < 3600*24*8) { return "1个星期前"; }
    if ($ggtime > 3600*24*8) { return date("Y-m-d H:i:s",$pptime); }
}
```
example3:

```php
function humanized_time($date)
{
    if (strlen($date)==10 || strlen($date)==19){
        if (substr($date,0,4)==date('Y')) {
            switch (substr($date,0,10)){
                case date('Y-m-d'):
                    $d='今天';
                    break;
                case date('Y-m-d', strtotime('-1 day')):
                    $d='昨天';
                    break;
                case date('Y-m-d', strtotime('-2 day')):
                    $d='前天';
                    break;
                case date('Y-m-d', strtotime('+1 day')):
                    $d='明天';
                    break;
                case date('Y-m-d', strtotime('+2 day')):
                    $d='后天';
                    break;
                default:
                    $d=substr($date,5,6);
            }
            return $d.substr($date,11);
        }else {
            return $date;
        }
    }else {
        return $date;
    }
}
```

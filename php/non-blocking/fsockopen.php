<?php
/*
 * 结果: 触发网络请求，非阻塞
 */
ignore_user_abort(true); // 忽略客户端断开
set_time_limit(0); // 设置执行不超时

$host = 'api67.pigai.org';
$path = '/callback.php';
$param = array(
    'name' => '熊fusong',
    'age' => 30
);
//$query = http_build_query($param);
$query = json_encode($param);


$fp = fsockopen($host, 80, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = 'GET '.$path." HTTP/1.1\r\n";
    $out .= 'Host: '.$host."\r\n";
    $out .= 'Content-Length:'.strlen($query)."\r\n";
    $out .= "Content-Type: application/json\r\n";
    $out .= "Connection: Close\r\n\r\n";
    $out .= $query;

    fwrite($fp, $out);
    /*忽略执行结果
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }*/
    fclose($fp);
    echo 'ok';
}
?>

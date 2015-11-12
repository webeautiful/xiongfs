<?php
$url = 'http://fake/#access_token=98f0df4f052d31d7e8266f7f82e5c566667d6123&expires_in=3600&token_type=Bearer&state=xyz?=&&?';
$parseUrl = parse_url($url);
$pairs = strToJson($parseUrl['fragment']);
print_r($parseUrl);
print_r($pairs);
parse_str($parseUrl['fragment'], $data);
print_r(json_encode($data));
//bug: 参数名和值中不能出现符号&和=,会导致解析错误
function strToJson($fragment) {
    $pairs = array();
    $p = explode('&', $fragment);
    foreach($p as $v){
        $t = explode('=', $v);
        $pairs[$t[0]] = $t[1];
    }
    header("Content-type: application/json");
    return json_encode($pairs);
}
?>

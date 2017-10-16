<?php
$param = urldecode($argv[1]);
parse_str($param, $data);
sleep(10);

file_put_contents('./log', $data['appId'].'---'.$data['eid']."\n", FILE_APPEND);
?>

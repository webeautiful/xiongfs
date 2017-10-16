<?php
/*
 * 触发本地执行命令，非阻塞
 * exec, shell_exec是阻塞型的, 等待命令行任务执行完成后, 才会向下执行
 */
$path = dirname(__FILE__);
$param = array(
    'appId' => 18,
    'eid' => 'pg234'
);
$query = urlencode(http_build_query($param));
$cmd = '/usr/local/php56/bin/php '.$path.'/test.php '.$query;
trigger_async_exec($cmd);
function trigger_async_exec($cmd) {
    $lastChr = strrchr($cmd, '&') === '&'? '': ' &';
    pclose(popen($cmd.$lastChr, 'r'));
}
echo 'complete!';
?>

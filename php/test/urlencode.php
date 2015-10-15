<?php
/*
* url编解码,可以防止php端get/post数据错误
*/
    $name = urlencode('程序员');
    $pwd = urlencode('&05638660&');
    $key = urlencode('Jb9vrVfYl');
    $url = 'http://example.com/?name='.$name.'&pwd='.$pwd.'&key='.$key;
    echo $url;
    echo "\n";
?>

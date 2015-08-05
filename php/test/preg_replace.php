<?php
/*
* 处理数组,返回的仍然是数组
*/
$arr = array("M y na\nme is xiong f\nson\n g", "Who a m I");
$arr = preg_replace("/\n/","<br>",$arr);
$a = preg_replace("/ /","",$arr);
echo $a;
var_dump($a);
?>

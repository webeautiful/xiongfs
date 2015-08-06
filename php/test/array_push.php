<?php
//----向一个空数组入毡一个关联数组

$stack = array();
$arr1 = array('name'=>'熊福松', 'age'=>'28');
$arr2 = array('name'=>'Jack', 'age'=>12);
array_push($stack,$arr1,$arr2);
print_r($stack);
?>


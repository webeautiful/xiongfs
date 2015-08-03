<?php
/*
* global的两个疑惑:
* 1. 在函数外用global声明变量,在函数内是否能成功获取该变量的值？
* 2. 修改函数内用global引用的一个全局变量的值,是否更改了该全局变量的值？
*/
$global1 = 'abc';
$global2 = 'abc';
global $global1;

test1();
echo "\n";
test2();
echo $global2; //def
echo "\n";
function test1(){
    echo $global1; //undefined
}
function test2(){
    global $global2;
    $global2 = 'def';
}
?>

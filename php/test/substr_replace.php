<?php
$a = '熊福松';

$b = substr_replace($a,'*',2);#中文替代会出现乱码
echo $b."\n";

$len = mb_strlen($a,'utf-8');
$str1 = mb_substr($a,0,1,'utf-8');
$str2 = mb_substr($a,2,1,'utf-8');
echo $str1.'*'.$str2."\n";

//3-5加*
$num = 12116782;
echo substr_replace($num,'***',2,3);
echo "\n";

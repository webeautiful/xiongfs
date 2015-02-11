<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('date.timezone','Asia/Shanghai');
#$curday = date('Y-m-d');
$curday = '2015-02-04';
echo strtotime($curday.' 08:00:00').' -- '.strtotime($curday.' 11:59:59');
echo "\n";
echo strtotime($curday.' 12:00:00').' -- '.strtotime($curday.' 17:59:59');
echo "\n";

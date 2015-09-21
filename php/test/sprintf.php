<?php
//把格式化的字符串写入变量
$prefix = 'log_file';
$file =  sprintf('%s_%s.log', $prefix, @date('Ymd'));
echo $file;

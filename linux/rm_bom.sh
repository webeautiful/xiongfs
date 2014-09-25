#!/bin/bash
#author:hsb
#date:2013.7.16
#description:remove bom
if [ "$1" = "" ];then
	echo 请输入路径！！！
else
	path=$1
	grep -r -I -l $'^\xEF\xBB\xBF' /$path | xargs sed -i 's/^\xEF\xBB\xBF//g'
fi

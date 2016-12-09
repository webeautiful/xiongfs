---
#AWK入门

##简介

1. AWK是由贝尔实验室1977年弄出来的文本处理神器,蛇年是AWK的本命年;  
2. AWK取自其三位发明者Family name的首字母,分别是:Alfred Aho，Peter Weinberger, 和 Brian Kernighan;  
3. 功能:流控制,数学运算,进程控制,内置的变量和函数,循环和判断

##awk脚本
成绩单:

    $ cat score.txt

    Marry   2143 78 84 77
    Jack    2321 66 78 45
    Tom     2122 48 77 71
    Mike    2537 87 97 95
    Bob     2415 40 57 62
计算成绩:

    $ cat cal.awk

    #!/usr/bin/awk -f
    #
    #  Program: Print a StudStoreInfo
    #
    #运行前
    BEGIN {
        math = 0
        english = 0
        computer = 0

        printf "NAME    NO.    MATH    ENGLISH    COMPUTER   TOTAL\n"
        printf "--------------------------------------------------\n"
    }
    #运行中
    {
        math+=$3
        english+=$4
        computer+=$5
        printf "%-6s %-6s %4d %8d %8d %8d\n",$1,$2,$3,$4,$5,$3+$4+$5
    }
    #运行后
    END {
        printf "-------------------------------------------------\n"
        printf "   TOTLAL:%10d %8d %8d \n",math,english,computer
        printf "AVERAGE:%10.2f %8.2f %8.2f\n",math/NR,english/NR,computer/NR
    }
执行结果如下:

    $ awk -f cal.awk score.txt
    NAME    NO.    MATH    ENGLISH    COMPUTER   TOTAL
    --------------------------------------------------
    Marry  2143     78       84       77      239
    Jack   2321     66       78       45      189
    Tom    2122     48       77       71      196
    Mike   2537     87       97       95      279
    Bob    2415     40       57       62      159
    -------------------------------------------------
       TOTLAL:       319      393      350 
       AVERAGE:     63.80    78.60    70.00
##基础
###awk内置变量表

|序号|属性|说明|
|----|----|----|
|1|$0  |当前记录,作为单个变量|
|2|$1~$n|当前记录的第n个字段,字段间由FS分隔|
|3|ARGC|命令行参数的数目|
|4|ARGV|包含命令行参数的数组|
|5|ARGIND|命令行中当前文件的位置(从0开始算)|
|6|NF|当前记录中的字段个数，就是有多少列|
|7|NR|已经读出的记录数，就是行号，从1开始|
|8|FS|输入字段分隔符(默认是空格或tab键)|
|9|RS|输入记录分隔符(默认是一个换行符)|
|10|OFS|输出字段分隔符(默认是空格或tab键)|
|11|ORS|输出记录分隔符(默认是一个换行符)|
|12|FILENAME|当前输入文件的名字|
|13|IGNORECASE|如果为真，则进行忽略大小写的匹配|
|14|ARGIND|当前被处理文件的ARGV标志符|
|15|ENVIRON|UNIX环境变量关联数组|
|16|ERRNO|最后一个UNIX系统错误的描述|
|17|FIELDWIDTHS|输入字段宽度列表(用空格键分隔)|
|18|FNR|同NR,但相对于当前文件|
|19|OFMT|数字的输出格式(默认值是`%.6g`)|
|20|CONVFMT|数字转换格式(默认值是`%.6g`)|
|21|RSTART|由match函数所匹配的字符串的第一个位置|
|22|RLENGTH|由match函数所匹配的字符串长度|
|23|SUBSEP|数组下标分割符(默认是`\034`)|

SUBSEP用例:

```bash
$ awk 'BEGIN{SUBSEP="-:-";arr["a","b"]=1;for(i in arr) print i, arr[i]}'
a-:-b 1
```

###运算符表

|类型|运算符|
|----|------|
|逻辑运算符|&&, 或 , !|
|关系运算符| ~(匹配), !~, >, <, ==, >=, <=, !=|
|条件运算符|?:(三目运算符)|
|数学运算符|^(指数), +, -, *, /, %|
|赋值运算符|=, +=, -=, *=, /=, %=, ^=|
|增/减量运算符|++, --|
|其他|+(正号), -(负号)|

##awk的内建函数
###字符串函数
|函数格式|功能描述|实例|
|--------|--------|----|
|sub(regular_expression,substitution_str[,target_str])|匹配目标字符串中第一个符合正则规则的字符串,然后用替换字符串代替|sub(/test/,"mytest")|
|gsub(r,s)|在整个$0中用s替代r|gsub(/test/,"mytest")|
|gsub(r,s,t)|在整个t中用s替代r|gsub(/test/,"mytest",'thisisonlyatest!')|
|split(s,a,fs)|用分隔符fs,将字符串s分成序列a|如:|

##awk数组和遍历
注:用awk执行循环的效率比shell高很多

###参考资料
- [AWK简明教程](http://coolshell.cn/articles/9070.html)
- [AWK命令学习系列](http://www.cnblogs.com/chengmo/archive/2013/01/17/2865479.html)

---

---
#AWK入门

###简介

1. AWK是由贝尔实验室1977年弄出来的文本处理神器,蛇年是AWK的本命年;  
2. AWK取自其三位发明者Family name的首字母,分别是:Alfred Aho，Peter Weinberger, 和 Brian Kernighan;  
3. 功能:流控制,数学运算,进程控制,内置的变量和函数,循环和判断

###awk脚本
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

###awk内置变量表

|属性|说明|
|$0  |当前记录(作为单个变量)|
|$1~$n|当前记录的第n个字段,字段间由FS分割|
|FS|输入字段分隔符,默认是空格|
|NF|当前记录中的字段个数，就是有多少列|
|NR|已经读出的记录数，就是行号，从1开始|

###参考资料
- [AWK简明教程](http://coolshell.cn/articles/9070.html)

---

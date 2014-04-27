---
###AWK入门

---
###简介

1. AWK是由贝尔实验室1977年弄出来的文本处理神器,蛇年是AWK的本命年;  
2. AWK取自其三位发明者Family name的首字母,分别是:Alfred Aho，Peter Weinberger, 和 Brian Kernighan;  

###awk脚本

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

###参考资料
- [AWK简明教程](http://coolshell.cn/articles/9070.html)

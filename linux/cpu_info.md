# 查看cpu相关信息

## 目录
+ [top](#top)
+ [uname](#uname)
+ [lsb_release](#lsb_release)
+ [/proc/cpuinfo](#cpuinfo)
+ [getconf](#getconf)

## top
`top 后按1`:可以看到n个逻辑cpu,及每个cpu的使用情况

```
Cpu0  :  3.2%us,  1.3%sy,  0.0%ni, 91.9%id,  2.6%wa,  0.0%hi,  1.0%si,  0.0%st
Cpu1  :  1.7%us,  0.7%sy,  0.0%ni, 97.3%id,  0.0%wa,  0.0%hi,  0.3%si,  0.0%st
Cpu2  : 17.1%us,  4.0%sy,  0.0%ni, 78.9%id,  0.0%wa,  0.0%hi,  0.0%si,  0.0%st
Cpu3  :  1.0%us,  4.0%sy,  0.0%ni, 95.0%id,  0.0%wa,  0.0%hi,  0.0%si,  0.0%st
Cpu4  :  3.4%us,  0.7%sy,  0.0%ni, 95.6%id,  0.0%wa,  0.0%hi,  0.3%si,  0.0%st
Cpu5  :  0.3%us,  0.0%sy,  0.0%ni, 99.7%id,  0.0%wa,  0.0%hi,  0.0%si,  0.0%st
Cpu6  :  0.3%us,  0.3%sy,  0.0%ni, 99.3%id,  0.0%wa,  0.0%hi,  0.0%si,  0.0%st
Cpu7  :  0.0%us,  0.0%sy,  0.0%ni,100.0%id,  0.0%wa,  0.0%hi,  0.0%si,  0.0%st
```

## uname

查看当前os内核信息

```
$ uname -a

Linux rabbitmq2 2.6.32-504.16.2.el6.x86_64 #1 SMP Wed Apr 22 06:48:29 UTC 2015 x86_64 x86_64 x86_64 GNU/Linux
```

* 信息解释
    - os名称: Linux `uname -s`
    - 计算机名: rabbitmq2 `uname -n`
    - os发行编号: 2.6.32-504.16.2.el6.x86_64 `uname -r`
    - os发行时间: #1 SMP Wed Apr 22 06:48:29 UTC 2015 `uname -v`
    - 计算机类型，进程类型，硬件平台：x86_64 x86_64 x86_64 `uname -m,uname -p,uname -i`
    - os信息: GNU/Linux `uname -o`
* 参数说明:
    - -a或--all 显示全部的信息
    - --help 显示帮助

## lsb_release

查看当前os发行版信息

```
$ lsb_release -a

LSB Version:    :base-4.0-amd64:base-4.0-noarch:core-4.0-amd64:core-4.0-noarch:graphics-4.0-amd64:graphics-4.0-noarch:printing-4.0-amd64:printing-4.0-noarch
Distributor ID: CentOS
Description:    CentOS release 6.6 (Final)
Release:    6.6
Codename:   Final
```

## /proc/cpuinfo
* 总核数 = 物理CPU个数 * 每颗物理CPU的核数
* 总逻辑CPU数 = 物理CPU个数 * 每颗物理CPU的核数 * 超线程数

###### 查看CPU信息（型号）

```
$ cat /proc/cpuinfo | grep name | cut -f2 -d: | uniq -c

     16  Intel(R) Xeon(R) CPU           E5620  @ 2.40GHz
```

从上面可以看到,有16个逻辑cpu,型号是`Intel(R) Xeon(R) CPU`的`E5620`,主频是`2.40GHz`

###### 查看物理CPU个数
即：实际Server中插槽上的CPU个数

```
$ cat /proc/cpuinfo | grep "physical id" | sort | uniq | wc -l
2
$ cat /proc/cpuinfo | grep 'physical id' | sort | uniq -c
    8 physical id   : 0
    8 physical id   : 1
```

###### 查看每个物理CPU中core的个数(即核数)
```
$ cat /proc/cpuinfo| grep "cpu cores"| uniq
cpu cores   : 4
```

###### 查看逻辑CPU的个数(总线程数)
```
$ cat /proc/cpuinfo| grep "processor"| wc -l
16
```

###### 查看CPU的主频
```
cat /proc/cpuinfo | grep "cpu MHz"| uniq
cpu MHz     : 2394.057
```

## getconf

###### 查看是否支持64bit计算
```
$ getconf LONG_BIT

64
```

## 参考资料

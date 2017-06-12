## top命令 -- linux的任务管理器

$ top -c 打印部分命令参数

```
xfs@linux:/home/svn$top

top - 17:17:46 up  8:34,  6 users,  load average: 2.01, 1.69, 1.70
Tasks: 235 total,   3 running, 227 sleeping,   0 stopped,   5 zombie
Cpu(s): 17.5%us, 10.8%sy,  0.0%ni, 71.0%id,  0.6%wa,  0.0%hi,  0.0%si,  0.0%st
Mem:   3689732k total,  3242072k used,   447660k free,   350968k buffers
Swap:  3753980k total,    70824k used,  3683156k free,  1152152k cached
<!--命令输入栏-->
  PID USER      PR  NI  VIRT  RES  SHR S %CPU %MEM    TIME+  COMMAND
 7485 xfs       20   0 1598m  35m 9948 S   28  1.0  73:16.63 Tencentdl.exe
 8192 xfs       20   0  362m  59m  32m S   16  1.7  38:26.64 chromium-browse
 7008 xfs       20   0 1703m 180m  80m S   15  5.0  53:43.18 qdwnd=65610
 3543 xfs       20   0  840m 316m  45m S   14  8.8  24:02.13 firefox
 1255 root      20   0  105m  38m  19m S   13  1.1  29:24.47 Xorg
 6943 xfs       20   0 12984 9248  764 R   12  0.3  28:05.47 wineserver
 2972 xfs       20   0  395m  81m  27m S    8  2.2  14:58.19 compiz
 4264 xfs       20   0  106m  22m  13m S    3  0.6   4:16.16 gnome-terminal
 3710 xfs       20   0  257m  51m  17m S    2  1.4  11:07.34 plugin-containe
 8977 xfs       20   0  567m 103m  68m S    1  2.9   2:09.50 wps
 3034 xfs       20   0  112m  77m 9396 S    1  2.2   0:50.05 fcitx
 6974 xfs       20   0 1584m 8560 5976 S    1  0.2   0:50.36 explorer.exe
 2998 xfs       20   0  617m 115m  51m S    1  3.2  23:04.65 chromium-browse
 3241 xfs       20   0  206m  35m  19m R    0  1.0   3:39.98 chromium-browse
 3208 xfs       20   0 50132  13m 9.9m S    0  0.4   0:38.86 gtk-window-deco
 2933 xfs       20   0  7744 3560  632 S    0  0.1   0:36.53 dbus-daemon
 3056 xfs       20   0  7424 3324  964 S    0  0.1   0:55.39 dbus-daemon
 3063 xfs       20   0 84508  10m 7552 S    0  0.3   0:37.73 bamfdaemon
 3133 xfs       20   0  114m  30m  11m S    0  0.9   1:14.57 unity-panel-ser
 3135 xfs       20   0 56216  12m 3428 S    0  0.3   1:18.29 hud-service
 6979 xfs       20   0 1602m  17m  12m S    0  0.5   0:28.71 QQProtect.exe
 8442 xfs       20   0  236m  65m  29m S    0  1.8   0:38.63 chromium-browse
15283 xfs       20   0  2852 1236  892 R    0  0.0   0:02.52 top
   15 root      RT   0     0    0    0 S    0  0.0   0:00.16 watchdog/2
   18 root      20   0     0    0    0 S    0  0.0   0:09.50 ksoftirqd/3
   85 root      20   0     0    0    0 S    0  0.0   0:18.75 kworker/0:2
  244 root      20   0     0    0    0 S    0  0.0   0:04.04 jbd2/sda1-8
 1082 mysql     20   0  328m  89m 4796 S    0  2.5   0:12.52 mysqld
 2943 xfs       20   0  155m  15m  11m S    0  0.4   0:39.31 gnome-settings-
```
### 系统信息栏
```
top - 17:17:46 up  8:34,  6 users,  load average: 2.01, 1.69, 1.70
Tasks: 235 total,   3 running, 227 sleeping,   0 stopped,   5 zombie
Cpu(s): 17.5%us, 10.8%sy,  0.0%ni, 71.0%id,  0.6%wa,  0.0%hi,  0.0%si,  0.0%st
Mem:   3689732k total,  3242072k used,   447660k free,   350968k buffers
Swap:  3753980k total,    70824k used,  3683156k free,  1152152k cached
```
###### 第一行显示系统信息:当前时间、系统已经运行了多长时间、目前有多少登陆用户、系统在过去的1分钟、5分钟和15分钟内的平均负载(uptime命令)
```
top - 17:17:46 up  8:34,  6 users,  load average: 2.01, 1.69, 1.70
```
###### 第二行:当前系统进程总数,当前运行中的进程数,当前处于等待状态中的进程数,被停止的系统进程数,被复原的进程数
```
Tasks: 235 total,   3 running, 227 sleeping,   0 stopped,   5 zombie
```
###### 第三行:cpu的使用率
```
Cpu(s): 17.5%us, 10.8%sy,  0.0%ni, 71.0%id,  0.6%wa,  0.0%hi,  0.0%si,  0.0%st
```
###### 第四行:内存总量,当前使用量,空闲内存量,缓冲使用中的内存量(free命令)
```
Mem:   3689732k total,  3242072k used,   447660k free,   350968k buffers
```
###### 第五行:交换区的内存使用情况
```
Swap:  3753980k total,    70824k used,  3683156k free,  1152152k cached
```
### 命令输入栏
|命 令|用 途|
|-----|-----|
|l|控制第一行信息的显示与隐藏|
|t|控制第二/三行信息的显示与隐藏|
|m|控制第四/五行信息的显示与隐藏|
|N|以 PID 大小顺序排序表示进程列表|
|P|以 CPU 占用率大小顺序排序表示进程列表|
|M|以 MEM 占用率大小顺序排列表示进程列表|
|s|设置画面更新频率|
|n|设置进程列表显示的进程数量|

### 进程列表栏
```
  PID USER      PR  NI  VIRT  RES  SHR S %CPU %MEM    TIME+  COMMAND
 7485 xfs       20   0 1598m  35m 9948 S   28  1.0  73:16.63 Tencentdl.exe
 8192 xfs       20   0  362m  59m  32m S   16  1.7  38:26.64 chromium-browse
 7008 xfs       20   0 1703m 180m  80m S   15  5.0  53:43.18 qdwnd=65610
 3543 xfs       20   0  840m 316m  45m S   14  8.8  24:02.13 firefox
 1255 root      20   0  105m  38m  19m S   13  1.1  29:24.47 Xorg
 6943 xfs       20   0 12984 9248  764 R   12  0.3  28:05.47 wineserver
 2972 xfs       20   0  395m  81m  27m S    8  2.2  14:58.19 compiz
 4264 xfs       20   0  106m  22m  13m S    3  0.6   4:16.16 gnome-terminal
 3710 xfs       20   0  257m  51m  17m S    2  1.4  11:07.34 plugin-containe
 8977 xfs       20   0  567m 103m  68m S    1  2.9   2:09.50 wps
```
| 列 名 | 含义 |
|-------|------|
|  PID  |进程id|
| USER  |进程所有者的用户名|
|  PR   |优先级|
|  NI   |nice值。负值表示高优先级，正值表示低优先级|
| VIRT  |进程使用的虚拟内存总量，单位kb。VIRT=SWAP+RES|
|  RES  |进程使用的、未被换出的物理内存大小，单位kb。RES=CODE+DATA|
|  SHR  |共享内存大小，单位kb|
|   S   |进程状态:D-不可中断的睡眠状态;R-运行;S-睡眠;T-跟踪/停止;Z-僵尸进程|
| %CPU  |上次更新到现在的CPU时间占用百分比|
| %MEM  |进程使用的物理内存百分比|
| TIME+ |进程使用的CPU时间总计，单位1/100秒|
|COMMAND|命令名/命令行|

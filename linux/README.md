linux相关
======
### sys cmd

- 列出所有开机启动项: `chkconfig --list`

- 过滤注释：`cat vsftpd.conf | grep -v '^#'`

- 过滤进程并杀死：`ps -ef | grep fetch | awk '{print $2}' | xargs kill -9`

- 添加用户并指定用户目录：
``` bash
useradd [user] -g ftp-d [path]
chown alloyftp -R
```

* 抓80端口tcp包
``` bash
tcpdump tcp port 80 -n -X -s 0
```

- 查找出占用内存>1%的php-fpm进程
``` bash
ps aux | grep php-fpm | grep -v grep | awk '{if($2>1) print $2}'
```

- 统计最常使用的命令
``` bash
history | awk '{CMD[$2]++;count++;} END { for(a in CMD) {print CMD[a] " " CMD[a]/count*100 "% " a}}' \
| grep -v "./" | column -c3 -s " " -t | sort -nr | nl |  head -n10
```

### linux命令
* [log分析命令](http://www.vaikan.com/8-linux-commands-every-developer-should-know/)
* [Generating SSH Keys](https://help.github.com/articles/generating-ssh-keys)
* [使用 shell 脚本对 Linux 系统和进程资源进行监控](http://www.ibm.com/developerworks/cn/linux/l-cn-shell-monitoring/)

## 中文资料
[GNU make中文手册][1]  
[鸟哥的Linux私房菜(简体中文版)][2]  

[1]:http://www.yayu.org/book/gnu_make/index.html
[2]:http://www.ha97.com/book/vbird_linux/

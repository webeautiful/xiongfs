###创建新用户
1. 以root账号登陆

2. 创建普通用户

* 添加新用户的同时指定主目录:`useradd -d /home/username  -m username`
* 为该用户设置初始密码:`passwd username`

3. 给该用户增加sudo权限:`vim /etc/sudoers`,添加一句：**username  ALL=(ALL:ALL) ALL**

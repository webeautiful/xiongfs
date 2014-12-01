###测试环境

* Ubuntu 14.04.1 LTS
* PHP 5.3.14
* RabbitMQ 3.2.4

###文件说明

- `rabbit_pigai214_2014-11-28.json` -- 搭建rabbitmq服务后,登入`http://127.0.0.1:15672/`管理界面，将此数据导入Overview>broker definitions
- `send.php` -- 消息生产者(producer)
- `receive.php` -- 消息消费者(consumer)

###参考资料

- [x] [RabbitMQ基础概念详细介绍](http://www.ostest.cn/archives/497)
- [x] [消息队列RabbitMQ入门介绍](http://www.ostest.cn/archives/483)
- [x] [RabbitMQ Performance Test](http://www.ostest.cn/archives/513 'rabbitmq性能测试')
- [X] [最近研究RabbitMQ的一些心得](http://rainbird.blog.51cto.com/211214/525523/)
- [ ] [施昌权](http://blog.chinaunix.net/uid/22312037/sid-163962-list-1.html)
- [x] [用PHP尝试RabbitMQ（amqp扩展）实现消息的发送和接收](http://www.icultivator.com/p/9722.html)
- [x] [RabbitMQ与PHP（二）—— 相关服务安装及如何用PHP作为守护模式处理消息](http://www.icultivator.com/p/8838.html)

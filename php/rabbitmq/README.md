###测试环境

* Ubuntu 14.04.1 LTS/CentOS 6.2
* PHP 5.3.14/PHP 5.3.10
+ 服务器端:
  - RabbitMQ 3.2.4
+ php客户端(均编译安装):
  - [rabbitmq-c](https://github.com/alanxz/rabbitmq-c/releases/tag/v0.5.2)
  - [php-amqp模块](http://pecl.php.net/package/amqp)

###文件说明

- `rabbit_pigai214_2014-11-28.json` -- 搭建rabbitmq服务后,登入`http://127.0.0.1:15672/`管理界面，将此数据导入Overview>broker definitions
- `send.php` -- 消息生产者(producer)
- `receive.php` -- 消息消费者(consumer)

###参考资料

- [x] [php官网amqp文档](http://php.net/manual/pl/book.amqp.php)
- [x] [接口说明](https://github.com/pdezwart/php-amqp/tree/master/stubs)
- [x] [RabbitMQ基础概念详细介绍](http://www.ostest.cn/archives/497)
- [x] [消息队列RabbitMQ入门介绍](http://www.ostest.cn/archives/483)
- [x] [RabbitMQ Performance Test](http://www.ostest.cn/archives/513 'rabbitmq性能测试')
- [X] [最近研究RabbitMQ的一些心得](http://rainbird.blog.51cto.com/211214/525523/)
- [ ] [施昌权](http://blog.chinaunix.net/uid/22312037/sid-163962-list-1.html)
- [x] [用PHP尝试RabbitMQ（amqp扩展）实现消息的发送和接收](http://www.icultivator.com/p/9722.html)
- [x] [RabbitMQ与PHP（二）—— 相关服务安装及如何用PHP作为守护模式处理消息](http://www.icultivator.com/p/8838.html)
- [x] [rabbitmq——prefetch count](http://my.oschina.net/hncscwc/blog/195560)

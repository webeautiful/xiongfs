<?php
ini_set('date.timezone','Asia/Shanghai');
$exchangeName = 'pigai_log';
$msg = array(
    'txt'=>'登录批改网',
    'ip'=>'192.168.1.66',
    'user_id'=>'17',
    'score'=>'1',
    'a'=>null,
    'c'=>null,
    'ctime'=>time(),
    'type'=>101
);
$res = mq_set($exchangeName,$msg);
var_dump($res);exit;
/*
*rabbitmq -- producer(生产者)
*
* $exchanges 交换机名称
* $arr 消息内容
* $routingKey  路由键(依exchange类型而定)
*
* return true/false  成功/失败
*/
function mq_set( $exchanges, $arr , $routingKey=''){
    //配置信息
    $params = array(
        'host' =>'127.0.0.1',
        'port' => 5672,
        'login' => 'root',
        'password' => 'cikuutest!',
        'vhost' => '/');
    try{
        //连接rabbitmq服务器
        $cnn = new AMQPConnection($params);
        $cnn->connect();
    }catch(AMQPConnectionException $e){
        return false;
    }
    $ch = new AMQPChannel($cnn);//创建信息通道

    //创建交换机对象
    $exchange = new AMQPExchange($ch);
    $exchange->setName( $exchanges ); #交换器名称

    //发送消息
    $key= $routingKey==''?'info': $routingKey;
    $res = $exchange->publish( is_array( $arr) ?json_encode($arr): $arr , $key , AMQP_NOPARAM, array('delivery_mode'=>2, 'priority'=>9));//delivery_mode为2

    $cnn->disconnect();

    return $res;
}

?>

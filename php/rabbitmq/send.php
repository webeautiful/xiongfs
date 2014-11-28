<?php
/*
*amqp测试 - 发送
*/
//连接rabbitmq服务器
$cnn = new AMQPConnection(array(
    'host'=>'127.0.0.1',
    'port'=>'5672',
    'login'=>'root',
    'password'=>'cikuutest!',
    'vhost'=>'/'
));
$cnn->connect();

$exchangeName = 'pigai_log';
$queueName = 'log_mysql';
$routeKey = 'info';
$message = 'this test is ok';

try{
    $channel = new AMQPChannel($cnn);
    $exchange = new AMQPExchange($channel);
    $exchange->setName($exchangeName);
    $queue = new AMQPQueue($channel);
    $queue->setName($queueName);
    $exchange->publish($message, $routeKey);
    var_dump("[x] Sent 'Hello World!'");
}catch(AMQPConnectionException $e) {
    print_r($e);
    exit();
}
$cnn->disconnect();

//总管给的程序
function mq_set( $exchanges, $arr ,$Routing_Key='' ){
    $params = array(
        'host' =>'127.0.0.1',
        'port' => 5672,
        'login' => 'root',
        'password' => 'cikuutest!',
        'vhost' => '/');
    //print_r($params );
    try{
         $cnn = new AMQPConnection($params);
         $cnn->connect();
    }catch(AMQPConnectionException $e){
        return false;
    }
    $ch = new AMQPChannel($cnn);//创建信息通道
    $exchange = new AMQPExchange($ch);
    $exchange->setName( $exchanges ); #通道名称
    //if( !$r )  return 0 ;
    //$re = $key='e_'.$arr['rid'].'_'.$arr['user_id'];
    $key= $Routing_Key==''?'info': $Routing_Key ;
    $res = $exchange->publish( is_array( $arr) ?json_encode($arr): $arr , $key , AMQP_NOPARAM, array('delivery_mode'=>2, 'priority'=>9));
    $cnn->disconnect();
    return $res;
}

?>

<?php
/*
*amqp测试 - 取队列
*/
//连接RabbitMQ
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$params = array('host' =>'127.0.0.1',
                'port' => 5672,
                'login' => 'root',
                'password' => 'cikuutest!',
                'vhost' => '/');
$cnn = new AMQPConnection($params);
if(!$cnn->connect()){
    die('Cannot connect to the broker!\n');
}
//设置queue名称，使用exchange，绑定routingkey
$ch = new AMQPChannel($cnn);//创建信息通道
$queue = new AMQPQueue($ch);
$queue->setName('log_mysql');
//$queue->setFlags(AMQP_DURABLE | AMQP_AUTODELETE);
//消息获取
$queue->consume('processMessage');//服务器主动发送，客户端只负责接受
$cnn->disconnect();

function processMessage($envelope, $queue){
    //global $db;
    //global $write;
    $msg = $envelope->getBody();
    $queue->ack($envelope->getDeliveryTag());
    echo $msg."\n";
    //$arr=json_decode( $msg, true);
    //print_r($arr);
    //$str= "\n[".date('Y-m-d H:i:s')."] user_id=".$arr['user_id'].' rid='.$arr['rid'] ;
    //echo $str;
    //$write->test(    );
    //$write->addEssay( $arr  );
    return false;//true:一直接受, false:只接受一次
}

?>

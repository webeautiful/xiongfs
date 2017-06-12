<?php
class Nosql2 {

    private $mq_connection = null;

    function mq_connect() {
        if(!$this->mq_connection) {
            if( !class_exists('AMQPConnection') ) die('No Module "AMQP"');
            //配置信息
            $params = array('host' =>'mq_server.xxx.xxx',
                'port' => 5672,
                'login' => 'xxx',
                'password' => 'xxxxxx',
                'vhost' => '/');
            //print_r($params );
            try{
                //连接rabbitmq服务器
                $cnn = new AMQPConnection($params);
                $this->mq_connection = $cnn;
            }catch(AMQPConnectionException $e){
                die('Connection failure!');
            }
        }
        return $this->mq_connection;
    }

    /*
    * 队列
    */
    function mq_set( $exchanges, $arr ,$Routing_Key='', $query_name='' ){
        $cnn = $this->mq_connect();
        $cnn->connect();

        $ch = new AMQPChannel($cnn);
        $exchange = new AMQPExchange($ch);
        $exchange->setName( $exchanges ); #队列通道名称
        //if( !$r )  return 0 ;
        //$re = $key='e_'.$arr['rid'].'_'.$arr['user_id'];
        $key= $Routing_Key==''?'info': $Routing_Key ;
        $res = $exchange->publish( is_array( $arr) ?json_encode($arr): $arr , $key , AMQP_NOPARAM, array('delivery_mode'=>2, 'priority'=>9));
        $cnn->disconnect();
        return $res;
    }

    function mq_getMcnt( $query_name ){
        $cnn = $this->mq_connect();
        $cnn->connect();

        $ch = new AMQPChannel($cnn);
        $queue =  new AMQPQueue($ch);
        $queue->setName( $query_name  );
        $queue->setFlags(AMQP_PASSIVE);
        $messageCount = $queue->declareQueue();
        $cnn->disconnect();
        return $messageCount;
    }

    function mq_rec($queueName,$callback){
        $cnn = $this->mq_connect();
        $cnn->connect();

        //创建信息通道
        $ch = new AMQPChannel($cnn);
        $ch->setPrefetchCount(54);

        //创建队列对象
        $queue = new AMQPQueue($ch);
        $queue->setName($queueName);#队列名称

        //阻塞模式接收消息
        $queue->consume($callback);//服务器主动发送，客户端只负责接收

        $cnn->disconnect();
    }
}
?>

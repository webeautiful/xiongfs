<?php

namespace Hht\Model;
/**
 * Description of NosqlModel
 *
 * @author Xiongfs
 */
class NosqlModel {
    var $redis_server= 'redis.pigai.org';
    var $redis_port= 6379;
    var $redis ;

    protected $redislog = array();
    protected $redis_arr = array();

    function redis_init(){
        if( $this->redis ) return $this->redis;
        if( !class_exists('Redis')){
            return null;
        }
        ini_set('default_socket_timeout', -1);
        try{    
            $this->redislog[]= "connect redis://".$this->redis_server.":". $this->redis_port  ;
            $redis = new \Redis(); 
            //$redis->connect( $this->redis_server, $this->redis_port,5 ); 
            $redis->pconnect( $this->redis_server, $this->redis_port,2 ); 
        } catch ( RedisException $e){
            #TODO error log
            $this->redis =  false;
            return false;
        }
        $this->redis = $redis;
        return $redis; 
    }

    function redis_get( $key ){
        $this->redislog[]='redis_get：'. $key  ;
        $redis = $this->redis_init();
        if( !$redis  ){
            return false; 
        }
        try{
            $msg= $redis->get( $key ); 
            return $msg;  
        }catch ( RedisException $e) {
            #TODO error log
            return false;
        }
    }

    function redis_set( $key,$var,$ttl=21600){
        $this->redislog[]='redis_set：'. $key.", ttl=".$ttl ;
        $redis = $this->redis_init();
        if( !$redis  ){
            return false; 
        }
        $value =  is_array($var)? json_encode($var): $var;
        try{
            $msg = $redis->set( $key,$value );
            if( $ttl>0 ){
                $redis->expire($key, $ttl );
            }
            return $msg; 
        }catch ( RedisException $e) {
            #TODO error log
            return FALSE ;
        }
    }

    function redis_del( $k ){
        $this->redislog[]='rdel：'. $k ;
        $this->redis_init();
        try {
            if( ! $this->redis  ) return false;
            if( ! $this->redis ->exists( $k ) ) return false;
            $this->redis->del( $k );   
            return true;
        } catch ( RedisException $ex) {
            #TODO error log
            return false;
        }
    }

    function redis_close_item( $v ){
        try{
            $v->close();
        } catch (Exception $ex) {
            #TODO error log
            return false ;
        }
        return true;
    }

    function __destruct() {
        try{
            if( $this->redis ){
                $this->redis->close();
                return true;
            }
        } catch ( RedisException $e){
            #TODO error log
            return false;
        }
    }
}

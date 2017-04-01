<?php
class RedisLib {
    /**
     * 内部实例对象
     */
    private static $instance = null;
    private $redis = null;

    private $_config = array('host'=> 'redis.api.pigai.org', 'port'=>6379);

    private function __construct($config) {
        $this->_config = array_merge($this->_config, $config);
        $this->redis_init();
    }

    /**
     * 静态方法，返回实例(单例模式)
     */
    public static function getInstance($config=array()) {
        if (self::$instance == null) {
            //获取静态绑定后的类名
            $class = get_called_class();
            self::$instance = new $class($config);
            return self::$instance;
        }
        self::$instance->_config = array_merge(self::$instance->_config, $config);
        return self::$instance;
    }

    private function redis_init() {
        if($this->redis) return $this->redis;

        $host = $this->_config['host'];
        $port = $this->_config['port'];

        $redis = new Redis();
        try {
            $redis->connect( $host, $port, 5 );
        } catch(RedisException $e) {
            die($e);
        }
        $this->redis = $redis;
        return $redis;
    }

    function hset($k, $k2, $v2) {
        $redis = $this->redis_init();

        if( ! $redis  ) return false;
        if( !$redis ->exists( $k ) ) return false;

        if( is_array( $v2)) $v2= json_encode ($v2);
        $redis->hset( $k, $k2, $v2  );
        return true;
    }

    function hget($k, $k2) {
        $redis = $this->redis_init();

        if( !$redis ) return false;
        try{
            if( !$redis->exists( $k ) ) return false;
            $str = $this->redis->hget( $k,$k2);
            return $str ;
        } catch ( RedisException $e){
            $this->Ex_error($e);
             return false;
        }
    }

    function get($k) {
        $redis = $this->redis_init();

        return $redis->get($k);
    }

    function set($k, $v, $ttl=21600) {
        $redis = $this->redis_init();

        $value = is_array($v)? json_encode($v): $v;
        try {
            $redis->set($k, $value);
            $redis->expire($k, $ttl );
            return true;
        } catch(RedisException $e) {
            return false;
        }
    }
}
?>

<?php
class Mysql
{
    private $connections = array();
    private $current = null;
    private $currentdb = null;

    public function __construct($config){
        $this->addConnection($config);
    }

    public function connect($config = array()){
        if(!empty($config)){
            $this->addConnection($config);
        }
        return $this;
    }

    /**
    * 插入一条数据
    * 请在使用前自行检查参数的安全性
    * @notice 如果上一查询没有产生 AUTO_INCREMENT 的 ID，则 mysql_insert_id() 返回 0
    * @param $table string
    * @param $data array
    * @return int/boolean
    **/
    public function insert($table, $data){
        $sql = "INSERT INTO `$table`";
        $fields = array();
        $values = array();
        foreach($data as $k => $v){
            $fields[] = $k;
            $values[] = is_numeric($v) ? $v : '"'.mysql_real_escape_string($v).'"';
        }
        $sql .= '('.implode(',', $fields).') VALUES ('. implode(',', $values) .')';
        $bool = mysql_query($sql, $this->current);
        if(!$bool) return false;
        $insert_id = mysql_insert_id($this->current);
        if($insert_id === 0) return true;
        return $insert_id;
    }

    /**
     * 发送查询语句
     * 注意: 1.仅对 SELECT，SHOW，DESCRIBE, EXPLAIN等语句返回一个 resource
     *       2.对NSERT, UPDATE, DELETE, DROP等，执行成功时返回 TRUE，出错时返回 FALSE
     *
     * return resource/boolean
     */
    public function query($sql){
        $result = mysql_query($sql, $this->current);
        if(!$result) die('sql语句无效!');
        return $result;
    }
    /**
     * Get number of affected rows in previous MySQL operation(针对INSERT/UPDATE/DELETE操作)
     * 注意:1.若update的字段没有发生变化，则影响的行数为0;2.若delete一个不存在的记录，影响的行数也为0
     */
    function affected_rows() {
        return mysql_affected_rows();
    }

    /**
     * 取得行的数目(针对SELECT操作)
     *
     * return integer
     */
    function num_rows($sql) {
        $resource = $this->query($sql);
        return mysql_num_rows($resource);
    }

    /**
    * 获得所有数据的第一行
    *
    * return array
    */
    public function getCol($sql){
        $result = mysql_query($sql, $this->current);
        $ret = array();
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            $ret[] = $row[0];
        };
        return $ret;
    }
    public function getCol2($sql){
        $result = mysql_query($sql, $this->current);
        $ret = array();
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            $ret[$row[0]] = $row[1];
        }
        return $ret;
    }
    public function getOne($sql){
        $result = mysql_query($sql, $this->current);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        return $row ? $row : array();
    }
    public function getAll($sql){
        $resource = $this->query($sql);
        $ret = array();
        while($row = mysql_fetch_assoc($resource)){
            $ret[] = $row;
        };
        return $ret;
    }

    // ---------------------------------
    /*
    * Begin Transaction
    *
    */
    function trans_begin(){
        $this->query('SET AUTOCOMMIT=0');
        $this->query('START TRANSACTION');
        return true;
    }

    /*
    * Commit Transaction
    *
    */
    function trans_commit(){
        $this->query('COMMIT');
        $this->query('SET AUTOCOMMIT=1');
        return true;
    }

    /*
    * Rollback Transaction
    *
    */
    function trans_rollback(){
        $this->query('ROLLBACK');
        $this->query('SET AUTOCOMMIT=1');
        return true;
    }

    public function close(){
        @mysql_close($this->current);
    }

    /**
    * 增加一个mysql连接
    * 如果连接成功，则将当前连接置为此连接
    * 如果连接不成功，则将当前连接置为null
    * @param $config array
    * @return bool
    **/
    private function addConnection($config){
        if(!is_array($config)){
            $this->current = null;
            return false;
        }
        foreach(array('host','user','pass','db') as $v){
            $_config[$v] = isset($config[$v]) ? $config[$v] : '';
        }
        $_config2 = $_config;
        unset($_config2['db']);
        $connkey = substr(md5(json_encode($_config2)), 0, 6);
        if(!isset($this->connections[$connkey])){
            $conn = mysql_connect($_config['host'], $_config['user'], $_config['pass']);
            if($conn){
                $this->connections[$connkey] = $conn;
            }else{
                $this->current = null;
                return false;
            }
        }
        $this->current = $this->connections[$connkey];
        mysql_select_db($_config['db'], $this->current);
        mysql_query('set names utf8', $this->current);
        return true;
    }
}
?>

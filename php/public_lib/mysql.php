<?php
/**
 * 数据库操作类
 *
 */

/**
 * MYSQL数据操方法封装类
 */

class MySql {

	/**
	 * 查询次数
	 * @var int
	 */
	private $queryCount = 0;

	/**
	 * 内部数据连接对象
	 * @var resourse
	 */
	private $conn;

	/**
	 * 内部数据结果
	 * @var resourse
	 */
	private $result;

	/**
	 * 内部实例对象
	 * @var object MySql
	 */
	private static $instance = null;

	/**
	 * 构造函数
	 */
	private function __construct() {
		if (!function_exists('mysql_connect')) {
			die('服务器PHP不支持MySql数据库');
		}
		if (!$this->conn = @mysql_connect(DB_HOST, DB_USER, DB_PASSWD)) {
			die("连接数据库失败,可能是数据库用户名或密码错误");
		}
		if ($this->getMysqlVersion() > '4.1') {
			mysql_query("SET NAMES 'utf8'");
		}
		@mysql_select_db(DB_NAME, $this->conn) OR die("未找到指定数据库");
	}

	/**
	 * 静态方法，返回数据库连接实例
	 */
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new MySql();
		}
		return self::$instance;
	}

	/**
	 * 关闭数据库连接
	 */
	function close() {
		return mysql_close($this->conn);
	}

	/**
	 * 发送查询语句
	 * 注意: 1.仅对 SELECT，SHOW，DESCRIBE, EXPLAIN等语句返回一个 resource
	 *       2.对NSERT, UPDATE, DELETE, DROP等，执行成功时返回 TRUE，出错时返回 FALSE
	 */
	function query($sql) {
		$this->result = @mysql_query($sql, $this->conn);
		$this->queryCount++;
		if (!$this->result) {
			die("SQL语句执行错误：$sql <br />" . $this->geterror());
		}else {
			return $this->result;
		}
	}

	/**
	 * 从结果集中取得一行作为关联数组/数字索引数组
	 *
	 */
	function fetch_array($query , $type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $type);
	}

	function once_fetch_array($sql) {
		$this->result = $this->query($sql);
		return $this->fetch_array($this->result);
	}

	/**
	 * 从结果集中取得一行作为数字索引数组
	 *
	 */
	function fetch_row($query) {
		return mysql_fetch_row($query);
	}

	/**
	 * 取得行的数目(针对SELECT操作)
	 *
	 * return integer
	 */
	function num_rows($query) {
		return mysql_num_rows($query);
	}

	/**
	 * 取得结果集中字段的数目
	 */
	function num_fields($query) {
		return mysql_num_fields($query);
	}
	/**
	 * 取得上一步 INSERT 操作产生的 ID
	 */
	function insert_id() {
		return mysql_insert_id($this->conn);
	}

	/**
	 * 获取mysql错误
	 */
	function geterror() {
		return mysql_error();
	}

	/**
	 * Get number of affected rows in previous MySQL operation(针对INSERT/UPDATE/DELETE操作)
	 * 注意:1.若update的字段没有发生变化，则影响的行数为0;2.若delete一个不存在的字段，影响的行数也为0
	 */
	function affected_rows() {
		return mysql_affected_rows();
	}

	/**
	 * 取得数据库版本信息
	 */
	function getMysqlVersion() {
		return mysql_get_server_info();
	}

	/**
	 * 取得数据库查询次数
	 */
	function getQueryCount() {
		return $this->queryCount;
	}
}

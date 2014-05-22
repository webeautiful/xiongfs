#OOP -- 继承性
以MVC模式下进行web开发为实例,每次开发项目model时,统一继承一个基类MY_Model

* 代码层次结构清晰
* 可维护性好
* 扩展性好
* 代码复用性高

基类 -- MY_Model.php

    /**
     * 数据层基类，提供基本的CRUD操作
     *
     * @author: zg
     * @author: Liangxifeng modify 2014-01-17
     * @date: 2013-11-06
     */

    class MY_Model extends CI_Model
    {
        //表名
        protected $_table;
        //主键
        protected $_pkey;

        public function __construct()
        {
            parent::__construct();
            $this->_pkey = 'id';
        }

        /**
         * 通过主键，得到某一字段数据
         *
         * @param int - $id 主键值
         * @param int - $field 要得到的字段名
         * @return string - 字段的值
         */
        public function getFieldById($id, $field)
        {
            if( empty($id) || !is_int($id) || empty($field) )
            {
                return false;
            }
            $this->db->select($field)->where($this->_pkey, (int)$id);
            $arr = $this->db->get($this->_table)->row();
            return empty($arr->$field) ? '' : $arr->$field;
        }

        /**
         * 通过主键，得到一条记录
         *
         * @param int - $id 主键值
         * @return mixed - 一条记录的数组/失败
         */
        public function getOne($id,$field="*")
        {
            if( empty($id) || !is_int($id) )
            {
                return false;
            }
            $query = $this->db->select($field)->where($this->_pkey, (int)$id)->get($this->_table);
            return ($query->num_rows() > 0) ? $query->row_array() : false;
        }

        /**
         * 得到符合条件的记录
         *
         * @param array - $where 条件，如：array('status'=>1)
         * @param int - $limit 最多返回条数
         * @param int - $offset 偏移量
         * @param string - $order 排序信息，如：'sort DESC'
         * @param array - $where_in 对应关键字IN，如：array('user_id'=>'1,2,5')
         * @param array - $where_not_in 对应关键字NOT IN，如：array('user_id'=>'1,2,5')
         * @param array - $where_like 对应关键字LIKE，如：array('user'=>'某某')
         * @return array - 所有记录的数组
         */
        public function getTotal($where=array(), $limit=0, $offset=0, $order='',$where_in=array(),$where_like=array(),$field="*",$where_not_in=array())
        {
            if(!empty($field))$this->db->select($field);
            if(!empty($where))$this->db->where($where);
            if(!empty($order))$this->db->order_by($order);
            if((int)$limit) $this->db->limit($limit);
            if((int)$offset) $this->db->offset($offset);
            if(!empty($where_in)) $this->db->where_in($where_in['field'],$where_in['values']);
            if(!empty($where_not_in)) $this->db->where_not_in($where_not_in['field'],$where_not_in['values']);
            if(!empty($where_like))$this->db->like($where_like);
            /* return $this->db->last_query(); */
            return $this->db->get($this->_table)->result_array();
        }

        /**
         * 得到符合条件的记录的总条数
         *
         * @param array - $where 条件，如：array('status'=>1)
         * @param array - $where_in 对应关键字IN，如：array('user_id'=>'1,2,5')
         * @param array - $where_like 对应关键字LIKE，如：array('user'=>'某某')
         * @return int - 条数
         */
        public function getTotalNum($where=array(),$where_in=array(),$where_like=array())
        {
            if( !empty($where) )
            {
                $this->db->where($where);
            }
            if( !empty($where_in) )
            {
               $this->db->where_in($where_in['field'],$where_in['values']);
            }
            if( !empty($where_like))
            {
                $this->db->like($where_like);
            }
            return $this->db->count_all_results($this->_table);
        }

        /**
         * 新增记录
         *
         * @param array - $data 记录内容数组，如：array('id'=>null, 'status'=>1)
         * @return mixed - 记录主键/false
         */
        public function insert($data=array())
        {
            if( empty($data) || !is_array($data) )
            {
                return false;
            }
            return ($this->db->insert($this->_table, $data)) ? $this->db->insert_id() : false;
            //$this->db->insert($this->_table, $data);
            //return $this->db->last_query();
        }

        /**
         * 通过主键，更新记录
         *
         * @param int - - $id 主键值
         * @param array - $data 记录内容数组，如：array('status'=>0)
         * @return boolean - 成功/失败
         */
        public function update($id, $data)
        {
            if( empty($id) || !is_int($id) )
            {
                return false;
            }
            /* 人工控制返回值，防止因为update变化引起返回值变化*/
            return ($this->db->update($this->_table, $data, array($this->_pkey => (int)$id))) ? true : false;
        }

        /**
         * 通过主键，删除记录
         *
         * @param int - $id 主键值
         * @return boolean - 成功/失败
         */
        public function del($id)
        {
            if( empty($id) || !is_int($id) )
            {
                return false;
            }
            return ($this->db->delete($this->_table, array($this->_pkey => (int)$id))) ? true : false;
        }
    }

一个子类model

    <?php
    /**
    * description:储存标签的表
    *
    * author:yangzhen
    * date:2014-05-07
    */
    class Ecm_diary_tag_info_mdl extends MY_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->_table = 'ecm_diary_tag_info';
            $this->_pkey = 'tag_id';
        }
    }
    ?>

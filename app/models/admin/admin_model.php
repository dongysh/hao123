<?php

class Admin_model extends CI_Model
{

	private $table_name = 'admins';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取管理员资料，通过管理员名
     * @param string $username 管理员名
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/6
     */

    public function get_info_by_username($username)
    {
        $this->db->where('admin_name', $username);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取管理员资料，通过管理员id
     * @param array $aid 管理员id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/7/31
     */
    public function get_info_by_aid($aid)
    {
        $this->db->where_in('admin_id',$aid);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }


    /**
     * 获取管理员总数
     * @param int $status 管理员状态参数
     * @return int 返回查询结果
     * @author Dongysh
     * @last update 2013/9/6
     */
    public function get_count($status=0)
    {
        $this->db->select('count(admin_id) as count');
        $this->db->where('status >=',$status);
        $query = $this->db->get($this->table_name);
        $ret = $query->row_array();

        return $ret['count'];
    }

    /**
     * 获取管理员列表
     * @param int $status 管理员状态参数
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_list($status=0)
    {
        $this->db->where('status >=',$status);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取某一平台下管理员列表
     * @param $op int 平台id int $status 管理员状态参数
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/21
     */
    public function get_list_by_op($op, $status=0)
    {
        $this->db->where('status >=',$status);
        $this->db->where("operator_id", $op);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 添加管理员
     * @access public
     * @param array $para 添加的管理员信息的数组
     * @return int 新增管理员的id
     * @author dongysh
     * @last update 2013/9/6
     */
    public function addAdmin(array $para)
    {
    	$this->db->insert($this->table_name, $para);
        return $this->db->insert_id();
    }

    /**
     * 修改管理员信息
     * @access public
     * @param int $aid 要修改的管理员id
     * @param array $para 要修改的内容数组
     * @return int
     * @author dongysh
     * @last update 2013/9/6
     */
    public function updateAdmin($aid,array $para)
    {
        $this->db->where('admin_id', $aid);
        $this->db->update($this->table_name, $para); 

        return $this->db->affected_rows();
    }
}
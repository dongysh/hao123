<?php

class Operator_model extends CI_Model
{

	private $table_name = 'operators';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取运营商资料，通过运营商id
     * @param array $oid 运营商id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_info_by_oid($oid)
    {
        $this->db->where_in('operator_id',$oid);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }


    /**
     * 获取运营商总数
     * @return int 返回查询结果
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_count()
    {
        $this->db->select('count(operator_id) as count');
        $query = $this->db->get($this->table_name);
        $ret = $query->row_array();

        return $ret['count'];
    }

    /**
     * 分页获取运营商列表
     * @para int offset 读取起始位置  int rows 每页记录数
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_list($offset=0,$rows=15)
    {
        $this->db->order_by('operator_id','asc');
        $this->db->limit($rows, $offset);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取全部运营商列表
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_all()
    {
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 添加运营商
     * @access public
     * @param array $para 添加的运营商信息的数组
     * @return int 新增运营商的id
     * @author dongysh
     * @last update 2013/9/18
     */
    public function addoperator(array $para)
    {
    	$this->db->insert($this->table_name, $para);
        return $this->db->insert_id();
    }

    /**
     * 修改运营商信息
     * @access public
     * @param int $oid 要修改的运营商id
     * @param array $para 要修改的内容数组
     * @return int
     * @author dongysh
     * @last update 2013/9/18
     */
    public function updateoperator($oid,array $para)
    {
        $this->db->where('operator_id', $oid);
        $this->db->update($this->table_name, $para); 

        return $this->db->affected_rows();
    }

    /**
     * 删除运营商信息
     * @param int or array $oid 运营商id
     * @return int 删除操作影响的记录数
     * @author dongysh
     * @last update 2013/9/18
     */
    public function deleteoperator($oid)
    {
        $this->db->where('operator_id',$oid);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }
}
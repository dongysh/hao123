<?php

class Research_model extends CI_Model
{

	private $table_name = 'researchs';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取研发商资料，通过研发商id
     * @param array $oid 研发商id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_info_by_rid($rid)
    {
        $this->db->where_in('research_id',$rid);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }


    /**
     * 获取研发商总数
     * @return int 返回查询结果
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_count()
    {
        $this->db->select('count(research_id) as count');
        $query = $this->db->get($this->table_name);
        $ret = $query->row_array();

        return $ret['count'];
    }

    /**
     * 获取研发商列表
     * @para int offset 读取起始位置  int rows 每页记录数
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_list($offset=0,$rows=15)
    {
        $this->db->order_by('research_id','asc');
        $this->db->limit($rows, $offset);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取全部开发商列表
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
     * 添加研发商
     * @access public
     * @param array $para 添加的研发商信息的数组
     * @return int 新增研发商的id
     * @author dongysh
     * @last update 2013/9/18
     */
    public function addresearch(array $para)
    {
    	$this->db->insert($this->table_name, $para);
        return $this->db->insert_id();
    }

    /**
     * 修改研发商信息
     * @access public
     * @param int $gid 要修改的研发商id
     * @param array $para 要修改的内容数组
     * @return int
     * @author dongysh
     * @last update 2013/9/18
     */
    public function updateresearch($rid,array $para)
    {
        $this->db->where('research_id', $rid);
        $this->db->update($this->table_name, $para); 

        return $this->db->affected_rows();
    }

    /**
     * 删除研发商信息
     * @param int or array $rid 研发商id
     * @return int 删除操作影响的记录数
     * @author dongysh
     * @last update 2013/9/18
     */
    public function deleteresearch($rid)
    {
        $this->db->where('research_id', $rid);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }
}
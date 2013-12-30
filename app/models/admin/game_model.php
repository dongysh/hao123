<?php

class Game_model extends CI_Model
{

	private $table_name = 'games';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取游戏资料，通过游戏名
     * @param string $username 游戏名
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_info_by_gamename($gamename)
    {
        $this->db->where('title', $gamename);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取游戏资料，通过游戏id
     * @param array $gid 游戏id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_info_by_gameid($gid)
    {
        $this->db->where_in('game_id',$gid);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 得到指定运营商的所有游戏
     * @param int $op 运营商id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_game_by_operator($op)
    {
        $this->db->where('operator', $op);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 得到要导出的游戏数据
     * @param int $op 运营商id  int $re 开发商id
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/22
     */
    public function export_game($op, $re)
    {
        $this->db->where('operator', $op);
        $this->db->where('research', $re);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }


    /**
     * 获取游戏总数
     * @return int 返回查询结果
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_count()
    {
        $this->db->select('count(game_id) as count');
        $query = $this->db->get($this->table_name);
        $ret = $query->row_array();

        return $ret['count'];
    }

    /**
     * 获取游戏列表
     * @para int offset 读取起始位置  int rows 每页记录数
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_list($offset=0,$rows=15)
    {
        $this->db->order_by('game_id','desc');
        $this->db->limit($rows, $offset);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取全部游戏
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_all()
    {
        $this->db->order_by('game_id','desc');
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 添加游戏
     * @access public
     * @param array $para 添加的游戏信息的数组
     * @return int 新增游戏的id
     * @author dongysh
     * @last update 2013/9/18
     */
    public function addGame(array $para)
    {
    	$this->db->insert($this->table_name, $para);
        return $this->db->insert_id();
    }

    /**
     * 修改游戏信息
     * @access public
     * @param int $gid 要修改的游戏id
     * @param array $para 要修改的内容数组
     * @return int
     * @author dongysh
     * @last update 2013/9/18
     */
    public function updateGame($gid,array $para)
    {
        $this->db->where('game_id', $gid);
        $this->db->update($this->table_name, $para); 

        return $this->db->affected_rows();
    }

    /**
     * 删除游戏信息
     * @param int or array $gid 游戏id
     * @return int 删除操作影响的记录数
     * @author dongysh
     * @last update 2013/9/18
     */
    public function deleteGame($gid)
    {
        $this->db->where('game_id', $gid);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }

    /**
     * 得到游戏所有常量
     * @return array 游戏常量信息
     * @author dongysh
     * @last update 2013/9/21
     */
    public function get_consts()
    {
        $consts = array(
                "type"=>array(
                        "角色扮演","体育竞技","战争策略","社区养成"
                    ),
                "style"=>array(
                        "武侠神话","写实","Q版卡通","小说","三国",
                        "武侠","魔幻","历史","航海","科幻","战国",
                        "动漫","射击","神话","体育"
                    ),
                "painting"=>array(
                        "3D","2D","2.5D","flash","图文"
                    ),
                "status"=>array(
                        "公测","内测","封测","运营中","研发中",
                    ),
                "ctg"=>array(
                        "网络游戏","网页游戏"
                    ),
                "origin"=>array(
                        "大陆"
                    ),
                "card_group"=>array(
                        "激活码","新手卡","特权码"
                    )
            );
        return $consts;
    }
}
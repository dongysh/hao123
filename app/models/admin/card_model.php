<?php

class Card_model extends CI_Model
{

	private $table_name = 'cards';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取指定游戏指定类型的全部点卡
     * @return array or false 查询结果或false
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function get_list($game_id, $card_group)
    {
        $this->db->where("game_id", $game_id);
        $this->db->where("card_group", $card_group);
        $query = $this->db->get($this->table_name);

        return $query->num_rows()>0 ? $query->result_array() : false;
    }

    /**
     * 获取指定游戏指定类型的点卡数量
     * @return int $count 点卡数量
     * @author Dongysh
     * @last update 2013/9/23
     */
    public function get_count($game_id, $card_group)
    {
        $this->db->select('count(card_id) as count');
        $this->db->where("game_id", $game_id);
        $this->db->where("card_group", $card_group);
        $query = $this->db->get($this->table_name);
        $ret = $query->row_array();

        return $ret['count'];
    }
}
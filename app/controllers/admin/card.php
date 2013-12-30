<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card extends CI_Controller {

	/**
	 * 构造函数，检查管理员的登录状态  导入相关模型类
	 * @author Dongysh
	 */
	public function __construct()
    {
        parent::__construct();
        if(!checkAdminLogin())
        {
            header("Location:".ADMIN_PATH);
            die();
        }
        $this->load->model(ADMIN_DIR.'/card_model','card');
        $this->load->model(ADMIN_DIR.'/game_model','game');
        $this->load->model(ADMIN_DIR.'/operator_model','operator');
    }

    /**
     * 控制器默认首页
     * 跳转到游戏列表页面 进行操作
     * @author dongysh
     * @last update 2013/9/22
     */
	public function index()
	{
        header("Location:".ADMIN_PATH."/card/search");
        die();
    }

    /**
     * 点卡管理 
     * 根据管理员权限 显示相应的游戏列表  进行相关操作
     * @author dongysh
     * @last update 2013/9/22
     */
    public function listgames()
    {
        if($_SESSION['operator_id'] == 0)                   //超级管理员
        {
            $data['gamelist'] = $this->game->get_all();
        }
        elseif($_SESSION['operator_id'] != 0 && $_SESSION['game_id'] == 0)      //平台管理员
        {
            $data['gamelist'] = $this->game->get_game_by_operator($_SESSION['operator_id']);
        }
        else                                                //游戏管理员
        {
            $data['gamelist'] = $this->game->get_info_by_gameid($_SESSION['game_id']);
        }
        $consts = $this->game->get_consts();                //得到所有常量值
        foreach($data['gamelist'] as $key=>$val)
        {
            $operator = $this->operator->get_info_by_oid($val['operator']);
            $data['gamelist'][$key]['group'] = $consts["card_group"][$val['card_group']-1];     //游戏点卡类型
            $data['gamelist'][$key]['operator']   = $operator[0]['operator_name'];              //运营商
            $data['gamelist'][$key]['count']   = $this->card->get_count($val['game_id'], $val['card_group']);   //点卡数量
        }
        $data['sidebar_game'] = "active";                   //选中左侧菜单栏相关项
        $data['sidebar_game_card'] = "active";
        $this->load->view(ADMIN_DIR."/card", $data); 
    }

    /* 
     * 查看点卡列表
     * 根据地址栏中的参数，查询到点卡列表
     * @author dongysh
     * @return array or false 返回查询结果或false
     * @last update 2013/9/22
     */
    public function listcards()
    {
        $game_id = $this->input->get("game");       //游戏id 
        $card_group = $this->input->get("card");    //点卡类型
        $data["cardlist"] = $this->card->get_list($game_id, $card_group);   //点卡列表
        $consts = $this->game->get_consts();                //得到所有常量值
        if($data["cardlist"])
        {
            foreach($data["cardlist"] as $key=>$val)
            {
                $game = $this->game->get_info_by_gameid($val['game_id']);
                $operator = $this->operator->get_info_by_oid($game[0]['operator']);
                $data['cardlist'][$key]['game_name']    = $game[0]['title'];                    //游戏名称
                $data['cardlist'][$key]['operator']     = $operator[0]['operator_name'];        //运营商
                $data['cardlist'][$key]['card_group']   = $consts["card_group"][$val['card_group']-1];  //点卡类型
            }
        }
        $data['sidebar_game'] = "active";                   //选中左侧菜单栏相关项
        $data['sidebar_game_card'] = "active";
        $this->load->view(ADMIN_DIR."/listcards", $data);
    }

    /** 
     * 批量导入点卡，通过csv文件
     * @author Dongysh
     * @last update 2013/9/22
     */
    public function import()
    {
        $action = $this->input->post('action');
        if($action=='importAction')
        {
            $filename = $_FILES['csvfile']['tmp_name'];
            if (empty ($filename))                     //判断文件是否上传
            { 
                echo "<script>alert('请选择要导入的CSV文件！');history.go(-1);</script>"; 
                die();
            }
            $handle = fopen($filename, 'r'); 
            $input = input_csv($handle);               //解析csv，将文件转化为数组
            $len_input = count($input); 
            if($len_input==0)                          //判断文件是否为空
            { 
                echo "<script>alert('没有任何数据！');history.go(-1);</script>"; 
            }

            $data_values = '';                          //判断游戏及点卡类型是否相符，以免导入错误
            $consts = $this->game->get_consts();
            $game_id = $this->input->post("game_id");
            $card_group = $this->input->post("card_group");

            for ($i = 1; $i < $len_input; $i++)                  //循环获取各字段值 
            { 
                $gamename   = trim(mb_convert_encoding($input[$i][0], 'UTF-8', "GBK, GB2312"));
                $group      = trim(mb_convert_encoding($input[$i][1], 'UTF-8', "GBK, GB2312"));
                $game       = $this->game->get_info_by_gamename($gamename);
                $gid        = $game[0]['game_id'];
                $c_group    = (array_search($group, $consts['card_group']) + 1);
                if($game_id != $gid || $card_group != $c_group)
                {
                    echo "<script>alert('请确认导入数据是否与游戏数据相符！');history.go(-1);</script>";
                    die();
                }
                $card_number    =   $input[$i][2];
                $status         =   1;
                $data_values .= "('$game_id','$card_group','$card_number','$status'),"; 
            } 
            $data_values = substr($data_values,0,-1);   //去掉最后一个逗号 
            fclose($handle);                            //关闭指针
            $sql = "insert into cards (game_id,card_group,card_number,status) values $data_values";
            $query = mysql_query($sql);                 //批量插入数据表中  
            if($query)
            { 
                echo "<script>alert('导入成功！');</script>";
                echo '<script>window.location.href="'.ADMIN_PATH.'/card/listgames";</script>';
            }
            else
            {
                echo "<script>alert('导入失败！');history.go(-1);</script>"; 
            } 
        }
        else
        {
            $game_id = $this->input->get("game");
            $gameInfo = $this->game->get_info_by_gameid($game_id);  //得到游戏信息
            $consts = $this->game->get_consts();
            $data['gameInfo'] = $gameInfo[0];
            $data['gameInfo']['card_group'] = $consts["card_group"][$gameInfo[0]['card_group']-1];
            $data['sidebar_game'] = "active";      //选中左侧导航栏内的相关项
            $data['sidebar_game_card'] = "active";                    
            $this->load->view(ADMIN_DIR.'/import',$data);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
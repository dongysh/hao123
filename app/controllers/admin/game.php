<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {

    private $perpage = 15;

	/**
	 * 构造函数，检查用户的登录状态，并加载所有要用到的模型类
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
        $this->load->model(ADMIN_DIR.'/game_model','game');
        $this->load->model(ADMIN_DIR.'/card_model','card');
        $this->load->model(ADMIN_DIR.'/operator_model','operator');
        $this->load->model(ADMIN_DIR.'/research_model','research');
    }

    /**
     * 控制器默认首页
     * 跳转到游戏列表页面
     * @author dongysh
     * @last update 2013/9/17
     */
	public function index()
	{
		header("Location:".ADMIN_PATH."/game/listgames");
		die();
	}

    /* 
     * 查看游戏列表
     * @author dongysh
     * @return array or false 返回查询结果或false
     * @last update 2013/9/18
     */
    public function listgames()
    {
        if($_SESSION['operator_id'] == 0)               //超级管理员
        {
            $data['gamelist'] = $this->game->get_all();
        }
        else                                            //平台管理员
        {
            $data['gamelist'] = $this->game->get_game_by_operator($_SESSION['operator_id']);
        }
        $consts = $this->game->get_consts();            //得到所有常量值
        if($data['gamelist'])
        {
            foreach($data['gamelist'] as $key=>$val)    //游戏列表，并将id值转换为对应的字符串
            {
                $operator = $this->operator->get_info_by_oid($val['operator']);
                $data['gamelist'][$key]['type']       = $consts["type"][$val['type']-1];
                $data['gamelist'][$key]['painting']   = $consts["painting"][$val['painting']-1];
                $data['gamelist'][$key]['style']      = $consts["style"][$val['style']-1];
                $data['gamelist'][$key]['status']     = $consts["status"][$val['status']-1];
                $data['gamelist'][$key]['ctg']        = $consts["ctg"][$val['ctg']-1];
                $data['gamelist'][$key]['origin']     = $consts["origin"][$val['origin']-1];
                $data['gamelist'][$key]['card_group'] = $consts["card_group"][$val['card_group']-1];
                $data['gamelist'][$key]['operator']   = $operator[0]['operator_name'];
            }
        }
        $data['sidebar_game'] = "active";               //选中左侧导航栏内的相关项
        $data['sidebar_game_list'] = "active";
        $this->load->view(ADMIN_DIR.'/listgames',$data);
    }

	/* 
	 * 查看游戏列表
	 * @author dongysh
	 * @return array or false 返回查询结果或false
	 * @last update 2013/9/18
	 */
    public function listgames2($current=1)
    {	
        $this->load->library('pagination');
        $config['base_url'] = ADMIN_PATH.'/game/listgames/';
        $total = $this->game->get_count();
        $config['total_rows'] = $total;
        $config['per_page'] = $this->perpage; 
        $config['uri_segment'] = 4;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $this->pagination->initialize($config);
		$data['gamelist'] = $this->game->get_list(($current-1)*$config['per_page'], $config['per_page']);
        $data['current'] = $current;
        $data['total'] = $total;
        $data['pages'] = $this->pagination->create_links();
		$data['sidebar_game'] = "active";				//选中左侧导航栏内的相关项
        $data['sidebar_game_list'] = "active";
		$this->load->view(ADMIN_DIR.'/listgames',$data);
    }

    /** 
     * 添加游戏
     * 处理前台ajax传过来的值，再将结果返回
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function addgame()
    {
        $action = $this->input->post("action");
        if($action == "addAction")
        {
            $filename = $_FILES['img']['tmp_name'];            
            if (empty ($filename))                             //判断是否上传图片
            { 
                echo "<script>alert('请选择游戏展示图片！');history.go(-1);</script>"; 
                die();
            }

            $type = get_file_type($_FILES['img']['name']);
            $allowExt = array("jpg",'gif','png');
            if(!in_array($type, $allowExt))                     //判断图片类型
            {
                echo "<script>alert('请确认选择图片！');history.go(-1);</script>"; 
                die();
            }
            $newName = time().'.'.$type;
            if(move_uploaded_file($_FILES['img']['tmp_name'],'upload/'.$newName))      //上传图片
            { 
                $_POST['imgurl'] = UPLOAD_PATH.'/'.$newName;
            }
            $_POST['card_start_time']    = date("Y-m-d", strtotime($this->input->post('starttime')));   //处理并组合表单POST的值，添加游戏
            $_POST['card_end_time']      = date("Y-m-d", strtotime($this->input->post('endtime')));
            unset($_POST['action']);
            unset($_POST['starttime']);
            unset($_POST['endtime']);
            if($this->game->addgame($_POST))
            {
                echo "<script>alert('游戏添加成功！');</script>";
                echo '<script>window.location.href="'.ADMIN_PATH.'/game/listgames";</script>';  //跳转到游戏列表
            }
            else
            {
                echo "<script>alert('游戏添加失败！');history.go(-1);</script>";
            }
        }
        else
        {     
            $data['consts'] = $this->game->get_consts();    //得到所有常量值
            if($_SESSION['operator_id'] == 0 )              //超级管理员
            {
                $data['operator']   = $this->operator->get_all();
            }
            else                                            //平台管理员
            {
                $data['operator']   = $this->operator->get_info_by_oid($_SESSION['operator_id']);
            }
            $data['research']   = $this->research->get_all();
            $data['sidebar_game']       = "active";               //选中左侧导航栏内的相关项
            $data['sidebar_game_list']  = "active";
            $this->load->view(ADMIN_DIR.'/addgame', $data);
        }
    }

    /** 
     * 更新游戏信息
     * 处理前台ajax传过来的值，再将结果返回
     * @param int $game_id 要修改的游戏id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function updategame($game_id)
    {
        $action = $this->input->post("action");
        if($action == "updateAction")
        {
            if(!empty($_FILES['img']['tmp_name']))          //若更新图片，则进行上传操作
            {
                $type = get_file_type($_FILES['img']['name']);
                $allowExt = array("jpg",'gif','png');
                if(!in_array($type, $allowExt))
                {
                    echo "<script>alert('请确认选择图片！');history.go(-1);</script>"; 
                    die();
                }
                $newName = time().'.'.$type;
                if(move_uploaded_file($_FILES['img']['tmp_name'],"upload/".$newName))
                { 
                    $_POST['imgurl'] = UPLOAD_PATH.'/'.$newName;
                }
            }
            $_POST['card_start_time']    = date("Y-m-d", strtotime($this->input->post('starttime')));
            $_POST['card_end_time']      = date("Y-m-d", strtotime($this->input->post('endtime')));
            unset($_POST['action']);
            unset($_POST['starttime']);
            unset($_POST['endtime']);
            if($this->game->updategame($game_id, $_POST))
            {
                echo "<script>alert('游戏更新成功！');</script>";
                echo '<script>window.location.href="'.ADMIN_PATH.'/game/listgames";</script>';
            }
            else
            {
                echo "<script>alert('游戏更新失败！');history.go(-1);</script>";
            }
        }
        else
        {
            $gameInfo = $this->game->get_info_by_gameid($game_id);  //得到游戏信息
            $data['gameInfo'] = $gameInfo[0];
            $data['consts'] = $this->game->get_consts();            //得到所有常量值
            $data['operator']   = $this->operator->get_all();
            $data['research']   = $this->research->get_all();
            $data['sidebar_game']       = "active";                 //选中左侧导航栏内的相关项
            $data['sidebar_game_list']  = "active";
            $this->load->view(ADMIN_DIR.'/updategame',$data);
        }
    }

    /** 
     * 删除游戏  并提示相关信息
     * @param int $game_id 要删除的游戏id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function deletegame($game_id)
    {
        if($this->game->deletegame($game_id))
        {
            echo "<script>alert('游戏删除成功！');history.go(-1);</script>";
        }
        else
        {
            echo "<script>alert('游戏删除失败！');history.go(-1);</script>";
        }
    }

    /** 
     * 游戏详情
     * @param int $game_id 游戏id
     * @author Dongysh
     * @last update 2013/9/23
     */
    public function detail($game_id)
    {
        $gameInfo = $this->game->get_info_by_gameid($game_id);  //得到游戏信息
        $consts = $this->game->get_consts();                     //得到所有常量值
        $operator = $this->operator->get_info_by_oid($gameInfo[0]['operator']);
        $research = $this->research->get_info_by_rid($gameInfo[0]['research']);
        $data['gameInfo'] = $gameInfo[0];
        $data['gameInfo']['type']       = $consts["type"][$gameInfo[0]['type']-1]; 
        $data['gameInfo']['painting']   = $consts["painting"][$gameInfo[0]['painting']-1];
        $data['gameInfo']['style']      = $consts["style"][$gameInfo[0]['style']-1];
        $data['gameInfo']['status']     = $consts["status"][$gameInfo[0]['status']-1];
        $data['gameInfo']['ctg']        = $consts["ctg"][$gameInfo[0]['ctg']-1];
        $data['gameInfo']['origin']     = $consts["origin"][$gameInfo[0]['origin']-1];
        $data['gameInfo']['operator']   = $operator[0]['operator_name'];
        $data['gameInfo']['research']   = $research[0]['research_name'];
        $data['gameInfo']['card_group'] = $consts["card_group"][$gameInfo[0]['card_group']-1];
        $data['consts'] = $consts;
        $data['sidebar_game']       = "active";                 //选中左侧导航栏内的相关项
        $data['sidebar_game_list']  = "active";
        $this->load->view(ADMIN_DIR."/gamedetail", $data);
    }

    /**
     * 得到指定运营商的所有游戏
     * 处理前台ajax传过来的值，再将结果返回
     * @return array or false 返回查询结果或false
     * @author dongysh
     * @last update 2013/9/18
     */
    public function get_game_by_operator()
    {
        $op = $this->input->post('operator');
        $games = $this->game->get_game_by_operator($op);
        echo json_encode($games);
    }

    /**
     * 导出指定运营商和开发商的所有游戏的XML文件
     * @return xml文件
     * @author dongysh
     * @last update 2013/9/22
     */
    public function exportXml()
    {
        $action = $this->input->post("action");
        if($action == "exportAction")
        {
            $operator = $this->input->post("operator");         //根据指定运营商和研发商查出游戏列表
            $research = $this->input->post("research");
            $data = $this->game->export_game($operator, $research);
            $consts = $this->game->get_consts();                //得到所有常量值
            foreach($data as $key=>$val)                        //处理查询出的数据，便于导出
            {
                $operator = $this->operator->get_info_by_oid($val['operator']);
                $research = $this->research->get_info_by_rid($val['research']);
                $data[$key]['type']       = $consts["type"][$val['type']-1]; 
                $data[$key]['painting']   = $consts["painting"][$val['painting']-1];
                $data[$key]['style']      = $consts["style"][$val['style']-1];
                $data[$key]['status']     = $consts["status"][$val['status']-1];
                $data[$key]['ctg']        = $consts["ctg"][$val['ctg']-1];
                $data[$key]['origin']     = $consts["origin"][$val['origin']-1];
                $data[$key]['operator']   = $operator[0]['operator_name'];
                $data[$key]['research']   = $research[0]['research_name'];
                $data[$key]['cards']      = $this->card->get_list($data[$key]['game_id'], $data[$key]['card_group']);
                $data[$key]['card_group'] = $consts["card_group"][$val['card_group']-1];
                unset($data[$key]['game_id']);
                unset($data[$key]['addtime']);
            }
            $dom=new DomDocument('1.0', 'utf-8');
            $dom->formatOutput = true;
            $root = $dom->createElement('urlset');  
            $dom->appendchild($root);
            $sitename = $dom->createElement('sitename');  
            $root->appendchild($sitename);
            $text = $dom->createCDATASection("游戏风云");  
            $sitename->appendchild($text); 
            $siteurl = $dom->createElement('siteurl');  
            $root->appendchild($siteurl);
            $text = $dom->createCDATASection("http://www.gamefy.cn");  
            $siteurl->appendchild($text); 
            $games = $dom->createElement('games');  
            $root->appendchild($games);
            foreach ($data as $value) 
            {
                $game = $dom->createElement('game');  
                $games->appendchild($game); 
                if (is_array($value)) 
                {  
                    foreach ($value as $key => $val) 
                    {
                        if(is_array($val) && $key == "cards")
                        {
                            $cards = $dom->createElement('cards');  
                            $game->appendchild($cards);
                            $card_group = $dom->createElement('card_group');  
                            $cards->appendchild($card_group);
                            $ctg = $dom->createElement('ctg');  
                            $card_group->appendchild($ctg);
                            $text = $dom->createCDATASection($value["card_group"]);  
                            $ctg->appendchild($text); 
                            $card_elements = $dom->createElement('card_elements');  
                            $card_group->appendchild($card_elements);
                            foreach($val as $k => $v)
                            {
                                $card = $dom->createElement('card');  
                                $card_elements->appendchild($card);
                                $$k = $dom->createElement("number");  
                                $card->appendchild($$k);
                                $text = $dom->createCDATASection($v["card_number"]);  
                                $$k->appendchild($text); 
                                $$k = $dom->createElement("valid_from");  
                                $card->appendchild($$k);
                                $text = $dom->createCDATASection($value['card_start_time']);  
                                $$k->appendchild($text);
                                $$k = $dom->createElement("valid_to");  
                                $card->appendchild($$k);
                                $text = $dom->createCDATASection($value['card_end_time']);  
                                $$k->appendchild($text); 
                            }
                        }
                        else
                        {
                            if($key != "card_group" && $key != "card_start_time" && $key != "card_end_time")
                            {
                                $$key = $dom->createElement($key);  
                                $game->appendchild($$key);
                                $text = $dom->createCDATASection($val);  
                                $$key->appendchild($text);  
                            }
                        }
                    }
                }  
            }
            header("Content-Type: text/xml");                   //导出xml文件
            // header("Content-Disposition:attachment;filename= games.xml"); 
            // header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
            // header('Expires:0'); 
            // header('Pragma:public');
            echo $dom->saveXML(); 
        }
        else
        {
            if($_SESSION['operator_id'] == 0 )                  //超级管理员
            {
                $data['operatorlist'] = $this->operator->get_all();
            }
            else                                                //平台管理员
            {
                $data['operatorlist'] = $this->operator->get_info_by_oid($_SESSION['operator_id']);
            }
            $data['researchlist'] = $this->research->get_all();
            $data['sidebar_game']       = "active";               //选中左侧导航栏内的相关项
            $data['sidebar_game_list']  = "active";
            $this->load->view(ADMIN_DIR."/exportxml", $data);
        }
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
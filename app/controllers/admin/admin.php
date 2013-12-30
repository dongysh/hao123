<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * 构造函数，检查管理员的登录状态，并加载所有要用到的模型类
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
        $this->load->model(ADMIN_DIR.'/admin_model','admin');
        $this->load->model(ADMIN_DIR.'/operator_model','operator');
        $this->load->model(ADMIN_DIR.'/game_model','game');
    }

    /**
     * 控制器默认首页
     * 跳转到管理员列表页面
     * @author dongysh
     * @last update 2013/8/21
     */
	public function index()
	{
		header("Location:".ADMIN_PATH."/admin/listadmins");
		die();
	}

	/**
     * 添加管理员
     * 处理前台ajax传过来的值，再将结果返回
     * @author dongysh
     * @last update 2013/8/21
     */
	public function addAdmin()
	{
		$action = $this->input->post('action');
		if($action=='addAction')
		{
			$para['admin_name'] = $this->input->post('username');
			$para['admin_pass'] = md5($this->input->post('password'));
			$para['operator_id']= $this->input->post('operator');
			$para['game_id'] 	= $this->input->post('game');
			$para['status'] 	= 1;
			if($this->admin->addadmin($para))
			{
				$msg['message'] = '用户添加成功';
				$msg['status'] = true;
				$msg['linkto'] = ADMIN_PATH."/admin/listadmins";
			}
			else
			{
				$msg['message'] = '用户添加失败';
				$msg['status'] = false;
			}
			echo json_encode($msg);
		}
		else
		{
			if($_SESSION['operator_id'] == 0 )			//超级管理员平台id 默认为0，可添加所有平台的管理员
            {
                $data['operatorlist']   = $this->operator->get_all();
            }
            else 										//某一平台的管理员只能添加对应平台的管理员
            {
                $data['operatorlist']   = $this->operator->get_info_by_oid($_SESSION['operator_id']);
                $data['gamelist'] = $this->game->get_game_by_operator($_SESSION['operator_id']);
            }
			$data['sidebar_admin'] = "active";				//选中左侧导航栏内的相关项
			$this->load->view(ADMIN_DIR.'/addadmin',$data);	
		}
	}

	/* 
	 * 查看管理员列表
	 * @author dongysh
	 * @return array or false 返回查询结果或false
	 * @last update 2013/8/21
	 */
    public function listAdmins()
    {	
    	if($_SESSION['operator_id'] == 0 )		//超级管理员可查看所有管理员信息
    	{
    		$data['adminlist'] = $this->admin->get_list();
    	}
    	else 									//某一平台的管理员可查看该平台下的管理员信息
    	{
    		$data['adminlist'] = $this->admin->get_list_by_op($_SESSION['operator_id']);
    	}
		$data['sidebar_admin'] = "active";				//选中左侧导航栏内的相关项
		$this->load->view(ADMIN_DIR.'/listadmins',$data);
    }

    /* 
	 * 更新管理员信息
	 * 处理前台ajax传过来的值，再将结果返回
	 * @author dongysh
	 * @return array or false 返回查询结果或false
	 * @last update 2013/8/21
	 */
    public function updateAdmin($aid)
    {
        $action = $this->input->post('action');
        if($action=='updateAction')
        {
            $para['admin_name'] = $this->input->post('username');
            $para['operator_id']= $this->input->post('operator');
			$para['game_id'] 	= $this->input->post('game');
            if($this->admin->updateAdmin($aid,$para))
            {
                $msg['message'] = '管理员更新成功';
                $msg['status'] = true;
                $msg['linkto'] = ADMIN_PATH."/admin/listadmins";
            }
            else
            {
                $msg['message'] = '管理员更新失败';
                $msg['status'] = false;
            }
            echo json_encode($msg);
        }
        else
        {
        	$adminInfo = $this->admin->get_info_by_aid($aid);		//查出管理员信息
        	$data['adminInfo'] = $adminInfo[0];
        	$data['operatorlist'] = $this->operator->get_all();
        	if($data['adminInfo']['operator_id'] != 0) 				//若为某平台的管理员，得到平台下的所有游戏
        	{
        		$data['gamelist'] = $this->game->get_game_by_operator($data['adminInfo']['operator_id']);
        	}
        	$data['sidebar_admin'] = "active";					//选中左侧导航栏内的相关项
            $this->load->view(ADMIN_DIR.'/updateadmin',$data); 
        } 
    }

    /* 
	 * 更新管理员状态
	 * para int aid 管理员id  
	 * para int status 管理员状态 
	 * @author dongysh
	 * @last update 2013/8/22
	 */
	public function updateAdminStatus($aid)
	{	
		$status = $this->input->get('status');
		// 初始管理员 admin 不能删除
		if ($aid != 1){
			$para['status'] = $status;
			if($this->admin->updateAdmin($aid,$para))
			{
				$message = $status==1 ? '启用成功' : '删除成功';
			}
			else
			{
				$message = $status==1 ? '启用失败' : '删除失败';
			}
		}
		else
		{
			$message = $status==1 ? '启用失败' : '删除失败';
		}
		echo "<script>alert('$message');history.go(-1);</script>";
	}

    /* 
	 * 查看个人资料  并可更新
	 * 处理前台ajax传过来的值，再将结果返回
	 * @author dongysh
	 * @last update 2013/8/26
	 */
    public function info()
    {
    	$action = $this->input->post('action');
        if($action=='updateAction')
        {
        	$aid = $this->input->post('aid');
            $para['admin_name'] = $this->input->post('username');
            if($this->admin->updateAdmin($aid,$para))
            {
                $msg['message'] = '个人资料更新成功';
                $msg['status'] = true;
                $msg['linkto'] = ADMIN_PATH;
            }
            else
            {
                $msg['message'] = '个人资料更新失败';
                $msg['status'] = false;
            }
            echo json_encode($msg);
        }
        else
        {
        	$user = $this->admin->get_info_by_aid($_SESSION['admin_id']);
	    	$data['userInfo'] = $user[0];
	    	$this->load->view(ADMIN_DIR.'/userinfo',$data);
        } 
    }

    /* 
	 * 修改密码
	 * 处理前台ajax传过来的值，再将结果返回
	 * @author dongysh
	 * @last update 2013/8/26
	 */
    public function changepwd()
    {
    	$action = $this->input->post('action');
        if($action=='updatePwdAction')
        {
	        $para['admin_pass'] = md5($this->input->post('password'));
	        $aid = $_SESSION['admin_id'];
	        if($this->admin->updateAdmin($aid,$para))
	        {
	            $msg['message'] = '密码修改成功,请重新登录';
	            $msg['status'] = true;
	            $msg['linkto'] = ADMIN_PATH."/main/logout";
	        }
	        else
	        {
	            $msg['message'] = '密码修改失败';
	            $msg['status'] = false;
	        }
	        echo json_encode($msg);
	    }
	    else
	    {
	    	$this->load->view(ADMIN_DIR.'/changepwd'); 
	    }
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
     * 构造函数
     * @author Dongysh
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(ADMIN_DIR.'/admin_model','admin');
    }

    /**
     * 控制器默认首页
     * 判断登录状态，以进入不同页面
     * @author dongysh
     * @last update 2013/8/21
     *
     */
	public function index()
	{
		if(!checkAdminLogin())
        {
            $this->load->view(ADMIN_DIR.'/login');
        }
        else
        {
            $data['sidebar_index'] = "active";              //选中左侧导航栏内的相关项
            $this->load->view(ADMIN_DIR.'/index',$data);
        }
	}

	/**
     * 管理员登录，验证用户名和密码是否正确，
     * 处理前台ajax传过来的值，再将结果返回，
     * 并将管理员信息存入session  保存此次登录日志
     * @author dongysh
     * @last update 2013/8/27
     */
	public function login()
	{
		$admin_name = $this->input->post('username');
		$admin_pass = $this->input->post('password');
		$res = $this->admin->get_info_by_username($admin_name);
		if($res && $res[0]['status'] == 1)
		{
			if ($res[0]['admin_pass'] == md5($admin_pass)) 
			{
				$_SESSION['admin_id']    = $res[0]['admin_id'];
                $_SESSION['admin_name']  = $res[0]['admin_name'];
                $_SESSION['operator_id'] = $res[0]['operator_id'];
                $_SESSION['game_id']     = $res[0]['game_id'];
                $msg['message'] = '登录成功';
                $msg['status']  = true;
                $msg['linkto']  = ADMIN_PATH;
            }
            else
            {
            	$msg['message'] = '登录失败,密码错误';
				$msg['status']  = false;
            }
		}
		else
		{
			$msg['message'] = '登录失败，用户不存在或者已被禁用';
			$msg['status'] = false;
		}
        echo json_encode($msg);
	}

	/**
     * 管理员退出，退出后跳到登录页面
     * 记录退出时间
     * @author dongysh
     * @last update 2013/8/27
     */
	public function logout()
	{
        $para['last_login_time'] = date("Y-m-d H:i:s",time());  //保存退出时间
        $this->admin->updateAdmin($_SESSION['admin_id'],$para);
		session_unset();
        session_destroy();
        header("Location:".ADMIN_PATH);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operator extends CI_Controller {

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
        $this->load->model(ADMIN_DIR.'/operator_model','operator');
    }

    /**
     * 控制器默认首页
     * 跳转到运营商列表页面
     * @author dongysh
     * @last update 2013/9/18
     */
	public function index()
	{
		header("Location:".ADMIN_PATH."/operator/listoperators");
		die();
	}

	/* 
	 * 查看运营商列表
	 * @author dongysh
	 * @return array or false 返回查询结果或false
	 * @last update 2013/9/18
	 */
    public function listoperators()
    {	
		$data['operatorlist'] = $this->operator->get_list();
        $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
		$data['sidebar_game_operator'] = "active";				
		$this->load->view(ADMIN_DIR.'/listoperators',$data);
    }

    /** 
     * 添加运营商
     * 处理前台ajax传过来的值，再将结果返回
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function addoperator()
    {
        $action = $this->input->post("action");
        if($action == "addAction")
        {
            $para['operator_name'] = $this->input->post('op_name');
            $para['addtime']       = date("Y-m-d H:i:s",time());
            if($this->operator->addoperator($para))
            {
                $msg["message"] = "运营商添加成功";
                $msg["status"] = true;
            }
            else
            {
                $msg["message"] = "运营商添加失败";
                $msg["status"] = false;
            }
            echo json_encode($msg);
        }
        else
        {
            $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
            $data['sidebar_game_operator'] = "active";      
            $this->load->view(ADMIN_DIR.'/addoperator');
        }
    }

    /** 
     * 修改运营商信息
     * 处理前台ajax传过来的值，再将结果返回
     * @param int $oid 要修改的运营商id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function updateoperator($oid)
    {
        $action = $this->input->post("action");
        if($action == "updateAction")
        {
            $para['operator_name'] = $this->input->post('op_name');
            if($this->operator->updateoperator($oid, $para))
            {
                $msg["message"] = "运营商更新成功";
                $msg["status"] = true;
            }
            else
            {
                $msg["message"] = "运营商更新失败";
                $msg["status"] = false;
            }
            echo json_encode($msg);
        }
        else
        {
            $op = $this->operator->get_info_by_oid($oid);
            $data['op'] = $op[0];
            $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
            $data['sidebar_game_operator'] = "active";      
            $this->load->view(ADMIN_DIR.'/updateoperator', $data);
        }
    }

    /** 
     * 删除运营商  并提示相关信息
     * @param int $oid 要删除的运营商id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function deleteoperator($oid)
    {
        if($this->operator->deleteoperator($oid))
        {
            echo "<script>alert('运营商删除成功！');history.go(-1);</script>";
        }
        else
        {
            echo "<script>alert('运营商删除失败！');history.go(-1);</script>";
        }
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
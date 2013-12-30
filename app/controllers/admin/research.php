<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Research extends CI_Controller {

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
        $this->load->model(ADMIN_DIR.'/research_model','research');
    }

    /**
     * 控制器默认首页
     * 跳转到研发商列表页面
     * @author dongysh
     * @last update 2013/9/18
     */
	public function index()
	{
		header("Location:".ADMIN_PATH."/research/listresearchs");
		die();
	}

	/* 
	 * 查看研发商列表
	 * @author dongysh
	 * @return array or false 返回查询结果或false
	 * @last update 2013/9/18
	 */
    public function listresearchs()
    {	
		$data['researchlist'] = $this->research->get_list();
        $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
		$data['sidebar_game_research'] = "active";				
		$this->load->view(ADMIN_DIR.'/listresearchs',$data);
    }

    /** 
     * 添加研发商
     * 处理前台ajax传过来的值，再将结果返回
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function addresearch()
    {
        $action = $this->input->post("action");
        if($action == "addAction")
        {
            $para['research_name'] = $this->input->post('research');
            $para['addtime']       = date("Y-m-d H:i:s",time());
            if($this->research->addresearch($para))
            {
                $msg["message"] = "研发商添加成功";
                $msg["status"] = true;
            }
            else
            {
                $msg["message"] = "研发商添加失败";
                $msg["status"] = false;
            }
            echo json_encode($msg);
        }
        else
        {
            $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
            $data['sidebar_game_research'] = "active";      
            $this->load->view(ADMIN_DIR.'/addresearch', $data);
        }
    }

    /** 
     * 修改研发商信息
     * 处理前台ajax传过来的值，再将结果返回
     * @param int $rid 要修改的研发商id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function updateresearch($rid)
    {
        $action = $this->input->post("action");
        if($action == "updateAction")
        {
            $para['research_name'] = $this->input->post('research');
            if($this->research->updateresearch($rid, $para))
            {
                $msg["message"] = "研发商更新成功";
                $msg["status"] = true;
            }
            else
            {
                $msg["message"] = "研发商更新失败";
                $msg["status"] = false;
            }
            echo json_encode($msg);
        }
        else
        {
            $researchInfo = $this->research->get_info_by_rid($rid);
            $data['researchInfo'] = $researchInfo[0];
            $data['sidebar_game'] = "active";                //选中左侧导航栏内的相关项
            $data['sidebar_game_research'] = "active";      
            $this->load->view(ADMIN_DIR.'/updateresearch', $data);
        }
    }

    /** 
     * 删除研发商  并提示相关信息
     * @param int $oid 要删除的研发商id
     * @author Dongysh
     * @last update 2013/9/18
     */
    public function deleteresearch($oid)
    {
        if($this->research->deleteresearch($oid))
        {
            echo "<script>alert('研发商删除成功！');history.go(-1);</script>";
        }
        else
        {
            echo "<script>alert('研发商删除失败！');history.go(-1);</script>";
        }
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
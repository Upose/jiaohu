<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectDesignModel;

class ProjectDesignController extends BaseController
{

	/**
     * 输出首页
     * @author fang.yu
     * 2018.8.24
     */
	public function index()
	{
    	
    	$this->display();

    }


    /**
     * 新增需求接口
     * @author fang.yu
     * 2018.8.24
     */
	public function demandAdd()
	{	
		//需求名称
    	$name = I('name');

    	//所属页面
    	$page = I('page');

    	//需求描述
    	$summary = I('summary');

    	//需求类型
    	//1新增设计 2功能调整  3样式调整
    	$type = I('type');

    	//需求状态
    	//1紧急 2重要 3一般 4优化
    	$state = I('state');

    	//完成时间
    	$end_time = I('end_time');

    	//项目id
    	$project_id = I('project_id');

    	//提交人id 
    	$submit_person_id =$_SESSION['user_id'];

    	$res=$this->res=
        ProjectDesignModel::demandAdd(
        $name,$page,$summary,$type,
        $end_time,$state,$project_id);


        //上传图片附件,包括原型截图、参考页面
		$upload =  new \Think\Upload();// 实例化上传类

		//以图片格式上传
		//设置附件上传大小
	  	$upload->maxSize=3145728;
	  	
	  	// 设置附件上传类型
	    $upload->exts=array('jpg','gif','png','jpeg');
	    // 设置附件上传根目录
	    $upload->rootPath = './Updata/'; 
	    // 设置附件上传（子）目录
        $upload->savePath = 'DesignImage/'; 

	    $info =  $upload->upload();

	  /*file_put_contents("cc.txt",json_encode($info));

	    if($info)
	    {
			for($i = 0;$i<count($info);$i++)
			{
			$type  = $info[$i]['type'];
	    	$name  = $info[$i]['name'];
	    	$savename  = $info[$i]['savename'];
	    	$path  = "Updata/".$info[$i]['savepath'];
	    	$newpath = $path.$savename;

	    	

			}
	
	    }*/

    }


     /**
     * 需求列表接口
     * @author fang.yu
     * 2018.8.24
     */
	public function demandList()
	{	

		//项目id
    	$project_id = I('project_id');

    	//页数
		$page=intval(I('page'));
		$pag=($page-1)*10;

		//起止时间
		$time1 =I('starTime');
		$time2 = I('endTime');

		//关键词
		$keywords = I('keywords');

		$res=$this->res=
        ProjectDesignModel::demandList($project_id,
        $pag,$time1,$time2,$keywords);

        //将数组中的type、state由数字转化为文字
        for($i = 0;$i < count($res);$i++)
        {
        	$res[$i][type] = $this->getDemandTypeName($res[$i][type]);
        	$res[$i][state] = $this->getPriorityName($res[$i][state]);
        }

       $this->Response(0,$res,'');
	}


	 /**
     * 需求详情接口
     * @author fang.yu
     * 2018.8.24
     */
	public function demandDetails()
	{
		//需求单id
		$demand_id = I('demand_id');
		$demand_id = 1;
		$res=$this->res=
        ProjectDesignModel::demandDetails($demand_id);

        //print_r($res);
        $this->Response(0,$res,'');
	}





}
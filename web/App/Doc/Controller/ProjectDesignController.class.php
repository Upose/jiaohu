<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectDesignModel;
date_default_timezone_set('prc');
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

    	//完成时间
    	$end_time = I('end_time');

    	//项目id
    	$project_id = I('project_id');

    	//提交人id 
    	$submit_person_id =$_SESSION['user_id'];

        //开始时间
        $start_time = date('Y-m-d',time());

        //新增设计需求
        $Model = D('project_demand');
        $data['id'] = '';
        $data['name'] = $name;
        $data['page'] = $page;
        $data['summary'] = $summary;
        $data['type'] = $type;
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
        $data['project_id'] = $project_id;

        //demand_id      
        $result = $Model->add($data);
        $result = (int)$result;

        //每增加一次需求，相应的也得在需求处理表增加提交人
        $Model = D('demand_handle');
        $handle['id'] = '';
        $handle['demand_id'] = $result;
        $handle['is_handle'] = 1;
        $handle['handle_person_id'] = $submit_person_id;
        $handle['handle_time'] = $start_time;
        $handle['handle_state'] = 1;
        
        $handleRes = $Model->add($handle);

        //上传图片附件,包括原型截图、参考页面
		$upload =  new \Think\Upload();// 实例化上传类

		//以图片格式上传
		//设置附件上传大小
	  	$upload->maxSize=3145728;
	  	
	  	//设置附件上传类型
	    $upload->exts=array('jpg','gif','png','jpeg');
	    //设置附件上传根目录
	    $upload->rootPath = './Updata/'; 
	    //设置附件上传（子）目录
        $upload->savePath = 'DesignImage/'; 

	    $info = $upload->upload();
      
	   if($info)
	    {

			for($i = 0;$i<count($info);$i++)
			{
                if($info[$i]['key'] == "photo1")
                {
                    //1原型截图 2参考页面
                    $code = 1;
                    $name = $info[$i]['name'];
                    $savename  = $info[$i]['savename'];
                    $path  = "Updata/".$info[$i]['savepath'];
                    $newpath = $path.$savename;
                    
                    $Model = D('design_image');
                    $data['id'] = '';
                    $data['name'] = $name;
                    $data['path'] = $newpath;
                    $data['demand_id'] = $result;
                    $data['code'] = $code;
                    $res1 = $Model->add($data);
                   
       
                }

               if($info[$i]['key'] == "photo2")
                {
                   //1原型截图 2参考页面
                    $code = 2;
                    $name = $info[$i]['name'];
                    $savename  = $info[$i]['savename'];
                    $path  = "Updata/".$info[$i]['savepath'];
                    $newpath = $path.$savename;

                    $Model = D('design_image');
                    $data['id'] = '';
                    $data['name'] = $name;
                    $data['path'] = $newpath;
                    $data['demand_id'] = $result;
                    $data['code'] = $code;

                    $res2 = $Model->add($data);
                   
                }


			}

	    }

        $this->redirect('ProjectDescription/pro_design',
        array('id'=>$project_id));

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
        

        $adress=$this->res=
        ProjectDesignModel::getAddress($project_id);
        
        $res['prototype_address'] = 
        $adress[0]['prototype_address'];

        $res['design_address'] = 
        $adress[0]['design_address'];
        
       $this->ajaxReturn($res);
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
		
		$res=$this->res=
        ProjectDesignModel::demandDetails($demand_id);
       
       $this->ajaxReturn($res);
	}


     /**
     * 需求处理接口
     * @author fang.yu
     * 2018.8.24
     */
    public function demandHandle()
    {
        //需求单id
        $demand_id = I('demand_id');
       
        //处理类型 1开始处理 2处理完成 3暂不处理 4确认完成
        $code = I('code');
        
        if($code == 1)
        {
            //开始处理的状态码
            $handle_state = 1;

            //将是否处理由未处理转变为正在处理
            $is_handle =2;

            $res=$this->res=
            ProjectDesignModel::demandHandle($demand_id,
            $handle_state,$is_handle);
        }

        if($code == 2)
        {
            //处理完成的状态码
            $handle_state = 3;

            //将是否处理由未处理转变为正在处理
            $is_handle =2;

            $res=$this->res=
            ProjectDesignModel::demandHandle($demand_id,
            $handle_state,$is_handle);
        }

        if($code == 3)
        {
           //暂不处理的状态码
            $handle_state = 5;

            //将是否处理仍然为未处理
            $is_handle =1;

            $res=$this->res=
            ProjectDesignModel::demandHandle($demand_id,
            $handle_state,$is_handle);
        }

        if($code == 4)
        {
            //暂不处理的状态码
            $handle_state = 4;

            //将是否处理转变为处理完成
            $is_handle =3;

            $res=$this->res=
            ProjectDesignModel::demandHandle($demand_id,
            $handle_state,$is_handle);
        }

        $res = 1;
        $this->ajaxReturn($res);
  
    }

     /**
     * 修改原型地址、设计稿地址接口
     * @author fang.yu
     * 2018.8.24
     */
    public function updateAddress()
    { 
        //项目id
        $project_id = I('project_id');
        
        //原型地址
        $prototype_address = I('prototype_address');
       
        //设计稿地址
        $design_address = I('design_address');
        

        $res=$this->res=
        ProjectDesignModel::updateAddress($project_id,
        $prototype_address,$design_address); 

         $this->redirect('ProjectDescription/pro_design',
            array('id'=>$project_id));   

    }





}
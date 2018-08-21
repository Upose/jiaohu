<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectOrganizationModel;

class ProjectOrganizationController extends BaseController{


	/**
     *输出首页
     *@author fang.yu
     *2018.8.16
     */
    public function index()
    {
      
    	$this->display();
    	
    }

   

    /**
	 *新增项目成员接口
	 *@author fang.yu
	 *2018.8.16
	 */
    public function memberAdd()
    {
    	
    	//项目id
    	$project_id = I($project_id);
      
    	//类型 内部0 外部1
    	$type = I($type);
		
    	if($type == 0)
    	{
    		//内部人id
    		$person_id = (int)I('person_id');
         
    		//所属标签 内部干系人1 开发团队3
    		$label = I('label');
    		
    		//人员信息
	    	$InPersonInfo = $this->res=
	    	ProjectOrganizationModel::getInPersonInfo($person_id);

	    	//名字
	    	$name  = $InPersonInfo[0]['name'];
	    	//电话号码
	    	$phone = $InPersonInfo[0]['phone'];
	    	//职位
	    	$position = $InPersonInfo[0]['position'];
	    	//部门
	    	$department = $InPersonInfo[0]['department'];
	    	//内部人员公司所属默认为空
	    	$company = "";

	    	$res = $this->res=
	    	ProjectOrganizationModel::memberAdd($name,$project_id,
	    	$type,$label,$phone,$position,$department,$company);


    	}

    	if($type == 1)
    	{
    		//所属标签 外部干系人2 开发团队3
    		$label = I('label');
    		//名字
    		$name = I('name');
    		//电话号码
    		$phone = I('phone');
    		//职位
    		$position = I('position');
    		//体系
	    	$department = I('department');
	    	//所属公司
	    	$company = I('company');

	    	$res = $this->res=
	    	ProjectOrganizationModel::memberAdd($name,$project_id,
	    	$type,$label,$phone,$position,$department,$company);
 	
    	}


    }


    /**
     *当前项目成员列表接口
     *@author fang.yu
     *2018.8.20
     */
    public function currentMemberList()
    {
        //所属项目id
        $project_id = I('project_id');
    
        $list = $this->list=
        ProjectOrganizationModel::currentMemberList($project_id);
        
        $this->Response(0,$list,'');
    }


    /**
     *历史项目成员列表接口
     *@author fang.yu
     *2018.8.20
     */
    public function historyMemberList()
    {
        //所属项目id
        $project_id = I('project_id');

        $list = $this->list=
        ProjectOrganizationModel::historyMemberList($project_id);

        $this->Response(0,$list,'');
    }

    /**
     *项目成员离场接口
     *@author fang.yu
     *2018.8.20
     */
    public function memberLeave()
    {

        $id = I('id');

        $res = $this->res=
       ProjectOrganizationModel::memberLeave($id);

    }

    /**
     *项目成员入场接口
     *@author fang.yu
     *2018.8.20
     */
    public function memberEnter()
    {

        $id = I('id');

        $res = $this->res=
        ProjectOrganizationModel::memberEnter($id);

    }

     /**
     *历史列表接口
     *@author fang.yu
     *2018.8.20
     */
    public function history()
    {
        //成员名字
        $name = I('name');
        //项目id
        $project_id =I('project_id');

        $res = $this->res=
        ProjectOrganizationModel::history($name,$project_id);

        $this->Response(0,$res,'');

    }



}
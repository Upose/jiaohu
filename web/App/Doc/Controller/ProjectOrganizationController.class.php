<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectOrganizationModel;

/**
*项目组织控制器
*@author fang.yu
*2018.8.16
*/
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
    	$project_id = I('pd_id');
        
    	//类型 内部0 外部1
    	$type = I('type');
		
    	if($type == 0)
    	{
            //内部人姓名
            $name = I('inname');

    		//内部人id
            $person_id = $this->res=
            ProjectOrganizationModel::
            getId($name);
            
            //职位id
            $position = I('position');

    		//所属标签 内部干系人1 开发团队3
    		$label = I('label');
    	     
	    	$res = $this->res=
	    	ProjectOrganizationModel::
            InmemberAdd($name,$project_id,
            $type,$person_id,$position,$label);

    	}

    	if($type == 1)
    	{
    		//所属标签 外部干系人2 开发团队3
    		$label = I('label');
    		//名字
    		$name = I('name');
    		//电话号码
    		$phone = I('phone');
    		//职位id
    		$position = I('position');

	    	//所属公司
	    	$company = I('company');

	    	$res = $this->res=
	    	ProjectOrganizationModel::
            OutmemberAdd($name,$project_id,
	    	$type,$label,$phone,$position,
            $company);

            // $this->redirect('ProjectDescription/pro_organization',array('id'=>1));
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
        ProjectOrganizationModel::
        currentMemberList($project_id);
        
        //新增中项目角色下拉框
        $projectRole = $this->res=
        ProjectOrganizationModel::projectRole();
        
        $response = array('data' => $list,
            'projectRole' =>$projectRole);

        $this->ajaxReturn($response);
        
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
        ProjectOrganizationModel::
        historyMemberList($project_id);
       
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

       $this->ajaxReturn(1);
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

    /**
     *新增成员中模糊搜索人名接口
     *@author fang.yu
     *2018.8.20
     */
    public function nameSearch()
    {
        $keywords = I('keywords');

        $res = $this->res=
        ProjectOrganizationModel::
        nameSearch($keywords);
        
        $this->Response(0,$res,'');
    }



// ===========================================================================================



    /**
     *下拉列表
     *@author songcx
     *2018.12.29
     */
    public function dropSelect()
    {

        //以下是所有下拉框列表
        //岗位职责 - 页面下拉项内容
        $jobType=$this->jobtype=
        ProjectOrganizationModel::jobType();

        //部门 - 页面下拉项内容
        $depatMent=$this->depatMent=
        ProjectOrganizationModel::depatMent();

        //JS框架 - 页面下拉项内容
        $allMember=$this->allMember=
        ProjectOrganizationModel::allMember();

        // //后台框架 - 页面下拉项内容
        // $backFrame=$this->backFrame=
        // ProjectOrganizationModel::backFrame();

        // //数据库框架 - 页面下拉项内容
        // $databaseFrame=$this->databaseFrame=
        // ProjectOrganizationModel::databaseFrame();

        $final['jobType'] = $jobType;
        $final['depatMent'] = $depatMent;
        $final['allMember'] = $allMember;

        $this->Response(200,$final,'');

    }


    /**
     *新增成员
     *@author songcx
     *2018.12.29
     */
    public function proPersionAdd()
    {

        // 成员id
        $user_code = I('uCode');
        // 成员姓名
        $member_name = I('mName');
        // 项目编号
        $pro_code = I('pCode');
        // 职位
        $duty = I('duty');
        // 部门
        $dept = I('dept');
        // 到岗时间
        $come_time = I('cTime');
        // 离岗时间
        $leave_time = I('lTime');
        // 操作类型
        $operation_type = I('oType');
        // 备注
        $remarks = I('remarks');
        // 备注
        $founder_id = I('founder_id');

        $res = $this->res=
        ProjectOrganizationModel::proPersionAdd($user_code,$member_name,$pro_code,$duty,$come_time,$leave_time,$operation_type,$remarks,$founder_id);
        
        $this->Response(0,$res,'');
    }



}
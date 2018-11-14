<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectRegistrationModel;

/**
*项目管理控制器
*@author song.chaoxu
*2018.11.14
*/
class ProjectRegistrationController extends BaseController {

	/**
     * 输出首页
     * @author song.chaoxu
     * 2018.11.14
     */
    public function index()
    {

    	$this->display();
    	
    }

	/**
	 * 现有项目列表接口
	 * @author song.chaoxu
	 * 2018.11.14
	 */
    public function projectRecord()
    {

    	//区域
    	// $area_id = I('area_id');
      
    	//状态
	 	// $status_id = I('status_id');
       
	 	//关键词
	 	// $kw = I('keywords');

	 	
	 	//项目列表
    	// $res=$this->res=
    	// ProjectManagementModel::projectList($area_id,
    	// 	$status_id,$kw);

        
        
	 	//以下是所有下拉框列表
    	//所有区域
    	$areaRes=$this->area=
    	ProjectRegistrationModel::areaList($province_id);
    	

        //所有行业
        $industryResult=$this->projectindustry=
        ProjectRegistrationModel::projectIndustryList();

        //项目密级别
        $rank=$this->rank=
        ProjectRegistrationModel::projectRankList();


  
    	$temp = array();

    	$final['area'] = $areaRes;
        $final['industryResult'] = $industryResult;
        $final['rank'] = $rank;
    	
      	$this->Response(0,$final,'');

    }


    /**
	 * 添加项目接口
	 * @author fang.yu
	 * 2018.8.15
	 */
    public function projectAdd()
    {

		//项目名称
    	$name = I('name');

    	//行业分类id
    	$industry_id = I('industry_id');

    	//客户类型
    	$customer_type_id = I('customer_type_id');

    	//项目类型id
    	$project_type_id = I('project_type_id');

    	//所在区域id
    	$area_id = I('area_id');

        //项目负责人
        $charge = I('charge');

    	//所在地址
    	$address = I('address');

    	//经度
    	$longitude = I('longitude');

    	//纬度
    	$latitude = I('latitude');

    	//开始时间
		$start_time = I('start_time');


		$res=$this->res=
    	ProjectManagementModel::projectAdd($name,
    	$project_type_id,$industry_id,
        $customer_type_id,$area_id,$charge,
    	$address,$longitude,$latitude,$start_time);

        $this->redirect('ProjectManagement/Manage');
    	
    }



}
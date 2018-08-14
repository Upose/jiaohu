<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectManagementModel;

class ProjectManagementController extends BaseController {

	//输出首页
    public function index()
    {

    	$this->display();
    	
    }

	/**
	 * 现有项目列表接口
	 * @author fang.yu
	 * 2018.8.14
	 */
    public function projectList()
    {

    	//区域
    	$area_id = I('area_id');
      
    	//状态
	 	$status_id = I('status_id');
       
	 	//关键词
	 	$kw = I('keywords');

	 	
	 	//项目列表
    	$res=$this->res=
    	ProjectManagementModel::projectList($area_id,
    		$status_id,$kw);

        
        
	 	//以下是所有下拉框列表
    	//所有区域
    	$areaRes=$this->area=
    	ProjectManagementModel::areaList($province_id);
    	

		//所有状态
    	$statusRes=$this->status=
    	ProjectManagementModel::statusList();

    	//所有行业
    	$industryRes=$this->industry=
    	ProjectManagementModel::industryList();

    	//所有客户类型
    	$customerRes=$this->customer=
    	ProjectManagementModel::customerList();

    	$temp = array();

    	foreach ($res as $v) 
    	{

			if(!is_array($temp[$v['pid']])){
				$temp[$v['pid']]['id'] = (int)$v['pid'];
				$temp[$v['pid']]['name'] = $v['pname'];
				$temp[$v['pid']]['child'] = array();
			}

				$child['id'] = (int)$v['cid'];
				$child['name'] = $v['cname'];
				$child['area'] = $v['area'];
				$child['industry'] = $v['pname'];
				$child['charge'] = $v['charge'];
				$child['member_num'] = $v['member_num'];
				$child['start_time'] = $v['start_time'];
				
				if($v['status'] == "完成验收")
				{
					
					$child['end_time'] = $v['end_time'];
				}
				else
				{
					$child['end_time'] = "今";
				}
				$child['status'] = $v['status'];
				$child['rate'] = $v['rate'];

				array_push($temp[$v['pid']]['child'], $child);

		}
    	
    	$final['area'] = $areaRes;
    	$final['status'] = $statusRes;
    	$final['industry'] = $industryRes;
    	$final['customer'] = $customerRes;
    	$final['list'] = $temp;
    	
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
    	$project_type_id,
    	$industry_id,
    	$customer_type_id,$area_id,
    	$address,$longitude,$latitude,$start_time);
    	
    }


 	/**
	 * 项目新增省市联动接口
	 * @author fang.yu
	 * 2018.8.14
	 */
    public function getCity()
    {
     	//省id
	 	$province_id = I('province_id');

	 	$city=$this->city=
    	ProjectManagementModel::getCity($province_id);

    	$this->Response(0,$city,'');

    }


}
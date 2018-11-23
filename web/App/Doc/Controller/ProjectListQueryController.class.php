<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectListQueryModel;

/**
*项目管理控制器
*@author song.chaoxu
*2018.11.14
*/
class ProjectListQueryController extends BaseController {

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
	 * 项目登记
	 * @author song.chaoxu
	 * 2018.11.14
	 */
    public function projectArea()
    {
        
	 	//以下是所有下拉框列表
    	//所有区域 - 页面下拉项内容
    	$areaRes=$this->area=
    	ProjectRegistrationModel::areaList($province_id);

        
    	$temp = array();

    	$final['area'] = $areaRes;

      	$this->Response(200,$final,'');

    }


    /**
     * 项目查询
     * @author song.chaoxu
     * 2018.11.21
     */
    public function projectList()
    {

        //区域
        $proArea = I('proArea',"");
      
        //名称
        $proName = I('proName',"");
       
        //页数
        $page=intval(I('page',1));

        //每页显示条数
        $limit=intval(I('limit',10));

        $pag=($page-1)*$limit;


        echo "$proArea:".$proArea ."——————1——————$proName".$proName;

        //项目列表
        $projectList=$this->projectList=
        ProjectRegistrationModel::projectList($proArea,$proName,$pag,$limit);

        $this->ajaxReturn($projectList);
        // $this->Response(200,$projectList,'');
        

    }



}
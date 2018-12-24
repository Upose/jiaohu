<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectCommonModel;

/**
* 公用接口
*@author song.chaoxu         第12-24版
*2018.12.24
*/
class  ProjectCommonController extends BaseController {

	/**
     * @author song.chaoxu
     * 2018.12.24
     */
    public function index()
    {

    	$this->display();
    	
    }


    /**
     * 查询项目列表 
     * @author song.chaoxu
     * 2018.12.24
     */
    public function projectList()
    {

        //获取此人ID 查询此人负责的项目列表
        $pMId = I('pMId');

        $projectList=$this->projectList=
        ProjectCommonModel::projectList($pMId);

        $this->Response(200,$projectList,'');

    }

    /**
     * 行业列表 
     * @author song.chaoxu
     * 2018.12.24
     */
    public function inIndustry()
    {

        //获取此人ID 查询此人负责的项目列表
        $inIndustryList=$this->inIndustry=
        ProjectCommonModel::inIndustry();

        $this->Response(200,$inIndustryList,'');

    }

    /**
     * 部门列表 
     * @author song.chaoxu
     * 2018.12.24
     */
    public function inDepartment()
    {

        //获取此人ID 查询此人负责的项目列表
        $inDepartmentList=$this->inDepartment=
        ProjectCommonModel::inDepartment();

        $this->Response(200,$inDepartmentList,'');

    }


    /**
     * 区域列表 
     * @author song.chaoxu
     * 2018.12.24
     */
    public function areaList()
    {

        $areaList=$this->areaList=
        ProjectCommonModel::areaList();

        $this->Response(200,$areaList,'');

    }


    /**
     * 项目经理列表 
     * @author song.chaoxu
     * 2018.12.24
     */

    public function pManagerList()
    {

        $pManagerList=$this->pManagerList=
        ProjectCommonModel::pManagerList();

        $this->Response(200,$pManagerList,'');

    }




}
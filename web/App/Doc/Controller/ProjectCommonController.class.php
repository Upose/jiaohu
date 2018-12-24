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
        $projectManagerId = I('projectManagerId');

        $projectList=$this->projectList=
        ProjectCommonModel::projectList($projectManagerId);

        // //以下是所有下拉框列表
        // //所有区域 - 页面下拉项内容
        // $areaRes=$this->area=
        // ProjectDeliveryModel::areaList();

        // //UI框架 - 页面下拉项内容
        // $uiFrame=$this->uiFrame=
        // ProjectDeliveryModel::uiFrame();

        // //JS框架 - 页面下拉项内容
        // $jsFrame=$this->jsFrame=
        // ProjectDeliveryModel::jsFrame();

        // //后台框架 - 页面下拉项内容
        // $backFrame=$this->backFrame=
        // ProjectDeliveryModel::backFrame();

        // //数据库框架 - 页面下拉项内容
        // $databaseFrame=$this->databaseFrame=
        // ProjectDeliveryModel::databaseFrame();

        $final['projectList'] = $projectList;
        // $final['area'] = $areaRes;
        // $final['uiFrame'] = $uiFrame;
        // $final['jsFrame'] = $jsFrame;
        // $final['backFrame'] = $backFrame;
        // $final['databaseFrame'] = $databaseFrame;
        
        $this->Response(200,$final,'');

    }





}
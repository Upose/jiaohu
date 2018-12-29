<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectCollectionStateModel;

/**
*采集状态
*@author song.chaoxu
*2018.12.19
*/
class  ProjectCollectionStateController extends BaseController {

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
     * 实施交付
     *
     * @author song.chaoxu
     * 2018.11.14
     * mender Jankin Hou
     * 2018-12-26
     * URL：http://localhost/index.php?s=/Doc/ProjectCollectionState/projectList.html
     * parameter  projectManagerId : 用户ID
     */
    public function projectList()
    {

        //获取此人ID 查询此人负责的项目列表
        $projectManagerId = I('projectManagerId');
		$projectManagerId = 875;
        $projectList=$this->projectList=
        ProjectCollectionStateModel::projectList($projectManagerId);
	    var_dump($projectList);die();
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
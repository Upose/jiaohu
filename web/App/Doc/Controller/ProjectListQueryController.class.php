<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectListQueryModel;

/**
*项目计划控制器
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
     * 项目查询
     * @author song.chaoxu
     * 2018.12.27
     */
    public function pList()
    {

        //区域
        // $proArea = I('proArea','');
      
        //名称
        $proName = I('proName','');
       
        //页数
        $page=intval(I('page',1));

        //每页显示条数
        $limit=intval(I('limit',10));

        $pag=($page-1)*$limit;

        //项目列表
        $projectList=$this->projectList=
        ProjectListQueryModel::pList($proName,$pag,$limit);

        $this->Response(200,$projectList,'');

    }

    /**
     * 项目详细查询
     * @author song.chaoxu
     * 2018.12.27
     */
    public function pListMsg()
    {
      
        //名称
        $proCode = I('proCode','');

        //项目详细列表
        $projectMsgList=$this->projectList=
        ProjectListQueryModel::pListMsg($proCode);

        $this->Response(200,$projectMsgList,'');

    }


    /**
     * 删除项目
     * @author song.chaoxu
     * 2018.12.27
     */
    public function deleteProject()
    {
      
        //根据项目编号 删除项目
        $pCode = I('pCode','');

        //定义执行状态码
        $status = 0;
       
        //定义执行信息
        $msg = "";

        //删除结果
        $dProjectResult=$this->dProjectResult=
        ProjectListQueryModel::dProject($pCode);

        if ($dProjectResult = 1) {
            $status= 200;
            $msg = "项目编号".$pCode."：删除成功!";
        }else if($dProjectResult = 0){
            $status= 200;
            $msg = "无删除记录";
        }else{
            $status= 500;
           $msg = "SQL错误：请检查SQL";

        }
        $this->Response($status,$dProjectResult,$msg);

    }



}
<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectPlanModel;

class ProjectPlanController extends BaseController
{

	public function index()
	{
    	
    	$this->display();

    }


    /**
	 * 项目阶段新增接口
	 * @author fang.yu
	 * 2018.8.20
	 */
    public function projectStageAdd()
    {
        //阶段名称
        $name = I('name');
        //开始时间
        $start_time =I('start_time');
        //结束时间
        $end_time = I('end_time');
        //项目id
        $project_id = I('project_id');


    	$res=$this->res=
    	ProjectPlanModel::projectStageAdd($name,
			$start_time,$end_time,$project_id);


    }

    /**
     * 项目阶段查询接口
     * @author fang.yu
     * 2018.8.20
     */
    public function projectStageSelect()
    {
        //项目id
        $project_id = I('project_id');
       
        $res=$this->res=
        ProjectPlanModel::projectStageSelect($project_id);

        $this->Response(0,$res,'');

    }

    /**
     * 项目目标新增接口
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetAdd()
    {

        //目标名称
        $name = I('name');
        //开始时间
        $start_time =I('start_time');
        //结束时间
        $end_time = I('end_time');
        //阶段id
        $ps_id = I('ps_id');
        //项目id
        $project_id = I('project_id');

/*
         //阶段名称
        $name = "完成开发任务3";
        //开始时间
        $start_time ="2018-07-27";
        //结束时间
        $end_time = "2018-08-27";
        //阶段id
        $ps_id = 3;
        //项目id
        $project_id = 1;
*/
        $res=$this->res=
        ProjectPlanModel::projectTargetAdd(
        $name,$start_time,$end_time,$ps_id,
        $project_id);

    

    }




}
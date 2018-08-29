<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectPlanModel;

class ProjectPlanController extends BaseController
{
    
    /**
     * 输出首页
     * @author fang.yu
     * 2018.8.20
     */
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

        $res=$this->res=
        ProjectPlanModel::projectTargetAdd(
        $name,$start_time,$end_time,$ps_id,
        $project_id);

    }

    /**
     * 项目规划列表接口
     * @author fang.yu
     * 2018.8.22
     */
    public function planList()
    {

        $res=$this->res=
        ProjectPlanModel::planList();

        $temp = array();

        foreach ($res as $v) 
        {
            if(!is_array($temp[$v['pid']]))
            {
                $temp[$v['pid']]['id'] = $v['pid'];
                $temp[$v['pid']]['name'] = $v['pname'];
                $temp[$v['pid']]['pstart_time'] = $v['pstart_time'];
                $temp[$v['pid']]['pend_time'] = $v['pend_time'];
                $temp[$v['pid']]['child'] = array();
            }

            $child['id'] = $v['cid'];
            $child['name'] = $v['cname'];
            $child['cstart_time'] = $v['cstart_time'];
            array_push($temp[$v['pid']]['child'], $child);
        }

        
        $this->Response(0,$temp,'');
    }


    /**
     * 当前状态接口
     * 当前所属阶段、当前目标
     * @author fang.yu
     * 2018.8.24
     */
    public function curryState()
    {

        

        //项目id
        $project_id = I('project_id');
      
        $res=$this->res=
        ProjectPlanModel::curryState($project_id);

        var_dump($res);
    }







}
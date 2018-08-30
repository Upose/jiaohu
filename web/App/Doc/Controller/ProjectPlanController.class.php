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
     * 项目目标详情接口
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetDetalis()
    {
        //目标id
        $id = I('id');
        
        $res=$this->res=
        ProjectPlanModel::
        projectTargetDetalis($id);

        $final['name'] = $res[0]['name'];
        $final['describe'] = $res[0]['describe'];
        $final['achievements'] = $res[0]['achievements'];
        $final['estimate_time'] = $res[0]['estimate_time'];
        $final['actual_end_time'] = $res[0]['actual_end_time'];
        $final['state'] = $res[0]['state'];
        $final['id'] = $res[0]['id'];
        if($final['state'] == "完成")
        {
            $code = 1;
        }

        if($final['state'] == "进行中")
        {
            $code = 0;
        }

        $final['code'] = $code;
    
        $this->Response(0,$final,'');
    }


    /**
     * 项目目标修改接口
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetUpdate()
    {
        //目标id
        $id = I('id');

        //描述
        $describe = I('describe');

        //成果
        $achievements = I('achievements');

        $res=$this->res=
        ProjectPlanModel::
        projectTargetUpdate($id,$describe,
                            $achievements);

      
    }

    /**
     * 项目目标完成接口
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetFinish()
    {
        //目标id
        $id = I('id');
       
        $res=$this->res=
        ProjectPlanModel::
        projectTargetFinish($id);
 
    }

    /**
     * 项目规划列表接口
     * @author fang.yu
     * 2018.8.22
     */
    public function planList()
    {

        //项目id
        $project_id = I('project_id');
        $project_id  =1;

        //当前状态
        $curryState=$this->res=
        ProjectPlanModel::
        curryState($project_id);

        //新增目标阶段下拉框
        $stageSelect=$this->res=
        ProjectPlanModel::
        projectStageSelect($project_id);


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

        $response = array('data' => $temp,
        'curryState' =>$curryState,
        'stageSelect' => $stageSelect);
       
        $this->ajaxReturn($response);
    }


}
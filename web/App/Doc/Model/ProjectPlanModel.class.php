<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectPlanModel{



    /**
     * 项目阶段新增
     * @author fang.yu
     * 2018.8.20
     */
	public function projectStageAdd($name,
        $start_time,$end_time,$project_id)
    {


    	$sql = "insert into project_stage
    	  		(name,start_time,
                end_time,project_id) 
    	  		values 
    	 		('$name','$start_time',
    	 		'$end_time',$project_id)";

    	$res = M()->execute($sql);

        return  $res;
    	
    }

    /**
     * 项目阶段查询
     * @author fang.yu
     * 2018.8.20
     */
    public function projectStageSelect($project_id)
    {
        $sql = "SELECT id as ps_id,name 
                FROM project_stage 
                where project_id = 
                $project_id";

        $res = M()->query($sql);

        return  $res;

    }


    /**
     * 项目目标新增
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetAdd($name,
    $start_time,$end_time,$ps_id,$project_id)
    {

        $sql = "insert into project_target
                (name,start_time,end_time,
                ps_id,project_id) 
                values 
                ('$name','$start_time',
                '$end_time',$ps_id,
                $project_id)";

        $res = M()->execute($sql);

        return  $res;
      

    }
}
<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 
date_default_timezone_set('prc');
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

    /**
     * 项目规划列表
     * @author fang.yu
     * 2018.8.22
     */
    public function planList()
    {
        
        $sql = "SELECT ps.id as pid,
                ps.name as pname,
                ps.start_time as pstart_time,
                ps.end_time as pend_time,
                pt.id as cid,
                pt.name as cname,
                pt.start_time as cstart_time
                from project_stage ps
                join project_target pt 
                on ps.id = pt.ps_id 
                ORDER BY pt.start_time ";

        $res = M()->query($sql);

        return $res;

    }


    /**
     * 当前所属阶段、当前目标
     * @author fang.yu
     * 2018.8.24
     */
    public function curryState($project_id)
    {

        //根据当前时间查找
        $currytime = date('Y-m-d',time());

        $sql1 = "SELECT NAME 
                FROM
                project_stage
                WHERE
                STR_TO_DATE(start_time,'%Y-%m-%d') 
                < STR_TO_DATE('$currytime','%Y-%m-%d') 
                AND STR_TO_DATE(end_time,'%Y-%m-%d') 
                > STR_TO_DATE('$currytime','%Y-%m-%d') 
                AND project_id = $project_id";

        $stage = M()->query($sql1);

        $sql2 = "SELECT NAME 
                FROM
                project_target 
                WHERE
                STR_TO_DATE(start_time,'%Y-%m-%d') 
                < STR_TO_DATE('$currytime','%Y-%m-%d') 
                AND STR_TO_DATE(end_time,'%Y-%m-%d') 
                > STR_TO_DATE('$currytime','%Y-%m-%d') 
                AND project_id = $project_id";

        $target = M()->query($sql2);

        $res['stage'] = $stage[0]['name'];
        $res['target'] = $target[0]['name'];

        return $res;


    }


     /**
     * 项目目标详情
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetDetalis($id)
    {
        $sql = "SELECT id,name,`describe`,
        achievements,
        end_time as estimate_time,
        actual_end_time,state  
        FROM project_target 
        where id = $id";

        $res = M()->query($sql);

        return $res;

    }


    /**
     * 项目目标修改
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetUpdate($id,$describe,
                                        $achievements)
    {
        $sql = "UPDATE project_target 
        set `describe` = '$describe',
        achievements = '$achievements' 
        where id = $id";

        $res = M()->execute($sql);

        return  $res;
    }


      /**
     * 项目目标完成
     * @author fang.yu
     * 2018.8.20
     */
    public function projectTargetFinish($id)
    {
        $Currytime = date('Y-m-d',time());

        $sql = "UPDATE project_target 
        set `state` = '完成',
        actual_end_time = '$Currytime' 
        where id = $id";

        $res = M()->execute($sql);

        return  $res;
  
    }


}
<?php
namespace Doc\Model;
date_default_timezone_set('prc');
mysql_query("SET NAMES UTF8"); 

class ProjectWeeklyModel
{

	/**
     *新增周报的项目阶段下拉框
     *@author fang.yu
     *2018.8.28
     */
    public function projectStage($project_id)
    {

    	$sql = "SELECT id,name 
		    	from project_stage 
		    	where project_id 
		    	= $project_id";

    	 $res = M()->query($sql);

        return  $res;

    }


    /**
     *新增周报接口
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyAdd($project_id,$name,$type,
    $last_week_content,$this_week_plan,$percentage,
    $project_explain,$start_time,$end_time,$week_num,$stage_id)
    {

        //提交时间
        $submit_time = date('Y-m-d',time());

        //提交人id
        $submit_person_id =$_SESSION['user_id'];

        $sql = "insert into project_weekly
                (id,project_id,name,type,
                last_week_content,this_week_plan,
                percentage,project_explain,
                start_time,end_time,week_num,
                submit_person_id,submit_time,stage_id) 
                values 
                ('',$project_id,'$name',$type,
                '$last_week_content',
                '$this_week_plan','$percentage',
                '$project_explain','$start_time',
                '$end_time',$week_num,
                $submit_person_id,'$submit_time','$stage_id')";

        $res = M()->execute($sql);

       if($res){
             return 0;
        }else{
             return 1;
        }   

    }

    /**
     *项目周报列表
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyList($project_id,$week_num,$pag)
    {

        $sql = "SELECT pw.id,pw.week_num as week,
                pw.start_time,pw.end_time,
                pw.percentage,ps.name as stage,pw.type,
                (SELECT count(*) 
                from project_weekly 
                WHERE week_num = $week_num
                and project_id = $project_id
                GROUP BY week_num ) as weeknum 
                from project_weekly pw
                join project_stage ps
                on pw.stage_id = ps.id 
                where pw.project_id = 
                $project_id  limit ".$pag.",10 ";

        $res = M()->query($sql);

        return  $res;

    }

     /**
     *个人周报是否上传
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyPersonIsExist($project_id)
    {
        $sql = "SELECT submit_person_id 
                from project_weekly 
                where project_id = 
                $project_id and type = 2";

        $res = M()->query($sql);

        return  $res;
    }


    /**
     *项目成员
     *@author fang.yu
     *2018.8.28
     */
    public function projectMember($project_id,$id)
    {

        $sql="SELECT
                a. NAME,a.id
            FROM
                project_member AS a
            LEFT JOIN project_role AS b ON a.position = b.id
            WHERE
                a.project_id = project_id
            and  b.id!='1'";
        $res = M()->query($sql);   
        $usql="SELECT
                    a.*, b. NAME AS personname,c.name as stagename
                FROM
                    project_weekly AS a
                LEFT JOIN project_member AS b ON a.submit_person_id = b.person_id
                left join project_stage as c on a.stage_id=c.id
                WHERE
                    a.id = '$id'
                AND a.project_id = $project_id";

        $ures = M()->query($usql);

        
       
        
        $result['res']=$res;
        $result['ures']=$ures;
        return  $result;
    }

    public function personReport($id){
        $sql="SELECT
                *
            FROM
                project_member AS a
            LEFT JOIN project_weekly AS b ON a.person_id = b.submit_person_id
            where b.type=2
            and a.id='$id'";
        $res = M()->query($sql); 
        return  $res;  
    }
    public function showid($user_id)
    {

        $sql = "SELECT
                a. NAME
            FROM
                project_role AS a
            LEFT JOIN project_member AS b ON a.id = b.position
            WHERE
                b.person_id = '$user_id'";

        $res = M()->query($sql);
        
        return  $res;
    }
   

}
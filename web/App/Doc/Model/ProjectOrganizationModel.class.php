<?php
namespace Doc\Model;
date_default_timezone_set('prc');
mysql_query("SET NAMES UTF8"); 

class ProjectOrganizationModel
{

    /**
     *新增内部项目成员
     *@author fang.yu
     *2018.8.16
     */
    public function InmemberAdd($name,$project_id,
                $type,$person_id,$position,$label)
    {
        //开始时间为当前时间
        $start_time =  date('Y-m-d',time());

        //必须将结束时间设置为空字符串
        $sql="INSERT INTO project_member 
            (name,project_id,type, 
            person_id,label,position,
            start_time,end_time)
            VALUES
            ('$name',$project_id, $type,
            $person_id,$label,$position,
            '$start_time','')";

        $res = M()->execute($sql);

        return $res;
    }

    /**
	 *新增外部项目成员
	 *@author fang.yu
	 *2018.8.16
	 */
	public function OutmemberAdd($name,$project_id,$type,
                    $label,$phone,$position,$company)
    {

        //开始时间为当前时间
        $start_time =  date('Y-m-d',time());

        //必须将结束时间设置为空字符串
     	$sql="insert into project_member
        	  (name,project_id,type,
              label,phone,position,
              company,
              start_time,end_time) 
        	  values 
        	  ('$name','$project_id',
              '$type','$label',
              '$phone',$position,
              '$company',
              '$start_time','')";

        $res = M()->execute($sql);

       	return $res;

    }


    /**
     *当前项目成员列表
     *@author fang.yu
     *2018.8.20
     */
    public function currentMemberList($project_id)
    {
        //内部干系人
        $insql = "SELECT pm.id,pm.name,
                p.position,p.phone,
                pm.start_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 1 
                and ISNULL( pm.end_time)";

        $inMember = M()->query($insql);


         for($i = 0;$i<count($inMember);$i++)
        {
          $inMember[$i]['is_history'] = "0";
          if(is_null($inMember[$i]['end_time']))
          {
             $inMember[$i]['end_time'] = '今';
          }
         
        }
        
        //外部干系人
        $outsql = "SELECT pm.id,pm.name,
                pr.name as position,
                pm.start_time,
                pm.phone,pm.company
                from project_member pm
                join project_role pr 
                on pm.position = pr.id
                where project_id = 
                $project_id
                and label = 2 
                and ISNULL( pm.end_time)";

        $outMember = M()->query($outsql);

        for($i = 0;$i<count($outMember);$i++)
        {

          $outMember[$i]['is_history'] = "1";
          if(is_null($outMember[$i]['end_time']))
          {
             $outMember[$i]['end_time'] = '今';
          }
        }

        //开发团队
        $dsql = "SELECT pm.id,pm.name,
                p.position,
                p.phone,pm.start_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 3 
                and ISNULL( pm.end_time)";

        $developers = M()->query($dsql);

         for($i = 0;$i<count($developers);$i++)
        {
         $developers[$i]['is_history'] = "1";
          if(is_null($developers[$i]['end_time']))
          {
             $developers[$i]['end_time'] = '今';
          }
        }
        
        
        $list = array();

        $list['inMember'] = $inMember;
        $list['outMember'] = $outMember;
        $list['developers'] = $developers;

        return $list;

    }

    /**
     *历史项目成员列表
     *@author fang.yu
     *2018.8.20
     */
    public function historyMemberList($project_id)
    {
        //内部干系人
        $insql = "SELECT pm.id,pm.name,
                p.position,
                p.phone,pm.start_time,
                pm.end_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 1";

        $inMember = M()->query($insql);

        for($i = 0;$i<count($inMember);$i++)
        {
          $inMember[$i]['is_history'] = "0";
          if(is_null($inMember[$i]['end_time']))
          {
             $inMember[$i]['end_time'] = '今';
          }
         
        }

        $dsql = "SELECT pm.id,pm.name,
                p.position,
                p.phone,pm.start_time,
                pm.end_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 3 ";

        //外部干系人
        $outsql = "SELECT pm.id,pm.name,
                pr.name as position,
                pm.start_time,
                pm.phone,pm.company
                from project_member pm
                join project_role pr 
                on pm.position = pr.id
                where project_id = 
                $project_id
                and label = 2 
                and ISNULL( pm.end_time)";

        $outMember = M()->query($outsql);


        for($i = 0;$i<count($outMember);$i++)
        {
          $outMember[$i]['is_history'] = "0";

          if(is_null($outMember[$i]['end_time'] ))
          {
             $outMember[$i]['end_time'] = '今';
          }
         
        }

        //开发团队
        $developers = M()->query($dsql);

        for($i = 0;$i<count($developers);$i++)
        {
          $developers[$i]['is_history'] = "0";
          if(is_null($developers[$i]['end_time'] ))
          {
             $developers[$i]['end_time'] = '今';
          }
         
        }

        $list = array();

        $list['inMember'] = $inMember;
        $list['outMember'] = $outMember;
        $list['developers'] = $developers;

        return $list;

    }

    /**
     *项目成员离场
     *@author fang.yu
     *2018.8.20
     */
    public function memberLeave($id)
    {
        $end_time =  date('Y-m-d',time());

        $sql = "UPDATE project_member 
        SET end_time = '$end_time' 
        where id = $id";
        $res = M()->execute($sql);

        return $res;

    }

     /**
     *历史列表
     *@author fang.yu
     *2018.8.20
     */
    public function history($name,$project_id)
    {

        $sql = "select a.* from 
              (select  id,name,project_id,
              start_time as time,'入场' state 
              from project_member 
              where project_id = $project_id
              UNION ALL
              select  id,name,project_id,
              end_time as time,'离场' 
              from project_member 
              where project_id = $project_id 
              and end_time is not null 
              ) a order by time desc";

          $res = M()->query($sql);

          return $res;

    }

    /**
     *项目角色下拉框
     *@author fang.yu
     *2018.8.20
     */
    public function projectRole()
    { 

      $sql = "SELECT id,name 
              from project_role 
              where is_delete = 0";

      $res = M()->query($sql);

      return $res;
    }


     /**
     *新增成员中模糊搜索人名
     *@author fang.yu
     *2018.8.20
     */
    public function nameSearch($keywords)
    {
      
        $sql = "SELECT id,name 
        from person 
        where name like '%$keywords%'";

        $res = M()->query($sql);

        return $res;
    }

    /**
     *新增成员中模糊搜索人名
     *@author fang.yu
     *2018.8.20
     */
    public function getId($name)
    {
      
        $sql = "SELECT id
        from person 
        where name = '$name'";

        $res = M()->query($sql);

        return $res;
    }



// =============================================================



// 岗位职责
public function jobType(){


  $sql = "SELECT jobtype_id,jobtype_name FROM `dm_jobtype`;";

  $res = M()->query($sql);

  return $res;

}

// 部门
public function depatMent(){


  $sql = "SELECT id,deptName FROM `dm_department`;";

  $res = M()->query($sql);

  return $res;

}

// 所有人
public function allMember(){


  $sql = "SELECT user_id,member_name FROM `user_member`;";

  $res = M()->query($sql);

  return $res;

}


// 新增人
public function proPersionAdd($user_code,$member_name,$pro_code,$duty,$come_time,$leave_time,$operation_type,$remarks,$founder_id){


                $app_project_persion = M("app_project_persion"); // 实例化User对象
                $data['user_code'] = $user_code;
                $data['member_name'] = $member_name;
                $data['pro_code'] = $pro_code;
                $data['duty'] = $duty;
                $data['come_time'] = $come_time;
                $data['leave_time'] = $leave_time;
                $data['operation_type'] = $operation_type;
                $data['remarks'] = $remarks;
                $data['founder_id'] = $remarks;
                $res = $app_project_persion->add($data);
                return $res;

}







}
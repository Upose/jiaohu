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
                          $type,$person_id,$label)
    {
        //开始时间为当前时间
        $start_time =  date('Y-m-d',time());

        //必须将结束时间设置为空字符串
        $sql="INSERT INTO project_member 
            (name,project_id,type, 
            person_id,label,start_time, 
            end_time)
            VALUES
            ('$name',$project_id, 
            $type,$person_id,$label, 
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
           $label,$phone,$position,$department,$company)
    {

        //开始时间为当前时间
        $start_time =  date('Y-m-d',time());

        //必须将结束时间设置为空字符串
     	$sql="insert into project_member
        	  (name,project_id,type,
              label,phone,position,
              department,company,
              start_time,end_time) 
        	  values 
        	  ('$name','$project_id',
              '$type','$label',
              '$phone',$position,
              '$department','$company',
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
                p.position,p.department,
                p.phone,pm.start_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 1 
                and pm.end_time =''";

        $inMember = M()->query($insql);

        for($i = 0;$i<count($inMember);$i++)
        {
          $inMember[$i]['end_time'] = '今';
        }
        
        //外部干系人
        $outsql = "SELECT pm.id,pm.name,
                pr.name as position,
                pm.department,
                pm.start_time,
                pm.phone,pm.company
                from project_member pm
                join project_role pr 
                on pm.position = pr.id
                where project_id = 
                $project_id
                and label = 2 
                and end_time =''";

        $outMember = M()->query($outsql);

        for($i = 0;$i<count($outMember);$i++)
        {
          $outMember[$i]['end_time'] = '今';
        }

        //开发团队
        $dsql = "SELECT pm.id,pm.name,
                p.position,p.department,
                p.phone,pm.start_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 3 
                and pm.end_time =''";

        $developers = M()->query($dsql);

         for($i = 0;$i<count($developers);$i++)
        {
          $developers[$i]['end_time'] = '今';
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
                p.position,p.department,
                p.phone,pm.start_time,
                pm.end_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 1
                and pm.end_time !=''";

        $inMember = M()->query($insql);

        $dsql = "SELECT pm.id,pm.name,
                p.position,p.department,
                p.phone,pm.start_time,
                pm.end_time
                from project_member pm
                join person p 
                on p.id = pm.person_id
                where project_id = 
                $project_id
                and pm.label = 3 
                and pm.end_time !=''";

        //因为外部干系人一直存在，所以历史人员不需要
        //开发团队
        $developers = M()->query($dsql);

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
     *项目成员入场
     *@author fang.yu
     *2018.8.20
     */
    public function memberEnter()
    {

        $start_time =  date('Y-m-d',time());

        $sql = "UPDATE project_member 
        SET end_time = '',
        start_time = '$start_time'
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

        $sql = "SELECT id,name,start_time as time
        from project_member 
        where name like '%".$name."%' and
        project_id = $project_id
        and end_time != '' ";

        $res = M()->query($sql);

        for($i = 0;$i < count($res);$i++)
        {
          $res[$i]['state'] = "入场";
        }

        $sql1 = "SELECT id,name,end_time as time
        from project_member 
        where name like '%".$name."%' and
        project_id = $project_id
        and end_time != '' ";

        $res1 = M()->query($sql1);

        for($i1 = 0;$i1 < count($res1);$i1++)
        {
          $res1[$i1]['state'] = "离场";
        }
        $final = array();

        for($j = 0;$j < count($res1);$j++)
        {
          array_push($final,$res[$j]);
          array_push($final,$res1[$j]);
        }

        return $final;

    }

    /**
     *新增外部人员职位下拉框
     *@author fang.yu
     *2018.8.20
     */
    public function outPosition()
    { 

      $sql = "SELECT id,name 
              from project_role 
              where is_delete = 0";

      $res = M()->query($sql);

      return $res;
    }


}
<?php
namespace Doc\Model;
date_default_timezone_set('prc');
mysql_query("SET NAMES UTF8"); 

class ProjectOrganizationModel
{

	/**
	 *获取内部人员信息
	 *@author fang.yu
	 *2018.8.16
	 */
	public function getInPersonInfo($person_id)
    {
     	
     	$sql = "SELECT name,phone,position,
     			department from person 
     			where id = $person_id";

     	$res = M()->query($sql);

     	return $res;

    }

    /**
	 *获取配置的职位信息
	 *@author fang.yu
	 *2018.8.16
	 */
	public function getPosition()
	{
		$sql = "SELECT id,name 
		from project_role";

     	$res = M()->query($sql);

     	return $res;
	}

    /**
	 *新增项目成员
	 *@author fang.yu
	 *2018.8.16
	 */
	public function memberAdd($name,$project_id,$type,
		$label,$phone,$position,$department,$company)
    {
        //开始时间为当前时间
        $start_time =  date('Y-m-d',time());

        //必须将结束时间设置为空字符串
     	$sql="insert into project_member
    	  (name,project_id,type,label,
          phone,position,department,
          company,start_time,end_time) 
    	  values 
    	  ('$name','$project_id',
          '$type','$label','$phone',
          '$position','$department',
          '$company','$start_time','')";

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
        $insql = "SELECT id,name,position,
        department,phone,start_time
        from project_member 
        where project_id = $project_id
        and label = 1 and end_time =''";

        $inMember = M()->query($insql);

        //外部干系人
        $outsql = "SELECT id,name,position,
        department,phone,company
        from project_member 
        where project_id = $project_id
        and label = 2 and end_time =''";

        $outMember = M()->query($outsql);

        //开发团队
        $dsql = "SELECT id,name,position,
        department,phone,start_time
        from project_member 
        where project_id = $project_id
        and label = 3 and end_time =''";

        $developers = M()->query($dsql);

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
        $insql = "SELECT id,name,position,
        department,phone,start_time,end_time
        from project_member 
        where project_id = $project_id
        and label = 1 and end_time !=''";

        $inMember = M()->query($insql);

        $dsql = "SELECT id,name,position,
        department,phone,start_time,end_time
        from project_member 
        where project_id = $project_id
        and label = 3 and end_time !=''";

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

        $sql = "SELECT id,name,end_time 
        from project_member 
        where name like '%".$name."%' and
        project_id = $project_id
        and end_time != '' 
        ORDER BY end_time desc";

        $res = M()->query($sql);

        return $res;

    }


}
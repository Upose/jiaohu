<?php
namespace Doc\Model;
date_default_timezone_set('prc');
mysql_query("SET NAMES UTF8"); 

class ProjectEventModel
{

	 /**
     *新增事件类型下拉框接口
     *@author fang.yu
     *2018.8.28
     */
    public function eventType()
    {
    	$sql = "SELECT id,name 
		    	from project_event 
		    	where is_delete = 0";

    	$res = query($sql);

    	return $res;

    }

	 /**
     *新增事件
     *@author fang.yu
     *2018.8.28
     */
    public function eventAdd($name,$project_id,$type_id,
    $submit_person_id,$start_time,$end_time,$we_person,
    $first_party_person,$other_person,$summary)
    {
    	$sql = "insert into project_eventManagement
    	  	(id,name,project_id,type_id,
    	  	submit_person_id,start_time,end_time,
    	  	we_person,first_party_person,other_person,
    	  	summary) values 
    	 	('','$name',$project_id,$type_id,
    	 	$submit_person_id,
    	 	'$start_time','$end_time','$we_person',
    	 	'$first_party_person','$other_person',
    	 	'$summary')";

    	$res = M()->execute($sql);

        return  $res;
    }

     /**
     *事件列表
     *@author fang.yu
     *2018.8.28
     */
    public function eventList($project_id,
    		$pag,$time1,$time2,$keywords)
    {
    	$sql = "SELECT pem.id,pem.name,pe.name as type,
    			p.name as person_name,pem.start_time,
    			pem.end_time 
    			from project_eventManagement pem 
				join project_event pe 
				on pem.type_id = pe.id
				join person p 
				on p.id = pem.submit_person_id";

		if(empty($time1)&&empty($time2)&&empty($keywords))
		{
			
			$sql.=" where project_id = $project_id 
			order by id desc limit ".$pag.",10 ";
		}

		if(empty($time1)&&empty($time2)&&!empty($keywords))
		{
			$sql.=" where pem.name like '%".$keywords."%' 
					order by id desc limit ".$pag.",10 ";
		}

		if(!empty($time1)&&!empty($time2)&&empty($keywords))
		{
			$sql.=" where pem.start_time BETWEEN '$time1' 
			and '$time2' order by id desc limit ".$pag.",10 ";
		}

		if(!empty($time1)&&!empty($time2)&&!empty($keywords))
		{
			$sql.=" where pem.name like '%$keywords%' 
			and em.start_time BETWEEN '$time1' and '$time2'
			order by id desc limit ".$pag.",10 ";
		}
		$res = M()->query($sql);

		//统计查出的总数
		$usql = "SELECT count(*)
    			from project_eventManagement pem 
				join project_event pe 
				on pem.type_id = pe.id
				join person p 
				on p.id = pem.submit_person_id";

		if(empty($time1)&&empty($time2)&&empty($keywords))
		{
			
			$usql.=" where project_id = $project_id 
			order by id desc limit ".$pag.",10 ";
		}

		if(empty($time1)&&empty($time2)&&!empty($keywords))
		{
			$usql.=" where pem.name like '%".$keywords."%' 
					order by id desc limit ".$pag.",10 ";
		}

		if(!empty($time1)&&!empty($time2)&&empty($keywords))
		{
			$usql.=" where pem.start_time BETWEEN '$time1' 
			and '$time2' order by id desc limit ".$pag.",10 ";
		}

		if(!empty($time1)&&!empty($time2)&&!empty($keywords))
		{
			$usql.=" where pem.name like '%$keywords%' 
			and em.start_time BETWEEN '$time1' and '$time2'
			order by id desc limit ".$pag.",10 ";
		}

		$ures = M()->query($usql);
		$count =$ures[0]['count'];

		$final['data'] = $res;
    	
		$final['count'] = $count;

        return  $final;
    }

    /**
     *事件详情
     *@author fang.yu
     *2018.8.28
     */
    public function eventDetails($event_id)
    {

    	$sql = "SELECT pem.id,pem.name,pe.name as type,
    		pem.start_time,pem.end_time,pem.we_person,
    		pem.first_party_person,pem.other_person,
    		pem.summary
			from project_eventManagement pem 
			join project_event pe 
			on pem.type_id = pe.id
			where pem.id = $event_id";

    	$res = M()->query($sql);

    	return $res;
    }



}

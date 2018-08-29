<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 
date_default_timezone_set('prc');

class ProjectDesignModel{


	 /**
     * 新增需求
     * @author fang.yu
     * 2018.8.24
     */
	public function demandAdd($name,$page,
		$summary,$type,$end_time,$state,$project_id)
	{

		//提交时间为当前时间
        $start_time = date('Y-m-d',time());

    	$sql = "insert into project_demand
    	  		(name,page,summary,type,
    	  		start_time,end_time,state,project_id) 
    	  		values 
    	 		('$name','$page','$summary',
    	 		$type,'$start_time',
    	 		'$end_time',$state,$project_id)";

    	$res = M()->execute($sql);

        return  $res;
	}


	 /**
     * 需求列表
     * @author fang.yu
     * 2018.8.24
     */
	public function demandList($project_id,
        	$pag,$time1,$time2,$keywords)
	{	

		$sql = "SELECT id,name,page,type,
				start_time,end_time,state 
				from project_demand 
				where project_id = $project_id ";

		if(empty($time1)&&empty($time2)&&empty($keywords))
		{
			$sql.=" order by id desc limit ".$pag.",10 ";
		}
		if(empty($time1)&&empty($time2)&&!empty($keywords))
		{
			$sql.=" and name like '%".$keywords."%' 
					order by id desc limit ".$pag.",10 ";
		}
		if(!empty($time1)&&!empty($time2)&&empty($keywords))
		{
			$sql.=" and start_time BETWEEN '$time1' and '$time2' 
					 order by id desc limit ".$pag.",10 ";
		}

		if(!empty($time1)&&!empty($time2)&&!empty($keywords))
		{
			$sql.=" and name like '%$keywords%' 
			and start_time BETWEEN '$time1' and '$time2'
			 order by id desc limit ".$pag.",10 ";
		}

    	$res = M()->query($sql);

    	return  $res;


	}

	 /**
     * 需求详情
     * @author fang.yu
     * 2018.8.24
     */
	public function demandDetails($demand_id)
	{

		$sql1 = "SELECT 
				DISTINCT(pd.name),pd.page,
				pd.summary,pd.type,
				pd.prototype_path,
				pd.refer_path,dm.is_handle
				from project_demand pd 
				join demand_handle dm
				on pd.id = dm.demand_id
				where pd.id = $demand_id";

		$details = M()->query($sql1);

		//将数组中的type、state由数字转化为文字
        for($i = 0;$i < count($details);$i++)
        {
        	$details[$i]['type'] = $this->
        	getDemandTypeName($details[$i]['type']);
        	$details[$i]['is_handle'] = $this->
        	getHandleTypeName($details[$i]['is_handle']);
        }

        $res['details'] = $details;

        $sql2 = "SELECT 
				p.name,dh.handle_time,
				dh.handle_state
				from demand_handle dh 
				join person p 
				on p.id = dh.handle_person_id
				join project_demand pd
				on pd.id = dh.demand_id
				where pd.id = $demand_id";

		$profess = M()->query($sql2);

		 for($i = 0;$i < count($profess);$i++)
        {
        	
        	$profess[$i]['handle_state'] = $this->
        	getHandleProcessTypeName($profess[$i]['handle_state']);
        }
		$res['profess'] = $profess;
    	return  $res;

	}

}
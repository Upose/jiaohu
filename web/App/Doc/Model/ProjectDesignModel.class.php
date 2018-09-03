<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 
date_default_timezone_set('prc');

class ProjectDesignModel{



	 /**
     * 需求列表
     * @author fang.yu
     * 2018.8.24
     */
	public function demandList($project_id,
        	$pag,$time1,$time2,$keywords)
	{	

		$sql = "SELECT id,name,page,type,
				start_time,end_time
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


    	//统计查出的总数
		$usql = "SELECT count(*) as count
    			from project_demand ";

		if(empty($time1)&&empty($time2)&&empty($keywords))
		{
			
			$usql.=" where project_id = $project_id ";
		}

		if(empty($time1)&&empty($time2)&&!empty($keywords))
		{
			$usql.=" where name like '%".$keywords."%' 
					 and project_id = $project_id";
		}

		if(!empty($time1)&&!empty($time2)&&empty($keywords))
		{
			$usql.=" where project_id = $project_id and 
			start_time BETWEEN '$time1' and '$time2' ";
		}

		if(!empty($time1)&&!empty($time2)&&!empty($keywords))
		{

			$usql.="where project_id = $project_id
					and name like '%$keywords%' 
					and start_time BETWEEN 
					'$time1' and '$time2' ";

		}

		$ures = M()->query($usql);
		$count =$ures[0]['count'];

		$final['data'] = $res;
    	
		$final['count'] = $count;

        return  $final;

	}

	 /**
     * 获取项目原型地址、设计稿地址
     * @author fang.yu
     * 2018.8.24
     */
	public function getAddress($project_id)
	{
		$sql = "SELECT prototype_address,
				design_address 
				from ProjectManagement 
				where id = $project_id";

		$res = M()->query($sql);

		return $res;


	}


	 /**
     * 修改项目原型地址、设计稿地址
     * @author fang.yu
     * 2018.8.24
     */
	public function updateAddress($project_id,
		   $prototype_address,$design_address)
	{
		$sql = "UPDATE ProjectManagement set prototype_address = '$prototype_address',design_address = '$design_address' where id = $project_id";

		$res = M()->execute($sql);

		return $res;


	}

	 /**
     * 需求详情
     * @author fang.yu
     * 2018.8.24
     */
	public function demandDetails($demand_id)
	{
		$temp = array();

		$sql = "SELECT id,name,page,
				summary,type
				from project_demand 
				where id = $demand_id";

		$res = M()->query($sql);

		$res[0]['type'] = $this->
        getDemandTypeName($res[0]['type']);
        
        $temp['id'] = $res[0]['id'];
		$temp['name'] = $res[0]['name'];
		$temp['page'] = $res[0]['page'];
		$temp['summary'] = $res[0]['summary'];
		$temp['type'] = $res[0]['type'];

		$sql1 = "SELECT 
				di.path as prototype_path
				from project_demand  pd
				join design_image di 
				on pd.id = di.demand_id
				where pd.id = $demand_id 
				and di.code = 1";

		$prototype_path = M()->query($sql1);

		for($i =0;$i<count($prototype_path);$i++)
		{
			$prototype_path[$i] = 
			$prototype_path[$i]['prototype_path'];
		}

		//将界面截图存进详情数组
		$temp['prototype_path'] = $prototype_path;


		$sql2 = "SELECT 
				di2.path as refer_path
				from project_demand  pd2
				join design_image di2 
				on pd2.id = di2.demand_id
				where pd2.id = $demand_id
				and di2.code = 2";

		$refer_path = M()->query($sql2);

		for($i =0;$i<count($refer_path);$i++)
		{
			$refer_path[$i] = 
			$refer_path[$i]['refer_path'];
		}

		//将参考页面存进详情数组
		$temp['refer_path'] = $refer_path;

 		//将详情存进最终数组
        $fianl['details'] = $temp;

        $sql3 = "SELECT 
				p.name,dh.handle_time,
				dh.handle_state
				from demand_handle dh 
				join person p 
				on p.id = dh.handle_person_id
				join project_demand pd
				on pd.id = dh.demand_id
				where pd.id = $demand_id";

		$profess = M()->query($sql3);

		 for($i = 0;$i < count($profess);$i++)
        {
        	
        	$profess[$i]['handle_state'] = $this->
        	getHandleProcessTypeName(
        	$profess[$i]['handle_state']);

        	
        }

        $fianl['profess'] = $profess;

        $sql4 = "SELECT 
				dh.is_handle
				from demand_handle dh 
				join person p 
				on p.id = dh.handle_person_id
				join project_demand pd
				on pd.id = dh.demand_id
				where pd.id = $demand_id and dh.id = 
				(SELECT max(id) from demand_handle) ";

		$is_handle = M()->query($sql4);
		$is_handle = $is_handle[0]['is_handle'];

       
       

		$fianl['is_handle'] = $is_handle;

    	return  $fianl;

	}



	 /**
     * 需求处理
     * @author fang.yu
     * 2018.8.24
     */
    public function demandHandle($demand_id,
    			  $handle_state,$is_handle)
    {

    	//处理人id
        $handle_person_id  =$_SESSION['user_id'];

        //处理时间
        $handle_time = date('Y-m-d',time());

    	$sql = "INSERT into 
    	demand_handle(id,
    	demand_id,is_handle,
    	handle_person_id,
    	handle_time,handle_state) 
    	VALUES('',$demand_id,$is_handle,
    	$handle_person_id,'$handle_time',
    	$handle_state)";

    	$res= M()->execute($sql); 

    	return $res;
    }



}
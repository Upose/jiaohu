<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectManagementModel
{


	/**
	 * 查询现有项目列表
	 * @author fang.yu
	 * 2018.8.14
	 */
	 public function projectList($area_id,$status_id,$kw)
	 {
	 	
	 	$sql = "SELECT i.id as pid,
	 	i.name as pname,
	 	pm.id as cid,pm.name as cname,
	 	a.name as area,
	 	pm.charge,pm.member_num,
	 	pm.start_time,
	 	pm.end_time,s.name as status,
	 	pm.progress_rate as rate
		from ProjectManagement pm 
		join project_select i 
		on pm.industry_id  = i.id 
		join area a 
		on pm.area_id = a.id
		join `project_status` s 
		on pm.status_id = s.id";
			
		//根据传来的不同条件进行搜索	 
		if(!empty($area_id) && empty($status_id) && empty($kw))
		{
			$sql.=" where a.id = '$area_id' ORDER BY pm.id ";
		}
		if(empty($area_id)&&!empty($status_id)&&empty($kw))
		{
			$sql.=" where s.id = '$status_id' ORDER BY pm.id ";
		}
		if(empty($area_id)&&empty($status_id)&&!empty($kw))
		{
			$sql.=" where pm.name like '%$kw%' ORDER BY pm.id ";
		}


	 	$res = M()->query($sql);

        return  $res;

	 }


	 /**
	 * 区域下拉框
	 * @author fang.yu
	 * 2018.8.14
	 */
	  public function areaList()
     {
     	$provinceSql = "SELECT id as pid,
 				name as pname from area 
     			where parent_id = 0";

     	$province = M()->query($provinceSql);
		$area['province'] = $province;
		$area['city'] = $city;
        return  $area;

     }

     /**
	 * 项目新增省市联动
	 * @author fang.yu
	 * 2018.8.14
	 */
     public function getCity($province_id)
     {
     	

     	$citySql = "SELECT 
     			a.id as cid,a.name as cname 
     			from area a
 				join (SELECT id as pid,
 				name as pname from area 
     			where parent_id = 0 ) b
				on a.parent_id = b.pid 
				where b.pid = '$province_id'";

		$city = M()->query($citySql);

        return  $city;

     }

     /**
	 * 状态下拉框
	 * @author fang.yu
	 * 2018.8.14
	 */
	  public function statusList()
     {
     	$sql = "SELECT id,name 
     	from project_status 
     	where is_delete = 0";

     	$status = M()->query($sql);

        return  $status;

     }

      /**
	 * 行业下拉框
	 * @author fang.yu
	 * 2018.8.15
	 */
	  public function industryList()
     {
     	$sql = "SELECT id,name 
     	from project_select
     	where is_delete = 0";

     	$industry = M()->query($sql);

        return  $industry;

     }
     /**
	 * 行业下拉框
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  // public function projectIndustryList()
   //   {

   //   	echo "projectIndustryList is OK";
   //   	$sql = "SELECT * FROM app_industry;";

   //   	$industry = M()->query($sql);

   //      return  $industry;

   //   }

     /**
	 * 客户类型下拉框
	 * @author fang.yu
	 * 2018.8.15
	 */
	  public function customerList()
     {
     	$sql = "SELECT id,name 
     	from customer_type";

     	$customer = M()->query($sql);

        return  $customer;

     }


     /**
	 * 添加项目
	 * @author fang.yu
	 * 2018.8.15
	 */
    public function projectAdd($name,
    	$project_type_id,$industry_id,
        $customer_type_id,$area_id,$charge,
    	$address,$longitude,$latitude,$start_time)
    {
    	  $sql="insert into ProjectManagement
    	  (name,project_type_id,industry_id,
    	  customer_type_id,area_id,charge,status_id,
    	  progress_rate,detailedAddress,longitude,
    	  latitude,start_time) 
    	  values 
    	  ('$name','$project_type_id',
    	  '$industry_id','$customer_type_id',
    	  '$area_id','$charge',1,'0%','$address',
    	  '$longitude','$latitude','$start_time')";

        $res = M()->execute($sql);
       	return $res;
    	 
    }

    /**
	 * 添加项目
	 * @author song.chaoxu
	 * 2018.11.14
	 */
    // public function projectAdd($name,
    // 	$project_type_id,$industry_id,
    //     $customer_type_id,$area_id,$charge,
    // 	$address,$longitude,$latitude,$start_time)
    // {
    // 	  $sql="insert into ProjectManagement
    // 	  (name,project_type_id,industry_id,
    // 	  customer_type_id,area_id,charge,status_id,
    // 	  progress_rate,detailedAddress,longitude,
    // 	  latitude,start_time) 
    // 	  values 
    // 	  ('$name','$project_type_id',
    // 	  '$industry_id','$customer_type_id',
    // 	  '$area_id','$charge',1,'0%','$address',
    // 	  '$longitude','$latitude','$start_time')";

    //     $res = M()->execute($sql);
    //    	return $res;
    	 
    // }

    /**
	 * 统计项目成员人数
	 * @author fang.yu
	 * 2018.8.15
	 */
    public function member_numCount($project_id)
    {
    	$sql = "SELECT count(*) 
	    	   as member_num 
	    	   from project_member 
	    	   where project_id = 
	    	   $project_id 
	    	   and end_time = ''";

     	$member_num = M()->query($sql);

        return  $member_num;

    }
    

}
<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectRegistrationModel
{


	/**
	 * 查询现有项目列表
	 * @author song.chaoxu
	 * 2018.11.14
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
        return  $area;

     }

     /**
	 * 行业下拉框
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function projectIndustryList()
     {


     	$sql = "SELECT * FROM app_industry;";

     	$industry = M()->query($sql);

        return  $industry;

     }

    /**
	 * 行业下拉框
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function projectRankList()
     {

     	$sql = "SELECT * FROM app_project_rank;";

     	$industry = M()->query($sql);

        return  $industry;

     }


    /**
     * 项目经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function projectManager()
     {


        $sql = "SELECT t.member_name FROM user_member t WHERE postsname like '%经理' AND department LIKE '%交付%'";

        $industry = M()->query($sql);

        return  $industry;

     }


    /**
     * 部门经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function divisionManager()
     {


        $sql = "SELECT t.member_name FROM user_member t WHERE postsname = '部门经理' AND department LIKE '%交付%'";

        $industry = M()->query($sql);

        return  $industry;

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


    

}
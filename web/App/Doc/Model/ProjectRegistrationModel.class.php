<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectRegistrationModel
{


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

     	$rankList = M()->query($sql);

        return  $rankList;

     }

    /**
     * 项目性质下拉框
     * @author song.chaoxu
     * 2018.11.21
     */
      public function projectNature()
     {

        $sql = "SELECT * FROM app_project_nature;";

        $projectNature = M()->query($sql);

        return  $projectNature;

     }


    /**
     * 项目经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function projectManager()
     {


        $sql = "SELECT t.member_id,t.member_name FROM user_member t WHERE postsname like '%经理' AND department LIKE '%交付%'";

        $projectManager = M()->query($sql);

        return  $projectManager;

     }


    /**
     * 部门经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function divisionManager()
     {


        $sql = "SELECT t.member_id,t.member_name FROM user_member t WHERE postsname = '部门经理' AND department LIKE '%交付%'";

        $divisionManager = M()->query($sql);

        return  $divisionManager;

     }


    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd($pro_code,$pro_name,$typeId,$industry, $projectManagerId, $projectManager, $projectStime,$projectEtime, $area,$rank,$createTime,$newPath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManagerId,$divisionManager,$contractAmount,$projectIntroduce){
    	  $sql="INSERT INTO `deliveryapplication`.`app_project` (
                    `pro_id`,
                    `pro_name`,
                    `type_id`,
                    `industry_id`,
                    `member_id`,
                    `pro_leader`,
                    `pro_stime`,
                    `pro_etime`,
                    `pro_address`,
                    `secrecy_grade`,
                    `create_data`,
                    `pro_enclosure`,
                    `pro_msg`,
                    `cooperative_unit`,
                    `pro_source`,
                    `division_manager_id`,
                    `pro_division_manager`,
                    `contract_amount`,
                    `pro_introduce`,
                )
                VALUES
                    (
                        $pro_code,
                        \"$pro_name\",
                        $typeId,
                        $industry,
                        $projectManagerId,
                        \"$projectManager\", 
                        $projectStime,
                        $projectEtime,
                        \"$area\",
                        \"$rank\",
                        $createTime,
                        \"$newPath\",
                        \"$lxMsg\",
                        \"$cooperativeUnit\",
                        \"$projectNature\",
                        $divisionManagerId,
                        \"$divisionManager\",
                        $contractAmount,
                        \"$projectIntroduce\"
                    );";

        $res = M()->execute($sql);
       	return $res;	 
    }



    /**
     * 查询现有项目列表
     * @author song.chaoxu
     * 2018.11.21
     */
     public function projectList($proArea,$proName,$proCode)
     {
        
        // $sql = "SELECT i.id as pid,
        // i.name as pname,
        // pm.id as cid,pm.name as cname,
        // a.name as area,
        // pm.charge,pm.member_num,
        // pm.start_time,
        // pm.end_time,s.name as status,
        // pm.progress_rate as rate
        // from ProjectManagement pm 
        // join project_select i 
        // on pm.industry_id  = i.id 
        // join area a 
        // on pm.area_id = a.id
        // join `project_status` s 
        // on pm.status_id = s.id";

        $sql = "

            SELECT
                `pro_id`,
                `pro_name`,
                `type_id`,
                `industry_id`,
                `member_id`,
                `pro_leader`,
                `pro_members`,
                `pro_stime`,
                `pro_etime`,
                `pro_status`,
                `pro_schedule`,
                `pro_address`,
                `secrecy_grade`,
                `insert_date`,
                `create_data`,
                `pro_longitude`,
                `pro_latitude`,
                `pro_enclosure`,
                `pro_code`,
                `pro_msg`,
                `cooperative_unit`,
                `pro_source`,
                `division_manager_id`,
                `pro_division_manager`,
                `contract_amount`,
                `pro_introduce` 
            FROM `app_project`;

        ";
            
        echo "$proArea:".$proArea ."————————————$proName".$proName."————————————$proCode".$proCode;
        //根据传来的不同条件进行搜索  
        if(!empty($proArea) && empty($proName) && empty($proCode))
        {
            $sql.=" where pro_address like '%$proArea%'";
        }
        if(empty($proArea)&&!empty($proName)&&empty($proCode))
        {
            $sql.=" where pro_naem like '%$proName%'";
        }
        if(empty($proArea)&&empty($proName)&&!empty($proCode))
        {
            $sql.=" where pro_id like '%$proCode%'";
        }

        $res = M()->query($sql);

        return  $res;

     }


}
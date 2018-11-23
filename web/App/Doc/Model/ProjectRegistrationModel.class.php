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
     	$provinceSql = "SELECT area_id as pid,
 				area_name as pname from app_area 
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
	 * 项目密级
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


        $sql = "SELECT t.member_id,t.member_name,t.department FROM user_member t WHERE postsname like '%经理' AND department LIKE '%交付%'";

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


        $sql = "SELECT t.member_id,t.member_name,t.department FROM user_member t WHERE postsname = '部门经理' AND department LIKE '%交付%'";

        $divisionManager = M()->query($sql);

        return  $divisionManager;

     }


    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd($pro_code,$pro_name,$typeId,$industry, $projectManagerId, $projectManager, $projectStime,$projectEtime, $area,$rank,$createTime,$newPath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManagerId,$divisionManager,$contractAmount,$projectIntroduce){

            // echo $createTime,$projectStime,$projectEtime;
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
                    `pro_introduce`
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


        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
       	 
    }

}
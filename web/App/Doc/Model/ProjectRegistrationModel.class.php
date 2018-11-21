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


        $sql = "SELECT t.member_id,t.member_name FROM user_member t WHERE postsname like '%经理' AND department LIKE '%交付%'";

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


        $sql = "SELECT t.member_id,t.member_name FROM user_member t WHERE postsname = '部门经理' AND department LIKE '%交付%'";

        $industry = M()->query($sql);

        return  $industry;

     }


    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd($pro_name,$pro_id,$rank,$createTime,$lxMsg,$area,$cooperativeUnit,$projectNature,$industry,$divisionManager,$projectManager,$contractAmount,$projectStime,$projectEtime,$projectIntroduce,$newpath){
    	  $sql="INSERT INTO `deliveryapplication`.`app_project` (
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
                    `pro_contract`,
                    `contract_amount`,
                    `pro_introduce`,
                    `filePath`

                )
                VALUES
                    (
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL
                    );";

        $res = M()->execute($sql);
       	return $res;	 
    }


}
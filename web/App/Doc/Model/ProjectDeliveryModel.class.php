<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectDeliveryModel
{


     /**
     * 根据此人ID 查询此人负责的项目列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function projectList($projectManagerId)
     {
        $projectListSql = "SELECT pro_id,pro_name,member_id,pro_leader FROM `app_project` WHERE member_id = \"$projectManagerId\";";
        $projectList = M()->query($projectListSql);
        return  $projectList;
     }
	 /**
	 * 区域下拉框
	 * @author song.chaoxu 
	 * 2018.11.24
	 */
	  public function areaList()
     {
     	$areaSql = "SELECT area_id as pid,
 				area_name as pname from app_area 
     			where parent_id = 0";

     	$area = M()->query($areaSql);
        return  $area;

     }

     /**
	 * UI前端框架
	 * @author song.chaoxu
	 * 2018.11.24
	 */
	  public function uiFrame()
     {


     	$sql = "SELECT frameid,frame_name FROM `app_development_frame` WHERE typeId = 1;";

     	$ui = M()->query($sql);

        return  $ui;

     }

    /**
	 * JS 框架
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function jsFrame()
     {

     	$sql = "SELECT frameid,frame_name FROM `app_development_frame` WHERE typeId = 4;";

     	$js = M()->query($sql);

        return  $js;

     }

    /**
     * 后端 开发语言
     * @author song.chaoxu
     * 2018.11.24
     */
      public function backFrame()
     {

        $sql = "SELECT frameid,frame_name FROM `app_development_frame` WHERE typeId = 2;";

        $back = M()->query($sql);

        return  $back;

     }


    /**
     * 数据库  列表
     * @author song.chaoxu
     * 2018.11.24
     */
      public function databaseFrame()
     {


        $sql = "SELECT frameid,frame_name FROM `app_development_frame` WHERE typeId = 3;";

        $database = M()->query($sql);

        return  $database;

     }





    /**
     * 实施交付新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function proDeliveryAdd($pro_code,$pro_name,$typeId,$industry, $projectManagerId, $projectManager, $projectStime,$projectEtime, $area,$rank,$createTime,$newPath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManagerId,$divisionManager,$contractAmount,$projectIntroduce){

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
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
     * 获取交付部下拉 部门列表
     * 
     * @author song.chaoxu 
     * 2018.11.30
     */
      public function getDepartment()
     {
        $departmentSql = "SELECT
                                u.department
                            FROM
                                `user_member` u
                            WHERE
                                department LIKE '%交付%'
                            GROUP BY
                                department;";
        $departmentList = M()->query($departmentSql);
        return  $departmentList;
     }


    /**
     * 获取职位下拉 
     * 
     * @author song.chaoxu 
     * 2018.11.30
     */
      public function getPostName()
     {
        $postNameSql = "SELECT j.jobtype_id,j.jobtype_name FROM `app_jobtype` j;";
        $postList = M()->query($postNameSql);
        return  $postList;
     }


    /**
     * 根据部门列表 查询部门下的人员
     * 
     * @author song.chaoxu 
     * 2018.11.30
     */
      public function getdepartmentPersion($departmentName)
     {
        $departmentPersionSql = "SELECT
                                u.member_id,
                                u.member_name,
                                u.postsname,
                                CASE
                            WHEN u.member_type = 0 THEN
                                '内部人员'
                            ELSE
                                '外部人员'
                            END AS member_type
                            FROM
                                `user_member` u
                            WHERE
                                department LIKE \"$departmentName\"

                            ";
        $departmentPersionList = M()->query($departmentPersionSql);
        return  $departmentPersionList;
     }




    /**
     * 实施交付信息新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function proDeliveryAdd($proId,$proName,$proArea,$uiFrame,$jsFrame,$backFrame,$databaseFrame,$stakeHolder,$whether_ys,$ys_date,$persionRelease){

    	  $sql="INSERT INTO `deliveryapplication`.`app_project_delivery` 
                    `pro_id`,
                    `pro_name`,
                    `pro_area`,
                    `uiframe`,
                    `jsframe`,
                    `backframe`,
                    `databaseframe`,
                    `stakeholder`,
                    `whether_ys`,
                    `ys_date`,
                    `person_release`
                )
                VALUES
                    (
                        $proId,
                        \"$proName\",
                        $proArea,
                        $uiFrame,
                        $jsFrame,
                        $backFrame,
                        $databaseFrame,
                        \"$stakeHolder\",
                        $whether_ys,
                        \"$ys_date\",
                        $persionRelease
                    );";

        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
       	 
    }



    /**
     * 实施交付人员新增
     * @author song.chaoxu
     * 2018.11.30
     */
    public function proDeliveryPersionAdd($proId,$proName,$persionId,$persionName,$jobType,$inTime){

          $sql="INSERT INTO `deliveryapplication`.`app_project_persion` (
                    `pro_name`,
                    `member_id`,
                    `pro_id`,
                    `member_name`,
                    `come_time`,
                    `duty`
                )
                VALUES
                    (
                        \"$proName\",
                        $persionId,
                        $proId,
                        \"$persionName\",
                        \"$inTime\",
                        $jobType
                    ); ";


        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
         
    }

}
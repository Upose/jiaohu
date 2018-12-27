<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectCommonModel
{


     /**
     * 根据此人ID 查询此人负责的项目列表
     * 
     * @author song.chaoxu 
     * 2018.12.24
     */
      public function projectList($pMId)
     {
        $projectListSql = "
                        SELECT
                            `pro_id`,
                            `pro_code`,
                            `pro_name`,
                            `industry_id`,
                            `pro_source`,
                            `pro_department`,
                            `pro_leader`,
                            `leader_name`,
                            `pro_address`,
                            `type_id`,
                            `pro_introduce`,
                            `state`,
                            `founder_id`,
                            `create_date`,
                            `operation_id`,
                            `operation_date`,
                            `last_date`
                        FROM `app_project` WHERE founder_id = \"$pMId\";";
        $projectList = M()->query($projectListSql);
        return  $projectList;
     }

     /**
     * 查询行业列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function inIndustry()
     {
        $inIndustrySql = "
                        SELECT
                            industry_id,
                            industry_name
                        FROM
                            `dm_industry`;";
        $inIndustryList = M()->query($inIndustrySql);
        return  $inIndustryList;
     }

     /**
     * 查询部门列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function inDepartment()
     {
        $inDepartmentSql = "
                        SELECT id,deptNmae FROM dm_department";
        $inDepartmentList = M()->query($inDepartmentSql);
        return  $inDepartmentList;
     }

    /**
     * 查询区域列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */

      public function areaList()
     {
        $areaSql = "SELECT
                        area_id AS aid,
                        area_name AS aname
                    FROM
                        dm_area
                    WHERE
                        parent_id = 0";

        $area = M()->query($areaSql);
        return  $area;

     }

    /**
     * 查询项目经理列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function pManagerList()
     {
        $pManagerSql = "SELECT
                            *
                        FROM
                            `user_member`
                        WHERE
                            department LIKE '%交付%'
                        AND duty LIKE '%项目经理%';";

        $pManager = M()->query($pManagerSql);
        return  $pManager;

     }





}
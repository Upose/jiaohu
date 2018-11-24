<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectMeetingModel
{


	 /**
	 * 会议列表
	 * @author song.chaoxu
	 * 2018.11.24
	 */
	  public function meetingList()
     {
     	$meetingSql = "SELECT area_id as pid,
 				area_name as pname from app_area 
     			where parent_id = 0";

     	$meetingList = M()->query($meetingSql);
		
        return  $meetingList;
     }


    /**
     * 项目所处阶段
     * @author song.chaoxu
     * 2018.11.24
     */
      public function stageList()
     {
        $sSql = "SELECT t_id,stage FROM `app_project_stage`;";

        $stageList = M()->query($sSql);
        
        return  $stageList;
     }



    /**
     * 会议新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function meetingAdd($mTheme,$mTime,$mStage,$mFrm,$joinPersionOut,$joinPersionIn,$mContent,$filePath){

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
                        \"$projectStime\",
                        \"$projectEtime\",
                        \"$area\",
                        \"$rank\",
                        \"$createTime\",
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
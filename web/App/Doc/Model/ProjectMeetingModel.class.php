<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectMeetingModel
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
        echo $projectListSql;
        $projectList = M()->query($projectListSql);
        return  $projectList;
        
     }


	 /**
	 * 会议列表
	 * @author song.chaoxu
	 * 2018.11.24
	 */
	  public function meetingList()
     {
     	$meetingSql = "SELECT
                            m.`meeting_id`,
                            m.`department_id`,
                            m.`stage`,
                            m.`meeting_mode`,
                            m.`meeting_level`,
                            m.`theme`,
                            m.`meeting_time`,
                            m.`address`,
                            m.`inside`,
                            m.`external`,
                            m.`content`,
                            m.`enclosure`,
                            m.`founder_id`,
                            m.`create_time`
                        FROM
                            `app_meeting` m;";

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
    public function meetingAdd($mTheme,$proId,$mAddress,$mLevel,$mTime,$mStage,$mForm,$joinPersionOut,$joinPersionIn,$mContent,$mCreatePersion,$filePath){

    	  $sql="INSERT INTO `deliveryapplication`.`app_meeting` (
                    `department_id`,
                    `stage`,
                    `meeting_mode`,
                    `meeting_level`,
                    `theme`,
                    `meeting_time`,
                    `address`,
                    `inside`,
                    `external`,
                    `content`,
                    `enclosure`,
                    `founder_id`
                )
                VALUES
                    (
                        $proId,
                        $mStage,
                        $mForm,
                        $mLevel,
                        \"$mTheme\",
                        \"$mTime\",
                        \"$mAddress\",
                        \"$joinPersionIn\",
                        \"$joinPersionOut\",
                        \"$mContent\",
                        \"$filePath\",
                        $mCreatePersion
                    );";

                    // echo $sql;

        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
       	 
    }

}
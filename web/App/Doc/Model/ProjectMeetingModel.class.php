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


        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
       	 
    }

}
<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectCollectionStateModel
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



}
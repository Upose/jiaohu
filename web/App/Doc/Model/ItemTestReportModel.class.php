<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ItemTestReportModel
{

    /**
     * 项目所属阶段
     * @author song.chaoxu
     * 2018.01.07
     */
    public function pStaus(){

        $dm_stage = M("dm_stage"); // 实例化User对象
        $result = $dm_stage->select();
        return $result;

    }






}
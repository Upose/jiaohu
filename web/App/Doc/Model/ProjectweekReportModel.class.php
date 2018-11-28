<?php
/**
 * Created by PhpStorm.
 * User: wangyao
 * Date: 2018/11/26
 * Time: 上午10:59
 */
namespace Doc\Model;
class ProjectweekReportModel{
    //获取新增记录的ID
    public function lastInsert()
    {
        $lastsql='select LAST_INSERT_ID()';
        $lastid=M()->execute($lastsql);
        return $lastid;
    }
    //项目周报和周报任务新增接口
    public function weekInsert()
    {
        //本周周报
        $data['weekly_stime']='2018-11-28';
        $data['weekly_etime']='2018-11-30';
        $data['pro_name']='大童';
        $data['stage']='进行中';
        $data['pro_schedule']='20';
        $data['stageenddate']='2018-12-01';
        //$res = M('')->execute($sql);
        $res = M('app_project_weekly')->data($data)->add();
        //$lastid=$this->lastInsert();
        var_dump($res);die;
        if($res){
            return 0;
        }else{
            return 1;
        }
    }

}
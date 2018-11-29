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
    public function weekInsert($workInfo,$thisWorkData,$nextWorkData)
    {
        $nowtime=date('Y-m-d H:i:s',time());
        $workInfo['create_date']=$nowtime;
        //本周周报
        $weekreportid = M('app_project_weekly')->data($workInfo)->add();
        //本周周报任务
        if($weekreportid){
            foreach($thisWorkData as $value){
                $value['create_time']=$nowtime;
                $value['weekly_id']=intval($weekreportid);
                $taskid[] = M('app_weekly_task')->data($value)->add();
            }
        }
        //下周周报任务
        if($nextWorkData){
            //下周周报
            //默认下个周一
            $nextweek['weekly_stime']=date('Y-m-d',strtotime('Sunday +1 day',strtotime($workInfo['weekly_stime'])));
            $nextweek['weekly_etime']=date('Y-m-d',strtotime('Sunday +5 day',strtotime($workInfo['weekly_etime'])));
            $nextweekid = M('app_project_weekly')->data($nextweek)->add();
            foreach ($nextWorkData as $value)
            {
                $value['create_time']=$nowtime;
                $value['weekly_id']=intval($nextweekid);
                $nextid[] = M('app_weekly_task')->data($value)->add();
            }
        }
        if($taskid || $nextid){
            return true;
        }else{
            return false;
        }
    }

}
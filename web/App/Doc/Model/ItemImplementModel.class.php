<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ItemImplementModel
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

    /**
     * 风险类别
     * @author song.chaoxu
     * 2018.01.07
     */
    public function rType(){

        $dm_risktype = M("dm_risktype"); // 实例化对象
        $result = $dm_risktype->select();
        return $result;

    }



    /**
     * 事件类型
     * @author song.chaoxu
     * 2018.01.07
     */
    public function eType(){

        $dm_etype = M("dm_etype"); // 实例化User对象
        $result = $dm_etype->select();
        return $result;

    }


    /**
     * 风险新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function riskAdd($pro_code,$pro_stage,$risk_content,$risk_type,$level,$consequence,$founder_id){

        $app_project_risk = M("app_project_risk"); // 实例化对象
        $data['pro_code'] = $pro_code;
        $data['pro_stage'] = $pro_stage;
        $data['risk_content'] = $risk_content;
        $data['risk_type'] = $risk_type;
        $data['level'] = $level;
        $data['consequence'] = $consequence;
        $data['founder_id'] = $founder_id;
        $result = $app_project_risk->add($data);
        return $result;
    }

    /**
     * 风险查询
     * @author song.chaoxu
     * 2018.01.07
     */
    public function riskResult($pCode,$page,$limit){

        $app_project_risk = M("app_project_risk"); // 实例化对象
        $count = $app_project_risk ->where('pro_code'.$pCode) ->count();
        $customerList = $app_project_risk ->field('id,pro_code,plan_code,stage,risk_content,risk_type,level,result,state,founder_id,create_data')
            ->where('pro_code',$pCode)
            ->page($page,$limit)
            ->order('create_data desc')
            ->select();
          $result = array();
          $result['code'] = 0;
          $result['msg'] = "";
          $result['count'] = $count;
          $result['data'] = $customerList;
          return $result;
    }

    /**
     * 事件新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function eventAdd($pro_code,$pro_stage,$event_name,$event_type,$event_content,$level,$happen_time,$enclosure,$remarks,$founder_id)
        {

                $app_majorevents = M("app_majorevents"); // 实例化对象
                $data['pro_code'] = $pro_code;
                $data['pro_stage'] = $pro_stage;
                $data['event_name'] = $event_name;
                $data['event_type'] = $event_type;
                $data['event_content'] = $event_content;
                $data['level'] = $level;
                $data['happen_time'] = $happen_time;
                $data['enclosure'] = $enclosure;
                $data['remarks'] = $remarks;
                $data['founder_id'] = $founder_id;
                $result = $app_majorevents->add($data);
                return $result;
            }


    /**
     * 会议新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function meetingAdd($pro_code,$pro_stage,$meeting_mode,$meeting_level,$theme,$meeting_time,$address,$inside,$external,$content,$founder_id,$enclosure)
        {

                $app_majorevents = M("app_meeting"); // 实例化对象
                $data['pro_code'] = $pro_code;
                $data['stage'] = $pro_stage;
                $data['meeting_mode'] = $meeting_mode;
                $data['meeting_level'] = $meeting_level;
                $data['theme'] = $theme;
                $data['meeting_time'] = $meeting_time;
                $data['address'] = $address;
                $data['inside'] = $inside;
                $data['external'] = $external;
                $data['content'] = $content;
                $data['enclosure'] = $enclosure;
                $data['founder_id'] = $founder_id;
                $result = $app_majorevents->add($data);
                return $result;

            }

    /**
     * 周报新增
     * @author song.chaoxu
     * 2018.01.11
     */
    public function pWeeklyAdd($pro_code,$weekly_name,$plan_code,$weekly_stime,$weekly_etime,$stage,$pro_schedule,$founder_id,$task_content,$completion_rate,$work_content,$work_state,$remarks,$state){


        $app_project_weekly = M("app_project_weekly"); // 实例化周报任务对象
        $app_weekly_task = M("app_weekly_task"); // 实例化周报明细对象


        //插入周报任务
        $data['pro_code'] = $pro_code;
        $data['weekly_name'] = $weekly_name;
        $data['plan_code'] = $plan_code;
        $data['weekly_stime'] = $weekly_stime;
        $data['weekly_etime'] = $weekly_etime;
        $data['meeting_time'] = $meeting_time;
        $data['stage'] = $stage;
        $data['pro_schedule'] = $pro_schedule;
        $data['founder_id'] = $founder_id;
        $weeklyID = $app_project_weekly->add($data);



        //插入周报任务明细
        $detailed['weekly_id'] = $weeklyID;
        $detailed['pro_code'] = $pro_code;
        $detailed['task_content'] = $task_content;
        $detailed['completion_rate'] = $completion_rate;
        $detailed['work_content'] = $work_content;
        $detailed['work_state'] = $work_state;
        $detailed['remarks'] = $remarks;
        $detailed['state'] = $state;
        $detailed['founder_id'] = $founder_id;
        $weeklyDetailedResult = $app_weekly_task->add($detailed);



        //查询未完成的任务并新增到本周
        // $unFinished = $app_weekly_task->where('work_state',0)->where('state',！=1)->where('pro_code',$pCode)
        // 修改state

            // $unFinished state =1;
            // $unFinished













        return $weeklyDetailedResult;
    }




    /**
     * 周报查询
     * @author song.chaoxu
     * 2018.01.11
     */
    public function weeklyResult($pro_code){

        $app_project_weekly = M("app_project_weekly"); // 实例化对象
        $result = $app_project_weekly->where('pro_code',$pCode)->find();
        return $result;

    }


}
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
        $arr = [];
        for ($i=0; $i <count($result) ; $i++) { 
          $arr[$i] = trim($result[$i]['stage']);
        }
        return $arr;

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
     * 查询现有项目会议分页列表
     * @author song.chaoxu
     * 2019.01.26
     */
     public function meetingList($pro_code,$pag,$limit)
     {

        $app_meeting = M("app_meeting"); // 实例化对象
        $count = $app_meeting ->where('pro_code'.$pCode) ->count();
        
        $sql = "
                SELECT
                  m.meeting_id,
                  s.stage,
                  m.theme,
                  m.address,
                  m.inside,
                  m.external,
                  m.content,
                  m.meeting_time,
                  CASE m.meeting_mode
                WHEN '1' THEN
                  '内部会议'
                WHEN '2' THEN
                  '客户会议'
                ELSE
                  m.meeting_mode
                END AS meeting_mode
                FROM
                  `app_meeting` m
                JOIN dm_stage s ON m.stage = s.t_id
                ";
            $sql.="where pro_code = \"$pro_code\"  limit ".$pag.",".$limit;


          $meetingList = M()->query($sql);
          $result = array();
          $result['code'] = 0;
          $result['msg'] = "";
          $result['count'] = $count;
          $result['data'] = $meetingList;
          return $result;

     }


    /**
     * 查询现有项目事件分页列表
     * @author song.chaoxu
     * 2019.01.26
     */
     public function eventList($pro_code,$pag,$limit)
     {

        $app_majorevents = M("app_majorevents"); // 实例化对象
        $count = $app_majorevents ->where('pro_code'.$pCode) ->count();
        
        $sql = "
               SELECT
                  m.id,
                  m.pro_code,
                  m.event_name,
                  m.event_content,
                  m.happen_time,
                  m.enclosure,
                  m.remarks,
                  e.etype,
                  CASE `level`
                WHEN '1' THEN
                  '普通'
                WHEN '2' THEN
                  '严重'
                ELSE
                  `level`
                END AS levels
                FROM
                  app_majorevents m
                JOIN dm_etype e ON m.event_type = e.id
                ";
            $sql.="where pro_code = \"$pro_code\"  limit ".$pag.",".$limit;


          $eventList = M()->query($sql);
          $result = array();
          $result['code'] = 0;
          $result['msg'] = "";
          $result['count'] = $count;
          $result['data'] = $eventList;
          return $result;

     }

    /**
     * 风险查询
     * @author song.chaoxu
     * 2018.01.07
     */
    public function riskResult($pCode,$page,$limit){


        $app_project_risk = M("app_project_risk"); // 实例化对象
        // $count = $app_project_risk ->where('pro_code',$pCode) ->count();

        $countSql = "SELECT COUNT(id) AS total
                            FROM
                              app_project_risk 
                            WHERE
                              pro_code = $pCode
                            ";

        // $customerList = $app_project_risk->alias('r') ->field('r.id,r.pro_code,r.plan_code,ds.stage,r.risk_content,dr.rtype,(case when r.level = 1 then \'一级\' when r.level = 2 then \'二级\' else \'三级\' end) as level,r.result,r.state,r.founder_id,r.create_data')
        //     ->join('dm_risktype dr','r.risk_type = dr.id')
        //     ->join('dm_stage ds','r.stage = ds.t_id')
        //     ->where('pro_code',$pCode)
        //     ->page($page,$limit)
        //     ->order('create_data desc')
        //     ->select();
          $querySql = "SELECT
                              r.id,
                              r.pro_code,
                              r.plan_code,
                              ds.stage,
                              r.risk_content,
                              dr.rtype as risk_type,
                              (
                                CASE
                                WHEN r. LEVEL = 1 THEN
                                  '一级'
                                WHEN r. LEVEL = 2 THEN
                                  '二级'
                                ELSE
                                  '三级'
                                END
                              ) AS level,
                              r.result,
                              r.state,
                              r.founder_id,
                              r.create_data
                            FROM
                              app_project_risk r
                            JOIN dm_risktype dr ON r.risk_type = dr.id
                            JOIN dm_stage ds ON r.stage = ds.t_id
                            WHERE
                              pro_code = $pCode
                            ORDER BY
                              create_data DESC
                            LIMIT $page,$limit";

          $count=M()->query($countSql); 
          // echo $countSql;
          $customerList = M()->query($querySql); 
          $result = array();
          $result['code'] = 0;
          $result['msg'] = "";
          $result['count'] = $count[0]['total'];
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
    public function pWeeklyAdd($pro_code,$weekly_code,$weekly_name,$plan_code,$stage,$pro_schedule,$founder_id,$upWeeklyList,$weeklyList,$nextWeeklyList){


        $app_project_weekly = M("app_project_weekly"); // 实例化周报任务对象
        $app_weekly_task = M("app_weekly_task"); // 实例化周报明细对象
        $weeklyID = '';
        //判断是否是本项目第一次添加任务
        if ($weekly_code) {
           
             //修改周报任务
            $data['stage'] = $stage;
            $data['pro_schedule'] = $pro_schedule;
            $app_project_weekly->where('weekly_id', $weekly_code)->update($data);

            if ($upWeeklyList) {
                # update
                for ($i=0; $i < count($upWeeklyList); $i++) { 
                   
                         //修改周报任务明细

                        $detailed['completion_rate'] = $weeklyList[$i]['cRate'];
                        $detailed['work_state'] = $weeklyList[$i]['wState'];
                        $detailed['remarks'] = $weeklyList[$i]['remarks'];
                        $weeklyDetailedResult = $app_weekly_task->where('task_id', $weeklyList[$i]['taskId'])->update($detailed);

                }
            }

            // 1,查询上周未完成的明细任务 状态为 进行中的并且isextends状态为空
            $unFinish = $app_weekly_task ->where('work_state','=',0) ->where('isextends','=',0)->select(); 

            // 2,合并  步骤1 查询出来的数据 到 $weeklyList  
            $weeklyList = array_merge($weeklyList,$unFinish);
            // print_r(array_merge($a1,$a2));

            // 3,数据合并完成后将 步骤1 查询出来的数据  isextends状态更改为已继承
            if ($unFinish) {
                    for ($i=0; $i < count($unFinish); $i++) { 
                   
                        $detailed['isextends'] = 1;
                        $detailed['isthisweek'] = 1;
                        $unFinishUpdateResult = $app_weekly_task->where('task_id', $unFinish[$i]['task_id'])->update($detailed);
                    }
            }

            if ($weeklyList) {
                    for ($i=0; $i < count($weeklyList); $i++) { 
                       
                             //插入周报任务明细
                            $detailed['weekly_id'] = $weekly_code;
                            $detailed['pro_code'] = $pro_code;
                            $detailed['completion_rate'] = $weeklyList[$i]['cRate'];
                            $detailed['work_content'] = $weeklyList[$i]['wContent'];
                            $detailed['work_state'] = $weeklyList[$i]['wState'];
                            $detailed['isthisweek'] = $weeklyList[$i]['isthisweek'];
                            $detailed['remarks'] = $weeklyList[$i]['remarks'];
                            $detailed['founder_id'] = $founder_id;
                            $weeklyDetailedResult = $app_weekly_task->add($detailed);

                    }
            }

            //下周一
            $next1 = date('Y-m-d', strtotime('+1 monday', time())); //无论今天几号,+1 monday为下一个有效周未

            //下周日
            // $next7 = date('Y-m-d', strtotime('last Sunday')); //下一个有效周日,同样适用于其它星期
            $next7 = date("Y-m-d",strtotime("+7 day",strtotime("next Sunday")));
            //插入下周报任务
            $data2['pro_code'] = $pro_code;
            $data2['weekly_name'] = $next1.'_'.$next7;
            $data2['plan_code'] = $plan_code;
            $data2['weekly_stime'] = $next1;
            $data2['weekly_etime'] = $next7;
            $data2['stage'] = $stage;
            $data2['pro_schedule'] = $pro_schedule;
            $data2['founder_id'] = $founder_id;
            $weeklyID2 = $app_project_weekly->add($data2);

            if ( !empty($weeklyID2) && !empty($nextWeeklyList)) {
                    for ($i=0; $i < count($nextWeeklyList); $i++) { 
                       
                             //插入周报任务明细
                            $detailed2['weekly_id'] = $weeklyID2;
                            $detailed2['pro_code'] = $pro_code;
                            $detailed2['work_content'] = $nextWeeklyList[$i];
                            $detailed2['founder_id'] = $founder_id;
                            $weeklyDetailedResult = $app_weekly_task->add($detailed2);

                    }
            }

        }else{

                //本周一
                $this1 = date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)); //w为星期几的数字形式,这里0为周日

                //本周日
                $this7 = date('Y-m-d', (time() + (7 - (date('w') == 0 ? 7 : date('w'))) * 24 * 3600)); //同样使用w,以现在与周日相关天数算

                 //下周一
                $next1 = date('Y-m-d', strtotime('+1 monday', time())); //无论今天几号,+1 monday为下一个有效周未

                //下周日
                // $next7 = date("Y-m-d",strtotime("+7 day",strtotime("next Sunday"))); //下一个有效周日,同样适用于其它星期
                $next7 = date("Y-m-d",strtotime("+7 day",strtotime("next Sunday")));
                
                //插入本周报任务
                $data1['pro_code'] = $pro_code;
                $data1['weekly_name'] = $this1.'_'.$this7;
                $data1['plan_code'] = $plan_code;
                $data1['weekly_stime'] = $this1;
                $data1['weekly_etime'] = $this7;
                $data1['stage'] = $stage;
                $data1['pro_schedule'] = $pro_schedule;
                $data1['founder_id'] = $founder_id;
                $weeklyID1 = $app_project_weekly->add($data1);
                if ( !empty($weeklyID1) && !empty($weeklyList)) {
                        for ($i=0; $i < count($weeklyList); $i++) { 
                           
                                 //插入周报任务明细
                                $detailed1['weekly_id'] = $weeklyID1;
                                $detailed1['pro_code'] = $pro_code;
                                $detailed1['completion_rate'] = $weeklyList[$i]['cRate'];
                                $detailed1['work_content'] = $weeklyList[$i]['wContent'];
                                $detailed1['work_state'] = $weeklyList[$i]['wState'];
                                $detailed1['remarks'] = $weeklyList[$i]['remarks'];
                                $detailed1['founder_id'] = $founder_id;
                                $weeklyDetailedResult = $app_weekly_task->add($detailed1);

                        }
                }

                //插入下周报任务
                $data2['pro_code'] = $pro_code;
                $data2['weekly_name'] = $next1.'_'.$next7;
                $data2['plan_code'] = $plan_code;
                $data2['weekly_stime'] = $next1;
                $data2['weekly_etime'] = $next7;
                $data2['stage'] = $stage;
                $data2['pro_schedule'] = $pro_schedule;
                $data2['founder_id'] = $founder_id;
                $weeklyID2 = $app_project_weekly->add($data2);

                if ( !empty($weeklyID2) && !empty($nextWeeklyList)) {
                        for ($i=0; $i < count($nextWeeklyList); $i++) { 
                           
                                 //插入周报任务明细
                                $detailed2['weekly_id'] = $weeklyID2;
                                $detailed2['pro_code'] = $pro_code;
                                $detailed2['work_content'] = $nextWeeklyList[$i];
                                $detailed2['founder_id'] = $founder_id;
                                $weeklyDetailedResult = $app_weekly_task->add($detailed2);

                        }
                }

        }
        
    }


    /**
     * 周报查询
     * @author song.chaoxu
     * 2018.01.11
     */
    public function weeklyResult($pro_code){

        $app_project_weekly = M("app_project_weekly"); // 实例化周报任务对象
        $app_weekly_task = M("app_weekly_task"); // 实例化周报明细对象


        $weeklyList = $app_project_weekly->where('pro_code',$pCode)
                    ->order('weekly_stime desc')->limit(2)->select();


        $thisWeek = array();
        $nextWeek = array();
        if ($weeklyList) {
            $thisWeekList = $app_weekly_task->where('pro_code',$pCode)
                                  ->where('work_state','=',0) 
                                  ->where('weekly_id','=',$weeklyList[1]['weekly_id'])
                                  ->select();
            $nextWeekList = $app_weekly_task->where('pro_code',$pCode)
                      ->where('work_state','=',0) 
                      ->where('weekly_id','=',$weeklyList[0]['weekly_id'])
                      ->select();

            $thisWeek = array('weekMission' => $weeklyList[1],'weeklyTaskList' => $thisWeekList);
            $nextWeek = array('weekMission' => $weeklyList[0],'weeklyTaskList' => $nextWeekList);
        }
        
        $result = array('thisWeek' => $thisWeek,'nextWeek' => $nextWeek);

        return $result;

    }

}
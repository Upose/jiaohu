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
    public function riskResult($pro_code){

        $app_project_risk = M("app_project_risk"); // 实例化对象
        $result = $app_project_risk->where('pro_code',$pCode)->find();
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


}
<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemImplementModel;

  /**
    *项目执行管理阶段
    *@author song.chaoxu
    *2018.01.02
    */
class ItemImplementController extends BaseController {

    /**
     * 输出首页
     * @author song.chaoxu
     * 2018.11.14
     */
    public function index()
    {

        $this->display();
        
    }

    
    /**
     * 风险新增下拉信息
     * @author song.chaoxu
     * 2019.01.06
     */
    public function riskDropResult(){

        //以下是所有下拉框列表
        //项目所属阶段 - 页面下拉项内容
        $pStaus=$this->pStaus=
        ItemImplementModel::pStaus();
        var_dump($pStaus);die;

        //风险类别 - 页面下拉项内容
        $rType=$this->rType=
        ItemImplementModel::rType();
        var_dump($rType);die;
        $final['pStaus'] = $pStaus;
        $final['rType'] = $rType;
        $this->Response(200,$final,'');

    }

    /**
     * 风险新增
     * @author song.chaoxu
     * 2019.01.07
     */
    public function riskAdd(){

        //項目编号
        $pro_code = I('pCode');

        //項目所属阶段
        $pro_stage = I('stage');

        //項目风险内容
        $risk_content = I('rContent');

        //风险类别
        $risk_type = I('rType');

        //风险等级
        $level = I('level');

        //风险结果
        $consequence = I('consequence');

        //创建人
        $founder_id = I('founder_id');

        $addStaus = $this->result=
        ItemImplementModel::riskAdd($pro_code,$pro_stage,$risk_content,$risk_type,$level,$consequence,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }


    /**
     * 风险查询
     * @author song.chaoxu
     * 2019.01.07
     */
    public function riskResult(){

        //項目编号
        $pro_code  = I('pCode');
        $page = I('page');
        $limit = I('limit');

        $riskResult = $this->result=
        ItemImplementModel::riskResult($pro_code,$page,$limit);
        
        $result_json = json_encode($riskResult);
        echo $result_json;

    }


    /**
     * 周报查询
     * @author song.chaoxu
     * 2019.01.07
     */
    public function weeklyResult(){

        //項目编号
        $pro_code = I('pCode');
 
        $weeklyResult = $this->result=
        ItemImplementModel::weeklyResult($pro_code);
        
        $this->Response(200,$weeklyResult,'');

    }

    /**
     * 事件新增下拉信息
     * @author song.chaoxu
     * 2019.01.06
     */
    public function eventDropResult(){

        //以下是所有下拉框列表
        //项目所属阶段 - 页面下拉项内容
        $pStaus=$this->pStaus=
        ItemImplementModel::pStaus();

        //风险类别 - 页面下拉项内容
        $eType=$this->eType=
        ItemImplementModel::eType();

        $final['pStaus'] = $pStaus;
        $final['eType'] = $eType;
        $this->Response(200,$final,'');

    }

    /**
     * 事件新增
     * @author song.chaoxu
     * 2019.01.07
     */
    public function eventAdd(){


        //項目编号
        $pro_code = I('pCode');

        //項目所属阶段
        $pro_stage = I('stage');

        //事件名称
        $event_name = I('event_name');

        //事件类型
        $event_type = I('event_type');

        //事件内容
        $event_content = I('event_content');

        //事件级别
        $level  = I('level');

        //事件发生时间
        $happen_time  = I('happen_time');

        // 附件
        $enclosure = I('filepath');

        //备注
        $remarks = I('remarks');

        //创建人
        $founder_id = I('founder_id');

        $addStaus = $this->result=
        ItemImplementModel::eventAdd($pro_code,$pro_stage,$event_name,$event_type,$event_content,$level,$happen_time,$enclosure,$remarks,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }


    /**
     * 会议和周报新增下拉信息
     * @author song.chaoxu
     * 2019.01.06
     */
    public function meetingDropResult(){

        //以下是所有下拉框列表
        //项目所属阶段 - 页面下拉项内容
        $pStaus=$this->pStaus=
        ItemImplementModel::pStaus();

        $this->Response(200,$pStaus,'');

    }

    /**
     * 会议新增
     * @author song.chaoxu
     * 2019.01.07
     */
    public function meetingAdd(){


        //項目编号
        $pro_code = I('pCode');

        //項目所属阶段
        $pro_stage = I('stage');

        //会议形式 1内部会议/2客户会议
        $meeting_mode = I('meeting_mode');

        //会议级别 （普通、重要）
        $meeting_level = I('meeting_level');

        //会议主题
        $theme = I('theme');

        //会议时间
        $meeting_time  = I('meeting_time');

        //会议地点
        $address  = I('address');

        //内部参会人员
        $inside = I('inside');

        //外部参会人员
        $external = I('external');

        //会议内容
        $content = I('content');

        //创建人
        $founder_id = I('founder_id');

        // 附件
        $enclosure = I('filepath');


        $addStaus = $this->result=
        ItemImplementModel::meetingAdd($pro_code,$pro_stage,$meeting_mode,$meeting_level,$theme,$meeting_time,$address,$inside,$external,$content,$founder_id,$enclosure);
        
        $this->Response(200,$addStaus,'');

    }



    /**
     * 会议查询
     * @author song.chaoxu
     * 2019.01.26
     */
    public function meetingList()
    {

      
        //項目编号
        $pro_code = I('pCode');
        $page = I('page');
        $limit = I('limit');

        $meetingList = $this->result=
        ItemImplementModel::meetingList($pro_code,$page,$limit);
                
        $result_json = json_encode($meetingList);
        echo $result_json;

    }


    /**
     * 会议查询
     * @author song.chaoxu
     * 2019.01.26
     */
    public function eventList()
    {

      
        //項目编号
        $pro_code = I('pCode');
        $page = I('page');
        $limit = I('limit');

        $eventList = $this->result=
        ItemImplementModel::eventList($pro_code,$page,$limit);
                
        $result_json = json_encode($eventList);
        echo $result_json;

    }


    /**
     * 周报新增
     * @author song.chaoxu
     * 2019.01.11
     */

    public function weeklyAdd(){

         //項目编号
        $pro_code = I('pCode');

        $weekly_code = I('wCode','');

        //计划编号
        $plan_code = I('plan_code');


        //所属阶段
        $stage  = I('stage');

        //阶段进度
        $pro_schedule  = I('pro_schedule');

        //创建人
        $founder_id = I('founder_id');

        $newList = array();
        // 周报任务明细列表
        $upWeeklyList = I('upWeeklyList',$newList);
        // [taskId,cRate,wContent,wState,remarks]

        $weeklyList = I('weeklyList',$newList);
        // [cRate,wContent,wState,remarks]

        $nextWeeklyList = I('nextWeeklyList');


        $addStaus = $this->result=
        ItemImplementModel::pWeeklyAdd($pro_code,$weekly_name,$plan_code,$stage,$pro_schedule,$founder_id,$upWeeklyList,$weeklyList,$nextWeeklyList);
       
        $this->Response(200,$addStaus,'');

    }


    function upload(){

                if ($_FILES) {
            // echo ($_FILES["file"][size] / 1024)."kb";

              foreach ($_FILES as $key => $value) {
                //实例化上传类
                $upload =  new \Think\Upload();
                //设置附件上传大小
                // $upload->maxSize=3145728;
                //保持文件名不变
                $upload->saveName = time()."dt".rand(0,10);
                //设置附件上传类型
                // $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt');
                //设置附件上传根目录
                $upload->rootPath = './Updata/MeetingFile/'; 
                //设置附件上传（子）目录
                $upload->savePath = '';
                $result = $upload->upload();
                // echo '<pre>';
                // var_dump($result);
                // echo '</pre>';
                // file_put_contents("11114.txt", json_encode($result));
                if($result){
                  foreach ($result as $key => $value) {
                    $savename  = $pro_code.'_'.$value['savename'];
                    $path  = "/Updata/MeetingFile/".$value['savepath'];
                    $enclosure = $newpath = $path.$savename;
                    $href[] = $newpath;
                    // echo $filePath."|_____________________path";
                                    
                  }
                }
                  
              }

            }
    }

    


}
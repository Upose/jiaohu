<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectWeeklyModel;

class ProjectWeeklyController extends BaseController
{

	/**
     *输出首页
     *@author fang.yu
     *2018.8.28
     */
    public function index()
    {
      
    	$this->display();
    	
    }

    /**
     *时间输出
     *@author fang.yu
     *2018.8.28
     */
    public function getCurryDate()
    {
      
        //自定义的获取时间函数
        $date = $this->getTime();

        //开始时间、默认本周第一天日期
        $start_time = $date['start'];

        //结束时间、默认本周最后一天日期
        $end_time = $date['end'];

        //当前周数
        $week_num = (int)$date['week'];

        //当前年份
        $year = $date['year'];

         $date = $year."年 第".$week_num."周"."</br>"
        .$start_time."至".$end_time;

         $this->Response(0,$date,'');
    
    }

	/**
     *新增周报的项目阶段下拉框接口
     *@author fang.yu
     *2018.8.28
     */
    public function projectStage()
    {

    	$project_id = I('project_id');
    	
    	$res=$this->res=
    	ProjectWeeklyModel::
        projectStage($project_id);

         $this->Response(0,$res,'');
    }


    /**
     *新增项目周报接口
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyAdd()
    {
        $user_id=$_SESSION['user_id'];
        $res=$this->res= ProjectWeeklyModel::showid($user_id);
        //var_dump($res[0]['name']);die;
        if($res[0]['name']==='项目经理'){
                //项目id
                $project_id = I('project_id');

                //名称
                $name = I('name');

                //周报类型 1项目 2个人
                $type = 1;

                //上周内容
                $last_week_content = I('last_week_content');

                //本周计划
                $this_week_plan = I('this_week_plan');

                //项目进度
                $percentage = I('percentage');

                //项目阶段id
                $stage_id = I('stage_id');

                //项目进度说明
                $project_explain = I('project_explain');

                //自定义的获取时间函数
                $date = $this->getTime();

                //开始时间、默认本周第一天日期
                $start_time = $date['start'];

                //结束时间、默认本周最后一天日期
                $end_time = $date['end'];

                //当前周数
                $week_num = (int)$date['week'];

                $res=$this->res=
                ProjectWeeklyModel::
                weeklyAdd($project_id,$name,$type,
                $last_week_content,$this_week_plan,
                $percentage,$project_explain,
                $start_time,$end_time,$week_num,$stage_id);
                if($res===0){
                    $this->Response(0,'添加成功','');
                }else{
                    $this->Response(1,'添加失败','');
                    }       
        }else{
                //项目id
                $project_id = I('project_id');
                
                //名称
                $name = I('name');

                //周报类型 1项目 2个人
                $type = 2;

                //上周内容
                $last_week_content = I('last_week_content');

                //本周计划
                $this_week_plan = I('this_week_plan');

                $percentage = '';
                $project_explain = '';
                $stage_id = null;

                //自定义的获取时间函数
                $date = $this->getTime();

                //开始时间、默认本周第一天日期
                $start_time = $date['start'];

                //结束时间、默认本周最后一天日期
                $end_time = $date['end'];

                //当前周数
                $week_num = (int)$date['week'];

                $res=$this->res=
                ProjectWeeklyModel::
                weeklyAdd($project_id,$name,$type,
                $last_week_content,$this_week_plan,
                $percentage,$project_explain,
                $start_time,$end_time,$week_num,$stage_id);
                if($res===0){
                    $this->Response(0,'添加成功','');
                }else{
                    $this->Response(1,'添加失败','');
                    }       

        }
        

    }


    /**
     *项目周报列表接口
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyList()
    {
        //项目id
        $project_id = I('project_id');
        //自定义的获取时间函数
        $date = $this->getTime();

        //开始时间、默认本周第一天日期
        $start_time = $date['start'];

        //结束时间、默认本周最后一天日期
        $end_time = $date['end'];

        //当前周数
        $week_num = (int)$date['week'];

        //当前年份
        $year = $date['year'];

        //页数
        $page=intval(I('page'));
        $pag=($page-1)*10;
        
        $res=$this->res=
        ProjectWeeklyModel::
        weeklyList($project_id,$week_num,$pag);

        for($i = 0;$i<count($res);$i++)
        {
            $res[$i]['week'] = 
            "第".$res[$i]['week']."周";
            $res[$i]['percentage'] = 
            $res[$i]['percentage']."%";
           
        }
        
        $date = $year."年 第".$week_num."周"."</br>"
        .$start_time."至".$end_time;

       $response = array('data' => $res ,'date' => $date);

        $this->ajaxReturn($response);
    }


    /**
     *新增个人周报接口
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyPersonAdd()
    {
        //项目id
        $project_id = I('project_id');
        
        //名称
        $name = I('name');

        //周报类型 1项目 2个人
        $type = 2;

        //上周内容
        $last_week_content = I('last_week_content');

        //本周计划
        $this_week_plan = I('this_week_plan');

        $percentage = '';
        $project_explain = '';
        $stage_id = null;

        //自定义的获取时间函数
        $date = $this->getTime();

        //开始时间、默认本周第一天日期
        $start_time = $date['start'];

        //结束时间、默认本周最后一天日期
        $end_time = $date['end'];

        //当前周数
        $week_num = (int)$date['week'];

        $res=$this->res=
        ProjectWeeklyModel::
        weeklyAdd($project_id,$name,$type,
        $last_week_content,$this_week_plan,
        $percentage,$project_explain,
        $start_time,$end_time,$week_num,$stage_id);

    }

    /**
     *周报详情接口
     *@author fang.yu
     *2018.8.28
     */
    public function weeklyDetails()
    {

        //项目id
        $project_id = I('project_id');
        //该项目所有成员
        $projectMember=
        $this->res=
        ProjectWeeklyModel::
        projectMember($project_id);
        $this->Response(0,$projectMember,'');
       
    }


}
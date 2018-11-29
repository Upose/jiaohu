<?php
/**
 * Created by PhpStorm.
 * User: wangyao
 * Date: 2018/11/26
 * Time: 上午10:45
 */
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectweekReportModel;

/**
 *周报管理控制器
 *@author fang.yu
 *2018.8.27
 */
class ProjectweekReportController extends BaseController
{
    public function test()
    {
        $now='2018-12-02';
        echo '本周五是'.date('Y-m-d',strtotime("Sunday -2 day",strtotime($now))).'<br/>';
        echo '下周五是'.date('Y-m-d',strtotime('Sunday +5 day',strtotime($now))).'<br/>';
        echo '本周一是'.date('Y-m-d',strtotime('Sunday -6 day', strtotime($now))).'<br/>';
        echo '下周一是'.date('Y-m-d',strtotime('Sunday +1 day',strtotime($now))).'<br/>';

        $date=date('Y-m-d',strtotime("this Friday", strtotime($now)));
//        echo '下周一是'.date('Y-m-d', strtotime('+1week last monday', strtotime($now))).'<br/>';
//        var_dump($date);
        die;
    }
    //项目周报和周报任务新增接口
    public function weekInsert()
    {
        //$weekly_stime=I();
        //var_dump($_POST);
        //var_dump($_POST['thisWorkData']);die;
        $workInfo=I('post.workInfo','','htmlspecialchars');
        $thisWorkData=I('post.thisWorkData','','htmlspecialchars');
        $nextWorkData=I('post.nextWorkData','','htmlspecialchars');
        //var_dump($workInfo,$thisWorkData,$nextWorkData);die;
        $res=D('ProjectweekReport')->weekInsert($workInfo,$thisWorkData,$nextWorkData);
        if($res){
            return true;
        }else{
            return false;
        }
        //var_dump($res);die;
        /*//基本信息
        $basicdata['weekly_stime']='周报开始日期';
        $basicdata['weekly_etime']='结束日期';
        $basicdata['pro_name']='项目名称';
        $basicdata['stage']='所属阶段';
        $basicdata['pro_schedule']='工作进度';
        $basicdata['stageenddate']='阶段任务截止日期';
        //本周工作内容
        $weekdata['weekly_id'][]='序号';
        $weekdata['task_content'][]='工作描述';
        $weekdata['finish_status'][]='完成率';
        $weekdata['finish_content'][]='完成内容';
        $weekdata['state'][]='状态';
        $weekdata['remark'][]='备注';
        //下周工作计划
        $nextdata['weekly_id'][]='序号';
        $nextdata['task_content'][]='工作描述';
        $nextdata['finish_plan'][]='计划完成';
        var_dump($basicdata,$weekdata,$nextdata);*/
    }
}
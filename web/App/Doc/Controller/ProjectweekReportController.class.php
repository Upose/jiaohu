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

    //项目周报和周报任务新增接口
    public function weekInsert()
    {
        $workInfo=I('post.workInfo','','htmlspecialchars');
        $thisWorkData=I('post.thisWorkData','','htmlspecialchars');
        $nextWorkData=I('post.nextWorkData','','htmlspecialchars');
        $res=D('ProjectweekReport')->weekInsert($workInfo,$thisWorkData,$nextWorkData);
        if($res){
            return true;
        }else{
            return false;
        }

    }
}
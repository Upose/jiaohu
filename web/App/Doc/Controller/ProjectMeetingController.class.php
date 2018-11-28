<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectMeetingModel;

/**
*项目会议控制器
*@author song.chaoxu
*2018.11.24
*/
class ProjectMeetingController extends BaseController {

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
     * 会议新增 + 項目附件上传
     * @author song.chaoxu
     * 2018.11.20
     */
    public function meetingAdd()
    {
        //会议主题
        $mTheme = I('mTheme');

        //所属项目
        $proId = I('proId');

        //会议地点
        $mAddress = I('mAddress');

        //会议级别
        $mLevel = I('mLevel');

        //会议时间
        $mTime = I('mTime');

        //项目所处阶段
        $mStage = I('mStage');

        //会议形式
        $mForm = I('mForm');

        //参会人员 -内部
        $joinPersionOut = I('joinPersionOut');

        //参会人员 -内部
        $joinPersionIn = I('joinPersionIn');

        //会议内容
        $mContent = I('mContent');

        //创建人ID
        $mCreatePersion = I('mCreatePersion');

        //会议附件
        $filePath = '';

        // $file=$_FILES['photo'];
        $filename=$file['name'];//客户端原文件名称，用于数据库保存文件名称
//         $file['name'] = iconv('UTF-8','GBK', $file['name']);//转换格式，以免出现中文乱码情况
        // echo $filename;
        // echo $_FILES["file"][type];

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
            // $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt','doc');
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
                $savename  = $value['savename'];
                $path  = "/Updata/MeetingFile/".$value['savepath'];
                $filePath = $newpath = $path.$savename;
                $href[] = $newpath;
                // echo $filePath."|_____________________path";
                                
              }
            }
              
          }

        }
        $status=$this->status=
            ProjectMeetingModel::meetingAdd($mTheme,$proId,$mAddress,$mLevel,$mTime,$mStage,$mForm,$joinPersionOut,$joinPersionIn,$mContent,$mCreatePersion,$filePath);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }

    /**
     * 会议下拉选项
     * @author song.chaoxu
     * 2018.11.24
     */
    public function meetingDropOption()
    {
        
        $projectManagerId = I('get.pMid');

        echo $projectManagerId." ← | get.projectManagerId|";

        $projectList=$this->projectList=
        ProjectMeetingModel::projectList($projectManagerId);

        //项目所处阶段 - 页面下拉项内容
        $stageList=$this->stage=
        ProjectMeetingModel::stageList();

        $final['stageList'] = $stageList;
        $final['projectList'] = $projectList;

        $this->Response(200,$final,'');
    }


    /**
     * 会议列表
     * @author song.chaoxu
     * 2018.11.24
     */
    public function meetinglist()
    {
        
        $pMid = I('get.pMid');
        // echo $pMid;
        echo $pMid." ← | get.pMid|";

        //所有会议列表
        $meetingList=$this->meetingList=
        ProjectMeetingModel::meetingList($pMid);
        
        $this->Response(200,$meetingList,'');

    }


    // public function mtest()
    // {
        
    //     $projectManagerId = I('get.pMid');

    //     echo $projectManagerId;

    // }



}
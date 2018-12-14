<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectDeliveryModel;

/**
*项目管理 - 实施交付 控制器
*@author song.chaoxu
*2018.11.14
*/
class ProjectDeliveryController extends BaseController {

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
	 * 实施交付
	 * @author song.chaoxu
	 * 2018.11.14
	 */
    public function proDelivery()
    {

        //获取此人ID 查询此人负责的项目列表
        $projectManagerId = I('projectManagerId');

        // echo $_SESSION;
        // var_dump($_SESSION);

        $projectList=$this->projectList=
        ProjectDeliveryModel::projectList($projectManagerId);

	 	//以下是所有下拉框列表
    	//所有区域 - 页面下拉项内容
    	$areaRes=$this->area=
    	ProjectDeliveryModel::areaList();

        //UI框架 - 页面下拉项内容
        $uiFrame=$this->uiFrame=
        ProjectDeliveryModel::uiFrame();

        //JS框架 - 页面下拉项内容
        $jsFrame=$this->jsFrame=
        ProjectDeliveryModel::jsFrame();

        //后台框架 - 页面下拉项内容
        $backFrame=$this->backFrame=
        ProjectDeliveryModel::backFrame();

        //数据库框架 - 页面下拉项内容
        $databaseFrame=$this->databaseFrame=
        ProjectDeliveryModel::databaseFrame();

        $final['projectList'] = $projectList;
    	$final['area'] = $areaRes;
        $final['uiFrame'] = $uiFrame;
        $final['jsFrame'] = $jsFrame;
        $final['backFrame'] = $backFrame;
        $final['databaseFrame'] = $databaseFrame;
    	
      	$this->Response(200,$final,'');

    }



    public function dateTest()
    {

        $res1[0] = array("newdate"=> "2018-07",
            "levels"=> "一级",
            "total"=> "7");
        $res1[1]= array("newdate"=> "2018-06",
            "levels"=> "一级",
            "total"=> "6");


        // $res2 = [{
        //     "newdate": "2018-08",
        //     "levels": "二级",
        //     "total": "8"
        // },{
        //     "newdate": "2018-05",
        //     "levels": "二级",
        //     "total": "5"
        // }];

        // $arr1 = array('newdate'=>"苹果",'levels'=>"香蕉",'total'=>"菠萝");
        $result1 = array();
        $month_arr=array();
        $starttime = strtotime(date('Y-m-01 00:00:00',strtotime('-12 month'))); //获取前12个月  时间戳
        $endtime = mktime(0,0,0,date('m'),date('d'),date('Y')); //获取当前月 时间戳
        while(($starttime = strtotime('+1 month',$starttime)) <= $endtime){
                $month_arr[]= date('Y-m',$starttime); // 取得递增月; 
                // echo date('Y-m',$starttime)." | ";
                // print_r($month_arr);
        }
        for($i=0;$i<count($month_arr);++$i){

            $result1[$i]["newdate"] = $month_arr[$i];
            $result1[$i]["levels"] = '一级';
            $result1[$i]["total"] = 0;
            for ($j=0; $j < count($res1); ++$j) { 
                if ($month_arr[$i] == $res1[$j]["newdate"]) {
                    $result1[$i]["total"] = $res1[$j]["total"];
                }
            }
        }

        print_r($result1);


        
    }

    /**
     * 获取交付部 部门列表
     * @author song.chaoxu
     * 2018.11.30
     */
    public function addPersionDropOperation()
    {

        //部门下拉
        $department=$this->department=
        ProjectDeliveryModel::getDepartment();


        //职位下拉
        $postName=$this->postName=
        ProjectDeliveryModel::getPostName();

        $final['department'] = $department;
        $final['postName'] = $postName;
        
        $this->Response(200,$final,'');

    }


    /**
     * 根据部门列表 查询部门下的人员
     * @author song.chaoxu
     * 2018.11.30
     */
    public function departmentPersion()
    {
        $departmentName = I('departmentName');

        //数据库框架 - 页面下拉项内容
        $departmentPersion=$this->departmentPersion=
        ProjectDeliveryModel::getdepartmentPersion($departmentName);
        
        $this->Response(200,$departmentPersion,'');

    }


    /**
     * 查询此人负责的项目实施交付信息
     * @author song.chaoxu
     * 2018.12.01
     */
    public function projectDeliveryContent()
    {
        
        //获取此人ID  查询此人负责的项目实施交付信息
        $projectManagerId = I('projectManagerId');

        $projectDeliveryContent=$this->projectDeliveryContent=
        ProjectDeliveryModel::projectDeliveryContent($projectManagerId);
        
        $this->Response(200,$projectDeliveryContent,'');

    }

    /**
     * 根据部门列表 查询部门下的人员
     * @author song.chaoxu
     * 2018.11.30
     */
    public function projectPersion()
    {
        $projectId = I('projectId');

        $projectPersion=$this->projectPersion=
        ProjectDeliveryModel::projectPersion($projectId);
        
        $this->Response(200,$projectPersion,'');

    }



    /**
     * 实施交付新增 
     * @author song.chaoxu
     * 2018.11.20
     */
    public function proDeliveryAdd()
    {
        //项目编号
        $proId = I('proId');

        //項目名稱
        $proName = I('proName');

        //施工地点
        $proArea = I('proArea');

        //UI框架
        $uiFrame = I('uiFrame');

        //web框架
        $jsFrame = I('jsFrame');

        //后台开发语言
        $backFrame = I('backFrame');

        //数据库
        $databaseFrame = I('databaseFrame');

        //干系人
        $stakeHolder = I('stakeHolder');

        //是否验收
        $whether_ys = I('whether_ys');

        //验收时间
        $ys_date = I('ys_date');

        //人员释放
        $persionRelease = I('persionRelease');

        
        $status=$this->status=
            ProjectDeliveryModel::proDeliveryAdd($proId,$proName,$proArea,$uiFrame,$jsFrame,$backFrame,$databaseFrame,$stakeHolder,$whether_ys,$ys_date,$persionRelease);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }



    /**
     * 实施交付人员新增 
     * @author song.chaoxu
     * 2018.11.30
     */
    public function proDeliveryPersionAdd()
    {

        //项目ID
        $proId = I('proId');

        //项目名称
        $proName = I('proName');

        //人员ID
        $persionId = I('persionId');

        //人员姓名
        $persionName = I('persionName');

        //职位类型
        $jobType = I('jobType');

        //到岗时间
        $inTime = I('inTime');


        
        $status=$this->status=
            ProjectDeliveryModel::proDeliveryPersionAdd($proId,$proName,$persionId,$persionName,$jobType,$inTime);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }


}
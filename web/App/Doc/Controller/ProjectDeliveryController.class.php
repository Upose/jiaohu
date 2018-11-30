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
     * 实施交付新增 
     * @author song.chaoxu
     * 2018.11.20
     */
    public function proDeliveryAdd()
    {
        //项目编号
        $pro_id = I('pro_id');

        //項目名稱
        $pro_name = I('pro_name');

        //保密等级
        $rank = I('rank');

        //创建时间
        $createTime = I('createTime');

        //立项信息
        $lxMsg = I('lxMsg');

        //所在区域
        $area = I('area');

        //合作单位
        $cooperativeUnit = I('cooperativeUnit');

        //项目性质
        $projectNature = I('projectNature');

        //所在行业
        $industry = I('industry');

        //部门经理
        $divisionManager = I('divisionManager');

        //部门经理ID
        $divisionManagerId = I('divisionManagerId');

        //项目经理
        $projectManager = I('projectManager');

        //项目经理ID
        $projectManagerId = I('projectManagerId');

        //合同额(元)
        $contractAmount = I('contractAmount');

        //是否合同
        $typeId = I('typeId');

        // 项目周期（开始时间）
        $projectStime = I('projectStime');

        // 项目周期（结束时间）
        $projectEtime = I('projectEtime');

        // 项目介绍
        $projectIntroduce = I('projectIntroduce');

        //项目附件 - 合同
        $filePath = '';

        // $file=$_FILES['photo'];
//         $filename=$file['name'];//客户端原文件名称，用于数据库保存文件名称
//         $file['name'] = iconv('UTF-8','GBK', $file['name']);//转换格式，以免出现中文乱码情况
// 
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
            // $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt');
            //设置附件上传根目录
            $upload->rootPath = './Updata/UpdateFile/'; 
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
                $path  = "/Updata/UpdateFile/".$value['savepath'];
                $filePath = $newpath = $path.$savename;
                $href[] = $newpath;
				// echo $filePath."|_____________________path";
								
              }
            }
              
          }

        }
        $status=$this->status=
            ProjectRegistrationModel::projectAdd($pro_id,$pro_name,$typeId,$industry,$projectManager,$projectManagerId,$projectStime,$projectEtime,$area,$rank,$createTime,$filePath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManager,$divisionManagerId,$contractAmount,$projectIntroduce);
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
        //人员ID
        $persionId = I('persionId');

        //人员姓名
        $persionName = I('persionName');

        //人员类型： 0内部人员 , 1外部人员
        $memberType = I('memberType');

        //人员类型： 0内部人员 , 1外部人员
        $memberType = I('memberType');

        //到岗时间
        $inTime = I('inTime');


        
        $status=$this->status=
            ProjectDeliveryModel::proDeliveryPersionAdd($pro_id,$pro_name,$typeId,$industry,$projectManager,$projectManagerId,$projectStime,$projectEtime,$area,$rank,$createTime,$filePath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManager,$divisionManagerId,$contractAmount,$projectIntroduce);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }


}
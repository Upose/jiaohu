<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectRegistrationModel;

/**
*项目管理控制器
*@author song.chaoxu
*2018.11.14
*/
class ProjectRegistrationController extends BaseController {

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
	 * 项目登记
	 * @author song.chaoxu
	 * 2018.11.14
	 */
    public function projectRecord()
    {
        
	 	//以下是所有下拉框列表
    	//所有区域 - 页面下拉项内容
    	$areaRes=$this->area=
    	ProjectRegistrationModel::areaList();

        //所有行业 - 页面下拉项内容
        $industryResult=$this->projectindustry=
        ProjectRegistrationModel::projectIndustryList();

        //项目密级别 - 页面下拉项内容
        $rank=$this->rank=
        ProjectRegistrationModel::projectRankList();

        //项目性质 - 页面下拉项内容
        $projectNature=$this->projectNature=
        ProjectRegistrationModel::projectNature();

        //项目经理 - 页面下拉项内容
        $projectManager=$this->projectManager=
        ProjectRegistrationModel::projectManager();

        //部门经理 - 页面下拉项内容
        $divisionManager=$this->divisionManager=
        ProjectRegistrationModel::divisionManager();

    	$final['area'] = $areaRes;
        $final['industryResult'] = $industryResult;
        $final['rank'] = $rank;
        $final['projectManager'] = $projectManager;
        $final['divisionManager'] = $divisionManager;
        $final['projectNature'] = $projectNature;
    	
      	$this->Response(200,$final,'');

    }


    /**
     * 项目新增 + 項目附件上传
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd()
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
            $upload->rootPath = './Updata/ProjectFile/'; 
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
                $path  = "/Updata/ProjectFile/".$value['savepath'];
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
     * 项目查询
     * @author song.chaoxu
     * 2018.11.21
     */
    public function projectList()
    {

        //以下是所有下拉框列表
        //所有区域 - 页面下拉项内容
        $areaRes=$this->area=
        ProjectRegistrationModel::areaList();
        
        $temp = array();


        //区域
        $proArea = I('proArea','');
      
        //名称
        $proName = I('proName','');
       
        //页数
        $page=intval(I('page',1));

        //每页显示条数
        $limit=intval(I('limit',10));

        $pag=($page-1)*$limit;

        //项目列表
        $projectList=$this->projectList=
        ProjectRegistrationModel::projectList($proArea,$proName,$pag,$limit);


        $final['area'] = $areaRes;
        $final['projectList'] = $projectList;

        $this->Response(200,$final,'');

        
    }



//  ==========================================   以下接口为 2018/12/26 版   ==========================================

    /**
     * 项目下拉信息
     * @author song.chaoxu
     * 2018.12.26
     */
    public function projectDropResult()
    {
        
        //以下是所有下拉框列表
        //区域 - 页面下拉项内容
        $aResult=$this->aResult=
        ProjectRegistrationModel::aResult();

        //行业 - 页面下拉项内容
        $iResult=$this->iResult=
        ProjectRegistrationModel::iResult();

        //性质 - 页面下拉项内容
        $nResult=$this->nResult=
        ProjectRegistrationModel::nResult();

        //经理 - 页面下拉项内容
        $pResult=$this->pResult=
        ProjectRegistrationModel::pResult();

        //部门 - 页面下拉项内容
        $dResult=$this->dResult=
        ProjectRegistrationModel::dResult();

        //项目来源 - 页面下拉项内容
        $kResult=$this->kResult=
        ProjectRegistrationModel::kResult();

        $final['aResult'] = $aResult;
        $final['iResult'] = $iResult;
        $final['pResult'] = $pResult;
        $final['dResult'] = $dResult;
        $final['kResult'] = $kResult;
        $final['nResult'] = $nResult;
        
        $this->Response(200,$final,'');

    }



    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectMsgAdd()
    {
        //项目编号
        $pro_code = intval(time());

        //項目名稱
        $pro_name = I('pro_name');

        //项目来源
        $pro_source = I('pro_source'); 

         //项目经理
        $projectManager = I('projectManager');

        //项目经理ID
        $projectManagerId = I('projectManagerId');
   
        //项目性质
        $projectNature = I('projectNature');

        //所在行业
        $industry = I('industry_id');

        //部门ID
        $deptId = I('divisionManagerId');

        //所在区域
        $area = I('pro_address');

        //性质描述
        $natureType = I('natureType');


        // 项目介绍
        $projectIntroduce = I('projectIntroduce');


        $status=$this->status=
            ProjectRegistrationModel::projectMsgAdd($pro_code,$pro_name,$pro_source,$projectManager,$projectManagerId,$projectNature,$industry,$deptId,$area,$natureType,$projectIntroduce);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }






}
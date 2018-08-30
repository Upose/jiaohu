<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectEventModel;

class ProjectEventController extends BaseController
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
     *新增事件类型下拉框接口
     *@author fang.yu
     *2018.8.28
     */
    public function eventType()
    {
    	$res=$this->res=
	    ProjectEventModel::eventType();

    	$this->Response(0,$res,'');

    }

    /**
     *新增事件接口
     *@author fang.yu
     *2018.8.28
     */
    public function eventAdd()
    {

      	//事件名称
    	$name = I('name');

    	//项目id
    	$project_id = I('project_id');

    	//事件类型id
    	$type_id = I('type_id');

    	//提交人id
    	 $submit_person_id =$_SESSION['user_id'];

    	//开始时间
    	$start_time = I('start_time');

    	//结束时间
    	$end_time = I('end_time');

    	//我方人员
    	$we_person = I('we_person');

    	//甲方人员
    	$first_party_person = I('first_party_person');

    	//其他人员
    	$other_person = I('other_person');

    	//描述
    	$summary = I('summary');
        
	    $res=$this->res=
	    	ProjectEventModel::eventAdd($name,$project_id,
	    $type_id,$submit_person_id,$start_time,$end_time,
	    $we_person,$first_party_person,$other_person,$summary);
    	
    }
    //文件上传
    public function uploadFile(){
        
        $imgname = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        $filepath = 'Updata/Image/';
        $path=move_uploaded_file($tmp,$filepath.$imgname);
        if(!move_uploaded_file($tmp,$filepath.$imgname)){
            $this->Response(0,'上传失败','');
        }else{
            $res=$this->res=ProjectEventModel::uploadFile($path);
            $this->Response(0,'上传成功','');
        }
       


    }
    /**
     *事件列表接口
     *@author fang.yu
     *2018.8.28
     */
    public function eventList()
    {
    	//项目id
    	$project_id = I('project_id');
       
    	//页数
		$page=intval(I('page'));

		$pag=($page-1)*10;

		//起止时间
		$time1 =I('starTime');
		$time2 = I('endTime');

		//关键词
		$keywords = I('keywords');

	    $final=$this->final=
	    ProjectEventModel::eventList($project_id,
	    $pag,$time1,$time2,$keywords);

	    $response = array('data' => $final['data'],
	    'count' =>$final['count']);
        
    	$this->ajaxReturn($response);
    }

    /**
     *事件详情接口
     *@author fang.yu
     *2018.8.28
     */
    public function eventDetails()
    {
    	//事件id
    	$event_id = I('event_id');
    	
    	$res=$this->res=
	    ProjectEventModel::eventDetails($event_id);

	    $this->Response(0,$res,'');
    }


}
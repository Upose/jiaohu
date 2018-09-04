<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectEventModel;

/**
*重大事件控制器
*@author fang.yu
*2018.8.28
*/
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

        if($res){
            $_SESSION['event_id']=$res;
            $this->Response(0,'添加成功','');
            
        }else{
            $this->Response(1,'添加失败','');
        }       
    	
    }
    //新增事件文件上传
    public function uploadFile(){
        $project_id = I('project_id');
        $event_id=$_SESSION['event_id'];
        $arr=array();
        $fileArray = $_FILES['photo'];
        //var_dump($fileArray);die;
        $upload_dir= './Updata/Image/';
        foreach ($fileArray['name'] as $key =>$value){
                 //var_dump($fileArray['name']);die;
                $temp_name = $fileArray['tmp_name'][$key];
                $file_name = $fileArray['name'][$key];
                $path=$upload_dir.$file_name;
                $res=$this->res=ProjectEventModel::uploadFile(substr($path,1),$event_id,$file_name,$project_id);
                $boole=move_uploaded_file($temp_name,iconv("UTF-8", "gbk",$path));
                array_push($arr,$boole);
        }
        // var_dump($arr);die;
        foreach ($arr as $key => $value) {
            if(!$value){
               $this->Response(1,'上传失败','');
           }  
        }

        $this->Response(0,'上传成功','');

           

       
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

    //事件文件下载
    public function downLoad(){
        $event_id = I('event_id');
        $project_id = I('project_id');
        $res=$this->res=ProjectEventModel::downLoad($event_id,$project_id);
        $this->Response(0,$res,'');
    }





}
<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectDevelopmentModel;

class ProjectDevelopmentController extends BaseController{


	/**
     *输出首页
     *@author fang.yu
     *2018.8.27
     */
    public function index()
    {
      
    	$this->display();
    	
    }

    /**
     *开发信息列表接口
     *@author fang.yu
     *2018.8.27
     */
    public function developmentList()
    {
        //项目id
        $project_id = I('project_id');

        //在访问开发信息-技术使用时，
        //要先将有的信息显示在输入框中，再修改
        $technologyUse=$this->res=
        ProjectDevelopmentModel::technologyUseList($project_id);

        $thirdLibraryList=$this->res=
        ProjectDevelopmentModel::thirdLibraryList($project_id);

        $res['technologyUse'] = $technologyUse;
        $res['thirdLibraryList'] = $thirdLibraryList;
        
        $this->Response(0,$res,'');
        
    }


     /**
     *技术使用更新接口
     *@author fang.yu
     *2018.8.27
     */
    public function technologyUseUpdate()
    {
        //项目id
        $project_id = I('project_id');

        //前端技术
        $html_technology = I('html_technology');

        //后端技术
        $backend_technology = I('backend_technology');

        //数据库类型
        $database_type = I('database_type');

        //UML地址
        $uml_address = I('uml_address');

        //接口地址
        $interface_address = I('interface_address');

        //数据库地址
        $database_address = I('database_address');

        $res=$this->res=
        ProjectDevelopmentModel::technologyUseUpdate($project_id,
            $html_technology,$backend_technology,$database_type,
            $uml_address,$interface_address,$database_address);
        
    }


     /**
     *第三方库新增接口
     *@author fang.yu
     *2018.8.27
     */
    public function thirdLibraryAdd()
    {
        //项目id
        $project_id = I('project_id');

        //名称
        $name = I('name');

        //简要描述
        $summary = I('summary');

        //所属语言
        $language = I('language');

        //版本号
        $edition = I('edition');

        //下载分类
        $download_type = I('download_type');

        $res=$this->res=
        ProjectDevelopmentModel::thirdLibraryAdd($project_id,
        $name,$summary,$language,$edition,$download_type);
        
    }

    /**
     *第三方库修改接口
     *@author fang.yu
     *2018.8.27
     */
    public function thirdLibraryUpdate()
    {
        //项目id
        $project_id = I('project_id');

        //名称
        $name = I('name');

        //简要描述
        $summary = I('summary');

        //所属语言
        $language = I('language');

        //版本号
        $edition = I('edition');

        //下载分类
        $download_type = I('download_type');

       
        $res=$this->res=
        ProjectDevelopmentModel::thirdLibraryUpdate($project_id,
            $name,$summary,$language,$edition,$download_type);

    }


    


    /**
     *BUG新增接口
     *@author fang.yu
     *2018.8.27
     */
    public function bugAdd()
    {
        //项目id
        $project_id = I('project_id');
       
        //问题名称
        $name = I('name');
        
        //紧急程度
        $urgency = I('urgency');

        //描述
        $summary = I('summary');

        //处理人id
        $handle_person_id = I('handle_person_id');

        $project_bug_id=$this->res=
        ProjectDevelopmentModel::bugAdd($project_id,
        $name,$urgency,$summary,$handle_person_id);


        //上传附件
        $upload =  new \Think\Upload();// 实例化上传类

        //设置附件上传大小
        $upload->maxSize=3145728;
        //设置附件上传类型
        $upload->exts=array('jpg','gif','png','jpeg');
        //设置附件上传根目录
        $upload->rootPath = './Updata/'; 
        //设置附件上传（子）目录
        $upload->savePath = 'BugImage/'; 

        $info =  $upload->upload();

       
        if($info)
        {
            for($i = 0;$i<count($info);$i++)
            {
            
            $name  = $info[$i]['name'];
            $savename  = $info[$i]['savename'];
            $path  = "Updata/".$info[$i]['savepath'];
            $newpath = $path.$savename;
           
            $res=$this->res=
            ProjectDevelopmentModel::bugImageAdd(
            $name,$newpath,$project_bug_id);

            }
    
        }

    }


    /**
     *BUG列表接口
     *@author fang.yu
     *2018.8.27
     */
    public function bugList()
    {

        //项目id
        $project_id = I('project_id');
       
        //页数
        $page=intval(I('page'));
        $pag=($page-1)*10;

        $res=$this->res=
        ProjectDevelopmentModel::bugList($project_id,$pag);
    
        $this->Response(0,$res,'');

    }

     /**
     *处理BUG接口
     *@author fang.yu
     *2018.8.27
     */
    public function handleBug()
    {

        //BUGid
        $id = I('id');
     
        //BUG详情
        $details = $this->res=
        ProjectDevelopmentModel::bugDetails($id);

        //处理过程列表
        $processList = $this->res=
        ProjectDevelopmentModel::processList($id);

        for($i = 0;$i<count($processList);$i++)
        {
            $processList[$i]['handle_state'] = 
            $this->getHandleProcessTypeName(
            $processList[$i]['handle_state']);
        }

    }

}
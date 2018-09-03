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


        //提交时间
        $submit_time = date('Y-m-d',time());

        //提交人id
        $submit_person_id =$_SESSION['user_id'];

        //提交状态设置成未处理
        $state = 1;

        //新增bug
        $Model = D('project_bug');
        $data['id'] = '';
        $data['name'] = $name;
        $data['project_id'] = $project_id;
        $data['urgency'] = $urgency;
        $data['summary'] = $summary;
        $data['submit_time'] = $submit_time;
        $data['submit_person_id'] = $submit_person_id;
        $data['state'] = $state;
        $data['handle_person_id'] = $handle_person_id;

        //bug_id      
        $bug_id = $Model->add($data);
        $bug_id = (int)$bug_id;

      //每新增一个BUG，除了要在BUG表中添加，
        //还要在bug_handle表中添加提交信息
        $Model = D('bug_handle');
        $data['id'] = '';
        $data['bug_id'] = $bug_id;
        $data['handle_person_id'] = $submit_person_id;
        $data['handle_time'] = $submit_time;
        $data['handle_state'] = 1;
       
    
        $r = $Model->add($data);
      
        //上传附件
        $upload =  new \Think\Upload();// 实例化上传类

        //设置附件上传大小
        $upload->maxSize=3145728;
       
        //设置附件上传根目录
        $upload->rootPath = './Updata/'; 
        //设置附件上传（子）目录
        $upload->savePath = 'BugImage/'; 

        $info =  $upload->upload();
        file_put_contents("aaa.txt",json_encode($info));
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
            $name,$newpath,$bug_id);

            }
    
        }


     $this->redirect('ProjectDescription/test',array('id'=>$project_id));

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
     *BUG详情接口
     *@author fang.yu
     *2018.8.27
     */
    public function bugDetails()
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


        $final['details'] = $details;
        $final['processList'] = $processList;
      
        $this->ajaxReturn($final);

    }


    /**
     * BUG处理接口
     * @author fang.yu
     * 2018.8.24
     */
    public function bugHandle()
    {
        //bug单id
        $bug_id = I('id');
        
        //处理类型 1开始处理 2处理完成 3暂不处理 4确认完成
        $code = I('code');
        
        if($code == 1)
        {
            //开始处理的状态码
            $handle_state = 1;

            //将是否处理由未处理转变为正在处理
            $is_handle =2;

            $res=$this->res=
            ProjectDevelopmentModel::bugHandle($bug_id,
            $handle_state,$is_handle);
        }

        if($code == 2)
        {
            //处理完成的状态码
            $handle_state = 3;

            //将是否处理由未处理转变为正在处理
            $is_handle =2;

            $res=$this->res=
            ProjectDevelopmentModel::bugHandle($bug_id,
            $handle_state,$is_handle);
        }

        if($code == 3)
        {
           //暂不处理的状态码
            $handle_state = 5;

            //将是否处理仍然为未处理
            $is_handle =1;

            $res=$this->res=
            ProjectDevelopmentModel::bugHandle($bug_id,
            $handle_state,$is_handle);
        }

        if($code == 4)
        {
            //暂不处理的状态码
            $handle_state = 4;

            //将是否处理转变为处理完成
            $is_handle =3;

            $res=$this->res=
            ProjectDevelopmentModel::bugHandle($bug_id,
            $handle_state,$is_handle);
        }

        $res = 1;
        $this->ajaxReturn($res);
  
    }


     /**
     *处理人下拉框接口
     *@author fang.yu
     *2018.8.27
     */
    public function project_member()
    {

        $project_id = I('project_id');

        $res = $this->res=
        ProjectDevelopmentModel::project_member($project_id);

        $this->ajaxReturn($res);

    }




}
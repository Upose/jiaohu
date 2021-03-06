<?php
namespace Doc\Controller;
use Think\Controller;
use Doc\Model\BackstageManagementModel;
//php环境默认时差与北京时间相差8小时，
//获取正确的时间就必须设置
date_default_timezone_set('prc');
/**
 * 后台管理模块控制器
 * @author zang.qun
 * 2018.8.1
 */
class BackstageManagementController extends BaseController{
 
    /**
	 * 问题分类接口
     * @author zang.qun
     * 2018-07-30
     */
	  public function problem(){
	      $list=$this->list=BackstageManagementModel::problem();
        $this->Response(0,$list,'');
	  }

	/**
	 * 添加问题分类接口
     * @author zang.qun
     * 2018-07-30
     */
  	public function addproblem(){
        $name=I('name');
    	  $summary=I('summary');
    	  $status=I('status');
        $Currytime = date('Y-m-d H:i:s',time());
        $update_time = $Currytime;
        $submit_person_id=$_SESSION['user_id'];
      	if(empty($name) ||empty($summary) ||empty($status)){
             $this->Response(0,'添加失败','');
      	}
      	else{
      	   $list=$this->list=BackstageManagementModel::addproblem($name,$update_time,$submit_person_id,$summary,$status);
             $this->Response(0,'添加成功','');
      	}	    
  	}

    /**
	 * 获取反馈信息接口
     * @author zang.qun
     * 2018-07-30
     */
    public function select(){
    	  $id=I('id');
    	  $list=$this->list=BackstageManagementModel::select($id);
    	  $this->Response(0,$list,'');
    }

    /**
	 * 产品查询接口
     * @author zang.qun
     * 2018-07-27
     */
    public function Product(){
    		$page=Intval(I('page'));
    		$list=$this->list=BackstageManagementModel::Product($page);
        $this->Response(0,$list,'');		
	  }

	/**
	 * 产品添加接口
     * @author zang.qun
     * 2018-07-30
     */
    public function addProduct(){
    	  $name=I('name');
    	  $level=intval(I('level'));
    	  $summary=I('summary');
    	  $f_id=intval(I('f_id'));
        $list=$this->list=BackstageManagementModel::addProduct($name,$level,$summary,$f_id);
        if($list===0){
          $this->Response(0,'添加成功','');
        }else{
         $this->Response(1,'添加失败','');
        }    	
    }


    /**
	 * 父级id,name接口
     * @author zang.qun
     * 2018-07-30
     */
    public function ParentProduct(){
    	  $list=$this->list=BackstageManagementModel::ParentProduct();
    	  $this->Response(0,$list,''); 	
    }


	  /**
	   * 软删除产品接口
     * @author zang.qun
     * 2018-07-30
     */
    public function softdelete(){
    	  $f_id=intval(I('f_id'));
    	  $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::softdelete($f_id,$id);
        $this->Response(0,'删除成功','');	
    }

    //二级产品修改(展示)
    public function updatee(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::updatee($id);
        $this->Response(0,$list,'');  
    }

    //二级产品修改
    public function update(){
        $id=intval(I('id'));
        $name=I('name');
        $summary=I('summary');
        $fid=intval(I('fid'));
        $list=$this->list=BackstageManagementModel::update($name,$summary,$fid,$id);
        if($list===0){
      	  $this->Response(0,'修改成功','');
      	}else{
      	  $this->Response(1,'修改失败','');
      	} 
    }

    //问题删除
    public function DeleteProblem(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::DeleteProblem($id);
        if($list==0){
       	  $this->Response(0,'删除成功','');
        }else{
       	  $this->Response(1,'删除失败','');
       }       
    }

    //问题修改(展示)
    public function UpdateeProblem(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::UpdateeProblem($id);
        $this->Response(0,$list,'');
    }

    //问题修改
    public function UpdateProblem(){
      $id=intval(I('id'));
      $name=I('name');
      $summary=I('summary');
      $status=I('status');
      $list=$this->list=BackstageManagementModel::UpdateProblem($name,$summary,$status,$id);
      if($list===0){
      	  $this->Response(0,'修改成功','');
      	}else{
      	  $this->Response(1,'修改失败','');
      	}  
    }

    //项目修改(展示)
    public function UpdateeProject(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::UpdateeProject($id);
        $this->Response(0,$list,'');
    }

    //项目修改(展示)
    public function UpdateProject(){
        $id=intval(I('id'));
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $list=$this->list=BackstageManagementModel::UpdateProject($name,$summary,$status,$id);
        if($list===0){
          $this->Response(0,'修改成功','');
        }else{
          $this->Response(1,'修改失败','');
        }   
    }

    //添加项目
    public function AddProject(){
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $Currytime = date('Y-m-d H:i:s',time());
        $update_time = $Currytime;
        $submit_person_id=$_SESSION['user_id'];
        if(empty($name) ||empty($summary) ||empty($status)){
             $this->Response(0,'添加失败','');
        }
        else{
           $list=$this->list=BackstageManagementModel::AddProject($name,$update_time,$submit_person_id,$summary,$status);
             $this->Response(0,'添加成功','');
        }     
    }

    //项目展示
    public function ShowProject(){
        $list=$this->list=BackstageManagementModel::ShowProject();
        $this->Response(0,$list,'');
    }

    //项目角色展示
    public function ShowProjectrole(){
        $list=$this->list=BackstageManagementModel::ShowProjectrole();
        $this->Response(0,$list,'');
    }

    //项目角色修改(展示)
    public function UpdateeProjectrole(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::UpdateeProjectrole($id);
        $this->Response(0,$list,'');
    }

    //项目角色修改
    public function UpdateProjectrole(){
        $id=intval(I('id'));
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $list=$this->list=BackstageManagementModel::UpdateProjectrole($name,$summary,$status,$id);
        if($list===0){
            $this->Response(0,'修改成功','');
        }else{
            $this->Response(1,'修改失败','');
          }     
    }

    //项目角色添加
    public function AddProjectrole(){
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $Currytime = date('Y-m-d H:i:s',time());
        $update_time = $Currytime;
        $submit_person_id=$_SESSION['user_id'];
        if(empty($name) ||empty($summary) ||empty($status)){
            $this->Response(0,'添加失败','');
        }
        else{
            $list=$this->list=BackstageManagementModel::AddProjectrole($name,$update_time,$submit_person_id,$summary,$status);
            $this->Response(0,'添加成功','');
        }     
    }

    //删除项目
    public function DeleteProject(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::DeleteProject($id);
        if($list==0){
            $this->Response(0,'删除成功','');
        }else{
            $this->Response(1,'删除失败','');
        }    
    }

    //删除项目角色
    public function DeleteProjectrole(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::DeleteProjectrole($id);
        if($list==0){
            $this->Response(0,'删除成功','');
        }else{
            $this->Response(1,'删除失败','');
        }   
    }

    //添加项目状态
    public function AddProjectstatus(){
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $Currytime = date('Y-m-d H:i:s',time());
        $update_time = $Currytime;
        $submit_person_id=$_SESSION['user_id'];
        if(empty($name) ||empty($summary) ||empty($status)){
            $this->Response(0,'添加失败','');
        }
        else{
            $list=$this->list=BackstageManagementModel::AddProjectstatus($name,$update_time,$submit_person_id,$summary,$status);
            $this->Response(0,'添加成功','');
        }     
    }

    //展示项目状态
    public function ShowProjectstatus(){
        $list=$this->list=BackstageManagementModel::ShowProjectstatus();
        $this->Response(0,$list,'');
    }

    //修改项目状态
    public function UpdateeProjectstatus(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::UpdateeProjectstatus($id);
        $this->Response(0,$list,'');
    }
    
    public function UpdateProjectstatus(){
        $id=intval(I('id'));
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $list=$this->list=BackstageManagementModel::UpdateProjectstatus($name,$summary,$status,$id);
        if($list===0){
            $this->Response(0,'修改成功','');
        }else{
            $this->Response(1,'修改失败','');
        }      
    }

    //删除项目状态
    public function DeleteProjectstatus(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::DeleteProjectstatus($id);
        if($list==0){
            $this->Response(0,'删除成功','');
        }else{
            $this->Response(1,'删除失败','');
        }       
    }

    //添加项目事件
    public function AddProjectevent(){
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $Currytime = date('Y-m-d H:i:s',time());
        $update_time = $Currytime;
        $submit_person_id=$_SESSION['user_id'];
        if(empty($name) ||empty($summary) ||empty($status)){
            $this->Response(0,'添加失败','');
        }
        else{
            $list=$this->list=BackstageManagementModel::AddProjectevent($name,$update_time,$submit_person_id,$summary,$status);
            $this->Response(0,'添加成功','');
        }     
    }

    //展示项目事件
    public function ShowProjectevent(){
        $list=$this->list=BackstageManagementModel::ShowProjectevent();
        $this->Response(0,$list,'');
    }

    //修改项目事件
    public function UpdateeProjectevent(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::UpdateeProjectevent($id);
        $this->Response(0,$list,'');
    }

    public function UpdateProjectevent(){
        $id=intval(I('id'));
        $name=I('name');
        $summary=I('summary');
        $status=I('status');
        $list=$this->list=BackstageManagementModel::UpdateProjectevent($name,$summary,$status,$id);
        if($list===0){
            $this->Response(0,'修改成功','');
        }else{
            $this->Response(1,'修改失败','');
        }   
    }

    //删除项目事件
    public function DeleteProjectevent(){
        $id=intval(I('id'));
        $list=$this->list=BackstageManagementModel::DeleteProjectevent($id);
        if($list==0){
            $this->Response(0,'删除成功','');
        }else{
            $this->Response(1,'删除失败','');
        }     
    }
    
}


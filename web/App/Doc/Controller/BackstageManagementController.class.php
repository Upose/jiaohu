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
  //测试接口
	public function index(){
       $list=$this->list=BackstageManagementModel::info();
       $this->Response(0,$list,'');
	}


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
    		
    		$asql="select id,name,level,summary 
    		from product where is_delete = 0";
    		$ares=M()->query($asql);
    		
    		$sql = "SELECT
    				product.name AS aname,
    				product_s.id,product_s.name,
    				product_s.summary,
    				product_s.f_id
    				FROM product 
    				LEFT JOIN product_s 
    				ON product.id = product_s.f_id  
    				where product.is_delete = 0 
    				and product_s.is_delete = 0 
    				limit $page,10 ";

    		$res = M()->query($sql);
    		$result=array();
    		$result['res']=$res;
    		$result['ares']=$ares;
    		
            $usql="select count(*) 
            as count from product_s
             where is_delete='0'";
            $ures = M()->query($usql);
            
            $result['count']=$ures[0]['count'];
            $this->Response(0,$result,'');

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

    	//父级产品level为1
    	if($level=='1')
    	{
           $sql="insert into product (name,level,summary,is_delete) 
           values ('$name','$level','$summary','0')";
           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}

    	//子级产品level为2
    	else if($level=='2')
    	{
           $sql="insert into product_s (name,level,summary,f_id,is_delete) values ('$name','$level','$summary','$f_id','0')";
           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}
    	else
    	{
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

    	//f_id为0是父级产品,不为0为子级产品
    	if($f_id==0)
    	{
           $sql="update product set is_delete = 1 
           where id='$id'";
           $res = M()->execute($sql);
           $usql="update product_s set is_delete = 1 
           where f_id='$id'";
           $ures = M()->execute($usql);
           $this->Response(0,'删除成功','');
    	}
    	else if($f_id!==0)
    	{
           $sql="update product_s set is_delete = 1 
           where id='$id'";
           $res = M()->execute($sql);
           $this->Response(0,'删除成功','');
    	}
    	else
    	{
    	   $this->Response(0,'删除失败','');
    	}

    }

    public function updatee(){
      $id=intval(I('id'));
      $list=$this->list=BackstageManagementModel::updatee($id);
      $this->Response(0,$list,'');
      
    }

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



    public function DeleteProblem(){
       $id=intval(I('id'));
       $list=$this->list=BackstageManagementModel::DeleteProblem($id);

       if($list==0){
       	 $this->Response(0,'删除成功','');
       }else{
       	 $this->Response(1,'删除失败','');
       }
       
    }

    public function UpdateeProblem(){
      $id=intval(I('id'));
      $list=$this->list=BackstageManagementModel::UpdateeProblem($id);
      $this->Response(0,$list,'');
    }

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
     
     // public function AddSalt(){
     //   $password=md5(I('password'));
     //   $salt=substr($password,1,3);
     //   $psw=md5(crypt($psw,$salt)); 
     // }

}
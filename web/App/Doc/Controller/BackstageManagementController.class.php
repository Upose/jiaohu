<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;


//php环境默认时差与北京时间相差8小时，
//获取正确的时间就必须设置
date_default_timezone_set('prc');
/**
 * 后台管理模块控制器
 * @author fang.yu
 * 2018.8.1
 */
class BackstageManagementController extends BaseController{

	public function index(){
    	$this->display();
    }

   /**
	 * 问题分类接口
     * @author zan.qun
     * 2018-07-30
     */
	public function problem()
	{
      $sql=" select * from problem_classification where is_delete =0 ";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
	}


	/**
	 * 添加问题分类接口
     * @author zan.qun
     * 2018-07-30
     */
  	public function addproblem()
  	{
        $name=I('name');
    	$summary=I('summary');
    	$status=I('status');
      $Currytime = date('Y-m-d H:i:s',time());
      $update_time = $Currytime;
      $submit_person_id=$_SESSION['user_id'];
    
    	if(empty($name) ||empty($summary) ||empty($status))
    	{
           $this->Response(0,'添加失败','');
    	}
    	else
    	{
    	   $sql="insert into problem_classification (name,update_time,submit_person_id,summary,status,is_delete) 
    	   values ('$name','$update_time','$submit_person_id','$summary','$status',0)";

           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}	    
  	}



  	/**
	 * 获取反馈信息接口
     * @author zan.qun
     * 2018-07-30
     */
    public function select()
    {
    	$id=I('id');
    	$sql="SELECT * FROM feedback as a  
    	left join priority as b  on a.priority = b.id 
    	WHERE a.id= ".$id;
    	$res = M()->query($sql);
    	$this->Response(0,$res,'');
    }



    /**
	 * 产品查询接口
     * @author zan.qun
     * 2018-07-27
     */
    public function Product()
	{

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
     * @author zan.qun
     * 2018-07-30
     */
    public function addProduct()
    {
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
    	   $this->Response(0,'添加失败','');
    	}
    }


    /**
	 * 父级id,name接口
     * @author zan.qun
     * 2018-07-30
     */
    public function ParentProduct()
    {
    	$sql="select id, name from product where is_delete=0 ";
    	$res = M()->query($sql);
    	$this->Response(0,$res,'');
    }


	   /**
	   * 软删除产品接口
     * @author zan.qun
     * 2018-07-30
     */
    public function softdelete()
    {

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
      $sql="select name,f_id,summary from product_s where id= '$id' and is_delete=0 ";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
    }
     public function update(){
      $id=intval(I('id'));
      $name=I('name');
      $summary=I('summary');
      $fid=intval(I('fid'));
      $sql="update product_s set name='$name',summary='$summary',f_id='$fid' where id='$id'";
      $res = M()->execute($sql);
      $this->Response(0,'修改成功','');
    }



    public function DeleteProblem(){
       $id=intval(I('id'));
       $sql="update problem_classification set is_delete = 1 
           where id='$id'";
       $res = M()->execute($sql);
       $this->Response(0,'删除成功','');
    }

}

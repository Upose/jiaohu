<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;

//解决跨域
header("Access-Control-Allow-Origin:*");

header('Access-Control-Allow-Methods:POST');

header('Access-Control-Allow-Headers:x-requested-with, content-type');

//php环境默认时差与北京时间相差8小时，获取正确的时间就必须设置
date_default_timezone_set('prc');

mysql_query('set names utf8');
/**
 * 反馈模块控制器
 * @author fang.yu
 * 2018.7.25 
 */
class FeedbackController extends BaseController {

	//输出首页
    public function index(){
    	$this->display();
    }


    //问题分类接口
	public function ProblemClassification()
	{
		$sql = "SELECT id,name from problem_classification";
		$res = M()->query($sql);

		for($i = 0;$i < count($res);$i++)
		{
			$problemRes[$i]['pc_id'] =  $res[$i]['id'];
			$problemRes[$i]['name'] =  $res[$i]['name'];

		}

			//var_dump($problemRes);
			$this->Response(0,$problemRes,'');

	}


	//所属项目接口
	public function ProjectSource()
	{
		$sql = "SELECT id,name from project_source";
		$res = M()->query($sql);

		for($i = 0;$i < count($res);$i++)
		{
			$projectRes[$i]['ps_id'] =  $res[$i]['id'];
			$projectRes[$i]['name'] =  $res[$i]['name'];

		}

			//var_dump($projectRes);
			$this->Response(0,$projectRes,'');

	}

	//所属产品接口
	public function ProudctList()
	{
		$sql = "SELECT id,name FROM product where level = 1";
		$res = M()->query($sql);

		for($i = 0;$i < count($res);$i++)
		{
			$proudctRes[$i]['pd_id'] =  $res[$i]['id'];
			$proudctRes[$i]['name'] =  $res[$i]['name'];

		}

			//var_dump($proudctRes);
			$this->Response(0,$proudctRes,'');

	}

	
	/**
     * 提交反馈接口
     * 接受前端传来的表单数据存入feedback表中
     * @author fang.yu
     * 2018-07-26
     */
	public function FeedbackSubmit()
	{
		//优先级
		$priority = I('priority');
		//$priority = 4;

		//问题id
		//$problem_name = "安装问题";
		$problem_name = I('$problem_name');
		
		$pc_id  = M()->query($problemSql);

		//产品id
		//$pd_id  = 1;
		$pd_id  = I('pd_id');
		//项目名称
		//$project_name = "上海追逃";
		$project_name = 
		
		$ps_id  = I('project_name');
		
		//名称
		//$name = "网络连接失败";
		$name = I('name');
		//描述
		//$describe = "网络连接失败";
		$describe = I('describe');
		//截止时间
		//$deadline = "2018-07-26";
		$deadline = I('deadline');
		$deadline = date('Y/m/d',strtotime($deadline));
		
		//提交时间默认为当前时间
		$Currytime = date('Y-m-d H:i:s',time());
		$Model = D('feedback');
		$data['id'] = '';
		$data['name'] = $name;
		$data['priority'] = $priority;
		$data['pc_id'] = $pc_id;
		$data['pd_id'] = $pd_id;
		$data['ps_id'] = $ps_id;
		$data['describe'] = $describe;
		$data['submit_time'] = $Currytime;
		$data['deadline'] = $deadline;
		$result = $Model->add($data);
		if ($result)
		{
		   $id = $result; // 获取数据库写入数据的主键
		}
		else
		{
		   exit($Model->getError());
		}

		var_dump($id);

	}


	/**
     * 反馈列表接口
     * 提交反馈后显示所有反馈单信息
     * @author fang.yu
     * 2018-07-26
     */
	public function FeedbackList()
	{
		//因为feedback表中只储存了各个关联表的外键，所以五表join查询
		$sql = "SELECT fb.id,fb.name,ps.name as project_name,
		pd.name as product_name,pc.name as classification_name,
		fb.submit_time,pr.name as priority 
		from feedback fb 
		JOIN project_source ps on fb.ps_id = ps.id 
		JOIN product pd on fb.pd_id = pd.id 
		JOIN problem_classification pc on fb.pc_id = pc.id 
		JOIN priority pr on fb.priority = pr.id ORDER BY fb.id";

		$res = M()->query($sql);
		//var_dump($res);
		$this->Response(0,$res,'');

	
	}

	/**
     * 按条件搜索得到的反馈列表接口
     * 前端选择限定条件进行显示
     * @author fang.yu
     * 2018-07-26
     */
	public function SearchFeedbackList()
	{

		//产品id
		//$pd_id = 1;
		$pd_id = I('pd_id');

		//时间选择范围
		//$time1 = "2018-07-24";
		$time1 =I('startTime');
		//$time2 = "2018-07-25";
		$time2 = I('endTime');

		//关键词
		//$keyWord = "网络";
		$keywords = I('keywords');
		
		//根据前端具体传来的条件进行where查询
		$sql = "SELECT fb.id,fb.name,ps.name as project_name,
		pd.name as product_name,pc.name as classification_name,
		fb.submit_time,pr.name as priority 
		from feedback fb 
		JOIN project_source ps on fb.ps_id = ps.id 
		JOIN product pd on fb.pd_id = pd.id 
		JOIN problem_classification pc on fb.pc_id = pc.id 
		JOIN priority pr on fb.priority = pr.id 
		where  fb.pd_id = $pd_id and fb.name like '%$keywords%' 
		and fb.submit_time BETWEEN '$time1'and '$time2' 
		ORDER BY fb.id limit 10 ";

		$res = M()->query($sql);
		//var_dump($res);
		$this->Response(0,$res,'');

	}


	/**
     * 问题反馈接口
     * 对于某个具体反馈进行查看操作
     * @author fang.yu
     * 2018-07-26
     */
	public function ProblemFeedback()
	{
		//反馈单编号
		//$id = I('id');
		$id = 1;
		
		/*查询各个列的8个sql语句*/
		
		$sql1 = "SELECT pr.NAME AS statue
				FROM feedback fb
				JOIN priority pr ON fb.priority = pr.id
				WHERE fb.id = '$id'";
		$statue = M()->query($sql1);		
		$statue = $statue[0]['statue'];

		
		$sql2 = "SELECT fb.deadline
				FROM feedback fb
				WHERE fb.id = '$id'";
		$deadline = M()->query($sql2);		
		$deadline = $deadline[0]['deadline'];

		$sql3 = "SELECT ps.NAME AS project_name
				FROM feedback fb
				JOIN project_source ps ON fb.ps_id = ps.id
				WHERE fb.id = '$id'";
		$project_name = M()->query($sql3);		
		$project_name = $project_name[0]['project_name'];

		$sql4 = "SELECT fb.NAME
				FROM feedback fb
				WHERE fb.id = '$id'";
		$name = M()->query($sql4);		
		$name = $name[0]['name'];

		$sql5 = "SELECT fb.DESCRIBE
				FROM feedback fb
				WHERE fb.id = '$id'";
		$describe = M()->query($sql5);		
		$describe = $describe[0]['describe'];

		$sql6 = "SELECT pd.NAME AS product_name
				FROM feedback fb
				JOIN product pd ON fb.pd_id = pd.id
				WHERE fb.id = '$id'";
		$product_name = M()->query($sql6);		
		$product_name = $product_name[0]['product_name'];

		$sql7 = "SELECT pds.NAME AS child_product_name
				FROM feedback fb
				JOIN product_s pds ON fb.pds_id = pds.id
				WHERE fb.id = '$id'";
		$child_product_name = M()->query($sql7);		
		$child_product_name = $child_product_name[0]['child_product_name'];


		$sql8 = "SELECT pc.NAME AS problem_classification
				FROM feedback fb
				JOIN problem_classification pc ON fb.pc_id = pc.id
				WHERE fb.id = '$id'";
		$problem_classification = M()->query($sql8);		
		$problem_classification = $problem_classification[0]['problem_classification'];


		//获取图片路径
		$filesql = "select path from file where f_id = '$id'";
		$path = M()->query($filesql);

		for($i =0;$i< count($path);$i++){
			$path[$i] = $path[$i]['path'];
		}

		$final['statue'] =$statue;
		$final['deadline'] =$deadline;
		$final['project_name'] =$project_name;
		$final['name'] =$name;
		$final['describe'] =$describe;
		$final['product_name'] =$product_name;
		$final['child_product_name'] =$child_product_name;
		$final['problem_classification'] =$problem_classification;
		$final['path'] = $path;

		print_r($path);
		$this->Response(0,$final,'');
	}

	/**
     * 暂停信息接口
     * 对反馈进行暂停处理
     * @author fang.yu
     * 2018-07-26
     */
	public function Suspend()
	{
		//$suspend_person = "张三，李四，王五";
		$suspend_person = I('name');
		//$suspend_reason = "研发在更新";
		$suspend_reason =I('content');
		$Model = D('suspend_information');
		$data['id'] = '';
		$data['suspend_person'] = $suspend_person;
		$data['suspend_reason'] = $suspend_reason;
		$result = $Model->add($data);
		if ($result)
		{
		   $id = $result; // 获取数据库写入数据的主键
		}

		else
		{
		   exit($Model->getError());
		}

		//var_dump($id);

	}

	/**
     * 解决信息接口
     * 对反馈进行解决处理
     * @author fang.yu
     * 2018-07-26
     */
	public function Solve()
	{
		//$solve_person = "张三，李四，王五";
		$solve_person = I('name');
		//$resolvent = "版本兼容已解决";
		$suspend_reason = I('content');;

		$Model = D('solve_information');
		$data['id'] = '';
		$data['solve_person'] = $solve_person;
		$data['resolvent'] = $resolvent;
		$result = $Model->add($data);
		if ($result)
		{
		   $id = $result; // 获取数据库写入数据的主键
		}
		else
		{
		   exit($Model->getError());
		}

		//var_dump($id);

	}
	/**
     * 附件上传接口
     * 处理反馈中附件上传图片
     * @author fang.yu
     * 2018-07-27
     */
	public function fileUpload()
	{
		$upload =  new \Think\Upload();// 实例化上传类

		//图片上传
	  	$upload->maxSize=3145728;// 设置附件上传大小
	    $upload->exts=array('jpg','gif','png','jpeg');// 设置附件上传类型
	    $upload->rootPath = './Updata/'; // 设置附件上传根目录
        $upload->savePath = 'Image/'; // 设置附件上传（子）目录
	    $info =  $upload->upload();
	    if($info)
	    {

	    	$type  = $info['photo']['type'];
	    	$name  = $info['photo']['name'];
	    	$savename  = $info['photo']['savename'];
	    	$path  = "Updata/".$info['photo']['savepath'];
	    	$newpath = "$path$savename";
	    	/*print_r($info);
	    	var_dump($newpath);*/
	    	$f_id =5;
	    	$Model = D('file');
	    	$data['id'] = '';
	    	$data['name'] = $name;
			$data['type'] = $type;
			$data['path'] = $newpath;
			$data['f_id'] = $f_id;
			$result = $Model->add($data);
	    	
	    }
	}

       //获取反馈信息接口
    public function select(){
    	$id=I('id');
    	$sql="SELECT * FROM feedback as a  left join priority as b  on a.priority = b.id WHERE a.id= ".$id;
    	$res = M()->query($sql);
    	$this->Response(0,$res,'');
    }

    //登录接口
    public function login (){
    	//获取用户名密码
    	$name=I('name');
    	$password=md5(I('password'));
    	//判断用户名是否存在
    	$sql="SELECT * FROM person where name = '$name' ";
    	$res = M()->query($sql);
    	if(count($res)==0){
    		//用户名不存在返回1
    		$this->Response(0,1,'');
    	}
        //判断用户名密码是否正确
    	$usql="select * from person where name = '$name' and password= '$password'";
    	$ures = M()->query($usql);
    	if(count($ures)==0){
    		//用户名或密码错误返回2
    		$this->Response(0,2,'');
    	}else{
    		//登陆成功,将用户信息保存在session
    		session_start();
    		$_SESSION['user_name']=$name;
    		$_SESSION['user_id']=$ures[0]['id'];
    		//var_dump($_SESSION);die;
    		$this->Response(0,$ures,'');
    		
    	}	
       
    }

    //产品添加接口
    public function addProduct(){
    	$name=I('name');
    	$level=intval(I('level'));
    	$summary=I('summary');
    	$f_id=intval(I('f_id'));
    	//父级产品level为1
    	if($level=='1'){
           $sql="insert into product (name,level,summary,is_delete) values ('$name','$level','$summary','0')";
           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}
    	//子级产品level为2
    	else if($level=='2'){
           $sql="insert into product_s (name,level,summary,f_id,is_delete) values ('$name','$level','$summary','$f_id','0')";
           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}else{
    	   $this->Response(0,'添加失败','');
    	}
    }


    //父级id,name接口
    public function ParentProduct(){
    	$sql="select id, name from product";
    	$res = M()->query($sql);
    	$this->Response(0,$res,'');
    }

    //软删除产品
    public function softdelete(){
    	$f_id=intval(I('f_id'));
    	$id=intval(I('id'));
    	//f_id为0是父级产品,不为0为子级产品
    	if($f_id==0){
           $sql="update product set is_delete = 1 where id='$id'";
           $res = M()->execute($sql);
           $usql="update product_s set is_delete = 1 where f_id='$id'";
           $ures = M()->execute($usql);
           $this->Response(0,'删除成功','');
    	}else if($f_id!==0){
           $sql="update product_s set is_delete = 1 where id='$id'";
           $res = M()->execute($sql);
           $this->Response(0,'删除成功','');
    	}else{
    	   $this->Response(0,'删除失败','');
    	}

    }
   
	//问题反馈列表
	public function problem(){
      $sql=" select * from problem_classification";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
	}
  	

  	//添加问题反馈列表
  	public function addproblem(){
        $name=I('name');
    	$summary=I('summary');
    	$status=I('status');
    	if(empty($name) ||empty($summary) ||empty($status)){
           $this->Response(0,'添加失败','');
    	}else{
    	   $sql="insert into problem_classification (name,summary,status) values ('$name','$summary','$status')";
           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}	    
  	}


    //回复列表
  	public function auth(){
  	  $sql="select * from reply";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
  	}

	public function Product(){

		$page=Intval(I('page'));
		//var_dump($_SESSION);die;
		$asql="select id,name,level,summary from product where is_delete = 0";
		$ares=M()->query($asql);
		//var_dump($ares);die;
		// foreach ($ares as $k => $v) {
		// 	var_dump($v['type']);die;
		$sql = "SELECT
					product.name AS aname,product_s.id,product_s.name,product_s.summary,product_s.status,
					product_s.f_id
				FROM
					product 
				LEFT JOIN product_s ON product.id = product_s.f_id  where product.is_delete = 0 and product_s.is_delete = 0 limit $page,2 ";
		$res = M()->query($sql);
		$result=array();
		$result['res']=$res;
		$result['ares']=$ares;
		 
		// }
        // var_dump($result);die;
        // $result=array();
        // foreach ($res as $k => $v) {
        // 	$result[$v['aname']][] = $v;
        // }
        
        $usql="select count(*) as count from product_s where is_delete='0'";
        $ures = M()->query($usql);
         //var_dump($ures[0]['count']);die;
        $result['count']=$ures[0]['count'];
        $this->Response(0,$result,'');

	}

	
 }




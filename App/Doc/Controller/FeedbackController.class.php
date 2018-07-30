<?php
namespace Doc\Controller;
use Think\Controller;


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


    /**
     * 获取产品信息接口
     * 以每个父产品对应旗下所有字产品的形式返回
     * @author zan.qun
     * 2018-07-26
     */
    
  	/*public function Product()
  	{
  		$sql = "SELECT p1.id as pid,p1.name as pname,
		        p2.name as childname,p2.id as cid
				FROM product p1 join product_s p2 on 
				p1.id = p2.f_id";

		$res = M()->query($sql);
		
        //var_dump($res);die;
		foreach ($res as $r)
		{
			//var_dump($r['pid']);die;
		
			if(!is_array($res[$r['pid']]))
			{
				var_dump(1111);die;
				$res[$r["pid"]] = array();
			}else{
			    
               
			}
			
			
		}


  	}*/


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

	//评论列表
  	public function auth(){
  	  $sql="select * from reply";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
  	}
	
	
 }




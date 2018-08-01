<?php
namespace Doc\Controller;
use Think\Controller;

//php环境默认时差与北京时间相差8小时，
//获取正确的时间就必须设置
date_default_timezone_set('prc');

//设置编码
mysql_query('set names utf8');


/**
 * 反馈模块控制器
 * @author fang.yu
 * 2018.7.25 
 */
class FeedbackController extends BaseController {


	
	/**
	 * 输出首页接口
	 * @author fang.yu
	 * 2018.7.25 
	 */
    public function index(){
    	$this->display();
    }

     /**
     * 登录接口
     * @author zan.qun
     * 2018-07-30
     */
    public function login()
    {
    	//获取用户名密码
    	$name=I('name');
    	$password=md5(I('password'));

    	//判断用户名是否存在
    	$sql="SELECT * FROM person 
    	where name = '$name' ";
    	$res = M()->query($sql);

    	if(count($res)==0)
    	{
    		//用户名不存在返回1
    		$this->Response(1,'');
    	}

        //判断用户名密码是否正确
    	$usql="select * from person 
    	where name = '$name' 
    	and password= '$password'";
    	$ures = M()->query($usql);
    	if(count($ures)==0)
    	{
    		//用户名或密码错误返回2
    		$this->Response(2,'');
    	}
    	else
    	{
    		//登陆成功,将用户信息保存在session
    		
    		$_SESSION['user_name']=$name;
    		$_SESSION['user_id']=$ures[0]['id'];
    		$this->Response(0,'登陆成功','');	
    	}	
       
    }

    /**
     * 获取产品信息接口
     * 以每个父产品对应旗下所有字产品的形式返回
     * @author zan.qun
     * 2018-07-26
     */
    public function ProductList(){
		
		$sql =
		"select ps.id as psid,ps.name as psname,
		p.id as pid,p.name as pname 
		from product_s ps inner join product p 
		on ps.f_id = p.id 
		where p.is_delete = 0 
		and ps.is_delete = 0 
		ORDER BY ps.id";
		$sql_res = M()->query($sql);
		$res = array();

		foreach ($sql_res as $v) {
			if(!is_array($res[$v['pid']])){
				$res[$v['pid']]['id'] = $v['pid'];
				$res[$v['pid']]['name'] = $v['pname'];
				$res[$v['pid']]['child'] = array();
			}
			
			$child['id'] = $v['psid'];
			$child['name'] = $v['psname'];
			array_push($res[$v['pid']]['child'], $child);
		}
		
        $this->Response(0,$res,'');

	}

		
	/**
     * 下拉框接口
     * 处理反馈中下拉框中的选项
     * @author fang.yu
     * 2018-07-26
     */
	public function DropdownBoxList()
	{
		//问题分类
		$problemsql = "SELECT id as pc_id,name 
		from problem_classification";
		$problemres = M()->query($problemsql);
		
		//所属项目
		$projectsql = "SELECT id as ps_id,name 
		from project_source";
		$projectres = M()->query($projectsql);

		$final['problem']=$problemres;
		$final['project']=$projectres;
		
		$this->Response(0,$final,'');

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
	
		//问题分类id
		$pc_id  = I('pc_id');

		//所属项目id
		$ps_id  = I('ps_id');
		 
		//父级id
		$pd_id  = I('pd_id');
		 
		//子级id
		$pds_id  = I('pds_id');
		
		//名称
		$name = I('name');

		//描述
		$describe = I('describe');

		//截止时间
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
		$data['pds_id'] = $pds_id;
		$data['ps_id'] = $ps_id;
		$data['describe'] = $describe;
		$data['submit_person_id'] =$_SESSION['user_id'];
		$data['submit_time'] = $Currytime;
		$data['deadline'] = $deadline;
                           
		$result = $Model->add($data);
		
		//上传附件
		$upload =  new \Think\Upload();// 实例化上传类

		//以图片格式上传
		//设置附件上传大小
	  	$upload->maxSize=3145728;
	  	// 设置附件上传类型
	    $upload->exts=array('jpg','gif','png','jpeg');
	    // 设置附件上传根目录
	    $upload->rootPath = './Updata/'; 
	    // 设置附件上传（子）目录
        $upload->savePath = 'Image/'; 

	    $info =  $upload->upload();
	   
	    
	    if($info)
	    {
			for($i = 0;$i<count($info);$i++)
			{
			$type  = $info[$i]['type'];
	    	$name  = $info[$i]['name'];
	    	$savename  = $info[$i]['savename'];
	    	$path  = "Updata/".$info[$i]['savepath'];
	    	$newpath = "$path$savename";
	    	
	    	$Model = D('file');
	    	$data1['id'] = '';
	    	$data1['name'] = $name;
			$data1['type'] = $type;
			$data1['path'] = $newpath;
			$data1['f_id'] = $result;
			$res = $Model->add($data1);

			}
		
			
	    }
	    
		$this->redirect('feedback/submit2');

	}


	/**
     * 反馈列表接口
     * 提交反馈后显示所有反馈单信息
     * @author fang.yu
     * 2018-07-26
     */
	public function FeedbackList()
	{
		$page=intval(I('page'));
		$pag=($page-1)*10;
		//因为feedback表中只储存了各个关联表的外键，所以五表join查询
		$sql = "SELECT fb.id,fb.name,ps.name as project_name,
		pd.name as product_name,pc.name as classification_name,
		fb.submit_time,pr.name as priority 
		from feedback fb 
		JOIN project_source ps on fb.ps_id = ps.id 
		JOIN product pd on fb.pd_id = pd.id 
		JOIN problem_classification pc on fb.pc_id = pc.id 
		JOIN priority pr on fb.priority = pr.id ORDER BY fb.id limit $pag,10";

		$res = M()->query($sql);
		$usql="select count(*) as count from feedback";
		$ures = M()->query($usql);
		$count =$ures[0]['count'];

		$response = array('data' => $res,'count' =>$count);

    	$this->ajaxReturn($response);
	

	}


	/**
	 * 按条件搜索得到的反馈列表接口
	 * 前端选择限定条件进行显示
	 * @author fang.yu
	 * 2018-07-26
	 */
	public function SearchFeedbackList()
	{

		$page=intval(I('page'));
		$pag=($page-1)*10;
		$time1 =I('starTime');
		$time2 = I('endTime');
		
		 //关键词
		$keywords = I('keywords');
		

	    $sql = "SELECT fb.id,fb.name,ps.name as project_name,
		pd.name as product_name,pc.name as classification_name,
		fb.submit_time,pr.name as priority 
		from feedback fb 
		JOIN project_source ps on fb.ps_id = ps.id 
		JOIN product pd on fb.pd_id = pd.id 
		JOIN problem_classification pc on fb.pc_id = pc.id 
		JOIN priority pr on fb.priority = pr.id 
		where fb.name like '%$keywords%'";
			 if(!empty($time1) && !empty($time2))
			 {
	          $sql.="and fb.submit_time BETWEEN '$time1'and '$time2'";
	          $sql.="limit ".$pag.",10 ";
			 }
			 else
			 {
				$sql.="";
				$sql.="limit ".$pag.",10";
			 }
			$res = M()->query($sql);
		    
    	$usql="SELECT count(*) as count  from feedback ";
		
    	if($keywords){
                 $usql .=" where name like '%$keywords%'";
		          if(!empty($time1) && !empty($time2)){
		    	      $usql.=" and submit_time BETWEEN '$time1' and '$time2'"; 	
		    		}else{
		    		  $usql.="";
    	            }  
    	 }
    	else{
                   if(!empty($time1) && !empty($time2)){
		    	      $usql.="where submit_time BETWEEN '$time1'and '$time2'"; 	
		    		}else{
		    		  $usql.="";
    	            }  
    	}
    	
		$ures = M()->query($usql);
		$count =$ures[0]['count'];
		$response = array('data' => $res,'count' =>$count);
        $this->ajaxReturn($response);

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
		$id = I('id');
		
		/*查询各个列的8个sql语句*/
		$sql1 = "SELECT pr.NAME AS statue
				FROM feedback fb
				JOIN priority pr 
				ON fb.priority = pr.id
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
				JOIN project_source ps 
				ON fb.ps_id = ps.id
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
				JOIN product pd 
				ON fb.pd_id = pd.id
				WHERE fb.id = '$id'";
		$product_name = M()->query($sql6);		
		$product_name = $product_name[0]['product_name'];

		$sql7 = "SELECT pds.NAME as child_product_name
				FROM feedback fb
				JOIN product_s pds ON fb.pds_id = pds.id
				WHERE fb.id = '$id'";
		$child_product_name = M()->query($sql7);		
		$child_product_name = $child_product_name[0]['child_product_name'];

		$sql8 = "SELECT pc.NAME as problem_classification
				FROM feedback fb
				JOIN problem_classification pc 
				ON fb.pc_id = pc.id
				WHERE fb.id = '$id'";
		$problem_classification = M()->query($sql8);		
		$problem_classification = $problem_classification[0]['problem_classification'];

		$sql9 = "SELECT p.NAME as submit_person_name
				FROM feedback fb
				JOIN person p
				ON fb.submit_person_id = p.id
				WHERE fb.id = '$id'";
		$submit_person_name = M()->query($sql9);		
		$submit_person_name = $submit_person_name[0]['submit_person_name'];


		//获取图片路径
		$filesql = "select path as img 
		from file where f_id = '$id'";
		$path = M()->query($filesql);

		//回复列表
		$replysql = "SELECT rp.author,rp.update_time as time, 
		rp.content FROM reply rp join feedback fb 
		on rp.f_id = fb.id where  fb.id = '$id'";
		$reply = M()->query($replysql);

		$final['statue'] =$statue;
		$final['deadline'] =$deadline;
		$final['project_name'] =$project_name;
		$final['submit_person_name']=$submit_person_name;
		$final['name'] =$name;
		$final['describe'] =$describe;
		$final['product_name'] =$product_name;
		$final['child_product_name'] =$child_product_name;
		$final['problem_classification'] =$problem_classification;
		$final['img'] = $path;
		$final['reply'] = $reply;
		
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
		//暂停人
		$suspend_person = I('name');
		
		//暂停理由
		$suspend_reason =I('content');

		$type_id = I('id');
		//存入数据库
		$Model = D('suspend_information');
		$data['id'] = '';
		$data['suspend_person'] = $suspend_person;
		$data['suspend_reason'] = $suspend_reason;
		$data['type_id'] = $type_id;
		$result = $Model->add($data);
		
	}

	/**
     * 解决信息接口
     * 对反馈进行解决处理
     * @author fang.yu
     * 2018-07-26
     */
	public function Solve()
	{
		//解决人
		$solve_person =I('name');
		
		//解决手段
		$resolvent = I('content');

		$type_id = I('id');


		$Model = D('solve_information');
		$data['id'] = '';
		$data['solve_person'] = $solve_person;
		$data['resolvent'] = $resolvent;
		$data['type_id'] = $type_id;
		$result = $Model->add($data);

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

	/**
     * 回复接口
     * 先进行展示 
     * 点击回复将输入框内容存入数据库
     * @author fang.yu
     * 2018-07-30
     */
	public function addReply()
	{

		//回复人
		$author = $_SESSION['user_name'];
		

		//内容
		$content = I('content');
		
		//当前时间
		$Currytime = date('Y-m-d H:i:s',time());

		//反馈单id
		$id = I('id');

		$Model = D('reply');
		    	$data['id'] = '';
		    	$data['author'] = $author;
				$data['content'] = $content;
				$data['update_time'] = $Currytime;
				$data['f_id'] = $id;
			
		$result = $Model->add($data);

  		//获取回复列表
		$replysql = "SELECT rp.author,rp.content,
		rp.update_time as time,
		FROM reply rp join feedback  fb 
		on rp.f_id = fb.id where  fb.id = '$id'";

		$reply = M()->query($replysql);

		$final['reply'] = $reply;
		
		$this->Response(0,$final,'');

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
    	$sql="select id, name from product";
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
   

   /**
	 * 问题分类接口
     * @author zan.qun
     * 2018-07-30
     */
	public function problem()
	{
      $sql=" select * from problem_classification";
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

    	if(empty($name) ||empty($summary) ||empty($status))
    	{
           $this->Response(0,'添加失败','');
    	}
    	else
    	{
    	   $sql="insert into problem_classification (name,summary,status) 
    	   values ('$name','$summary','$status')";

           $res = M()->execute($sql);
           $this->Response(0,'添加成功','');
    	}	    
  	}


  	public function auth()
  	{
  	  $sql="select * from reply";
      $res = M()->query($sql);
      $this->Response(0,$res,'');
  	}

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
				product_s.status,
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

	public function logout()
	{
     
	    if(isset($_COOKIE[session_name()]))
	    {  
	        //判断客户端的cookie文件是否存在
	        //存在的话将其设置为过期.
	       setcookie(session_name(),'',time()-1,'/');
	    }
	       session_destroy();
	      $this->Response(0,'退出登录','');
	}


 }

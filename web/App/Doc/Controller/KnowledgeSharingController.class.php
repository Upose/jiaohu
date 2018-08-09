<?php
namespace Doc\Controller;
use Think\Controller;

/**
 * 知识共享模块控制器
 * @author fang.yu
 * 2018.8.1 
 */
class KnowledgeSharingController extends BaseController {

	/**
	 * 输出首页接口
	 * @author fang.yu
	 * 2018.8.1
	 */
    public function index(){
        
        $sql = "SELECT flm.name as pname,
                  flm.id as pid,
                  slm.name as psname,
                  slm.id as psid
                  FROM FirstLevelMenu flm 
                  JOIN SecondLevelMenu slm 
                  on flm.id = slm.f_id";

          $sql_res = M()->query($sql);

          print_r($result);

          $res = array();
           $ch = array();
            foreach ($sql_res as $v) 
            {
              if(!is_array($res[$v['pid']]))
              {
                $res[$v['pid']]['pid'] = $v['pid'];
                $res[$v['pid']]['pname'] = $v['pname'];
                $res[$v['pid']]['child'] = array();
              }
            
            $child['cid'] = $v['psid'];
            $child['cname'] = $v['psname'];
            array_push($res[$v['pid']]['child'], $child);
             array_push($ch,$child);
           }


         $this->assign('res', $res);
           
           
            $this->display();


       
    }


    /**
	 * 文章列表接口
	 * @author fang.yu
	 * 2018.8.2
	 */
    public function articlesList()
    {


    	$f_id = I('f_id');
    	
    	$typeid = I('typeid');

      $kw =I('key');

  		switch ($typeid)
  		{
  		case 0:
  		   $type = "";
  		    break;
  		case 1:
  		    $type = " ORDER BY submit_time DESC";
  		    break;
  		case 2:
  		    $type = " ORDER BY read_number DESC";
  		    break;
          case 4:
              $type = "";
              break;
  		default:
  		die;
  		  
  		}

    	$topsql = "SELECT id,name,keywords,author,
    	submit_time,read_number,comment_number,is_top,href
    	FROM KnowledgeDocument
		  where is_top = 1 and f_id = $f_id  
      and name like '%$kw%'".$type;
		
    	$topres = M()->query($topsql);

    	for($i = 0;$i<count($topres);$i++)
    	{
    		$topres[$i]['keywords'] = explode(",",$topres[$i]['keywords']);
    	}


    	$not_topsql = "SELECT id,name,keywords,author,
    	submit_time,read_number,comment_number,is_top,href
    	FROM KnowledgeDocument
		  where is_top = 0 and f_id = $f_id 
        and name like '%$kw%' ".$type;
    	$not_topres = M()->query($not_topsql);

    	for($i = 0;$i<count($not_topres);$i++)
    	{
    		$not_topres[$i]['keywords'] = explode(",",$not_topres[$i]['keywords']);
    	}

    	$response = array('top' => $topres,'not_top' =>$not_topres);
      
      $this->ajaxReturn($response);

    }



  /**
   * 计数接口
   * 点击一次文章，相应阅读量+1
   * @author fang.yu
   * 2018.8.7
   */
    public function numberCount()
    {
     
        $id = I('id');

        $sql = "SELECT read_number  from KnowledgeDocument where id = $id";

        $res = M()->query($sql);

        $num = (int)$res[0]['read_number'];

        //每访问接口一次，加一
        $num +=1;

        $usql = "UPDATE KnowledgeDocument SET read_number = $num WHERE id = $id";

        $ures = M()->execute($usql);

        $hsql = "SELECT href  from KnowledgeDocument where id = $id";

        $hres = M()->query($hsql);

        $href = $hres[0]['href'];

        $this->Response(0,$href,'');

    }


    /**
   * 新增文章接口
   * @author fang.yu
   * 2018.8.7
   */
    public function addArticle()
    {

        //文档名称
        $name = I('feedName');
       
        //关键词(数组形式)
        $keywords = I('feedNames');
        $keywords = implode(",",$keywords);
        //分割数组,以逗号隔开

        //作者
        $author = $_SESSION['user_name'];
        
        //提交时间默认为当前时间 
        $submit_time = date('Y-m-d H:i:s',time());

        //阅读数
        $read_number = 0;

        //评论数
        $comment_number = 0;

        //是否置顶
        $is_top = 0;

        //二级菜单id
        $f_id = (int)I('feedId');
       // file_put_contents("11114.txt", json_encode($f_id));
        
        //网页链接
        $feedhttp  =I('feedhttps');
       
      if(!empty($feedhttp))
        {
          $href = $feedhttp;
        }
        else
        {
            //以下是上传附件操作
            //实例化上传类
            $upload =  new \Think\Upload();
            //设置附件上传大小
            $upload->maxSize=3145728;
            //保持文件名不变
            $upload->saveName = time()."dt".rand(0,10);
            //设置附件上传类型
            $upload->exts=array('html','htm');
            //设置附件上传根目录
            $upload->rootPath = './Mdhtml/'; 
            //设置附件上传（子）目录
            $upload->savePath = ''; 

            $info =  $upload->upload();

             file_put_contents("11114.txt", json_encode($info));

            if($info)
            {

                $savename  = $info['feedfile']['savename'];
                $path  = "/Mdhtml/".$info['feedfile']['savepath'];
                $newpath = $path.$savename;
                $href = $newpath;
               
            }
        }
       
          $sql = "INSERT INTO KnowledgeDocument 
          VALUES 
          ('','$name','$keywords','$author','$submit_time',
          '$read_number','$comment_number','$is_top','$f_id','$href')";   

         $ures = M()->execute($sql);     

          $this->redirect('KnowledgeSharing/document _m');

        
    }


}
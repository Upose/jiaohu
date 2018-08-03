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

    	$topsql = "SELECT name,keywords,author,
    	submit_time,read_number,comment_number,is_top,href
    	FROM KnowledgeDocument
		where is_top = 1 and f_id = $f_id  and name like '%$kw%'".$type;
		
    	$topres = M()->query($topsql);

    	for($i = 0;$i<count($topres);$i++)
    	{
    		$topres[$i]['keywords'] = explode(",",$topres[$i]['keywords']);
    	}


    	$not_topsql = "SELECT name,keywords,author,
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


   



}
<?php
namespace Doc\Model;
use Think\Model;

class KnowledgeSharingModel{

	/**
	 * 查询一二级菜单
	 * @author fang.yu
	 * 2018.8.2
	 */
	public function menu()
	{
		 
        $sql = "SELECT flm.name as pname,
                flm.id as pid,
                slm.name as psname,
                slm.id as psid
                FROM FirstLevelMenu flm 
                JOIN SecondLevelMenu slm 
                on flm.id = slm.f_id";

        $sql_res = M()->query($sql);

        return  $sql_res;
	}



	/**
	 * 查询文章
	 * @author fang.yu
	 * 2018.8.2
	 */
	public function articlesList($f_id,$typeid,$kw)
	{

		//选择排序类型
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

  		//置顶
    	$topsql = "SELECT id,name,keywords,
    	author,submit_time,read_number,
    	comment_number,is_top,href
    	FROM KnowledgeDocument
		where is_top = 1 and f_id = $f_id  
      	and name like '%$kw%'".$type;
		
    	$topres = M()->query($topsql);

    	for($i = 0;$i<count($topres);$i++)
    	{
    		$topres[$i]['keywords'] = 
    		explode(",",$topres[$i]['keywords']);
    	}

    	//不置顶
    	$not_topsql = "SELECT id,name,keywords,
    	author,submit_time,read_number,
    	comment_number,is_top,href
    	FROM KnowledgeDocument
		where is_top = 0 and f_id = $f_id 
        and name like '%$kw%' ".$type;

    	$not_topres = M()->query($not_topsql);

    	for($i = 0;$i<count($not_topres);$i++)
    	{
    		$not_topres[$i]['keywords'] = 
    		explode(",",$not_topres[$i]['keywords']);
    	}

    	$response = array('top' => $topres,
    	'not_top' =>$not_topres);

		return $response;

	}

	 /**
   * 计数更新
   * 点击一次文章，相应阅读量+1
   * @author fang.yu
   * 2018.8.7
   */
    public function numberCount($id)
    {
    	$sql = "SELECT read_number  
    	from KnowledgeDocument where id = $id";

        $res = M()->query($sql);

        $num = (int)$res[0]['read_number'];

        //每访问接口一次，加一
        $num +=1;

        $usql = "UPDATE KnowledgeDocument 
        SET read_number = $num WHERE id = $id";

        $ures = M()->execute($usql);

        $hsql = "SELECT href  
        from KnowledgeDocument where id = $id";

        $hres = M()->query($hsql);

        $href = $hres[0]['href'];

        return $href;
    }




}
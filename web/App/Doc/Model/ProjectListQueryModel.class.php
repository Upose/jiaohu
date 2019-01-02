<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectListQueryModel
{


    /**
     * 查询现有项目列表
     * @author song.chaoxu
     * 2018.11.21
     */
     public function pList($proName,$pag,$limit)
     {
        
        $sql = "
                SELECT
					p.pro_code,
					p.pro_name,
					d.deptName,
					i.industry_name
				FROM
					`app_project` p
				JOIN dm_industry i ON p.industry_id = i.industry_id
				JOIN dm_department d ON p.pro_department = d.id
                ";

        //根据传来的不同条件进行搜索  
        if ( $proName != "" ) {

            $sql.="where pro_name like \"%$proName%\"  limit ".$pag.",".$limit;

        } else{

             $sql.="limit ".$pag.",".$limit;
        }

        $res = M()->query($sql);

        $sqlCount = "   
        		SELECT
					count(pro_name) total
				FROM
					`app_project` p
				JOIN dm_industry i ON p.industry_id = i.industry_id
				JOIN dm_department d ON p.pro_department = d.id
                    ";

        //根据传来的不同条件进行搜索  
        if ($proArea!="" && $proName != "" ) {

            $sqlCount.="where pro_name like \"%$proName%\"  ";

        } else{

             $sqlCount.="";
        }


        $total = M()->query($sqlCount);

        $count =$total[0]['total'];
        
        $response = array('result' => $res,'count' =>$count);

        return $response;

     }


    /**
     * 查询现有项目列表
     * @author song.chaoxu
     * 2018.11.21
     */
     public function pListMsg($proCode)
     {
        
        $sql = "
                SELECT
                    p.pro_code,
                    p.pro_name,
                    p.pro_source,
                    p.pro_leader,
                    p.leader_name,
                    p.type_id,
                    i.industry_name,
                    d.deptName,
                    a.area_name,
                    p.natureType,
                    p.pro_introduce
                FROM
                    `app_project` p
                JOIN dm_industry i ON p.industry_id = i.industry_id
                JOIN dm_department d ON p.pro_department = d.id
                JOIN dm_area a ON p.pro_address = a.area_id
                ";

        $response = M()->query($sql);

        return $response;

     }

    /**
     * 删除指定项目记录
     * @author song.chaoxu
     * 2018.12.27
     */
	public function dProject($pCode){
		
		$delCode = 'pro_code='.$pCode;
		$pTable = M("app_project"); // 实例化User对象
		$result = $pTable->where($delCode)->delete(); // 删除id为5的用户数据
		return $result;

	}


}
<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectListQueryModel
{


	 /**
	 * 区域下拉框
	 * @author song.chaoxu
	 * 2018.11.23
	 */
	  public function areaList()
     {
     	$provinceSql = "SELECT area_id as pid,
 				area_name as pname from app_area 
     			where parent_id = 0";

     	$province = M()->query($provinceSql);
		$area['province'] = $province;
        return  $area;

     }


    /**
     * 查询现有项目列表
     * @author song.chaoxu
     * 2018.11.21
     */
     public function projectList($proArea,$proName,$pag,$limit)
     {
        
        // $sql = "SELECT i.id as pid,
        // i.name as pname,
        // pm.id as cid,pm.name as cname,
        // a.name as area,
        // pm.charge,pm.member_num,
        // pm.start_time,
        // pm.end_time,s.name as status,
        // pm.progress_rate as rate
        // from ProjectManagement pm 
        // join project_select i 
        // on pm.industry_id  = i.id 
        // join area a 
        // on pm.area_id = a.id
        // join `project_status` s 
        // on pm.status_id = s.id";

        $sql = "
                SELECT
                    p.pro_id,
                    p.pro_name,
                    r.rank_name,
                    i.industry_name,
                    a.area_name,
                    u.member_name,
                    p.create_data
                FROM
                    app_project p
                JOIN app_area a ON p.pro_address = a.area_id
                JOIN user_member u ON p.pro_leader = u.member_id
                JOIN app_industry i ON p.industry_id = i.industry_id
                JOIN app_project_rank r ON p.secrecy_grade = r.id;
                ";

        //根据传来的不同条件进行搜索  
        if ($proArea!="" && $proName != "" ) {

            $sql.="where pro_name like \"%$proName%\" AND pro_address = \"%$proArea%\" limit ".$pag.",".$limit;

        } else if ($proName != "" ){

            $sql.="where pro_name like \"%$proName%\" limit ".$pag.",".$limit;

        } else if($proArea != "" ){

            $sql.="where pro_address = \"%$proArea%\" limit ".$pag.",".$limit;
        }else{

             $sql.="";
        }

        // echo $sql;

        $res = M()->query($sql);

        $sqlCount = "   SELECT
                            count(*) total
                        FROM
                            app_project p
                        JOIN app_area a ON p.pro_address = a.area_id
                        JOIN user_member u ON p.pro_leader = u.member_id
                        JOIN app_industry i ON p.industry_id = i.industry_id
                        JOIN app_project_rank r ON p.secrecy_grade = r.id;
                    ";

        //根据传来的不同条件进行搜索  
        if ($proArea!="" && $proName != "" ) {

            $sql.="where pro_name like \"%$proName%\" AND pro_address = \"%$proArea%\" limit ".$pag.",".$limit;

        } else if ($proName != "" ){

            $sql.="where pro_name like \"%$proName%\" limit ".$pag.",".$limit;

        } else if($proArea != "" ){

            $sql.="where pro_address = \"%$proArea%\" limit ".$pag.",".$limit;
        }else{

             $sql.="";
        }

        // echo $sqlCount;

        $total = M()->query($sqlCount);

        $count =$total[0]['total'];
        
        $response = array('data' => $res,'count' =>$count);

        return $response;

     }


}
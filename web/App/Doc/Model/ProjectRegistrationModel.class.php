<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ProjectRegistrationModel
{


	 /**
	 * 区域下拉框
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function areaList()
     {
     	$areaSql = "SELECT area_id as pid,
 				area_name as pname from app_area 
     			where parent_id = 0";

     	$area = M()->query($areaSql);
		
        return  $area;
     }


     /**
	 * 行业下拉框
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function projectIndustryList()
     {


     	$sql = "SELECT industry_id,industry_name FROM dm_industry;";

     	$industry = M()->query($sql);

        return  $industry;

     }

    /**
	 * 项目密级
	 * @author song.chaoxu
	 * 2018.11.14
	 */
	  public function projectRankList()
     {

     	$sql = "SELECT * FROM app_project_rank;";

     	$rankList = M()->query($sql);

        return  $rankList;

     }

    /**
     * 项目性质下拉框
     * @author song.chaoxu
     * 2018.11.21
     */
      public function projectNature()
     {

        $sql = "SELECT * FROM app_project_nature;";

        $projectNature = M()->query($sql);

        return  $projectNature;

     }


    /**
     * 项目经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function projectManager()
     {


        $sql = "SELECT t.member_id,t.member_name,t.department FROM user_member t WHERE postsname like '%经理' AND department LIKE '%交付%'";

        $projectManager = M()->query($sql);

        return  $projectManager;

     }


    /**
     * 部门经理
     * @author song.chaoxu
     * 2018.11.20
     */
      public function divisionManager()
     {


        $sql = "SELECT t.member_id,t.member_name,t.department FROM user_member t WHERE postsname = '部门经理' AND department LIKE '%交付%'";

        $divisionManager = M()->query($sql);

        return  $divisionManager;

     }


    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd($pro_code,$pro_name,$typeId,$industry, $projectManagerId, $projectManager, $projectStime,$projectEtime, $area,$rank,$createTime,$newPath,$lxMsg,$cooperativeUnit,$projectNature,$divisionManagerId,$divisionManager,$contractAmount,$projectIntroduce){

    	  $sql="INSERT INTO `deliveryapplication`.`app_project` (
                    `pro_id`,
                    `pro_name`,
                    `type_id`,
                    `industry_id`,
                    `member_id`,
                    `pro_leader`,
                    `pro_stime`,
                    `pro_etime`,
                    `pro_address`,
                    `secrecy_grade`,
                    `create_data`,
                    `pro_enclosure`,
                    `pro_msg`,
                    `cooperative_unit`,
                    `pro_source`,
                    `division_manager_id`,
                    `pro_division_manager`,
                    `contract_amount`,
                    `pro_introduce`
                )
                VALUES
                    (
                        $pro_code,
                        \"$pro_name\",
                        $typeId,
                        $industry,
                        $projectManagerId,
                        \"$projectManager\", 
                        \"$projectStime\",
                        \"$projectEtime\",
                        \"$area\",
                        \"$rank\",
                        \"$createTime\",
                        \"$newPath\",
                        \"$lxMsg\",
                        \"$cooperativeUnit\",
                        \"$projectNature\",
                        $divisionManagerId,
                        \"$divisionManager\",
                        $contractAmount,
                        \"$projectIntroduce\"
                    );";


        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
       	 
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
                JOIN app_project_rank r ON p.secrecy_grade = r.id
                ";

        //根据传来的不同条件进行搜索  
        if ($proArea!="" && $proName != "" ) {

            $sql.="where pro_name like \"%$proName%\" AND pro_address = \"$proArea\" limit ".$pag.",".$limit;

        } else if ($proName != "" ){

            $sql.="where pro_name like \"%$proName%\" limit ".$pag.",".$limit;

        } else if($proArea != "" ){

            $sql.="where pro_address = \"$proArea\" limit ".$pag.",".$limit;
        }else{

             $sql.="limit ".$pag.",".$limit;
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
                        JOIN app_project_rank r ON p.secrecy_grade = r.id
                    ";

        //根据传来的不同条件进行搜索  
        if ($proArea!="" && $proName != "" ) {

            $sqlCount.="where pro_name like \"%$proName%\" AND pro_address = \"$proArea\" ";

        } else if ($proName != "" ){

            $sqlCount.="where pro_name like \"%$proName%\" ";

        } else if($proArea != "" ){

            $sqlCount.="where pro_address = \"$proArea\" ";
        }else{

             $sqlCount.="";
        }

        // echo $sqlCount;

        $total = M()->query($sqlCount);

        $count =$total[0]['total'];
        
        $response = array('result' => $res,'count' =>$count);

        return $response;

     }





//  ==========================================   以下接口为 2018/12/26 版   ==========================================





    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.12.26
     */
    public function projectMsgAdd($pro_code,$pro_name,$pro_source,$projectManager,$projectManagerId,$projectNature,$industry,$deptId,$area,$natureType,$projectIntroduce){

          $sql="
              INSERT INTO `itemapplication`.`app_project` (
                    `pro_code`,
                    `pro_name`,
                    `industry_id`,
                    `pro_source`,
                    `pro_department`,
                    `pro_leader`,
                    `leader_name`,
                    `pro_address`,
                    `type_id`,
                    `natureType`,
                    `pro_introduce`,
                    `founder_id`
                )
                VALUES
                    (
                    $pro_code,
                    \"$pro_name\",
                    $industry,
                    $pro_source,
                    $deptId,
                    $projectManagerId,
                    \"$projectManager\",
                    $area,
                    $projectNature,
                    $natureType,
                    \"$projectIntroduce\",
                    $projectManagerId
                    )";


        try{

            $res =  M()->execute($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
         
    }




     /**
     * 查询行业列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function iResult()
     {
        $sql = "
                        SELECT
                            industry_id,
                            industry_name
                        FROM
                            `dm_industry`;";
        $iResultList = M()->query($sql);
        return  $iResultList;
     }

     /**
     * 查询部门列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function dResult()
     {
        $sql = " SELECT id,deptName FROM dm_department";
        $dResultList = M()->query($sql);
        return  $dResultList;
     }

    /**
     * 查询区域列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */

      public function aResult()
     {
        $sql = "SELECT
                        area_id AS aid,
                        area_name AS aname
                    FROM
                        dm_area
                    WHERE
                        parent_id = 0";

        $aResultList = M()->query($sql);
        return  $aResultList;

     }

    /**
     * 查询项目经理列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
      public function pResult()
     {
        $sql = "SELECT * FROM `user_member` WHERE  department LIKE '%交付%' AND duty LIKE '%项目经理%';";

        $pResultList = M()->query($sql);
        return  $pResultList;

     }




}
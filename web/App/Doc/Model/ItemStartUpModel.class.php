<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ItemStartUpModel
{

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
                            industry_id AS iid,
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
        $sql = " SELECT id AS did,deptName FROM dm_department";
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
     * 控股公司列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */

    public function kResult()
     {
        $sql = "SELECT id AS kid,holding FROM `dm_dolding`;";

        $kResultList = M()->query($sql);
        return  $kResultList;

     }

    /**
     * 项目性质 / 战略性质
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */

    public function nResult()
     {
        $sql = "SELECT id AS nid,nature FROM `dm_nature`;";

        $nResultList = M()->query($sql);
        return  $nResultList;

     }
     

    /**
     * 查询项目经理列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function pResult()
     {
        $sql = "SELECT
                    user_id AS pid,
                    member_name
                FROM
                    `user_member` u
                JOIN dm_department d ON u.department = d.id
                WHERE
                    d.deptName LIKE '%交付%'
                AND u.duty LIKE '%项目经理%';";

        $pResultList = M()->query($sql);
        return  $pResultList;

     }

    /**
     * 商务人员
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function swResult()
     {
        $sql = "SELECT user_id,member_name FROM `user_member` WHERE duty like '%商务%'";

        $swResultList = M()->query($sql);
        return  $swResultList;

     }

    /**
     * 售前人员
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function sqResult()
     {
        $sql = "SELECT user_id,member_name FROM `user_member` WHERE duty like '%售前%'";

        $sqResultList = M()->query($sql);
        return  $sqResultList;

     }

     


    /**
     * 人员岗位职责
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function jResult(){


      $sql = "SELECT jobtype_id AS jid,jobtype_name FROM `dm_jobtype`;";

      $res = M()->query($sql);

      return $res;

    }


    
    /**
     * 所有交付人员
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function memberResult($deptCode){


      $sql = "SELECT user_id AS mid,member_name FROM `user_member` where department = \"$deptCode\" ;";

      $res = M()->query($sql);

      return $res;

    }



    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.12.26
     */
    public function projectAdd($pro_code,$pro_name,$pro_source,$projectManager,$projectManagerId,$projectNature,$industry,$deptId,$area,$natureType,$projectIntroduce){

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
     * 查询现有项目分页列表
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
                    i.industry_name,
                    p.logo_path,
                    p.create_date
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
     * 查询现有项目详细列表
     * @author song.chaoxu
     * 2018.11.21
     */
    public function pContent($proCode)
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
                    p.pro_introduce,
                    p.create_date
                    
                FROM
                    `app_project` p
                JOIN dm_industry i ON p.industry_id = i.industry_id
                JOIN dm_department d ON p.pro_department = d.id
                JOIN dm_area a ON p.pro_address = a.area_id
                where p.pro_code = $proCode

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
        $result = $pTable->where($delCode)->delete(); // 删除id为$delCode的用户数据
        return $result;

    }

    /**
     * 新增项目成员
     * @author song.chaoxu
     * 2018.12.27
     */
    public function proPersionAdd($user_code,$member_name,$pro_code,$duty,$come_time,$leave_time,$operation_type,$remarks,$founder_id){

        $app_project_persion = M("app_project_persion"); // 实例化User对象
        $data['user_code'] = $user_code;
        $data['member_name'] = $member_name;
        $data['pro_code'] = $pro_code;
        $data['duty'] = $duty;
        $data['come_time'] = $come_time;
        $data['leave_time'] = $leave_time;
        $data['operation_type'] = $operation_type;
        $data['remarks'] = $remarks;
        $data['founder_id'] = $remarks;
        $res = $app_project_persion->add($data);
        return $res;

    }


    /**
     * 项目成员 列表
     * 
     * @author song.chaoxu 
     * 2018.11.24
     */
    public function persionList($pCode,$page,$limit){
      $app_customer = M('app_project_persion');
      // $count = $app_customer ->where('pro_code=',$pCode) ->count();
      $countSql = "SELECT
                count(id) as total
            FROM
                app_project_persion 
            WHERE
                pro_code=$pCode";
      // $persionList = $app_customer ->field('id,member_name,dept,come_time,leave_time,(case when operation_type = 0 then \'计划内\' when operation_type = 1 then \'新增\' else \'离场\' end)as operation_type,create_data')
      //                               ->join('dm_risktype dr','r.risk_type = dr.id')
      //                               ->where('pro_code',$pCode)
      //                               ->order('create_data desc')
      //                               ->page($page,$limit)
      //                               ->select();
      $sql = "SELECT
                appersion.id,
                appersion.member_name,
                dm.deptName as dept,
                appersion.come_time,
                appersion.leave_time,
                (
                    CASE
                    WHEN appersion.operation_type = 0 THEN
                        '计划内'
                    WHEN appersion.operation_type = 1 THEN
                        '新增'
                    ELSE
                        '离场'
                    END
                ) AS operation_type,
                appersion.create_data
            FROM
                app_project_persion appersion
            JOIN dm_department dm ON appersion.dept = dm.id
            WHERE
                pro_code=$pCode
            ORDER BY
                create_data DESC
            LIMIT $page,$limit";  
      $count=M()->query($countSql); 
      $persionList=M()->query($sql);     
      $result = array();
      $result['code'] = 0;
      $result['msg'] = "";
      $result['count'] = $count[0]['total'];
      $result['data'] = $persionList;
      return $result;

    }


    /**
     *新增客户人
     *@author songcx
     *2018.12.29
     */
    public function proCustomerAdd($pro_code,$department,$duty,$customer_type,$customer_name,$phone,$mailbox,$founder_id,$remarks){

        $app_customer = M("app_customer"); // 实例化User对象
        $data['department'] = $department;
        $data['customer_type'] = $customer_type;
        $data['pro_code'] = $pro_code;
        $data['duty'] = $duty;
        $data['customer_name'] = $customer_name;
        $data['phone'] = $phone;
        $data['mailbox'] = $mailbox;
        $data['remarks'] = $remarks;
        $data['founder_id'] = $founder_id;
        $res = $app_customer->add($data);
        return $res;

    }

    /**
     *客户人列表
     *@author songcx
     *2018.12.29
     */
    public function customerList($pCode,$page,$limit){

       
      // $sql = "SELECT
                        //      c.id AS cid,
                        //      c.department,
                        //      c.duty,
                        //      (
                        //          CASE c.customer_type
                        //          WHEN '1' THEN
                        //              '其他公司'
                        //          WHEN '0' THEN
                        //              '客户'
                        //          ELSE
                        //              '其他'
                        //          END
                        //      ) AS customer_type,
                        //      c.customer_name,
                        //      c.phone,
                        //      c.mailbox,
                        //      c.remarks
                        //  FROM
                        //      `app_customer` c
                        //  WHERE
                        //      c.pro_code = $pCode";

      $app_customer = M('app_customer');
      $count = $app_customer ->where('pro_code='.$pCode) ->count();
      $customerList = $app_customer ->field('id,department,duty,customer_name,phone,mailbox,remarks,create_data,CASE customer_type
                                    WHEN \'1\' THEN
                                        \'其他公司\'
                                    WHEN \'0\' THEN
                                        \'客户\'
                                    ELSE
                                        \'其他\'
                                    END
                                AS customer_type')
                                    ->where('pro_code',$pCode)
                                    ->page($page,$limit)
                                    ->order('create_data desc')
                                    ->select();
      $result = array();
      $result['code'] = 0;
      $result['msg'] = "";
      $result['count'] = $count;
      $result['data'] = $customerList;
      return $result;
    }


    /**
     *立项信息新增
     *@author songcx
     *2018.01.05
     */
    public function approvalAdd( $data )
    {

        $app_project_approval = M('app_project_approval');

        $res = $app_project_approval->add( $data );
        return $res;

    }


    /**
     *立项信息列表
     *@author songcx
     *2018.01.05
     */
    public function approvalList($pCode)
    {

        $app_project_approval = M('app_project_approval');
        $result = $app_project_approval->where('pro_code = '.$pCode)->find();
        // 获取商务人员名称
        $result['swName'] = M('user_member')->field('member_name')->where('user_id = '.$result['market_name'])->find()['member_name'];
        // 获取售前人员名称
        $result['sqName'] = M('user_member')->field('member_name')->where('user_id = '.$result['pre_sale_name'])->find()['member_name'];

        return $result;
    }


}
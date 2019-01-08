<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ItemImplementModel
{


    // /**
    //  * 查询与此人相关的项目列表
    //  * @author song.chaoxu
    //  * 2018.01.07
    //  */
    // public function aboutMeProject($pMCode){

    //     $app_project = M("app_meeting"); // 实例化User对象
    //     $result = $app_project->where('founder_id',$pMCode)->find();
    //     return $result;

    // }

    /**
     * 项目所属阶段
     * @author song.chaoxu
     * 2018.01.07
     */
    public function pStaus(){

        $dm_stage = M("dm_stage"); // 实例化User对象
        $result = $dm_stage->select();
        return $result;

    }

    /**
     * 风险类别
     * @author song.chaoxu
     * 2018.01.07
     */
    public function rType(){

        $dm_risktype = M("dm_risktype"); // 实例化对象
        $result = $dm_risktype->select();
        return $result;

    }

    /**
     * 事件类型
     * @author song.chaoxu
     * 2018.01.07
     */
    public function eType(){

        $dm_etype = M("dm_etype"); // 实例化User对象
        $result = $dm_etype->select();
        return $result;

    }


    /**
     * 风险新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function riskAdd($pro_code,$pro_stage,$risk_content,$risk_type,$level,$consequence,$founder_id){

        $app_project_risk = M("app_project_risk"); // 实例化对象
        $data['pro_code'] = $pro_code;
        $data['pro_stage'] = $pro_stage;
        $data['risk_content'] = $risk_content;
        $data['risk_type'] = $risk_type;
        $data['level'] = $level;
        $data['consequence'] = $consequence;
        $data['founder_id'] = $founder_id;
        $result = $app_project_risk->add($data);
        return $result;
    }

    /**
     * 事件新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function eventAdd($pro_code,$pro_stage,$event_name,$event_type,$event_content,$level,$happen_time,$enclosure,$remarks,$founder_id)
        {

                $app_majorevents = M("app_majorevents"); // 实例化对象
                $data['pro_code'] = $pro_code;
                $data['pro_stage'] = $pro_stage;
                $data['event_name'] = $event_name;
                $data['event_type'] = $event_type;
                $data['event_content'] = $event_content;
                $data['level'] = $level;
                $data['happen_time'] = $happen_time;
                $data['enclosure'] = $enclosure;
                $data['remarks'] = $remarks;
                $data['founder_id'] = $founder_id;
                $result = $app_majorevents->add($data);
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

      // $sql = "SELECT * FROM `app_project_persion` WHERE pro_code = $pCode";

      // $res = M()->query($sql);

      $app_customer = M('app_project_persion');
      $count = $app_customer ->where('pro_code='.$pCode) ->count();
      $persionList = $app_customer ->field('id,member_name,dept,come_time,leave_time,operation_type,create_data')
                                    ->where('pro_code',$pCode)
                                    ->order('create_data desc')
                                    ->page($page,$limit)
                                    ->select();
      $result = array();
      $result['code'] = 0;
      $result['msg'] = "";
      $result['count'] = $count;
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
						// 		c.id AS cid,
						// 		c.department,
						// 		c.duty,
						// 		(
						// 			CASE c.customer_type
						// 			WHEN '1' THEN
						// 				'其他公司'
						// 			WHEN '0' THEN
						// 				'客户'
						// 			ELSE
						// 				'其他'
						// 			END
						// 		) AS customer_type,
						// 		c.customer_name,
						// 		c.phone,
						// 		c.mailbox,
						// 		c.remarks
						// 	FROM
						// 		`app_customer` c
						// 	WHERE
						// 		c.pro_code = $pCode";

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
    public function approvalAdd($pro_code,$market_name,$pre_sale_name,$pro_stime,$pro_etime,$secrecy_grade,$difficulty_rank,$pro_enclosure,$pro_msg,$cooperative_unit,$state,$founder_id)
    {

        $app_project_approval = M('app_project_approval');
        $data['pro_code'] = $department;
        $data['market_name'] = $customer_type;
        $data['pre_sale_name'] = $pro_code;
        $data['pro_stime'] = $duty;
        $data['pro_etime'] = $customer_name;
        $data['secrecy_grade'] = $phone;
        $data['difficulty_rank'] = $mailbox;
        $data['pro_enclosure'] = $remarks;       
        $data['pro_msg'] = $founder_id;
        $data['cooperative_unit'] = $founder_id;
        $data['founder_id'] = $founder_id;
        $res = $app_project_approval->add($data);
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
        $result = $app_project_approval->where('pro_code',$pCode)->find();
        
        return $result;
    }


}
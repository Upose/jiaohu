<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemStartUpModel;

  /**
    *项目启动阶段
    *@author song.chaoxu
    *2018.01.02
    */
class ItemStartUpController extends BaseController {

	/**
     * 输出首页
     * @author song.chaoxu
     * 2018.11.14
     */
    public function index()
    {

    	$this->display();
    	
    }

    /**
     * 项目新增下拉信息
     * @author song.chaoxu
     * 2018.12.26
     */
    public function projectDropResult()
    {
        
        //以下是所有下拉框列表
        //区域 - 页面下拉项内容
        $aResult=$this->aResult=
        ItemStartUpModel::aResult();

        //行业 - 页面下拉项内容
        $iResult=$this->iResult=
        ItemStartUpModel::iResult();

        //性质 - 页面下拉项内容
        $nResult=$this->nResult=
        ItemStartUpModel::nResult();

        //经理 - 页面下拉项内容
        $pResult=$this->pResult=
        ItemStartUpModel::pResult();

        //部门 - 页面下拉项内容
        $dResult=$this->dResult=
        ItemStartUpModel::dResult();

        //项目来源 - 页面下拉项内容
        $kResult=$this->kResult=
        ItemStartUpModel::kResult();

        $final['aResult'] = $aResult;
        $final['iResult'] = $iResult;
        $final['pResult'] = $pResult;
        $final['dResult'] = $dResult;
        $final['kResult'] = $kResult;
        $final['nResult'] = $nResult;
        
        $this->Response(200,$final,'');

    }



    /**
     * 项目新增
     * @author song.chaoxu
     * 2018.11.20
     */
    public function projectAdd()
    {
        //项目编号
        $pro_code = intval(time());

        //項目名稱
        $pro_name = I('pro_name');

        //项目来源
        $pro_source = I('pro_source'); 

         //项目经理
        $projectManager = I('projectManager');

        //项目经理ID
        $projectManagerId = I('projectManagerId');
   
        //项目性质
        $projectNature = I('projectNature');

        //所在行业
        $industry = I('industry_id');

        //部门ID
        $deptId = I('divisionManagerId');

        //所在区域
        $area = I('pro_address');

        //性质描述
        $natureType = I('natureType');

        // 项目介绍
        $projectIntroduce = I('projectIntroduce');


        $status=$this->status=
            ItemStartUpModel::projectAdd($pro_code,$pro_name,$pro_source,$projectManager,$projectManagerId,$projectNature,$industry,$deptId,$area,$natureType,$projectIntroduce);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

    }


    /**
     * 项目查询
     * @author song.chaoxu
     * 2018.12.27
     */
    public function pList()
    {

        //区域
        // $proArea = I('proArea','');
      
        //名称
        $proName = I('proName','');
       
        //页数
        $page=intval(I('page',1));

        //每页显示条数
        $limit=intval(I('limit',10));

        $pag=($page-1)*$limit;

        //项目列表
        $projectList=$this->projectList=
        ItemStartUpModel::pList($proName,$pag,$limit);

        $this->Response(200,$projectList,'');

    }




    /**
     * 项目详细查询
     * @author song.chaoxu
     * 2018.12.27
     */
    public function pContent()
    {
      
        //项目编码
        $proCode = I('pCode','');

        //项目详细列表
        $pContent=$this->pContent=
        ItemStartUpModel::pContent($proCode);

        $this->Response(200,$pContent,'');

    }



    /**
     * 删除项目
     * @author song.chaoxu
     * 2018.12.27
     */
    public function deleteProject()
    {
      
        //根据项目编号 删除项目
        $pCode = I('pCode','');

        //定义执行状态码
        $status = 0;
       
        //定义执行信息
        $msg = "";

        //删除结果
        $dProjectResult=$this->dProjectResult=
        ItemStartUpModel::dProject($pCode);

        if ($dProjectResult = 1) {
            $status= 200;
            $msg = "项目编号".$pCode."：删除成功!";
        }else if($dProjectResult = 0){
            $status= 300;
            $msg = "无删除记录";
        }else{
            $status= 500;
           $msg = "SQL错误：请检查SQL";

        }
        $this->Response($status,$dProjectResult,$msg);

    }

    /**
     *成员下拉列表
     *@author songcx
     *2018.01.02
     */
    public function memberDropSelect()
    {

        //以下是所有下拉框列表
        //岗位职责 - 页面下拉项内容
        $jResult=$this->jResult=
        ItemStartUpModel::jResult();

        //部门 - 页面下拉项内容
        $dResult=$this->dResult=
        ItemStartUpModel::dResult();

        //所有人 - 页面下拉项内容
        $memberResult=$this->memberResult=
        ItemStartUpModel::memberResult();


        $final['jResult'] = $jResult;
        $final['dResult'] = $dResult;
        $final['memberResult'] = $memberResult;


        $this->Response(200,$final,'');

    }

    /**
     *新增项目成员
     *@author songcx
     *2018.12.29
     */
    public function proPersionAdd()
    {

        // 成员id
        $user_code = I('uCode');
        // 成员姓名
        $member_name = I('mName');
        // 项目编号
        $pro_code = I('pCode');
        // 职位
        $duty = I('duty');
        // 部门
        $dept = I('dept');
        // 到岗时间
        $come_time = I('cTime');
        // 离岗时间
        $leave_time = I('lTime');
        // 操作类型
        $operation_type = I('oType');
        // 备注
        $remarks = I('remarks');
        // 备注
        $founder_id = I('founder_id');

        $res = $this->res=
        ItemStartUpModel::proPersionAdd($user_code,$member_name,$pro_code,$duty,$come_time,$leave_time,$operation_type,$remarks,$founder_id);
        
        $this->Response(0,$res,'');
    }

// -------------------------未完成-----------------------------------------
    /**
     *客户干系下拉列表
     *@author songcx
     *2018.01.02
     */
    public function customerDropSelect()
    {



        //以下是所有下拉框列表

        //查询此人的项目列表 
        $pMId = I('pMId');

        $projectList=$this->projectList=
        ProjectCommonModel::myProjrce($pMId);


        // //部门 - 页面下拉项内容
        // $dResult=$this->dResult=
        // ItemStartUpModel::dResult();

        // //所有人 - 页面下拉项内容
        // $memberResult=$this->memberResult=
        // ItemStartUpModel::customerResult();


        // $final['jResult'] = $jResult;
        // $final['dResult'] = $dResult;
        // $final['memberResult'] = $memberResult;



        $this->Response(200,$final,'');

    }

// ------------------------------------------------------------------


    /**
     *新增客户成员
     *@author songcx
     *2018.12.29
     */
    public function proCustomerAdd()
    {

        // 项目编号
        $pro_code = I('pCode');
        // 部门
        $department = I('department');
        // 所属职责
        $duty = I('duty');
        // 客户类别
        $customer_type = I('customer_type');
        // 客户姓名
        $customer_name = I('customer_name');
        // 客户联系电话
        $phone = I('phone');
        // 客户邮箱
        $mailbox = I('mailbox');
        // 创建人
        $founder_id = I('founder_id');
        // 备注
        $remarks = I('remarks');

        $res = $this->res=
        ProjectCommonModel::proCustomerAdd($pro_code,$department,$duty,$customer_type,$customer_name,$phone,$mailbox,$founder_id,$remarks);
        
        $this->Response(0,$res,'');
    }




}
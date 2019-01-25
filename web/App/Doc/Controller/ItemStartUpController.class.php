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
    public function memberDropResult()
    {

        // 成员id
        $deptCode = I('deptCode');

        //所有人 - 页面下拉项内容
        $memberResult=$this->memberResult=
        ItemStartUpModel::memberResult($deptCode);

        $this->Response(200,$memberResult,'');

    }

    /**
     *成员下拉列表
     *@author songcx
     *2018.01.02
     */
    public function deptmentDropResult()
    {

        //以下是所有下拉框列表
        //岗位职责 - 页面下拉项内容
        $jResult=$this->jResult=
        ItemStartUpModel::jResult();

        //部门 - 页面下拉项内容
        $dResult=$this->dResult=
        ItemStartUpModel::dResult();

        $final['jResult'] = $jResult;
        $final['dResult'] = $dResult;

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
        
        $this->Response(200,$res,'');
    }


   /**
     *项目成员列表
     *@author songcx
     *2018.01.02
     */
    public function persionList()
    {

        $pCode = I('pCode');
        $page = I('page');
        $limit = I('limit');

        $persionList=$this->persionList=
        ItemStartUpModel::persionList($pCode,$page,$limit);


        $result_json = json_encode($persionList);
        echo $result_json;

    }


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
        ItemStartUpModel::proCustomerAdd($pro_code,$department,$duty,$customer_type,$customer_name,$phone,$mailbox,$founder_id,$remarks);
        
        $this->Response(200,$res,'');
    }


   /**
     *客户干系列表
     *@author songcx
     *2018.01.02
     */
    public function customerList()
    {
        $pCode = I('pCode');
        $page = I('page');
        $limit = I('limit');
        $customerList=$this->customerList=
        ItemStartUpModel::customerList($pCode,$page,$limit);
        
        $result_json = json_encode($customerList);
        echo $result_json;
    }


    /**
     *立项信息下拉列表
     *@author songcx
     *2018.01.03
     */
    public function approvalDropResult()
    {

        //以下是所有下拉框列表
        //商务人员 - 页面下拉项内容
        $swResult=$this->swResult=
        ItemStartUpModel::swResult();

        //售前人员 - 页面下拉项内容
        $sqResult=$this->sqResult=
        ItemStartUpModel::sqResult();

        $final['swResult'] = $swResult;
        $final['sqResult'] = $sqResult;


        $this->Response(200,$final,'');

    }

    /**
     *立项信息列表
     *@author songcx
     *2018.01.05
     */
    public function approvalList()
    {

        //项目编号
        $pCode = I('pCode');

        $approvalList=$this->approvalList=
        ItemStartUpModel::approvalList($pCode);

        $this->Response(200,$approvalList,'');

    }

    /**
     *立项信息新增
     *@author songcx
     *2018.01.05
     */
    public function approvalAdd()
    {

        //项目编号 pro_code    
        $pro_code = I('pCode');

        // market_name 商务责任人
        $market_name = I('swName');

        // Pre_sale_name   售前责任人
        $pre_sale_name = I('sqName');

        // pro_stime   项目计划开始时间
        $pro_stime = I('pStime');

        // pro_etime   项目计划结束时间
        $pro_etime = I('pEtime');

        // secrecy_grade   密级程度（普通、紧急）
        $secrecy_grade = I('sGrade');

        // difficulty_rank 项目难度等级
        $difficulty_rank = I('dRank');

        // pro_enclosure   项目相关附件
        $pro_enclosure = '';

        // pro_msg     立项信息
        $pro_msg = I('pMsg');

        // cooperative_unit    合作单位
        $cooperative_unit = I('cUtil');

        // Founder_id  
        $founder_id = I('pMid');


        if ($_FILES) {
        // echo ($_FILES["file"][size] / 1024)."kb";

          foreach ($_FILES as $key => $value) {
            //实例化上传类
            $upload =  new \Think\Upload();
            //设置附件上传大小
            // $upload->maxSize=3145728;
            //保持文件名不变
            $upload->saveName = time()."dt".rand(0,10);
            //设置附件上传类型
            // $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt');
            //设置附件上传根目录
            $upload->rootPath = './Updata/ApprovalFile/'; 
            //设置附件上传（子）目录
            $upload->savePath = '';
            $result = $upload->upload();
            // echo '<pre>';
            // var_dump($result);
            // echo '</pre>';
            // file_put_contents("11114.txt", json_encode($result));
            if($result){
              foreach ($result as $key => $value) {
                $savename  = $pro_code.'_'.$value['savename'];
                $path  = "/Updata/ApprovalFile/".$value['savepath'];
                $pro_enclosure = $newpath = $path.$savename;
                $href[] = $newpath;
                echo $filePath."|_____________________path";
                                
              }
            }
              
          }

        }

        $approvalAdd=$this->approvalAdd=
        ItemStartUpModel::approvalAdd($pro_code,$market_name,$pre_sale_name,$pro_stime,$pro_etime,$secrecy_grade,$difficulty_rank,$pro_enclosure,$pro_msg,$cooperative_unit,$founder_id);

        $this->Response(200,$approvalAdd,'');

    }


}
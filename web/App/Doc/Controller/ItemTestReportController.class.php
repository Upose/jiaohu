<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemTestReportModel;

  /**
    *项目测试阶段
    *@author song.chaoxu
    *2018.01.22
    */
class ItemTestReportController extends BaseController {

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
     * 测试新增
     * @author song.chaoxu
     * 2019.01.22
     */
    public function testReportAdd(){

        //項目编号
        $pro_code = I('pCode');

        //测试目的
        $objective = I('objective');

        //测试类型
        $type = I('type');

        //操作系统
        $operating_system = I('oSystem');

        //cpu
        $cpu = I('cpu');

        //内存
        $memory  = I('memory');

        //存储
        $storage  = I('storage');

        //系统名称 

        $system_name  = I('sName');

        //测试人
        $testPeople  = I('testPeople');

        //系统测试时间 
        $testTime  = I('testTime');

        //预留问题
        $residual_defect  = I('rDefect');

        //是否达到预定目标 
        $target  = I('target');

        // 附件
        $enclosure = I('filePath');

        //备注
        $remarks = I('remarks');

        //创建人
        $founder_id = I('founder_id');


        $addStaus = $this->result=
        ItemTestReportModel::testReportAdd($pro_code,$objective,$type,$operating_system,$cpu,$memory,$storage,$system_name,$testPeople,$testTime,$remarks,$residual_defect,$target,$enclosure,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }



    /**
     * 会议查询
     * @author song.chaoxu
     * 2019.01.26
     */
    public function testReportList()
    {

      
        //項目编号
        $pro_code = I('pCode');
        $page = I('page');
        $limit = I('limit');

        $testReportResult = $this->result=
        ItemTestReportModel::testReportResult($pro_code,$page,$limit);
                
        $result_json = json_encode($testReportResult);
        echo $result_json;

    }








}
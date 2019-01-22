<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemTestReportModel;

  /**
    *项目执行管理阶段
    *@author song.chaoxu
    *2018.01.02
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
     * 2019.01.07
     */
    public function testReportAdd(){


// pro_code    varchar(255)    项目编号  
// objective   varchar(255)    测试目的  
// type    int   测试类型  
// operating_system    char(30)    操作系统  
// cpu   char(30)    cpu 
// Memory    char(30)    内存  
// storage   char(30)    存储  
// System_name   varchar(255)    系统名称  
// people    varchar(255)    测试人员  
// time    varchar(255)    测试时间  
// Residual_defect   varchar(255)    残留缺陷  
// target    int   是否达到预定目标  
// enclosure   varchar(255)    相关附件  
// remarks   varchar(255)    备注  
// state   int   状态  
// Founder_id    int   创建人 
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

        //存储
        $testPeople  = I('testPeople');

        //系统测试时间 
        $testTime  = I('testTime');

        //预留问题
        $residual_defect  = I('rDefect');

        //是否达到预定目标 
        $target  = I('target');

        // 附件
        $enclosure = '';

        //备注
        $remarks = I('remarks');

        //创建人
        $founder_id = I('founder_id');

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
            $upload->rootPath = './Updata/TestReportFile/'; 
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
                $path  = "/Updata/TestReportFile/".$value['savepath'];
                $enclosure = $newpath = $path.$savename;
                $href[] = $newpath;
                echo $filePath."|_____________________path";
                                
              }
            }
              
          }

        }

        $addStaus = $this->result=
        ItemImplementModel::eventAdd($pro_code,$pro_stage,$event_name,$event_type,$event_content,$level,$happen_time,$enclosure,$remarks,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }

}
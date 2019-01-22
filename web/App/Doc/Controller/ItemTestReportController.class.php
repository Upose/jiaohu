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
                // echo $filePath."|_____________________path";
                                
              }
            }
              
          }

        }

        $addStaus = $this->result=
        ItemTestReportModel::testReportAdd($pro_code,$objective,$type,$operating_system,$cpu,$memory,$storage,$system_name,$testPeople,$testTime,$remarks,$residual_defect,$target,$enclosure,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }

}
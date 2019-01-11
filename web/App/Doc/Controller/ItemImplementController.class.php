<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemImplementModel;

  /**
    *项目执行管理阶段
    *@author song.chaoxu
    *2018.01.02
    */
class ItemImplementController extends BaseController {

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
     * 风险新增下拉信息
     * @author song.chaoxu
     * 2019.01.06
     */
    public function riskDropResult(){

        //以下是所有下拉框列表
        //项目所属阶段 - 页面下拉项内容
        $pStaus=$this->pStaus=
        ItemImplementModel::pStaus();

        //风险类别 - 页面下拉项内容
        $rType=$this->rType=
        ItemImplementModel::rType();

        $final['pStaus'] = $pStaus;
        $final['rType'] = $rType;
        $this->Response(200,$final,'');

    }

    /**
     * 风险新增
     * @author song.chaoxu
     * 2019.01.07
     */
    public function riskAdd(){



        //項目编号
        $pro_code = I('pCode');

        //項目所属阶段
        $pro_stage = I('stage');

        //項目风险内容
        $risk_content = I('rContent');

        //风险类别
        $risk_type = I('rType');

        //风险等级
        $level = I('level');

        //风险结果
        $consequence = I('consequence');

        //创建人
        $founder_id = I('founder_id');

        $addStaus = $this->result=
        ItemStartUpModel::riskAdd($pro_code,$pro_stage,$risk_content,$risk_type,$level,$consequence,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }


    /**
     * 事件新增下拉信息
     * @author song.chaoxu
     * 2019.01.06
     */
    public function eventDropResult(){

        //以下是所有下拉框列表
        //项目所属阶段 - 页面下拉项内容
        $pStaus=$this->pStaus=
        ItemImplementModel::pStaus();

        //风险类别 - 页面下拉项内容
        $eType=$this->eType=
        ItemImplementModel::eType();

        $final['pStaus'] = $pStaus;
        $final['eType'] = $eType;
        $this->Response(200,$final,'');

    }

    /**
     * 事件新增
     * @author song.chaoxu
     * 2019.01.07
     */
    public function eventAdd(){


        //項目编号
        $pro_code = I('pCode');

        //項目所属阶段
        $pro_stage = I('stage');

        //事件名称
        $event_name = I('event_name');

        //事件类型
        $event_type = I('event_type');

        //事件内容
        $event_content = I('event_content');

        //事件级别
        $level  = I('level');

        //事件发生时间
        $happen_time  = I('happen_time');

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
            $upload->rootPath = './Updata/EventFile/'; 
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
                $path  = "/Updata/EventFile/".$value['savepath'];
                $enclosure = $newpath = $path.$savename;
                $href[] = $newpath;
                echo $filePath."|_____________________path";
                                
              }
            }
              
          }

        }

        $addStaus = $this->result=
        ItemStartUpModel::eventAdd($pro_code,$pro_stage,$event_name,$event_type,$event_content,$level,$happen_time,$enclosure,$remarks,$founder_id);
        
        $this->Response(200,$addStaus,'');

    }



}
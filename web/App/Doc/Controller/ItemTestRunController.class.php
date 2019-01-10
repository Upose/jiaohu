<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemTestRunModel;

/**
*试运行控制器
*@author he.xiang
*2019.1.4
*/
class ItemTestRunController extends BaseController {
	/**
	 *项目试运行信息添加接口
     *@author he.xiang
     *2018.1.4
	 */
	public function testRunAdd(){
		//项目编号
		$p['pro_code'] = I('pro_code');
		//试运行内容
		$p['content'] = I('content');
		//试运行情况
		$p['situation'] = I('situation');
		//运行部门
		$p['department'] = I('department');
		//用户评价
		$p['evaluate'] = I('evaluate');
		//开始时间
		$p['start_time'] = I('start_time');
		//结束时间
		$p['stop_time'] = I('stop_time');
		//是否达到预期目标
		$p['target'] = I('target');
		//备注
		$p['remarks'] = I('remarks');
		//创建人
		$p['founder_id'] = I('founder_id');
		//相关附件
		$p['enclosure'] = '';
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
	            $upload->rootPath = './Updata/TestRun/'; 
	            //设置附件上传（子）目录
	            $upload->savePath = '';
	            $result = $upload->upload();
	            // echo '<pre>';
	            // var_dump($result);
	            // echo '</pre>';
	            // file_put_contents("11114.txt", json_encode($result));
	            if($result){
					foreach ($result as $key => $value) {
					$savename  = $value['savename'];
					$path  = "/Updata/TestRun/".$value['savepath'];
					$p['enclosure'] = $newpath = $path.$savename;
					$href[] = $newpath;
					// echo $filePath."|_____________________path";
	            	}
	            }
            }
		}
		$status=$this->status=ItemAcceptanceModel::testRunAdd($p);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }

	}










}
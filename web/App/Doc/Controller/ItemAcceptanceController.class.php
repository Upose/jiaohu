<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemAcceptanceModel;

/**
*验收归档控制器
*@author he.xiang
*2019.1.2
*/
class ItemAcceptanceController extends BaseController {
	/**
	 *项目验收接口
     *@author he.xiang
     *2018.1.2
	 */
	public function projectAcceptance(){
		//项目id
		$p['pro_code'] = I('pro_code');
		//验收地点
		$p['place'] = I('place');
		//竣工时间
		$p['J_time'] = I('J_time');
		//验收时间
		$p['C_time'] = I('C_time');
		//验收人员
		$p['people'] = I('people');
		//验收内容
		$p['content'] = I('content');
		//验收评价
		$p['evaluate'] = I('evaluate');
		//备注
		$p['remarks'] = I('remarks');
		//创建人
		$p['founder_id'] = I('founder_id');
		//上传附件
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
	            $upload->rootPath = './Updata/ProjectFile/'; 
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
					$path  = "/Updata/ProjectFile/".$value['savepath'];
					$p['enclosure'] = $newpath = $path.$savename;
					$href[] = $newpath;
					// echo $filePath."|_____________________path";
	            	}
	            }
            }
		}
		$status=$this->status=ItemAcceptanceModel::acceptAdd($p);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
                } else {
                throw new Exception('数据插入失败');
                }
	}

}
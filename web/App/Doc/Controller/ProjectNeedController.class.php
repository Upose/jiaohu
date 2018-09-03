<?php 

namespace Doc\Controller;
use Doc\Model\ProjectNeedModel;

/**
 * 需求管理模块控制器
 * @author shi.xiaoyang
 * 2018.8.16
 */
class ProjectNeedController extends BaseController
{
	/**
   * 需求列表接口
   * @author shi.xiaoyang
   * 2018.8.16
   *参数1 pid  项目id
   */
  public function add(){
    $this->display();
  }
	public function needlist()
	{
		$params['pid'] = I('pid');
		$params['start_time'] = I('start_time');
		$params['end_time'] = I('end_time');
    $params['title'] = I('title');
    $params['page'] = I('page');
		$params['size'] = I('size');
		$data = ProjectNeedModel::needlist($params);
		// var_dump($data);die;
		$this->Response(0,$data,'');
	}
	/**
   * 需求添加接口
   * @author shi.xiaoyang
   * 2018.8.16
   *参数1 pid  项目id
   *参数2 title  需求名称
   *参数3 kname  甲方名称
   *参数4 dname  调研人名称
   *参数5 start_time  开始时间
   *参数6 end_time  结束时间
   *参数7 content  需求内容
   */
	public function needadd()
	{
		$pid = I('pid');
		$title = I('title');
		$kname = I('kname');
		$dname = I('dname');
		$start_time = I('start_time');
		$end_time = I('end_time');
    $content = I('content');
		$xuqiu_back = I('xuqiu_back');
    $href = array();
    if(!empty($content)){
      $href[] = $content;
    }
    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';
    // die;
    // if ($_FILES) {
    //   echo '1';
    // }else{
    //   echo 2;
    // }
    // die;
    if ($_FILES) {
      foreach ($_FILES as $key => $value) {
        //实例化上传类
        $upload =  new \Think\Upload();
        //设置附件上传大小
        $upload->maxSize=3145728;
        //保持文件名不变
        $upload->saveName = time()."dt".rand(0,10);
        //设置附件上传类型
        $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt');
        //设置附件上传根目录
        $upload->rootPath = './Mdhtml/'; 
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
            $path  = "/Mdhtml/".$value['savepath'];
            $newpath = $path.$savename;
            // echo $newpath;
            $href[] = $newpath;
          }
        }
          
      }
    }
    $info =array(
    	'pid'=>$pid,
    	'title'=>$title,
    	'kname'=>$kname,
    	'dname'=>$dname,
    	'start_time'=>$start_time,
    	'end_time'=>$end_time,
    	'xuqiu_back'=>$xuqiu_back,
    );
        // var_dump($info);die;
		$data = ProjectNeedModel::needadd($info,$href);
		$this->Response(0,$data,'');
	}
	/**
   * 需求查看接口
   * @author shi.xiaoyang
   * 2018.8.16
   *参数1 id  需求id
   */
	public function needcheck()
	{
		$id = I('id');
		$data = ProjectNeedModel::needcheck($id);
		// var_dump($data);die;
		$this->Response(0,$data,'');
	}
	/**
   * 需求编辑接口
   * @author shi.xiaoyang
   * 2018.8.16
   *参数1 id  需求id
   *参数2 title  需求名称
   *参数3 kname  甲方名称
   *参数4 dname  调研人名称
   *参数5 start_time  开始时间
   *参数6 end_time  结束时间
   *参数7 content  需求内容
   */
	public function neededit()
	{
		$id = I('id');
		$Uid = I('Uid');
		$title = I('title');
		$kname = I('kname');
		$dname = I('dname');
		$start_time = I('start_time');
		$end_time = I('end_time');
    $content = I('content');
    $xuqiu_back = I('xuqiu_back');
		$href = array();
    if(!empty($content)){
      $href[] = $content;
    }
    if ($_FILES) {
      foreach ($_FILES as $key => $value) {
        //实例化上传类
        $upload =  new \Think\Upload();
        //设置附件上传大小
        $upload->maxSize=3145728;
        //保持文件名不变
        $upload->saveName = time()."dt".rand(0,10);
        //设置附件上传类型
        $upload->exts=array('html','htm','jpg', 'gif', 'png', 'jpeg','txt');
        //设置附件上传根目录
        $upload->rootPath = './Mdhtml/'; 
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
            $path  = "/Mdhtml/".$value['savepath'];
            $newpath = $path.$savename;
            // echo $newpath;
            $href[] = $newpath;
          }
        }
          
      }
    }
    $info =array(
      'pid'=>$pid,
      'title'=>$title,
      'kname'=>$kname,
      'dname'=>$dname,
      'start_time'=>$start_time,
      'end_time'=>$end_time,
      'xuqiu_back'=>$xuqiu_back,
    );
		$data = ProjectNeedModel::neededit($id,$info,$href);
		//data = 1,表示修改成功,=0表示数据没有修改,=2表示修改失败
		if ($data == 1 || $data == 0) {
			$data = 1;
    }
  
    // $this->Response(0,$data,'');
    
    $this->redirect('ProjectDescription/pro_demand',array('id'=>$Uid));
	}



}





 ?>
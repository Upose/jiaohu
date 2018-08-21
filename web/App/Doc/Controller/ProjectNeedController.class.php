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
	public function needlist()
	{
		$params['pid'] = I('pid');
		$params['start_time'] = I('start_time');
		$params['end_time'] = I('end_time');
		$params['title'] = I('title');
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
   *参数8 xuqiu_back 需求背景
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
		if(!empty($content))
        {
          $href = $content;
        }
        else
        {
            //以下是上传附件操作
            //实例化上传类
            $upload =  new \Think\Upload();
            //设置附件上传大小
            $upload->maxSize=3145728;
            //保持文件名不变
            $upload->saveName = time()."dt".rand(0,10);
            //设置附件上传类型
            $upload->exts=array('html','htm');
            //设置附件上传根目录
            $upload->rootPath = './Mdhtml/'; 
            //设置附件上传（子）目录
            $upload->savePath = ''; 

            $info =  $upload->upload();

           

            if($info)
            {

                $savename  = $info['feedfile']['savename'];
                $path  = "/Mdhtml/".$info['feedfile']['savepath'];
                $newpath = $path.$savename;
                $href = $newpath;
               
            }
        }
        $info =array(
        	'pid'=>$pid,
        	'title'=>$title,
        	'kname'=>$kname,
        	'dname'=>$dname,
        	'start_time'=>$start_time,
        	'end_time'=>$end_time,
        	'content'=>$href,
        	'xuqiu_back'=>$xuqiu_back,
        );
        // var_dump($info);die;
        $data = ProjectNeedModel::needadd($info);
            if($data)
            {
              $this->redirect('ProjectDescription/pro_demand',array('id'=>$pid));
              
                
            }

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
		$title = I('title');
		$kname = I('kname');
		$dname = I('dname');
		$start_time = I('start_time');
		$end_time = I('end_time');
		$content = I('content');
		if(!empty($content))
        {
          $href = $content;
        }
        else
        {
            //以下是上传附件操作
            //实例化上传类
            $upload =  new \Think\Upload();
            //设置附件上传大小
            $upload->maxSize=3145728;
            //保持文件名不变
            $upload->saveName = time()."dt".rand(0,10);
            //设置附件上传类型
            $upload->exts=array('html','htm');
            //设置附件上传根目录
            $upload->rootPath = './Mdhtml/'; 
            //设置附件上传（子）目录
            $upload->savePath = ''; 

            $info =  $upload->upload();

           

            if($info)
            {
                $savename  = $info['feedfile']['savename'];
                $path  = "/Mdhtml/".$info['feedfile']['savepath'];
                $newpath = $path.$savename;
                $href = $newpath;
               
            }
        }
        $info =array(
        	'title'=>$title,
        	'kname'=>$kname,
        	'dname'=>$dname,
        	'start_time'=>$start_time,
        	'end_time'=>$end_time,
        	'content'=>$href,
        );
		$data = ProjectNeedModel::neededit($id,$info);
		//data = 1,表示修改成功,=0表示数据没有修改,=2表示修改失败
		if ($data == 1 || $data == 0) {
			$data = 1;
		}
		$this->Response(0,$data,'');
	}




}





 ?>
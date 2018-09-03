<?php 

namespace Doc\Model;
/**
 * 需求管理模型
 * @author shi.xiaoyang
 * 2018.8.16
 */
class ProjectNeedModel{

	/**
	 * 查询现有项目所有需求
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function needlist($params)
	{
		$where = " a.pid=$params[pid]";
		if (!empty($params['start_time'])) {
			$where .= " and a.start_time >= '$params[start_time]'";
		}
		if (!empty($params['end_time'])) {
			$where .= " and a.start_time <= '$params[end_time]'";
		}
		if (!empty($params['title'])) {
			$where .= " and a.title like '%$params[title]%'";
		}
		if (!empty($params['size']) && !empty($params['page'])) {
			$size = $params['size'];
			$page = $params['page'];
			$start = ($page - 1) * $size;
		}
		$res['res'] = M("project_need as a")->join("ProjectManagement as b on b.id=a.pid")->field("a.*,b.name")->where($where)->limit($start,$size)->select();
		foreach ($res['res'] as $key => &$value) {
			$content = M("need_content")->field("content")->where("need_id=$value[id]")->select();
			foreach ($content as $v) {
				$info[] = $v['content'];
			}
			$value['content'] = $info;
		}
		$res['counts'] = M("project_need as a")->join("ProjectManagement as b on b.id=a.pid")->field("a.*,b.name")->where($where)->count();
		return $res;
	}
	/**
	 * 添加一条新的项目需求
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function needadd($info,$href)
	{
		if (!empty($info)) {
			$res = M("project_need")->add($info);
			if ($res) {
				foreach ($href as $key => $value) {
					$info1 =array(
					    	'need_id'=>$res,
					    	'content'=>$value
					    );
					$result = M("need_content")->add($info1);
				}
				return 1;
			}
		}
		return 0;
	}

	/**
	 * 查询单条需求内容
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function needcheck($id)
	{
		if (!empty($id)) {
			$where = " a.id=$id";
		}
		$res = M("project_need as a")->join("ProjectManagement as b on b.id=a.pid")->field("a.*,b.name")->where($where)->select();
		foreach ($res as $key => &$value) {
			$content = M("need_content")->field("content")->where("need_id=$value[id]")->select();
			foreach ($content as $v) {
				$info[] = $v['content'];
			}
			$value['content'] = $info;
		}
		return $res;
	}
	/**
	 * 编辑一条新的项目需求
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function neededit($id,$info,$href)
	{
		if (!empty($info)) {
			$res = M("project_need")->where("id=$id")->save($info);
			$result = M("need_content")->where("need_id=$id")->delete();
			foreach ($href as $key => $value) {
				$info1 =array(
				    	'need_id'=>$id,
				    	'content'=>$value
				    );
				$result = M("need_content")->add($info1);
			}
			return 1;
		}
		return 2;
	}



}














 ?>
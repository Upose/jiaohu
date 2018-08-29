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
		if (!empty($params[start_time])) {
			$where .= " and a.start_time >= '$params[start_time]'";
		}
		if (!empty($params[end_time])) {
			$where .= " and a.start_time <= '$params[end_time]'";
		}
		if (!empty($params[title])) {
			$where .= " and a.title like '%$params[title]%'";
		}
		$res = M("project_need as a")->join("ProjectManagement as b on b.id=a.pid")->field("a.*,b.name")->where($where)->select();
		return $res;
	}
	/**
	 * 添加一条新的项目需求
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function needadd($info)
	{
		if (!empty($info)) {
			$res = M("project_need")->add($info);
			if ($res) {
				return $res;
			}
			return 0;
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
		return $res;
	}
	/**
	 * 编辑一条新的项目需求
	 * @author shi.xiaoyang
	 * 2018.8.16
	 */
	public function neededit($id,$info)
	{
		if (!empty($info)) {
			$res = M("project_need")->where("id=$id")->save($info);
			return $res;
		}
		return 2;
	}



}














 ?>
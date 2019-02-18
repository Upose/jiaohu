<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemMilepostModel;

/**
*项目里程碑/工作计划
*@author he.xiang
*2019.1.2
*/ 
class ItemMilepostController extends BaseController {
	/**
	 *新建总体计划任务接口
     *@author he.xiang
     *2018.1.2
	 */
	public function planningTask(){
		//pro_code	项目编号
		$p['pro_code'] = I('pro_code');
		//plan_code 计划编号
		$p['plan_code'] = time();
		//plan_name	计划名称
		$p['plan_name'] = I('plan_name');
		//plan_content	计划内容
		$p['plan_content'] = I('plan_content');
		//type_id	项目性质
		$p['type_id'] = I('type_id');
		//plan_stime	计划开始时间
		$p['plan_stime'] = I('plan_stime');
		//plan_etime	计划开始时间
		$p['plan_etime'] = I('plan_etime');
		//deliver_target	计划交付目标
		$p['deliver_target'] = I('deliver_target');
		//计划类型
		$p['plan_type'] = I('plan_type');
		//remarks 备注
		$p['remarks'] = I('remarks');
		//创建人
		$p['founder_id'] = I('founder_id');

		$status=$this->status=ItemMilepostModel::planningTask($p);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
            } else {
            	throw new Exception('数据插入失败');
            }
	}

	/**
	 *计划任务列表接口
     *@author he.xiang
     *2018.1.2
	 */
	public function planList(){
		$status=$this->status=ItemMilepostModel::planList();
            if ($status) {
                $this->Response(200,$status,'数据查询成功');
            } else {
            	throw new Exception('数据查询失败');
            }
	}

	/**
	 *新增阶段计划
     *@author he.xiang
     *2018.1.2
	 */
	public function planStage(){
		//pro_code	项目编号
		$p['pro_code'] = I('pro_code');
		// plan_code	计划任务编号
		$p['plan_code'] = I('plan_code');
		// Milepost_id	里程碑id
		$p['milepost_id'] = '100'.time();
		// t_id	阶段id
		$p['t_id'] = I('t_id');
		// plan_content	内容
		$p['plan_content'] = I('plan_content');
		// plan_stime	开始时间
		$p['plan_stime'] = I('plan_stime');
		// plan_etime	结束时间
		$p['plan_etime'] = I('plan_etime');
		// deliver_target	交付目标
		$p['deliver_target'] = I('deliver_target');
		//plan_type计划类型
		$p['plan_type'] = I('plan_type');
		//plan_name计划名称
		$p['plan_name'] = I('plan_name');
		// remarks	备注
		$p['remarks'] = I('remarks');

		$status=$this->status=ItemMilepostModel::planStage($p);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
            } else {
            	throw new Exception('数据插入失败');
            }
	}

	/**
	 *阶段计划列表
     *@author he.xiang
     *2018.1.2
	 */
	public function stageList() {
		//pro_code 项目编号
		$p['pro_code'] = I('pro_code');
		//plan_code 总体计划编号
		$p['plan_code'] = I('plan_code');
		//阶段id
		$p['t_id'] = I('t_id');
		$status=$this->status=ItemMilepostModel::stageList($p);
            if ($status) {
                $this->Response(200,$status,'数据查询成功');
            } else {
            	$this->Response(200,'','-100');
            }
	}

	/**
	 *工作计划，新增接口
     *@author he.xiang
     *2018.1.2
	 */
	public function workPlanAdd(){
		//项目编号
		$p['pro_code'] = I('pro_code');
		//计划名称
		$p['plan_name'] = I('plan_name');
		//plan_code 计划编号 - 项目计划主表
		$p['plan_code'] = I('plan_code');
		//plan_id 计划id - 项目计划从表
		$p['milepost_id'] = I('milepost_id');
		//plan_type 计划类别 计划类别- （默认计划内）0计划内，1新增，2变更
		$p['plan_type'] = I('plan_type');
		//main_member 责任人
		$p['main_member'] = I('main_member');
		//member_name 人员姓名
		$p['member_name'] = I('member_name');
		//duty 岗位职责
		$p['duty'] = I('duty');
		//task_content 任务内容
		$p['task_content'] = I('task_content');
		//plan_stime 开始时间
		$p['plan_stime'] = I('plan_stime');
		//plan_etime 结束时间
		$p['plan_etime'] = I('plan_etime');
		//remarks 备注
		$p['remarks'] = I('remarks');

		$status=$this->status=ItemMilepostModel::workPlanAdd($p);
        echo json_encode($status);
	}

	/**
	 *工作计划列表接口
     *@author he.xiang
     *2018.1.2
	 */
	public function workPlanList(){
		//plan_code 计划编号 - 项目计划主表
		$p['pro_code'] = I('pro_code');
		$status=$this->status=ItemMilepostModel::workPlanList($p);
        echo json_encode($status);
	}

	/**
	 *项目计划主表信息查询
     *@author he.xiang
     *@param pro_code
     *2018.1.2
	 */

	public function selPlan(){
		//项目编号
		$p['pro_code'] = I('pro_code');
		$status=$this->status=ItemMilepostModel::selPlan($p);
        echo json_encode($status);
	}


	/**
	 *项目计划从表信息查询
     *@author he.xiang
     *@param plan_code
     *2018.1.2
	 */

	public function selMile(){
		//计划任务编号
		$p['plan_code'] = I('plan_code');
		$status=$this->status=ItemMilepostModel::selMile($p);
        echo json_encode($status);
	}

	/**
	 *责任人，人员姓名列表查询
     *@author he.xiang
     *@param 
     *2018.1.2
	 */
	public function selMember() {
		//项目编号
		$p['pro_code'] = I('pro_code');
		$status=$this->status=ItemMilepostModel::selMember($p);
        echo json_encode($status);
	}

	/**
	 *岗位职责查询
     *@author he.xiang
     *@param 
     *2018.1.2
	 */
	public function selJob() {
		$status=$this->status=ItemMilepostModel::selJob();
        echo json_encode($status);
	}


}
<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ItemMilepostModel;

/**
*项目里程碑
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
		$p['plan_code'] = time();
		// Milepost_id	里程碑id
		$p['milepost_id'] = I('milepost_id');
		// plan_content	内容
		$p['plan_content'] = I('plan_content');
		// plan_stime	开始时间
		$p['plan_stime'] = I('plan_stime');
		// plan_etime	结束时间
		$p['plan_etime'] = I('plan_etime');
		// deliver_target	交付目标
		$p['deliver_target'] = I('deliver_target');
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
		//milepost_id 里程碑id
		$p['milepost_id'] = I('milepost_id');
		$status=$this->status=ItemMilepostModel::planStage($p);
            if ($status) {
                $this->Response(200,$status,'数据新增成功');
            } else {
            	throw new Exception('数据插入失败');
            }
	}
}
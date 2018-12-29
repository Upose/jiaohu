<?php

namespace Doc\Model;

use Think\Db;

mysql_query( "SET NAMES UTF8" );

class ProjectCollectionStateModel {

	//请求数据库，获取文件是否存在
	function getData( $tableName, $value ) {
		$rows = M()->table( 'itemapplication.' . $tableName )
		           ->where( 'pro_code=' . $value['pro_code'] )
		           ->select();

		return $rows;
	}
	/*
	 * 根据此人ID 查询此人负责的项目列表
	 * @author song.chaoxu
	 * 2018.11.24
	 * mender Jankin Hou
	 * 2018-12-26
	 * */
	/**
	 * @param $projectManagerId
	 *
	 * @return array
	 */
	function projectList( $projectManagerId ) {
		$stage = array();//所处阶段数组
		$isUp = '已提交';
		$notUp ='未提交';
		//列出此人所有的项目
		$projectList = M()->table( 'itemapplication.app_project xm' )
		                  ->where( 'xm.pro_leader=' . $projectManagerId )
		                  ->join( ' LEFT JOIN itemapplication.dm_industry hy ON xm.industry_id = hy.industry_id' )
		                  ->join( 'LEFT JOIN itemapplication.dm_department de ON de.id = xm.pro_department' )
		                  ->field( 'xm.pro_name,hy.industry_name,de.deptName,xm.create_date,xm.logo_path,xm.pro_code' )
		                  ->select();
		if ( $projectList ) {
			//如果获取到的项目列表不为空，则遍历数组获取每个项目的未提交文件数
			//1，项目验收表
			foreach ( $projectList as $key => $value ) {
				$rows1 = M()->table( 'itemapplication.app_project_complete ' )//验收表
					->field('pro_id complete_id')
					->where('pro_code=' . $value['pro_code'] )
					->select();
				$rows2 = M()->table('itemapplication.app_test_run')//试运行表
				            ->field('id run_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows3 = M()->table('itemapplication.app_project_test')//测试联调表
				            ->field('id test_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows4 = M()->table('itemapplication.app_majorevents')//时间记录表
				            ->field('id majorevents_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows5 = M()->table('itemapplication.app_meeting')//会议信息表
				            ->field('meeting_id meeting_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows6 = M()->table('itemapplication.app_weekly_task')//周报任务表
				            ->field('task_id task_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows7 = M()->table('itemapplication.app_project_weekly')//项目周报表
				            ->field('weekly_id weekly_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows8 = M()->table('itemapplication.app_project_risk')//项目风险表
				            ->field('id risk_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows9 = M()->table('itemapplication.app_member_plan')//成员任务分解表
				            ->field('id member_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows10 = M()->table('itemapplication.app_project_plan_B')//项目计划从表
				            ->field('id planb_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows11 = M()->table('itemapplication.app_project_plan_A')//项目计划主表
				            ->field('id plana_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows12 = M()->table('itemapplication.app_customer')//客户关系表
				            ->field('id customer_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows13 = M()->table('itemapplication.app_project_persion')//项目成员信息表
				            ->field('id persion_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				$rows14 = M()->table('itemapplication.app_project_approval')//立项信息表
				            ->field('id approval_id')
				            ->where('pro_code=' . $value['pro_code'])
				            ->select();
				//判断当前阶段未提交文件数量
				$num1 = $rows1[0]['complete_id']?0:1;//归档阶段
				$num2 = $rows2[0]['run_id']?0:1;
				$num3 =  $rows3[0]['test_id']?0:1;
				$num4 = $rows4[0]['majorevents_id']?0:1;
				$num4 = $rows5[0]['meeting_id']?$num4:$num4+1;
				$num4 = $rows6[0]['task_id']?$num4:$num4+1;
				$num4 = $rows7[0]['weekly_id']?$num4:$num4+1;
				$num5 = $rows8[0]['risk_id']?0:1;
				$num5 = $rows9[0]['member_id']?$num5:$num5+1;
				$num5 = $rows10[0]['planb_id']?$num5:$num5+1;
				$num5 = $rows11[0]['plana_id']?$num5:$num5+1;
				$num6 = $rows12[0]['customer_id']?0:1;
				$num6 = $rows13[0]['persion_id']?$num6:$num6+1;
				$num6 = $rows14[0]['approval_id']?$num6:$num6+1;
				$status = '';//阶段标识
				if($num1 == 0){
					//验收表中有数据，当前项目处于已完成或者归档
					$status = '已完成';
				}elseif ($num1 == 1){
					$status = '运行中';
				}else{
					$status ='项目异常';
				}
				$stage[$key] = [
					'pro_code' => $value['pro_code'],
					'pro_name'=> $value['pro_name'],
					'industry_name' => $value['industry_name'],
					'deptName' => $value['deptName'],
					'create_date' => $value['create_date'],
					'loo_path' => $value['logo_path'],
					'completeFile' => $rows1[0]['complete_id']?$isUp:$notUp,
					'acceptance_phase' => $num1,
					'runFile' => $rows2[0]['run_id']?$isUp:$notUp,
					'test_run'=>$num2,
					'testFile' => $rows3[0]['test_id']?$isUp:$notUp,
					'project_test'=>$num3,
					'majoreventsFile' => $rows4[0]['majorevents_id']?$isUp:$notUp,
					'meetingFile' => $rows5[0]['meeting_id']?$isUp:$notUp,
					'taskFile' => $rows6[0]['task_id']?$isUp:$notUp,
					'weeklyFile' => $rows7[0]['weekly_id']?$isUp:$notUp,
					'execute_management'=>$num4,
					'riskFile' => $rows8[0]['risk_id']?$isUp:$notUp,
					'memberFile' => $rows9[0]['member_id']?$isUp:$notUp,
					'planbFile' => $rows10[0]['planb_id']?$isUp:$notUp,
					'planaFile' => $rows11[0]['plana_id']?$isUp:$notUp,
					'plan_management'=>$num5,
					'customerFile' => $rows12[0]['customer_id']?$isUp:$notUp,
					'persionFile' => $rows13[0]['persion_id']?$isUp:$notUp,
					'approvalFile' => $rows14[0]['approval_id']?$isUp:$notUp,
					'start_phase'=>$num6,
					'status' => $status
				];
			}
		} else {
			return FALSE;
		}//$projectList 为空
		return $stage;
//以下注释代码为测试代码，暂不用。
		//		if ($projectList){
		//			foreach ( $projectList as $key => $value ) {
		//				$rows1 = M()->table('itemapplication.app_project_complete complete')
		//				            ->where('complete.pro_code='.$value['pro_code'])
		//				            ->select();
		//				if($rows1){
		//					//如果项目验收表中有数据，表示当前项目所处阶段为验收阶段
		//					$stage[$key] = [
		//						'pro_code' => $value['pro_code'],
		//						'pro_name'=> $value['pro_name'],
		//						'industry_name' => $value['industry_name'],
		//						'deptName' => $value['deptName'],
		//						'create_date' => $value['create_date'],
		//						'logo_path' => $value['logo_path'],
		//						'stage' => '验收阶段',
		//						'wtjNum'=>0
		//					];
		//				}else{
		//					//项目验收表中无数据，继续查询试运行表
		//					$rows2 = M()->table('itemapplication.app_test_run')
		//					            ->where('pro_code='.$value['pro_code'])
		//					            ->select();
		//					if ($rows2){
		//						//如果试运行表中有数据，则提示当前项目处于试运行阶段
		//						$stage[$key] = [
		//							'pro_code' => $value['pro_code'],
		//							'pro_name'=> $value['pro_name'],
		//							'industry_name' => $value['industry_name'],
		//							'deptName' => $value['deptName'],
		//							'create_date' => $value['create_date'],
		//							'logo_path' => $value['logo_path'],
		//							'stage' => '试运行阶段',
		//							'wtjNum'=>0
		//						];
		//					}else{
		//						//试运行表中也无数，则继续查询测试联调表
		//						$rows3 = M()->table('itemapplication.app_project_test')
		//						            ->where('pro_code='.$value['pro_code'])
		//						            ->select();
		//						if ($rows3){
		//							//测试联调表中有数据，则当前项目处于测试联调状态
		//							$stage[$key] = [
		//								'pro_code' => $value['pro_code'],
		//								'pro_name'=> $value['pro_name'],
		//								'industry_name' => $value['industry_name'],
		//								'deptName' => $value['deptName'],
		//								'create_date' => $value['create_date'],
		//								'logo_path' => $value['logo_path'],
		//								'stage' => '测试联调阶段',
		//								'wtjNum'=>0
		//							];
		//						}else{
		////							itemapplication.app_project_weekly weekly
		//							//测试联调表中无数据，则继续查询执行管理相关表
		//							$rows4 = M()->table('itemapplication.app_meeting meeting')
		//							            ->where('meeting.pro_code='.$value['pro_code'])
		//										->field('weekly.weekly_id weeklyId,task.task_id taskId,meeting.meeting_id meetingId,major.id majoreventsId')
		//							            ->join('LEFT JOIN itemapplication.app_weekly_task task ON task.pro_code='.$value['pro_code'])
		//							            ->join('LEFT JOIN itemapplication.app_project_weekly weekly ON weekly.pro_code='.$value['pro_code'])
		//							            ->join('LEFT JOIN itemapplication.app_majorevents major ON major.pro_code='.$value['pro_code'])
		//							            ->select();
		//							if($rows4){
		//								//如果有数据，则当前处于执行管理阶段
		//								$num = $rows4[0]['weeklyid']?0:1;
		//								$num = $rows4[0]['taskid']?$num:$num+1;
		//								$num = $rows4[0]['meetingid']?$num:$num+1;
		//								$num = $rows4[0]['majoreventsid']?$num:$num+1;
		//								$stage[$key] = [
		//									'pro_code' => $value['pro_code'],
		//									'pro_name'=> $value['pro_name'],
		//									'industry_name' => $value['industry_name'],
		//									'deptName' => $value['deptName'],
		//									'create_date' => $value['create_date'],
		//									'logo_path' => $value['logo_path'],
		//									'stage' => '执行管理阶段',
		//									'weekly' => $rows4[0]['weeklyid']?'已提交':'未提交',
		//									'task'=>$rows4[0]['taskid']?'已提交':'未提交',
		//									'meeting'=>$rows4[0]['meetingid'] ? '已提交':'未提交',
		//									'app_majorevents'=>$rows4[0]['majoreventsid']?'已提交':'未提交',
		//									'wtjNum' => $num
		//								];
		//
		//							}else{
		//								//执行管理阶段没数据，则继续查询计划管理
		//								$rows5 = M()->table('itemapplication.app_project_plan_A plana')
		//								            ->where('plana.pro_code='.$value['pro_code'])
		//								            ->field('plana.id planaId,risk.id riskId,member.id memberId')
		//								            ->join('LEFT JOIN itemapplication.app_project_risk risk ON risk.pro_code='.$value['pro_code'])
		//								            ->join('LEFT JOIN itemapplication.app_member_plan member ON member.pro_code='.$value['pro_code'])
		//								            ->select();
		//								if($rows5){
		//									//如果有数据，则当前处于计划管理阶段
		//									$num = $rows5[0]['planaid']?0:1;
		//									$num = $rows5[0]['riskid']?$num:$num+1;
		//									$num = $rows5[0]['memberid']?$num:$num+1;
		//									$stage[$key] = [
		//										'pro_code' => $value['pro_code'],
		//										'pro_name'=> $value['pro_name'],
		//										'industry_name' => $value['industry_name'],
		//										'deptName' => $value['deptName'],
		//										'create_date' => $value['create_date'],
		//										'logo_path' => $value['logo_path'],
		//										'stage' => '计划管理阶段',
		//										'plan' => $rows5[0]['planaid']?'已提交':'未提交',
		//										'risk' => $rows5[0]['riskid']?'已提交':'未提交',
		//										'member' => $rows5[0]['memberid']?'已提交':'未提交',
		//										'wtjNum' => $num,
		//									];
		//								}else{
		//									//如果计划管理阶段没有数据，则项目处于启动阶段
		//									$rows6 = M()->table('itemapplication.app_project_approval approval')
		//									            ->where('approval.pro_code='.$value['pro_code'])
		//									            ->field('approval.id approvalId,persion.id persionId,customer.id customerId')
		//									            ->join('LEFT JOIN itemapplication.app_project_persion persion ON persion.pro_code='.$value['pro_code'])
		//									            ->join('LEFT JOIN itemapplication.app_customer customer ON customer.pro_code='.$value['pro_code'])
		//									            ->select();
		//									if ($rows6){
		//										//启动阶段有数据
		//										$num = $rows6[0]['approvalid']?0:1;
		//										$num = $rows6[0]['persionid']?$num:$num+1;
		//										$num = $rows6[0]['customerid']?$num:$num+1;
		//										$stage[$key] = [
		//											'pro_code' => $value['pro_code'],
		//											'pro_name'=> $value['pro_name'],
		//											'industry_name' => $value['industry_name'],
		//											'deptName' => $value['deptName'],
		//											'create_date' => $value['create_date'],
		//											'logo_path' => $value['logo_path'],
		//											'stage' => '启动阶段',
		//											'approval' => $rows6[0]['approvalid']?'已提交':'未提交',
		//											'persion' => $rows6[0]['persionid']?'已提交':'未提交',
		//											'customer' => $rows6[0]['customerid']?'已提交':'未提交',
		//											'wtjNum' =>  $num,
		//										];
		//									}else{
		//										$stage[$key] = [
		//											'pro_code' => $value['pro_code'],
		//											'pro_name'=> $value['pro_name'],
		//											'industry_name' => $value['industry_name'],
		//											'deptName' => $value['deptName'],
		//											'create_date' => $value['create_date'],
		//											'logo_path' => $value['logo_path'],
		//											'stage' => '未知',
		//											'wtjNum'=>0
		//										];
		//									}
		//								}
		//							}
		//						}
		//					}
		//				}
		//			}//foreach  end
		//		}else{
		//			return FALSE;
		//		}//$projectList 为空
		return $stage;
	}


}
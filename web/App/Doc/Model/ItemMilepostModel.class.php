<?php
namespace Doc\Model;
use Think\Model;

class ItemMilepostModel{
	public function planningTask($p) {
		try{
            $res =  M('app_project_plana')->add($p);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
	}

	public function planList(){
		try{
			$sql = "SELECT
						A.id,
						A.pro_code,
						A.plan_code,
						A.type_id,
						A.plan_name,
						DATE_FORMAT(A.plan_stime,'%Y-%m-%d') plan_stime,
						DATE_FORMAT(A.plan_etime,'%Y-%m-%d') plan_etime,
						B.nature,
						A.plan_type
					FROM
						`app_project_plana` A
						LEFT JOIN dm_nature B ON A.type_id = B.id";
            $res =  M('app_project_plana')->query($sql);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }

	}

	public function planStage($p) {
		try{
            $res =  M('app_project_planb')->add($p);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
	}

	public function stageList($p) {
		try{
	            $res =  M('app_project_planb')->where($p)->select($p);
	            for ($i=0; $i <count($res) ; $i++) { 
	            	$res[$i]['plan_stime'] = date('Y-m-d',strtotime($res[$i]['plan_stime']));
	            	$res[$i]['plan_etime'] = date('Y-m-d',strtotime($res[$i]['plan_etime']));
	            	$res[$i]['create_data'] = date('Y-m-d',strtotime($res[$i]['create_data']));
	            }
	            return $res;
        }catch(Exception $e){
            return $e->getMessage();
        }
	}
}
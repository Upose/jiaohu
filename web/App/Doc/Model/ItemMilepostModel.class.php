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
						A.plan_stime,
						A.plan_etime,
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
			if(!$p['pro_code'] && !$p['plan_code']) {
				$res =  M('app_project_planb')->select($p);
            	return $res;
			}else{
	            $res =  M('app_project_planb')->where($p)->select($p);
	            return $res;
			}
         
        }catch(Exception $e){
            return $e->getMessage();
        }
	}
}
<?php
namespace Doc\Model;
use Think\Model;

class ItemAcceptanceModel{
	public function acceptAdd($p) {
		try{
            $res =  M('app_project_complete')->add($p);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
	}

	public function acceptList($pro_code,$page,$limit) {

		$res = M('app_project_complete')->where('pro_code='.$pro_code)
	                                    ->page($page,$limit)
	                                    ->order('create_date desc')
										->select();
		$count = M('app_project_complete')->where('pro_code='.$pro_code)
										->select();
		$arr = [];
		$arr['code'] = 0;
		$arr['count'] = count($count);
		$arr['data'] = $res;
		$arr['msg'] = '';
		return $arr;
	}
}
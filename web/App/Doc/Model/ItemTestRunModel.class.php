<?php
namespace Doc\Model;
use Think\Model;

class ItemTestRunModel{
	public function testRunAdd($p) {
		try{
            $res =  M('app_test_run')->add($p);
            return $res;
         
        }catch(Exception $e){
            return $e->getMessage();
        }
	}

	public function runList($pro_code,$page,$limit) {
		$res = M('app_test_run')->where('pro_code='.$pro_code)
	                                    ->page($page,$limit)
	                                    ->order('create_data desc')
										->select();
		$count = M('app_test_run')->where('pro_code='.$pro_code)
										->select();
		$arr = [];
		$arr['code'] = 0;
		$arr['count'] = count($count);
		$arr['data'] = $res;
		$arr['msg'] = '';
		return $arr;
	}
}
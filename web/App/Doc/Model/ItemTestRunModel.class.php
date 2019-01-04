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
}
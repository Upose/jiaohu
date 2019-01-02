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
}
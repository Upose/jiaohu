<?php
namespace Doc\Controller;
use Think\Controller;

class IndexController extends BaseController {

	//输出文档首页
    public function index(){
    	$this->display();
    }

    public function test(){
    	$a = 1;
    	var_dump($a);
    }



}
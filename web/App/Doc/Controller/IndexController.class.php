<?php
namespace Doc\Controller;
use Think\Controller;

class IndexController extends BaseController {

	//输出文档首页
    public function index(){
		print_r("welcome to teaparty");exit();
    	$this->display();
    }

    

}
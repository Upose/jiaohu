<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;

/**
 * 登陆模块控制器
 * @author fang.yu
 * 2018.7.30
 */
class WelcomeController extends BaseController{

	public function index(){
    	$this->display();
    }

}
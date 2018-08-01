<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;

/**
 * 后台管理模块控制器
 * @author fang.yu
 * 2018.8.1
 */
class BackstageManagementController extends BaseController{

	public function index(){
    	$this->display();
    }

}

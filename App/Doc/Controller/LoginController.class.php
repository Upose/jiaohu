<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;
session_start();
/**
 * 登陆模块控制器
 * @author fang.yu
 * 2018.7.30
 */
class LoginController extends BaseController{


	public function index(){
    	$this->display();
    }

     //登录接口
    public function loginn (){
    	//获取用户名密码
    	$name=I('name');
    	$password=md5(I('password'));
    	//判断用户名是否存在
    	$sql="SELECT * FROM person where name = '$name' ";
    	$res = M()->query($sql);
    	if(count($res)==0){
    		//用户名不存在返回1
    		$this->Response(1,'');
    	}
        //判断用户名密码是否正确
    	$usql="select * from person where name = '$name' and password= '$password'";
    	$ures = M()->query($usql);
    	if(count($ures)==0){
    		//用户名或密码错误返回2
    		$this->Response(2,'');
    	}else{
    		//登陆成功,将用户信息保存在session
    		
    		$_SESSION['user_name']=$name;
    		$_SESSION['user_id']=$ures[0]['id'];
    		//var_dump($_SESSION);die;
    		$this->Response(0,$ures,'登录成功');
    		
    	}
       
    }


}

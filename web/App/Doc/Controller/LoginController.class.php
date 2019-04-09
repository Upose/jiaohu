<?php
namespace Doc\Controller;
use Think\Controller;
use think\Session;

/**
 * 登陆模块控制器
 * @author zang.qun
 * 2018.7.30
 */
class LoginController extends BaseController{


	public function index(){
    	$this->display();
    }

     //登录接口
    public function dologin(){
       
    	//获取用户名密码
    	$name=I('name');
    	$password=md5(I('password'));
    	//判断用户名是否存在
    	$sql="SELECT * FROM user_member where member_email = '$name' ";
    	$res = M()->query($sql);
    	if(count($res)==0){
    		//用户名不存在返回1
    		$this->Response(1,'');
    	}
        //判断用户名密码是否正确
    	$usql="select * from user_member where member_email = '$name' and password= '$password'";
    	$ures = M()->query($usql);
    	if(count($ures)==0){
    		//用户名或密码错误返回2
    		$this->Response(2,'');
    	}else{
    		//登陆成功,将用户信息保存在session
    		
    		$_SESSION['user_name']=$name;
    		$_SESSION['user_id']=$ures[0]['user_id'];
    		//var_dump($_SESSION);die;
    		$this->Response(0,$ures,'登录成功');
    		
    	}
       
    }

     //退出登录接口
    public function logout()
    {
     
        if(isset($_COOKIE[session_name()]))
        {  
            //判断客户端的cookie文件是否存在
            //存在的话将其设置为过期.
           setcookie(session_name(),'',time()-1,'/');
        }
           session_destroy();
          $this->Response(0,'退出登录','');
    }

        /**
     * 修改密码
     */
    public function updPass () {
        $uid = I('uid');
        $ypassWord = I('oldPass');
        $npassWord = I('newPass');
        $rpassWord = I('repeatPass');
        if ( !$npassWord ) {
            $this->Response(2,'密码不能为空');
        }
        // 查询用户密码
        $uinfo = M('user_member')->where('user_id = '.$uid)->find();
        if ( !($uinfo['password'] == md5( $ypassWord )) ) {
            $this->Response(2,'原密码不正确');
        } 
        if ( !( $npassWord == $rpassWord ) ) {
            $this->Response(2,'新密码不一致');
        }
        // 修改密码
        $res = M('user_member')->where("user_id = {$uid}")->save( ['password' => md5( $npassWord ) ] );
        if ( $res ) {
            $this->Response(200,'密码修改成功','');
        }
    }


}

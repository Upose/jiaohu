<?php

namespace Doc\Controller;

use Think\Controller;

/**
 * 基础控制器
 * @author fang.yu
 * 2018.7.25 
 */
class BaseController extends Controller
{

    
    /**
     * Api接口统一输出,0表示执行成功
     * @author fang.yu
     * 2018.7.25 
     */
    public function Response($code = 0,$data = array(),$msg = "")
    {

        $response = array('code' => $code, 'data' => $data,'errmsg' => $msg);

        $this->ajaxReturn($response);
    }

}

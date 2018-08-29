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




    /**
     * 根据编码获取解决方式名称
     * @param 解决方式编号
     * @return 解决方式名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getSolutionName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "BUG修复";
              break;
            case 2:
              $res = "操作指导";
              break;
        }
        return $res;
    }


    /**
     * 根据编码获取优先级名称
     * @param 优先级编号
     * @return 优先级名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getPriorityName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "紧急";
              break;
            case 2:
              $res = "重要";
              break;
            case 3:
              $res = "一般";
              break;
            case 4:
              $res = "优化";
              break;
        }
        return $res;
    }


    /**
     * 根据编码获取项目类型名称
     * @param 项目类型编号
     * @return 项目类型名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getProjectTypeName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "合同项目";
              break;
            case 2:
              $res = "预实施项目";
              break;
        }
        return $res;
    }

}

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


     /**
     * 根据编码获取设计管理中需求类型名称
     * @param 需求类型编号
     * @return 需求类型名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getDemandTypeName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "新增设计";
              break;
            case 2:
              $res = "功能调整";
              break;
            case 3:
              $res = "功能调整";
              break;
        }
        return $res;
    }


     /**
     * 根据编码获取设计管理中处理状态名称
     * @param 需求类型编号
     * @return 需求类型名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getHandleTypeName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "未处理";
              break;
            case 2:
              $res = "进行中";
              break;
            case 3:
              $res = "已完成";
              break;
        }
        return $res;
    }


    /**
     * 根据编码获取设计管理中处理过程状态名称
     * @param 需求类型编号
     * @return 需求类型名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getHandleProcessTypeName($type){
        $res = '';
        switch($type){
            case 1:
              $res = "提交问题";
              break;
            case 2:
              $res = "开始处理";
              break;
            case 3:
              $res = "处理完成";
              break;
            case 4:
              $res = "确认完成";
              break;
             case 5:
              $res = "暂不处理";
              break;
        }
        return $res;
    }


    /**
     * 获取当前周数以及开始结束日期
     * @param 需求类型编号
     * @return 需求类型名称
     * @author fang.yu
     * 2018-08-21
     */
    public function getTime()
    {

      //计算当前周是第几周以及开始结束日期
      $week = date('W',time());
      $year = date('Y',time());
      $weeks = date("W", mktime(0, 0, 0, 12, 28, $year));

      if ($week > $weeks || $week <= 0)
      {
          $week = 1;
      }

      // 若周数是个位数，则前面带0
      if ($week < 10)
      {
          $week = '0' . $week; 
      }

      $timestamp['start'] = strtotime($year . 'W' . $week);
      $timestamp['end'] = strtotime('+1 week -1 day', 
      $timestamp['start']);
      
      $date['year'] = $year;
      $date['week'] = $week;
      $date['start'] = date("Y-m-d", $timestamp['start']);
      $date['end'] = date("Y-m-d", $timestamp['end']);

      return $date;
    }

}

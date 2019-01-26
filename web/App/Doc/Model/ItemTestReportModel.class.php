<?php
namespace Doc\Model;
mysql_query("SET NAMES UTF8"); 

class ItemTestReportModel
{

    /**
     * 测试报告新增
     * @author song.chaoxu
     * 2018.01.07
     */
    public function testReportAdd($pro_code,$objective,$type,$operating_system,$cpu,$memory,$storage,$system_name,$testPeople,$testTime,$remarks,$residual_defect,$target,$enclosure,$founder_id){

            $app_project_test = M("app_project_test"); // 实例化对象
                $data['pro_code'] = $pro_code;
                $data['objective'] = $objective;
                $data['type'] = $type;
                $data['operating_system'] = $operating_system;
                $data['cpu'] = $cpu;
                $data['memory'] = $memory;
                $data['storage'] = $storage;
                $data['system_name'] = $system_name;
                $data['testPeople'] = $testPeople;
                $data['testTime'] = $testTime;
                $data['residual_defect'] = $residual_defect;
                $data['target'] = $target;
                $data['remarks'] = $remarks;
                $data['enclosure'] = $enclosure;
                $data['founder_id'] = $founder_id;
                $result = $app_project_test->add($data);
                return $result;
    }


    /**
     * 测试报告查询
     * @author song.chaoxu
     * 2019.01.26
     */
    public function testReportResult($pCode,$page,$limit){

        $app_project_test = M("app_project_test"); // 实例化对象
        $count = $app_project_test ->where('pro_code',$pCode) ->count();
        $customerList = $app_project_test ->field('id,pro_code,objective,type,operating_system,cpu,memory,storage, system_name,people,test_time,residual_defect,target,enclosure,remarks,state,founder_id,create_data')
            ->where('pro_code',$pCode)
            ->page($page,$limit)
            ->order('create_data desc')
            ->select();
          $result = array();
          $result['code'] = 0;
          $result['msg'] = "";
          $result['count'] = $count;
          $result['data'] = $customerList;
          return $result;
    }






}
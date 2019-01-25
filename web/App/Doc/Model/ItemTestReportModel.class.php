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

            $app_majorevents = M("app_project_test"); // 实例化对象
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
                $result = $app_majorevents->add($data);
                return $result;
    }






}
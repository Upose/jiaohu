<?php

namespace Doc\Controller;
use Think\Controller;
use Doc\Model\ProjectDescriptionModel;

/**
*项目管理详情控制器
*@author fang.yu
*2018.8.16
*/
class ProjectDescriptionController extends BaseController{

    
    /**
     *首页输出
     *@author fang.yu
     *2018.8.16
     */
    public function index()
    {

        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
        
    }

    /**
     *项目组织模块输出
     *@author fang.yu
     *2018.8.16
     */
    public function pro_organization()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }


    /**
    *项目规划模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_planning()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }

    /**
    *需求管理模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_demand()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }

    /**
    *设计管理模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_design()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }

    /**
    *开发信息模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function infor()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }

     /**
    *开发信息模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function test()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }


     /**
    *周报管理模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_weekly()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }



     /**
    *重大事件模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_event()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }


     /**
    *开发管理模块输出
    *@author fang.yu
    *2018.8.16
    */
    public function pro_development()
    {
        //先获取id再渲染出去
        $id = I("id");
        $this->assign("pro_id",$id);
        $this->display();
    }


}
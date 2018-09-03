<?php
namespace Doc\Model;
date_default_timezone_set('prc');
mysql_query("SET NAMES UTF8"); 

class ProjectDevelopmentModel
{

	 /**
     *技术使用列表
     *@author fang.yu
     *2018.8.27
     */
    public function technologyUseList($project_id)
    {
      
      	$sql = "SELECT html_technology,
		      	backend_technology,database_type,
		      	uml_address,interface_address,
		      	database_address 
				from technologyUse 
				where project_id = $project_id";

        $res = M()->query($sql);

        return  $res;
        
    }

    /**
     *技术使用更新
     *@author fang.yu
     *2018.8.27
     */
    public function technologyUseUpdate($project_id,
    $html_technology,$backend_technology,$database_type,
    $uml_address,$interface_address,$database_address)
    {

   $sql =  "update technologyUse set 
   		    html_technology = '$html_technology',
   		    backend_technology = '$backend_technology',
   		    database_type = '$database_type',
    	    uml_address = '$uml_address', 
    	    interface_address= '$interface_address',
    		database_address='$database_address'
    		where project_id = $project_id";

    	$res = M()->execute($sql);

        return  $res;

    }


    /**
     *第三方库列表
     *@author fang.yu
     *2018.8.27
     */
    public function thirdLibraryList($project_id)
    {
      
      	$sql = "SELECT id,name,summary,language,
		      	edition,download_type 
		      	from project_thirdLibrary 
		      	where project_id = $project_id";

        $res = M()->query($sql);

        return  $res;
        
    }

    /**
     *第三方库新增
     *@author fang.yu
     *2018.8.27
     */
    public function thirdLibraryAdd($project_id,
    $name,$summary,$language,$edition,$download_type)
    {
    		$sql = "insert into project_thirdLibrary
    	  		(id,project_id,name,summary,language,
                edition,download_type) 
    	  		values 
    	 		('',$project_id,'$name','$summary',
    	 		'$language','$edition',$download_type)";

    	$res = M()->execute($sql);

        return  $res;
    }


    /**
     *第三方库修改
     *@author fang.yu
     *2018.8.27
     */
    public function thirdLibraryUpdate($project_id,
    $name,$summary,$language,$edition,$download_type)
    {
    	
    	 	$sql = "update project_thirdLibrary 
    	 	set name = '$name',summary = '$summary',
   		    language = '$language',download_type 
   		    = '$download_type' 
   		    where project_id = $project_id";

    	$res = M()->execute($sql);

        return  $res;
    }


    /**
     *Bug新增
     *@author fang.yu
     *2018.8.27
     */
    public function bugAdd($project_id,$name,
    	$urgency,$summary,$handle_person_id)
    {

    	$sql = "insert into project_bug
    	  		(id,name,project_id,urgency,
    	  		summary,submit_time,submit_person_id,state,
    	  		handle_person_id) 
    	  		values 
    	 		('','$name',$project_id,$urgency,
    	 		'$summary','$submit_time',
    	 		$submit_person_id,$state,$handle_person_id)";

    	$bug_id = M()->execute($sql);

        //每新增一个BUG，除了要在BUG表中添加，
        //还要在bug_handle表中添加提交信息
       
        $sql1 = "insert into bug_handle
                (id,bug_id,handle_person_id,
                handle_time,handle_state) 
                values 
                ('',$bug_id,$submit_person_id,
                '$submit_time',1)";

        $res1 = M()->execute($sql1);

        return  $bug_id;
    }

     /**
     *Bug图片新增
     *@author fang.yu
     *2018.8.27
     */
    public function bugImageAdd($name,
    		$newpath,$project_bug_id)
    {
    	$update_time = date('Y-m-d',time());

    	$sql = "insert into project_bugImage
    	  		(id,name,path,project_bug_id,
    	  		update_time) values 
    	 		('','$name','$newpath',
    	 		$project_bug_id,'$update_time')";

    	$res = M()->execute($sql);

        return  $res;
    }

    /**
     *BUG列表
     *@author fang.yu
     *2018.8.27
     */
    public function bugList($project_id,$pag)
    {
    	$sql = "SELECT pb.id,pb.name,
    			pb.urgency,pb.summary,
    			pb.submit_time,
    			pm.name as handle_person,
    			state from project_bug pb 
				join 
				(SELECT id,name from 
				project_member 
				where project_id  =$project_id) pm 
				on pb.handle_person_id = pm.id
				where pb.project_id = $project_id 
				order by pb.id desc limit ".$pag.",10 ";
 
        $res = M()->query($sql);

        //将数组中的urgency、state由数字转化为文字
        for($i = 0;$i < count($res);$i++)
        {
        	
        	$res[$i]['state'] = $this->
        	getHandleTypeName($res[$i]['state']);
        }

        $usql = "SELECT count(*)  as count
                from project_bug pb 
                join 
                (SELECT id,name from 
                project_member 
                where project_id  =$project_id) pm 
                on pb.handle_person_id = pm.id
                where pb.project_id = $project_id 
                order by pb.id desc limit ".$pag.",10 ";

         $num = M()->query($usql);       
         $num = $num[0]['count'];
		//未处理
		$sql2 = "SELECT count(*) as count
    			 from project_bug pb 
				join 
				(SELECT id,name from 
				project_member 
				where project_id  =$project_id) pm 
				on pb.handle_person_id = pm.id
				where pb.project_id = $project_id 
				and pb.state  = 1";
		$unDo = M()->query($sql2);

		//正在做
		$sql3 = "SELECT count(*) as count
    			 from project_bug pb 
				join 
				(SELECT id,name from 
				project_member 
				where project_id  =$project_id) pm 
				on pb.handle_person_id = pm.id
				where pb.project_id = $project_id 
				and pb.state  = 2";
		$doing = M()->query($sql3);

		//已处理
		$sql4 = "SELECT count(*) as count
    			 from project_bug pb 
				join 
				(SELECT id,name from 
				project_member 
				where project_id  =$project_id) pm 
				on pb.handle_person_id = pm.id
				where pb.project_id = $project_id 
				and pb.state  = 3";
		$done = M()->query($sql4);

		$count['unDo'] = (int)$unDo[0]['count'];
		$count['doing'] = (int)$doing[0]['count'];
		$count['done'] = (int)$done[0]['count'];
      	
      	$final['count'] = $count;
		$final['list'] = $res;
        $final['listNum'] = $num;
        return  $final;

    }


    /**
     *BUG详情
     *@author fang.yu
     *2018.8.27
     */
    public function bugDetails($id)
    {

        $temp = array();
		$sql = "SELECT DISTINCT(pb.name),
        pb.urgency,
		pb.summary,p.name as submit_person,
		pb.state from project_bug pb
		join person p 
		on p.id = pb.submit_person_id 
		where pb.id = $id";

		$res = M()->query($sql);

        $temp['name'] = $res[0]['name'];
        $temp['urgency'] = $res[0]['urgency'];
        $temp['summary'] = $res[0]['summary'];
        $temp['submit_person'] = $res[0]['submit_person'];
        $temp['state'] = $res[0]['state'];
	

        //因为提交人和处理人同时存在，所以得分开查
        $sql1 = "SELECT 
        p.name as handle_person
        from project_bug pb
        join person p 
        on p.id = pb.handle_person_id
        where pb.id = $id";

        $res1 = M()->query($sql1);
		
        $temp['handle_person'] = 
        $res1[0]['handle_person'];

		//将状态码转化为文字
		for($i = 0;$i < count($res);$i++)
        {
        	
        	$res[$i]['state'] = $this->
        	getHandleTypeName($res[$i]['state']);
        }

        $res1 = M()->query($sql1);

        $fsql = "SELECT pbi.path 
        from project_bugImage pbi
        join project_bug pb
        on pbi.project_bug_id = pb.id
        where pbi.project_bug_id = $id";

        $path = M()->query($fsql);
        $temp['path'] = $path;

		return  $temp;

    }
    /**
     *处理BUG
     *@author fang.yu
     *2018.8.27
     */
    public function handleBug()
    {

    	$sql = "SELECT id,name 
		    	from project_member 
		    	where project_id = 
		    	$project_id 
		    	and end_time = ''";

        $res = M()->query($sql);

        return  $res;
    }


    /**
     *BUG处理过程列表
     *@author fang.yu
     *2018.8.27
     */
    public function processList($id)
    {
    	$sql = "SELECT p.name,bh.handle_time,
                bh.handle_state 
                from bug_handle bh
                join person p
                on bh.handle_person_id = p.id
                where bh.bug_id = $id
                ORDER BY bh.handle_time desc";

        $res = M()->query($sql);

        return  $res;

    }


    /**
     *处理人下拉框
     *@author fang.yu
     *2018.8.27
     */
    public function project_member($project_id)
    {
        $sql = "SELECT id,name 
            from project_member 
            where project_id = $project_id 
            and end_time = ''";

        $res = M()->query($sql);

        return $res;

    }



    /**
     * bug处理
     * @author fang.yu
     * 2018.8.24
     */
    public function bugHandle($bug_id,
                  $handle_state,$is_handle)
    {

        //处理人id
        $handle_person_id  =$_SESSION['user_id'];

        //处理时间
        $handle_time = date('Y-m-d',time());

        $sql1 = "INSERT into 
        bug_handle(id,bug_id,handle_person_id,
        handle_time,handle_state) 
        VALUES('',$bug_id,
        $handle_person_id,'$handle_time',
        $handle_state)";

        $res1= M()->execute($sql1); 

        $sql2 = "UPDATE project_bug 
        set state = $is_handle where id = $bug_id";

        $res2= M()->execute($sql2); 

        return $res1;
    }



   
}
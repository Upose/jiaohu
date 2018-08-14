<?php
namespace Doc\Model;
class BackstageManagementModel{

    public function problem(){  
      $sql=" select * from problem_classification where is_delete =0 ";
      $res = M()->query($sql);
      return $res;
	  }
    
    public function addproblem($name,$update_time,$submit_person_id,$summary,$status){  
        $sql="insert into problem_classification (name,update_time,submit_person_id,summary,status,is_delete) 
    	   values ('$name','$update_time','$submit_person_id','$summary','$status',0)";
        $res = M()->execute($sql);
       return $res;
	  }

    public function select($id){
    	$sql="SELECT * FROM feedback as a  
    	left join priority as b  on a.priority = b.id 
    	WHERE a.id= ".$id;
    	$res = M()->query($sql);
    	return $res;
    }

    public function ParentProduct(){
        $sql="select id, name from product where is_delete=0 ";
    	$res = M()->query($sql);
    	return $res;
    }

    public function updatee($id){
        $sql="select name,f_id,summary from product_s where id= '$id' and is_delete=0 ";
        $res = M()->query($sql);
        return $res;
    }

    public function update($name,$summary,$fid,$id){
      $sql="update product_s set name='$name',summary='$summary',f_id='$fid' where id='$id'";
      $res = M()->execute($sql);
	    if($res){
	      	 return 0;
	    }else{
	      	 return 1;
	    }
      
    }


    public function DeleteProblem($id){
       $sql="update problem_classification set is_delete = 1 
           where id='$id'";
       $res = M()->execute($sql);
       //var_dump($res);die;
  	   if($res){
  	      	 return 0;
  	   }else{
  	      	 return 1;
  	   }
     }



    public function UpdateeProblem($id){
	      $sql="select name,status,summary from problem_classification where id= '$id' and is_delete=0 ";
	      $res = M()->query($sql);
        return $res;
    }


    public function UpdateProblem($name,$summary,$status,$id){
      $sql="update problem_classification set name='$name',summary='$summary',status='$status' where id='$id'";
      $res = M()->execute($sql);
      if($res){
	      	 return 0;
	      }else{
	      	 return 1;
	      }
    }

    public function UpdateeProject($id){
        $sql="select name,status,summary from project_select where id= '$id' and is_delete=0 ";
        $res = M()->query($sql);
        return $res;
    }

    public function UpdateProject($name,$summary,$status,$id){
      $sql="update project_select set name='$name',summary='$summary',status='$status' where id='$id'";
      $res = M()->execute($sql);
      if($res){
           return 0;
        }else{
           return 1;
        }
    }

    public function AddProject($name,$update_time,$submit_person_id,$summary,$status){  
        $sql="insert into project_select (name,update_time,submit_person_id,summary,status,is_delete) 
         values ('$name','$update_time','$submit_person_id','$summary','$status',0)";
        $res = M()->execute($sql);
       return $res;
    }
    public function softdelete($f_id,$id){
       //f_id为0是父级产品,不为0为子级产品
        if($f_id==0)
        {
             $sql="update product set is_delete = 1 
             where id='$id'";
             $res = M()->execute($sql);
             $usql="update product_s set is_delete = 1 
             where f_id='$id'";
             $ures = M()->execute($usql);
             return 0;
        }
       if($f_id!==0)
        {
             $sql="update product_s set is_delete = 1 
             where id='$id'";
             $res = M()->execute($sql);
             return 0;
        }
     
    }



    public function addProduct($name,$level,$summary,$f_id){
      //父级产品level为1
      if($level=='1')
      {
           $sql="insert into product (name,level,summary,is_delete) 
           values ('$name','$level','$summary','0')";
           $res = M()->execute($sql);
           return 0;
      }

      //子级产品level为2
      else if($level=='2')
      {
           $sql="insert into product_s (name,level,summary,f_id,is_delete) values ('$name','$level','$summary','$f_id','0')";
           $res = M()->execute($sql);
           return 0;
      }
      else
      {
           return 1;
      }

    }


    public function Product($page){
        $asql="select id,name,level,summary 
        from product where is_delete = 0";
        $ares=M()->query($asql);
        
        $sql = "SELECT
            product.name AS aname,
            product_s.id,product_s.name,
            product_s.summary,
            product_s.f_id
            FROM product 
            LEFT JOIN product_s 
            ON product.id = product_s.f_id  
            where product.is_delete = 0 
            and product_s.is_delete = 0 
            limit $page,10 ";

        $res = M()->query($sql);
        $result=array();
        $result['res']=$res;
        $result['ares']=$ares;
        $usql="select count(*) 
        as count from product_s
         where is_delete='0'";
        $ures = M()->query($usql);
            
        $result['count']=$ures[0]['count'];
        return $result;
    }
    
}




<?php
namespace Doc\Model;
class BackstageManagementModel{
	public function info(){
        $sql="select * from person";
        $res = M()->query($sql);
        return $res;
    }
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
      //var_dump($res);die;
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

}
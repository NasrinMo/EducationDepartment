<?php
class Student{
	public function studentList($array=null){ //means array is null defult if parameter dose not pass for function
		global $conn;

		if ( isset($array["order"]) && $array["order"] !== "" && $array !== null )   {
			$order = $array["order"];
		}else{
			$order = "asc";
		}

		if ( isset($array["sort"]) && $array["sort"] !== "" && $array !== null ) {
			$sort = $array["sort"];
		}else{
			$sort = "id_student";
		}

		$sql = "select * from student order by ".$sort." ".$order." ;";

		$result = $conn->query($sql);
		$myData = [];
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    $myData[] = $row;
		  }
		}
		return $myData;
	}

	public function studentInsert($array){
		global $conn;
		$sql = "INSERT INTO student (firstName, lastName,birthday,gender, email,phone)
					VALUES ('".$array['firstName']."', '".$array['lastName']."', '".$array['birthday']."', '".$array['gender']."', '".$array['email']."', '".$array['phone']."')";
		
		if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true);
			$last_id = $conn->insert_id;
			$resultTag = $this->tagsInsert($array['tags'],$last_id);
			if (isset($array["courses"]) && count($array["courses"])>0 ) {
			 	enrollInsert($last_id,$array["courses"]);
			}
			if (isset($resultTag['status']) && $resultTag['status'] == false ){
				$result = array("status"=> false , "error" => $conn->error );
			}

		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}


		return $result;

	}

	public function tagsInsert($str,$id){
		if( $str !== ""){
			global $conn;
			$sql="INSERT INTO tags (id_student, name)
						VALUES ";
			$str_arr = explode (",", $str);//convert string separate by comma to array

			foreach ($str_arr as $key => $value) {
				if( $value !== ""){
					$sql .= "(".$id.", '".trim($value)."'),";
				}

			}

			$sql = rtrim($sql, ","); //remove last comma in string
			$sql .=";";
			
			if ($conn->query($sql) === TRUE) {
				$result = array("status"=> true);
			} else {
				$result = array("status"=> false , "error" => $conn->error );
			}
			return $result;
		}else{
			return false;
		}
	}

	public function studentDelete($id){ 
		global $conn;
		$sql = "delete from tags where id_student =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		$sql = "delete from enrollment where id_student =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		$sql = "delete from student where id_student =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		return $result;

	}

	public function selectedStudentDelete($array){ 
		global $conn;
		$str = implode(",", $array["row"]); //convert array to string separate by comma
		$sql = "delete from tags where id_student IN (".$str.")" ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		$sql = "delete from enrollment where id_student  IN (".$str.")" ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		$sql = "delete from student where id_student IN (".$str.")" ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		return $result;

	}

	public function getStudentById($id){
		global $conn;

		$sql = "select * from student where id_student =".$id ;
		$tags = $this->getTagsByStudentId($id);
		$courses = $this->getCourseByStudentId($id);
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

		  // output data of each row
		  $row = $result->fetch_assoc();
		  //attach tags to student array
		  foreach ($tags as $key => $value) { 
		  	$row['tags'][] =  $value;
		  } 

		  //attach selected course to student array
		  foreach ($courses as $key => $value) {
		  	$row['courses'][$value["id_course"]] =  $value;
		  } 

		}
		return $row;		
	}

	public function getCourseByStudentId($id){
		global $conn;
		$sql = "select c.*,e.create_at AS assign_created,e.update_at AS assign_updated
				from student s join enrollment e
				on s.id_student = e.id_student join course  c 
				on c.id_course = e.id_course  where e.id_student =".$id ;
		
		$result = $conn->query($sql);
		$myData = [];
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    $myData[] = $row;
		  }
		}
		return $myData;		
	}

	public function getTagsByStudentId($id){
		global $conn;
		$sql = "select * from tags where id_student =".$id ;
		$result = $conn->query($sql);
		$myData = [];
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    $myData[] = $row;
		  }
		}
		return $myData;
	}

	public function studentUpdate($array){
		global $conn;
		$sql = "update student set firstName='".$array['firstName']."', lastName='".$array['lastName']."', birthday='".$array['birthday']."' , gender='".$array['gender']."',email='".$array['email']."',phone='".$array['phone']."'  
			where id_student=".$array['id'].""; 

	    $executeDeleteTag = $this->deleteTagsByStudentId($array['id']);
		$this->tagsInsert($array['tags'],$array['id']);

	    $executeDeleteEnrollment = $this->deleteEnrollmentByStudentId($array['id']);
	    enrollInsert($array['id'],$array["courses"]);
		

		if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true);
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}
		
		return $result;
	}

	public function deleteTagsByStudentId($id){
		global $conn;
		$sql = "delete from tags where id_student =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}
		return $result;
	}

	public function deleteEnrollmentByStudentId($id){
		global $conn;
		$sql = "delete from enrollment where id_student =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}
		return $result;
	}

}

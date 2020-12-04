<?php
class Course{
	private $_title;
	private $_unit;
	private $_description;

	public function __constract(){

	}

	// public function set_title($title){
	// 	$this->_title = $title;
	// }

	// public function set_unit($unit){
	// 	$this->_unit = $unit;
	// }

	// public function set_description($description){
	// 	$this->_description = $description;
	// }

	// public function get_title(){
	// 	return $this->_title;
	// }

	// public function get_unit(){
	// 	return $this->_unit;
	// }

	// public function get_description(){
	// 	return $this->_description;
	// }

	public function courseList(){
		global $conn;
		$sql = "select * from course ;";
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

	public function courseInsert($array){
		global $conn;
		$sql = "INSERT INTO course (title, unit, description)
					VALUES ('".$array['title']."', '".$array['unit']."', '".$array['description']."')";
					
		if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true);
			$last_id = $conn->insert_id;
			if (isset($array['students']) && count($array['students'])>0 ) {
			 	$this->enrollInsertByCourseId($last_id,$array['students']);
			}
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}
		return $result;

	}

	public function enrollInsertByCourseId($id_course,$studentsArray){
		if( $id_course !== "" && count($studentsArray)>0 ){
			global $conn;
			$sql = "";
			$sql .= "INSERT INTO enrollment (id_student,id_course)
						VALUES ";
			foreach ($studentsArray as $key => $value) {
				if( $value !== ""){
					$sql .= "('".$value."','".$id_course."'),";
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

	public function courseDelete($id){
		global $conn;

		$sql = "delete from enrollment where id_course =".$id ;
			if ($conn->query($sql) === TRUE) {
				$result = array("status"=> true);
			} else {
				$result = array("status"=> false , "error" => $conn->error );
			}

		$sql = "delete from course where id_course =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}

		return $result;

	}

	public function getCourseById($id){ 
		global $conn;
		$sql = "select * from course where id_course =".$id ;
		$students = $this->getStudentByCourseId($id);
		$result = $conn->query($sql);
		$row = [];

		if ($result->num_rows > 0) {
		  // output data of each row
		 $row = $result->fetch_assoc() ;
		 foreach ($students as $key => $value) {
		 	 $row["students"][$value["id_student"]] = $value;
		 }

		}

		return $row;	
	}

	public function getStudentByCourseId($id){ 
		global $conn;
		$sql = "select s.*,e.create_at AS assign_created,e.update_at AS assign_updated
				from student s join enrollment e
				on s.id_student = e.id_student join course  c 
				on c.id_course = e.id_course  where e.id_course =".$id ;
		$result = $conn->query($sql);
		$myData = [];
		if ($result->num_rows > 0) {
		  // output data of each row
			while ( $row = $result->fetch_assoc()) {
				 $myData[] = $row;
			}
		}

		return $myData;			
	}

	public function courseUpdate($array){
		global $conn;
		$sql = "update course set title='".$array['title']."', unit='".$array['unit']."', description='".$array['description']."'  
			where id_course=".$array['id']."";
		
		$executeDeleteEnrollment = $this->deleteEnrollmentByCourseId($array['id']);
		$this->enrollInsertByCourseId($array['id'],$array['students']);

		if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true);
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}
		
		return $result;
	}

	public function deleteEnrollmentByCourseId($id){
		global $conn;
		$sql = "delete from enrollment where id_course =".$id ;
				if ($conn->query($sql) === TRUE) {
					$result = array("status"=> true);
				} else {
					$result = array("status"=> false , "error" => $conn->error );
				}
		return $result;
	}

}
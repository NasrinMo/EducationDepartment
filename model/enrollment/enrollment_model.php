<?php
function enrollList(){
	global $conn;
	$sql = "select e.id_student,firstName,lastName,title
			from student s JOIN enrollment e
			on s.id_student = e.id_student JOIN course c
			on c.id_course = e.id_course order by e.id_student ;";
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

function enrollDelete($id){
	global $conn;
	$sql = "delete from enrollment where id_student =".$id ;
			if ($conn->query($sql) === TRUE) {
				$result = array("status"=> true);
			} else {
				$result = array("status"=> false , "error" => $conn->error );
			}

	return $result;

}

function enrollInsert($id_student,$coursesArray){

	if( $id_student !== "" && count($coursesArray)>0 ){
		global $conn;
		$sql="INSERT INTO enrollment (id_student, id_course)
					VALUES ";
		foreach ($coursesArray as $key => $value) {
			if( $value !== ""){
				$sql .= "(".$id_student.", '".$value."'),";
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
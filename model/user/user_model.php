<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function checkUser($array) {
	global $conn;
	global $salt;
	$passwordMd5 = md5($array["password"].$salt);
	$sql = "select * from users where email ='".$array["email"]."' and password='".$passwordMd5."'";
	$result = $conn->query($sql);
	$row ="";
	
	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
	}
	
	return $row;
}

function checkUniqueUser($array) {
	global $conn;
	global $salt;
	$email = $array["email"];
	$sql = "select * from users where email ='".$email."'";
	$result = $conn->query($sql);
	$row ="";
	
	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
	}

	return $row;
}

function userInsert($array){
	global $conn;
	global $salt;
	$password = md5($array["password"].$salt);
    $token = generateToken($array["email"] ,date("Y-m-i h:i:s"));
	$imageUrl = "";

	if (basename($_FILES["photo"]["name"]) != "") {
		$imageUrl = uploadPhoto($array);
	}
		
	$sql = "INSERT INTO users (firstName, lastName,email,password,token,imageUrl)
			VALUES ('".$array['firstName']."', '".$array['lastName']."', '".$array['email']."', '".$password."', '".$token."', '".$imageUrl."')";
 
	if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true);	
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}

	return $result;

}


function getToken($array){
	global $conn;

	$sql = "select * from users where id=".$array["id"];

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
	}

	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

	$body = "Click on this link to change password<br>"."<a href='"
			.$actual_link 
			."/php/student/index.php?action=password_create&token=".$row["token"]."'>".$actual_link 
			."/php/student/index.php?action=password_create&token=".$row["token"]."</a>";
	
	$infoArray = [
		"host" => "smtp.gmail.com",
		"username" => "nasrinDeveloper2020@gmail.com",
		"password" => "N@sr!nR@min2020",
		"from" => "nasrinDeveloper2020@gmail.com",
		"address" => $array["email"],
		"subject" => "Forget Password Link",
		"body" => $body,
		"name" => $array["firstName"]." ".$array["lastName"]
	];

	$resultEmail = sendMail($infoArray);


	return $row;

}

function sendMail($array){

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
	    $mail->SMTPDebug = false;                     // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = $array["host"];                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = $array["username"];                     // SMTP username
	    $mail->Password   = $array["password"];                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom($array["from"], 'Education Department');
	    $mail->addAddress($array["address"], $array["name"]);     // Add a recipient
	    // $mail->addAddress('ellen@example.com');               // Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    // Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $array["subject"];
	    $mail->Body    = $array["body"];
	   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    return true;
	} catch (Exception $e) {
	    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}

function uploadPhoto($array){
	$year = date('yy');
	$month = date('m');

	$folderDate = $year."_".$month ;

	if (! is_dir($folderDate) ){
		mkdir("uploads/".$folderDate, 0755);
	}

	$target_dir = "uploads/".$folderDate."/";

	$currentDate = date("Y-m-i h:i:s");
	$photoHashed = md5($currentDate);
	$target_file = $target_dir . $photoHashed.basename($_FILES["photo"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	// if(isset($array["submit"])) {
	//   $check = getimagesize($_FILES["photo"]["name"]);
	//   if($check !== false) {
	//     echo "File is an image - " . $check["mime"] . ".";
	//     $uploadOk = 1;
	//   } else {
	//     echo "File is not an image.";
	//     $uploadOk = 0;
	//   }
	// }

	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["photo"]["size"] > 500000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
	    echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
	  } else {
	    echo "Sorry, there was an error uploading your file.";
	  }
	}
	
	if ($uploadOk == 0) {
		return 0;
	}else{
		return  $target_file ;
	}
	
}

function userUpdate($array){
	global $conn;
	
	if (basename($_FILES["photo"]["name"]) !== "") {
		$imageUrl = uploadPhoto($array);
		$sql = "update users set firstName='".$array['firstName']."', lastName='".$array['lastName']."', email='".$array['email']."', imageUrl='".$imageUrl."' 
		where id=".$array['id']."";
	}else{
		$sql = "update users set firstName='".$array['firstName']."', lastName='".$array['lastName']."', email='".$array['email']."' 
		where id=".$array['id']."";

	}


	if ($conn->query($sql) === TRUE) {
		$result = array("status"=> true);
	} else {
		$result = array("status"=> false , "error" => $conn->error );
	}
	
	return $result;
}

function passwordUpdate($array){
	global $conn;
	global $salt;

	$newPassword = md5($array["newPassword"].$salt);
	$currentPassword = md5($array["currentPassword"].$salt);

	$user = getUserById($array["id"]);

	$sql = "update users set password='".$newPassword."',token='".generateToken($user["email"],$user["update_at"])."' 
		where email='".$array["email"]."'  and password='".$currentPassword."'"	;
	
	if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true,"success"=> "","message"=> "");
			if ($conn->affected_rows <= 0 ) {
				$result["message"]="Current Password is Incorrect";
			}else{
				$result["message"]="Password Changed Successfully";
				$result["success"]=true;
			}
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}

	return $result;


}

function getUserById($id){
	global $conn;

	$sql = "select * from users where id=".$id;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
	}

	return $row;
}

function getUserByToken($token){
	global $conn;

	$sql = "select * from users where token='".$token."'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	   $row = $result->fetch_assoc();
	   $row["status"] = true;
	}else{
	  $row["status"] = false;
	}
	
	return $row;
}

function passwordUpdateByToken($array){
	global $conn;
	global $salt;

	$newPassword = md5($array["newPassword"].$salt);

	$user = getUserById($array["id"]);

	$sql = "update users set password='".$newPassword."',token='".generateToken($user["email"],$user["update_at"])."' 
		where email='".$array["email"]."'";
	
	if ($conn->query($sql) === TRUE) {
			$result = array("status"=> true,"success"=> "","message"=> "");
		} else {
			$result = array("status"=> false , "error" => $conn->error );
		}

	return $result;


}

function generateToken($email,$date){

	return md5($email.$date);
}
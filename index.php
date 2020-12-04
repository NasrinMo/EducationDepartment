<?php
session_start();


require_once "model/model_main.php";

$courseObject = new Course();
$studentObject = new Student();

if (isset($_GET["action"])){
	$action = $_GET["action"];
}else{
	$action = "";
}

require_once "titles.php";

require_once "header.php";

switch ($action) {
	case 'login':
			require_once "html/user/".$action.".php";
		break;
	case 'authentified':
			if (isset($_POST) && !empty($_POST)) { 
				$user = checkUser($_POST);
				if ( $user !== "" && count($user) > 0 ) {
					$_SESSION["user"] = array(  "id"=>$user["id"] ,
												"firstName"=>$user["firstName"] ,
												"lastName"=>$user["lastName"] ,
												"email"=>$user["email"],
												"photo"=>$user["imageUrl"]
									        ) ;

					header("Location: index.php");
				}else{
					$str = "&message=Username or Password is incorrect";
					header("Location: index.php?action=login".$str);
				}
			}else{
					header("Location: index.php");
			}
		break;
	case 'logout':
			unset($_SESSION['user']);  
			session_destroy();
			header("Location: index.php");
		break;
	case 'signup':
			require_once "html/user/".$action.".php";
		break;
	case 'createUser':
			$user = checkUniqueUser($_POST);
			if ( $user !== "" && count($user) > 0 ) {
				$str = "&message=Email address already exists";
				header("Location: index.php?action=signup".$str);
			}else{
				$resultQuery = userInsert($_POST);
				if(!$resultQuery['status']){
					$str = "&message=".$resultQuery['error'] ;
					header("Location: index.php?action=signup".$str);
				}else{
					$str = "&message=Registration Successful. Please Login";
					header("Location: index.php?action=login".$str);
				}
			}	
		break;
	case 'user_edit':
				if (isset($_GET["id"]) && $_GET["id"] != "" && isset($_SESSION["user"])) {
					$user = getUserById($_GET["id"]);
					require_once "html/user/".$action.".php";
				}else{
					header("Location: index.php");
				}	
		break;
	case 'user_update':
		if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) { 
			$resultQuery = userUpdate($_POST);
			if(!$resultQuery['status']){
				$str = "&message=".$resultQuery['message'] ;
				header("Location: index.php?action=user_edit".$str);
			}else{
				$id =$_SESSION["user"]["id"];
				$user = getUserById($_POST["id"]);
				$_SESSION["user"] = array(  "id" => $id,
											"firstName"=>$_POST["firstName"] ,
											"lastName"=>$_POST["lastName"] ,
											"email"=>$_POST["email"],
											"photo"=>$user["imageUrl"]
								        ) ;
				header("Location: index.php?action=home");
			}
		}else{
					header("Location: index.php");
				} 
		break;
	case 'email_check':
				require_once "html/user/".$action.".php"; 	
		break;
	case 'sendLink':
				if (isset($_POST)) {
					$user = checkUniqueUser($_POST);
					if ( $user !== "" && count($user) > 0 ) {
						$result=getToken($user);
						require_once "html/user/".$action.".php";
					}else{
						$str = "&message=This email does not exist";
						header("Location: index.php?action=email_check".$str);
					}
				}	
		break;
	case 'password_create':
				if (isset($_GET["token"]) && $_GET["token"] !="") {
					$user = getUserByToken($_GET["token"]);
					if ($user["status"] == false) {
						header("Location: index.php?action=home");
					}else{
						require_once "html/user/".$action.".php";	
					}	
				}
		break;
	case 'password_update_by_token':
		if (isset($_POST) && $_POST !== "") {
			$resultQuery = passwordUpdateByToken($_POST);
			if(!$resultQuery['status']){
				$str = "&message=".$resultQuery['error'] ;
				header("Location: index.php?token=".$_POST["token"]."&action=password_create".$str);
			}else{
				$str = "&message=Password Changed Successfully" ;
				header("Location: index.php?action=login".$str);
			}
		}

		break;
	case 'password_edit':
				if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
					$user = getUserById($_GET["id"]);
					 require_once "html/user/".$action.".php";
				}else{
					header("Location: index.php");
				} 	
		break;
	case 'password_update':
		if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
			$resultQuery = passwordUpdate($_POST);
			if(!$resultQuery['status']){
				$str = "&message=".$resultQuery['error'] ;
				header("Location: index.php?action=password_edit".$str);
			}else{
				$str = "&message=".$resultQuery["message"];
				if ($resultQuery["success"] == true) {
					//dump("ok");
					header("Location: index.php?action=user_edit&id=". $_POST["id"] .$str);
				}else
				    header("Location: index.php?action=password_edit&id=". $_POST["id"].$str);
			}
		}else{
				header("Location: index.php");
			}

		break;
	case 'student_list':
			if (isset($_SESSION["user"])) {
				$students = $studentObject->studentList($_POST);
				if (isset($_POST["order"]) && $_POST["order"] !== "" ) {
					$order = $_POST["order"];
				}
				if (isset($_POST["sort"]) && $_POST["sort"] !== ""  ) {
					$sort = $_POST["sort"];
				}
				require_once "html/student/".$action.".php";
			}else{
				header("Location: index.php");
			}
			
		break;
	case 'student_add':
			if (isset($_SESSION["user"])) {
				$allCourses = $courseObject->courseList();
				require_once "html/student/".$action.".php";
			}else{
				header("Location: index.php");
			}
		break;
	case 'student_insert':
			if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
				$resultQuery = $studentObject->studentInsert($_POST);
				if(!$resultQuery['status']){
					$str = "&error=".$resultQuery['error'] ;
					header("Location: index.php?action=student_add".$str);
				}else{
					header("Location: index.php?action=student_list");
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'student_delete':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				$resultDelete = $studentObject->studentDelete($_GET['id']);
				
				if(!$resultQuery['status']){
					$str = "&error=".$resultDelete['error'] ;
				}else{
					$str = "";
				}
				header("Location: index.php?action=student_list".$str);
			}else{
				header("Location: index.php");
			}
		break;
	case 'delete_selected':
			if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
				$resultDelete = $studentObject->selectedStudentDelete($_POST);
				if(!$resultQuery['status']){
					$str = "&error=".$resultDelete['error'] ;
				}else{
					$str = "";
				}
				header("Location: index.php?action=student_list".$str);
			}else{
				header("Location: index.php");
			}
		break;
	case 'student_edit':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				if (isset($_GET['id'])) {
					$allCourses = $courseObject->courseList();
					$student = $studentObject->getStudentById($_GET['id']);
					require_once "html/student/".$action.".php";
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'student_update':
			if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
				if (isset($_POST)) {
					$resultQuery = $studentObject->studentUpdate($_POST);
					if(!$resultQuery['status']){
						$str = "&id=".$_POST["id"]."&error=".$resultQuery['error'] ;
						header("Location: index.php?action=student_edit".$str);
					}else{
						header("Location: index.php?action=student_list");
					}
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'student_detail':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				if (isset($_GET['id'])) {
					$student = $studentObject->getStudentById($_GET['id']);
					require_once "html/student/".$action.".php";
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_list': 
			if (isset($_SESSION["user"])) {
				$courses = $courseObject->courseList();
				require_once "html/course/".$action.".php";
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_add':
			if (isset($_SESSION["user"])) {
				$allStudents = $studentObject->studentList();
				require_once "html/course/".$action.".php";
			}else{
				header("Location: index.php");
			}

		break;
	case 'course_insert':
			if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
				$resultQuery = $courseObject->courseInsert($_POST);
				if(!$resultQuery['status']){
					$str = "&error=".$resultQuery['error'] ;
					header("Location: index.php?action=course_add".$str);
				}else{
					header("Location: index.php?action=course_list");
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_edit':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				$allStudents = $studentObject->studentList();
				if (isset($_GET['id'])) {
					$course = $courseObject->getCourseById($_GET['id']);
					require_once "html/course/".$action.".php";
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_update':
			if (isset($_POST) && !empty($_POST) && isset($_SESSION["user"])) {
				$resultQuery = $courseObject->courseUpdate($_POST);
				if(!$resultQuery['status']){
					$str = "&id=".$_POST["id"]."&error=".$resultQuery['error'] ;
					header("Location: index.php?action=course_edit".$str);
				}else{
					header("Location: index.php?action=course_list");
				}
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_detail':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				$course = $courseObject->getCourseById($_GET['id']);
				require_once "html/course/".$action.".php";
			}else{
				header("Location: index.php");
			}
		break;
	case 'course_delete':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				$resultDelete = $courseObject->courseDelete($_GET['id']);
				
				if(!$resultQuery['status']){
					$str = "&error=".$resultDelete['error'] ;
				}else{
					$str = "";
				}
				header("Location: index.php?action=course_list".$str);
			}else{
				header("Location: index.php");
			}
		break;
	case 'enroll_list':
			if (isset($_SESSION["user"])) {
				$enrolls = enrollList();
				require_once "html/enrollment/".$action.".php";
			}else{
				header("Location: index.php");
			}
		break;
	case 'enroll_delete':
			if (isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION["user"])) {
				$resultDelete = enrollDelete($_GET['id']);
				
				if(!$resultQuery['status']){
					$str = "&error=".$resultDelete['error'] ;
				}else{
					$str = "";
				}

				header("Location: index.php?action=enroll_list".$str);
			}else{
				header("Location: index.php");
			}
		break;
	default:
			require_once "html/home.php";
		break;
}
?>
	
<?php require_once "footer.php"; ?>
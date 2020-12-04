<?php

if($action == "student_list"){
	$title="Student list";
}elseif($action =="course_list"){
	$title="Course list";
}elseif($action =="course_add"){
	$title="Add New Course";
}elseif($action =="student_add"){
	$title="Add New Student";
}elseif($action =="course_edit"){
	$title="Edit Course";
}elseif($action =="student_edit"){
	$title="Edit Student";
}elseif($action =="student_detail"){
	$title="Detail Student";
}elseif($action =="course_detail"){
	$title="Detail Course";
}elseif($action =="enroll_list"){
	$title="Enrollment List";
}elseif($action =="login"){
	$title="Login";
}elseif($action =="signup"){
	$title="Signup";
}elseif($action =="user_edit"){
	$title="Profile Information";
}elseif($action =="password_edit"){
	$title="Change Password";
}elseif($action =="email_check" || $action =="sendLink" || $action =="password_create"){
	$title="Forget Password";
}else{
	$title="Education Department";
}


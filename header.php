<!DOCTYPE html>
<html>
	<head>
		<link href="assets/font/css/all.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="assets/css/_student.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/student.js?v=12"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		<title><?php echo $title; ?></title>
		<style type="text/css">
			.box{
				padding: 5px;
				border: 2px #E6E6FA solid;
				border-radius: 5px;
				overflow-y: scroll;
				height: 100px;"
			}

			.home{
				background-image: url("assets/image/student/home.jpg");
				width: 100%;
				height: 530px;
			}

			.profilePhoto{
				width: 50px;
				height: 50px;
				border: 2px #E6E6FA solid;
				border-radius: 50px;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".delete-selected").click(function(){
					$(".delete-form").submit();
				});
			});
		</script>
	</head>
	<body>
	<?php require_once "menu/menu_login.php"; ?>
	
	<?php 
	if ( isset($_SESSION["user"]) && $_SESSION["user"] !== "" ) {
		require_once "menu/menu_main.php";
	}
	 ?>
<?php
$conn = new mysqli("localhost","root","","schooldb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function dump($val){
	echo "<pre>";var_dump($val);die;
}

$salt = "!@#1qaEf?%";
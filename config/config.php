<?php 
ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/Bucharest");

$db_name = "restaurant";
$db_user = "root";
$db_pass = "";
$db_host = "localhost";

try {
	$con = new PDO("mysql:host=$db_host; dbname=" .$db_name,$db_user,$db_pass);
	$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
/* 	echo "merge"; */
} catch (PDOException $err) {
	 echo "Fail to connect, there is some problems" . $err->getMessage();
	 exit();
}



?>
<?php
function connect(){
$DB_SERVER="localhost";
$DB_USER="root";
$DB_PASS="";
$DB_NAME="library";
$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASS);
if(!$connection){
 die("Connection failure: " . mysqli_error($connection));
	}
$db_select = mysqli_select_db($connection,$DB_NAME);
if(!$db_select){
 die("Database Error: " . mysqli_error($connection));
	}
	return $connection;
}
?>
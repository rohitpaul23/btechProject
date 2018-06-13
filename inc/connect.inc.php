<?php
	$host="localhost";
	$user="root";
	$password="";
	$dbname="wander";

	$conn=mysqli_connect($host,$user,$password,$dbname);
	if(!$conn)
		echo "<h1>MySQL Server is not connected</h1>";
?>
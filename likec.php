<?php 	
include("./inc/connect.inc.php");
	session_start();

	$userCount=0;
	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}

	$cID=$_POST["commentId"];
	$likeAt = date("Y-m-d h:i:sa");

	$checkQuery=mysqli_query($conn,"SELECT user_id FROM liked WHERE user_id='$u_id' AND content_id='$cID' AND like_status='1'")or die(mysqli_error($conn));
	if(!mysqli_fetch_assoc($checkQuery)){

			$likeCommand = "INSERT INTO liked VALUES('','$u_id','$cID','$likeAt','1')";
			$likequery=mysqli_query($conn,$likeCommand)or die(mysqli_error($conn));
	}
	$count=mysqli_query($conn,"SELECT COUNT(user_id) AS userCount FROM liked WHERE content_id='$cID' AND like_status='1'") or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($count);
	$userCount=$row["userCount"];

	echo "$userCount";
 ?>
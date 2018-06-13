<?php 
	include("./inc/connect.inc.php"); 


	$id=$_REQUEST["q"];
	$n=$_REQUEST["n"];
	$temp=0;

	if($n==0){
		echo "<h2>Follower</h2>";
		$followerQuery=mysqli_query($conn,"SELECT follower_ID  FROM follow WHERE following_ID='$id'")or die(mysqli_error($conn));
		while($followerRow=mysqli_fetch_assoc($followerQuery)){
			$temp=1;
			$follower=$followerRow["follower_ID"];
			$userQuery=mysqli_query($conn,"SELECT username,first_name,last_name FROM users WHERE u_id='$follower'")or die(mysqli_error($conn));
			if($userRow=mysqli_fetch_assoc($userQuery)){
				$first_name=$userRow["first_name"];
				$last_name=$userRow["last_name"];
				$user_name=$userRow["username"];
				$name=$first_name." ".$last_name;
				echo "<a href='$user_name' style='text-decoration: none; color:#275821; font-weight:bold; padding:4px;'>$name</a> <br>";
			}
		}
		if ($temp==0) {
			echo "<h3>You have no Follower</h3>";
		}
	}else{
		echo "<h2>Following</h2>";
		$followingQuery=mysqli_query($conn,"SELECT following_ID  FROM follow WHERE follower_ID='$id'")or die(mysqli_error($conn));
		while($followingRow=mysqli_fetch_assoc($followingQuery)){
			$temp=1;
			$following=$followingRow["following_ID"];
			$userQuery=mysqli_query($conn,"SELECT username,first_name,last_name FROM users WHERE u_id='$following'")or die(mysqli_error($conn));
			if($userRow=mysqli_fetch_assoc($userQuery)){
				$first_name=$userRow["first_name"];
				$last_name=$userRow["last_name"];
				$user_name=$userRow["username"];
				$name=$first_name." ".$last_name;
				echo "<a href='$user_name'>$name</a> <br>";
			}
		}
		if ($temp==0) {
			echo "<h3>You have not Follow anyone</h3>";
		}		
	}
	

?>
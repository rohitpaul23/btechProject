<?php

include("./inc/connect.inc.php");
	session_start();

	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}

	$bID=$_POST["blogID"];
	$comment=mysql_real_escape_string($_POST["content"]);
	$commentAt = date("Y-m-d h:i:sa");

	$commentCommand = "INSERT INTO comment VALUES('','$u_id','$bID','$comment','$commentAt','0')";  
	$commentquery=mysqli_query($conn,$commentCommand)or die(mysqli_error($conn));
	//echo "Comment Submitted Successfully";

	$name=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$u_id'") or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($name);
	if($row){
		$FName=$row['first_name'];
		$LName=$row['last_name'];
		$Name=$FName." ".$LName;
	}

	echo "<div class='commentDisplay'>
		  		<p class='name'>$Name</p>
		  		<p class='time'>$commentAt</p>
      			<p class='comment'>$comment</p>							
		</div>";

?>
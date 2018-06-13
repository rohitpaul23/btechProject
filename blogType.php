<?php 
include("./inc/connect.inc.php");
	session_start();

	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}

	$bt=$_POST["blogType"];
	$ttemp=0;
			$blogTypeQuery=mysqli_query($conn,"SELECT * FROM blog WHERE blog_type='$bt'")or die(mysqli_error($conn));
			while($trow=mysqli_fetch_assoc($blogTypeQuery)){
				$tblogId=$trow["blog_id"];
				$tblogTitle=$trow["blog_title"];
				$tblogType=$trow["blog_type"];
				$tblogAdded=$trow["blog_added"];
				$tuserID=$trow["added_id"];

				$followUserQuery=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$tuserID'")or die(mysqli_error($conn));
				if($urow=mysqli_fetch_assoc($followUserQuery)){
					$tFirstName=$urow["first_name"];
					$tLastName=$urow["last_name"];
					$tName=$tFirstName." ".$tLastName;
				}

    	    			
    	    	echo "<button class='accord' onclick='blogDisplay(".$tblogId.")'>
						<div style='font-size:15px;'>".
							$tName."-".$tblogType."-".$tblogAdded."
						</div>".$tblogTitle."
						</button>";
						$ttemp=1;
			}
			if($ttemp==0){
				echo "<h3>No Result Found</h3>";
			}

 ?>
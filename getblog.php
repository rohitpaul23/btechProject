<?php	
	include("./inc/connect.inc.php"); 
	session_start();

	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}

	$blogId=$_REQUEST["q"];
	$cat=$_REQUEST["p"];

	if($cat==2){
		$blogquery="SELECT * FROM blog WHERE EXISTS(SELECT following_ID FROM follow WHERE (follower_ID=blog.added_id OR follower_ID='$u_id') AND (following_ID='$u_id' OR following_ID=blog.added_id))OR added_id='$u_id' ORDER BY blog_id DESC LIMIT 5 OFFSET ".$blogId."";
		$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
	}else if ($cat==1) {
		$blogquery="SELECT * FROM blog WHERE added_id='$u_id' ORDER BY blog_id DESC LIMIT 5 OFFSET ".$blogId."";
		$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
	}
	
	$temp=0;
	$j=1;
			/*$blogquery="SELECT * FROM blog ORDER BY blog_id DESC LIMIT 5 OFFSET ".$blogId."";
			$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));*/
				while($row=mysqli_fetch_assoc($getblog)){
					$temp=1;
					$bId=$row['blog_id'];
					$bTitle=$row['blog_title'];
					$bType=$row['blog_type'];
					$bPicArray=$row['blog_picArray'];
					$bAdded=$row['blog_added'];
					$bContent=$row['blog_content'];
					$bAddedId=$row['added_id'];
					
					$getname=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$bAddedId'") or die(mysqli_error($conn));
					$nrow=mysqli_fetch_assoc($getname);
					$bFName=$nrow['first_name'];
					$bLName=$nrow['last_name'];
					$bName=$bFName." ".$bLName;
					$bSubTitle="";

					$profile_pic="img/default_pic.jpg";
					$getprofilepic=mysqli_query($conn,"SELECT profile_pic FROM usersdetails WHERE user_id='$bAddedId'")or die(mysqli_error($conn));
					$prow=mysqli_fetch_assoc($getprofilepic);
					if($prow){
						$pPPic=$prow['profile_pic'];
						$profile_pic="userdata/profile_pics/".$pPPic;
					}

					if(strlen($bTitle)<=75)
						$bSubTitle=$bTitle;
					else
						$bSubTitle=substr($bTitle,0,75).'...';
					

					$picarray=explode(",", $bPicArray,-1);

					echo "<button class='accord' onclick='blogDisplay(".$bId.")'>
								<div style='font-size:15px;'>".
									$bName."-".$bType."-".$bAdded."
								</div>
								".$bSubTitle."
							</button>";

					$j++;
				}
				/*echo "<div class='blogDisplayModal' id='blogDisplayModal'>
					<div class='blogDisplayModalContent'>
						<span class='closeDisplay' onclick='closeFunc()'>&times;</span>";
				echo "
					<div class='blogBody' id='bd'></div>
					</div>
					</div>";
*/			if($temp==1){
				echo "
	<button class='next' onclick='loadDoc(".($blogId+$j-1).")'>&#10095;</button>
	<button class='back' onclick='backDoc()'>&#10094;</button>";

}

	//echo "Hey";

?>
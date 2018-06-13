<?php include("./inc/header.inc.php"); ?>

<div class="contentWrap">
	<?php 
		$not_query=mysqli_query($conn,"SELECT 'follow' As Type,follow_ID,followed_at,follow_status
											FROM follow 
											UNION
											SELECT 'blog',blog_id,blog_added,blog_status
											FROM blog
											ORDER BY followed_at DESC")or die(mysqli_error($conn));
		while($not_row=mysqli_fetch_assoc($not_query)){
			//print_r($not_row);
			if($not_row["Type"]=="follow"){
				$fid=$not_row["follow_ID"];
				$follow_query=mysqli_query($conn,"SELECT follower_ID,following_ID,followed_at FROM follow WHERE follow_ID='$fid'")or die(mysqli_error("$conn"));
				if($follow_row=mysqli_fetch_assoc($follow_query)){
					$follower=$follow_row["follower_ID"];
					$following=$follow_row["following_ID"];						
					$followed_at=$follow_row["followed_at"];
					if($following==$u_id){
						$check_query=mysqli_query($conn,"SELECT follower_ID,following_ID FROM follow WHERE follower_ID='$following' AND following_ID='$follower'")or die(mysqli_error("$conn"));
						if(!mysqli_fetch_assoc($check_query)){
							$user_query=mysqli_query($conn,"SELECT first_name,last_name,username FROM users WHERE u_id='$follower'")or die(mysqli_error("$conn"));
							if ($user_row=mysqli_fetch_assoc($user_query)) {
								$firstName=$user_row["first_name"];
								$lastName=$user_row["last_name"];
								$userName=$user_row["username"];
								$name=$firstName." ".$lastName;
								$date = date_create();
								$followed_at = date_create($followed_at);

								$dateDiff=date_diff($date,$followed_at);

								echo "<div class='notification'>
									<a href='".$userName."'>".$name."</a> started Following you
										<div class='date'>";

								if ($dateDiff->y==0) {
									if ($dateDiff->m==0) {
										if ($dateDiff->d==0) {
											if ($dateDiff->h==0) {
												if ($dateDiff->m==0) {
													if ($dateDiff->s==0) {
														echo "Just Now";
													}
													else
														print $dateDiff->s." Sec ago";
												}
												else
													print $dateDiff->m." Mins ago";
											}
											else
												print $dateDiff->h." Hours ago";
										}
										else
											print $dateDiff->d." Days ago";
									}
									else
										print $dateDiff->m." Months ago";
								}
								else
									print $dateDiff->y." Years ago";

								echo "</div>

								</div>";
							}
						}
					}
					if ($follower==$u_id) {
							$user_query=mysqli_query($conn,"SELECT first_name,last_name,username FROM users WHERE u_id='$following'")or die(mysqli_error("$conn"));
							if ($user_row=mysqli_fetch_assoc($user_query)) {
								$firstName=$user_row["first_name"];
								$lastName=$user_row["last_name"];
								$userName=$user_row["username"];
								$name=$firstName." ".$lastName;
								$date = date_create();
								$followed_at = date_create($followed_at);

								$dateDiff=date_diff($date,$followed_at);

								echo "<div class='notification'>
									You started Following <a href='".$userName."'>".$name."</a>
									<div class='date'>";

								if ($dateDiff->y==0) {
									if ($dateDiff->m==0) {
										if ($dateDiff->d==0) {
											if ($dateDiff->h==0) {
												if ($dateDiff->m==0) {
													if ($dateDiff->s==0) {
														echo "Just Now";
													}
													else
														print $dateDiff->s." Sec ago";
												}
												else
													print $dateDiff->m." Mins ago";
											}
											else
												print $dateDiff->h." Hours ago";
										}
										else
											print $dateDiff->d." Days ago";
									}
									else
										print $dateDiff->m." Months ago";
								}
								else
									print $dateDiff->y." Years ago";

								echo "</div>
								</div>";
							}
						
					}
				}
			}
			else if($not_row["Type"]=="blog"){
				$bid=$not_row["follow_ID"];
				$blog_query=mysqli_query($conn,"SELECT added_id,blog_added FROM blog WHERE blog_id='$bid'")or die(mysqli_error("$conn"));
				if($blog_row=mysqli_fetch_assoc($follow_query)){
					$blogAddedId=$blog_row["added_id"];
					$blogAdded=$follow_row["blog_added"];						
					
					$checkb_query=mysqli_query($conn,"SELECT * FROM follow WHERE (follower_ID='$u_id' AND following_ID='blogAddedId')OR(follower_ID='$blogAddedId' AND following_ID='$u_id')")or die(mysqli_error($conn));
					if(mysqli_fetch_assoc($checkb_query)){
							$userb_query=mysqli_query($conn,"SELECT first_name,last_name,username FROM users WHERE u_id='$blogAddedId'")or die(mysqli_error("$conn"));
							if ($userb_row=mysqli_fetch_assoc($userb_query)) {
								$firstName=$userb_row["first_name"];
								$lastName=$userb_row["last_name"];
								$userName=$userb_row["username"];
								$name=$firstName." ".$lastName;
								$date = date_create();
								$followed_at = date_create($blogAdded);

								$dateDiff=date_diff($date,$blogAdded);

								echo "<div class='notification'>
									<a href='".$userName."'>".$name."</a> Shared a Blog
										<div class='date'>";

								if ($dateDiff->y==0) {
									if ($dateDiff->m==0) {
										if ($dateDiff->d==0) {
											if ($dateDiff->h==0) {
												if ($dateDiff->m==0) {
													if ($dateDiff->s==0) {
														echo "Just Now";
													}
													else
														print $dateDiff->s." Sec ago";
												}
												else
													print $dateDiff->m." Mins ago";
											}
											else
												print $dateDiff->h." Hours ago";
										}
										else
											print $dateDiff->d." Days ago";
									}
									else
										print $dateDiff->m." Months ago";
								}
								else
									print $dateDiff->y." Years ago";

								echo "</div>

								</div>";
							}
						
					}
				}
			}
		}
	 ?>
</div>
<?php 
	include("./inc/connect.inc.php"); 

	$blogId=$_REQUEST["q"];

	$blogquery="SELECT * FROM blog WHERE blog_id='".$blogId."'";
	$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($getblog);
		if($row){
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

			$btitle=str_ireplace(" ", "_", $bTitle);


		
				echo "	<div class='blogAttr'>
							<img src='".$profile_pic."' width='70' />  ".$bName."<br><h2><a href='search.php?q=@".$bType."' style='text-decoration:none;'>".$bType."</a></h2>
							<div class='mdate'>".$bAdded."</div>
							<input type='hidden' id='blogID' value='$blogId'>
							<input type='hidden' id='addedID' value='$bAddedId'>
							<div class='link'>
								<a href='blog.php?title=$btitle' target='_blank'><div class='newTab'>Open in New Tab</div></a>
							</div>
						</div>
						<h1>".$bTitle."</h1><br>";

						if(strpos($bContent,"[[[img]]]")==TRUE){
							/*echo "<script>alert('hey1')</script>";
							if(preg_match("/^[[[img]]]+[a-z0-9]+.[a-z]+[[[\img]]]$/", $bContent)){
								echo "<script>alert('hey2')</script>";
							}*/
							$imgArray=array();
							$i=0;
							$content=$bContent;
							$word1 = '[[[img]]]';
							$word2 = '[[[/img]]]';
							$folder=strstr($picarray[0],"/",true);

							while(preg_match('/'.preg_quote($word1,'/').'(.*?)'.preg_quote($word2,'/').'/is', $content, $match)){
							$content=strstr($content, "[[[img]]]$match[1][[[/img]]]");
							$content=str_ireplace("[[[img]]]$match[1][[[/img]]]","",$content);
							$imgArray[$i++]=$folder."/".$match[1];
							}
							/*echo "$folder <br>";
							print_r($imgArray);
							print_r($picarray);*/
							for($i=0;$i<count($imgArray);$i++){
								$no=array_search($imgArray[$i],$picarray);
								array_splice($picarray,$no,1);
								echo "<br>";
							}
							//print_r($picarray);


							echo "<div class='slideshow-container'>";

								for($k=0;$k<count($picarray);$k++){
										echo "<div class='mySlides'";
										if ($k==0) {
											echo "style='display:block;'";
										}
										echo ">
											<div class='numbertext'>".($k+1)."/".count($picarray)."</div>
											<img src='userdata/blog_pics/";
											echo $picarray[$k];
											echo "' style='width:100%'>
											<div class='text'></div>
										</div>";
									
								}
								if(count($picarray)>=1){
									echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
									<a class='pnext' onclick='plusSlides(1)'>&#10095;</a>";
								}

							echo "</div>
							<br>
							<div style='text-align:center'>";

								for($l=1;$l<=count($picarray);$l++){
									echo "<span class='dot' onclick='currentSlide(".$l.")'></span>";
								}
							echo "</div>";
						}
						else{
							echo "<div class='slideshow-container'>";

								for($k=0;$k<count($picarray);$k++){
										echo "<div class='mySlides'";
										if ($k==0) {
											echo "style='display:block;'";
										}
										echo ">
											<div class='numbertext'>".($k+1)."/".count($picarray)."</div>
											<img src='userdata/blog_pics/";
											echo $picarray[$k];
											echo "' style='width:100%'>
											<div class='text'></div>
										</div>";	
								}
								if(count($picarray)>=1){
									echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
									<a class='pnext' onclick='plusSlides(1)'>&#10095;</a>";
								}

							echo "</div>
							<br>
							<div style='text-align:center'>";

								for($l=1;$l<=count($picarray);$l++){
									echo "<span class='dot' onclick='currentSlide(".$l.")'></span>";
								}
							echo "</div>";
						}
						$s1= str_ireplace("[[[b]]]", "<b>", $bContent);
    					$s2= str_ireplace("[[[/b]]]", "</b>", $s1);
    					$s4=$s2;
    					$picarray=explode(",", $bPicArray,-1);
    					if(count($picarray)!=0){
    						$pFArray=explode("/", $picarray[0]);
    						$pFolder=$pFArray[0];
    						$s3= str_ireplace("[[[img]]]", "<img src='userdata/blog_pics/".$pFolder."/", $s2);
    						$s4= str_ireplace("[[[/img]]]", "' style='width:50%'>", $s3);
    					}
    					preg_match_all('/#([^\s]+)/', $s4, $matches);
    					foreach ($matches[1] as $match) {
    						$s4=str_ireplace("#".$match, "<a href='hashtag.php?q=".$match."'>#".$match."</a>", $s4);
    					}

						echo "<p style='font-size:18px; padding:8px;'>".nl2br($s4)."</p>";

						

/*
					echo "
						<textarea name='blogComment' id='commentContent' cols='65' rows='10' style='margin-left: 10px;' placeholder='Add Comment'></textarea>
						<input type='submit' name='commSubmit' id='commentSubmit' value='comment' style='position:relative; bottom:11px;'>
						<div id='commentError' style='color:red; padding-left:10px; display:none;'>This field is required</div>
						<br/><br/>
					
					<div onclick='showComment()' style='color:#ob703c; cursor:pointer; font-weight:bold; margin-left10px;'>Show Comment</div>
						<div id='cc' style='display:none;'>";

						$comm = mysqli_query($conn,"SELECT user_id,blog_id,comm_content,comm_at FROM comment")or die(mysqli_error($conn));
    					while($Crow=mysqli_fetch_array($comm))
  						{
	  						$Cu_id=$Crow['user_id'];
	  						$Cblog_id=$Crow['blog_id'];
      						$Ccomm_content=$Crow['comm_content'];
      						$Ccomm_at=$Crow['comm_at'];
      						$CName="";
							
								$Cname=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$Cu_id'") or die(mysqli_error($conn));
								$Cnrow=mysqli_fetch_assoc($Cname);
								if($Cnrow){
									$CFName=$Cnrow['first_name'];
									$CLName=$Cnrow['last_name'];
									$CName=$CFName." ".$CLName;
								}
								echo "<div class='commentDisplay'>
		  								<p class='name'>$CName</p>
		  								<p class='time'>$Ccomm_at</p>
      									<p class='comment'>$Ccomm_content</p>	
	  									
									</div>";
						
						}
					echo "</div>";
*/
				echo "</div>";
		}

 ?>
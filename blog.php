<!DOCTYPE html>
<html>
<head>
	<title>WANDER</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

	<div style="padding: 45px; background-color: #f6fbf7;">
<?php 
	include("./inc/connect.inc.php"); 

			$bTitle="";
			$blogId="";
			$bType="";
			$bPicArray="";
			$bAdded="";
			$bContent="";
			$bAddedId="";
			$Cc_id="";


	$btitle=str_ireplace("_", " ", $_REQUEST["title"]);


	$blogquery="SELECT * FROM blog WHERE blog_title='".$btitle."'";
	$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($getblog);
		if($row){
			$bTitle=$row['blog_title'];
			$blogId=$row['blog_id'];
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

			


		
				echo "	<div class='blogAttr'>
							<img src='".$profile_pic."' width='70' />  ".$bName."<br><h2>".$bType."</h2>
							<div class='mdate'>".$bAdded."</div>
							<input type='hidden' id='blogID' value='$blogId'>
							<input type='hidden' id='addedID' value='$bAddedId'>
							
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
								if(count($picarray>=2)){
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

						echo "<p style='font-size:18px; padding:10px 50px;'>".nl2br($s4)."</p>";

						$likeCount=0;

						$likequery=mysqli_query($conn,"SELECT COUNT(user_id) AS userCount FROM liked WHERE content_id='$blogId' AND like_status='0'") or die(mysqli_error($conn));
						$lrow=mysqli_fetch_assoc($likequery);
						$likeCount=$lrow["userCount"];

				echo "<div class='like' id='like'>
						<img src='img/like.png'>
						<div class='likeDetails'>
							<div id='likeDetails' class='likeCount'>
								$likeCount
							</div>
							people like this
						</div>
					</div>";

				echo "<div class='comment' style='padding:50px;'>";
					echo "
						<textarea name='blogComment' id='commentContent' cols='65' rows='10' style='margin-left: 10px;' placeholder='Add Comment'></textarea>
						<input type='submit' name='commSubmit' id='commentSubmit' value='comment' style='position:relative; bottom:11px;'>
						<div id='commentError' style='color:red; padding-left:10px; display:none;'>This field is required</div>
						<br/><br/>
					
					<div id='showComment' style='color:#ob703c; cursor:pointer; font-weight:bold; margin-left10px;'>Show Comment</div>
					<br><br>
						<div id='cc'>";

						$cTemp=0;
						$comm = mysqli_query($conn,"SELECT comm_id,user_id,blog_id,comm_content,comm_at FROM comment ORDER BY comm_at DESC")or die(mysqli_error($conn));
    					while($Crow=mysqli_fetch_array($comm))
  						{
	  						$Cu_id=$Crow['user_id'];
	  						$Cc_id=$Crow['comm_id'];
	  						$Cblog_id=$Crow['blog_id'];
      						$Ccomm_content=$Crow['comm_content'];
      						$Ccomm_at=$Crow['comm_at'];
      						$CName="";
							
							if($Cblog_id==$blogId){
								$Cname=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$Cu_id'") or die(mysqli_error($conn));
								$Cnrow=mysqli_fetch_assoc($Cname);
								if($Cnrow){
									$CFName=$Cnrow['first_name'];
									$CLName=$Cnrow['last_name'];
									$CName=$CFName." ".$CLName;
								}
								$likequery=mysqli_query($conn,"SELECT COUNT(user_id) AS userCount FROM liked WHERE content_id='$Cc_id' AND like_status='1'") or die(mysqli_error($conn));
								$lrow=mysqli_fetch_assoc($likequery);
								$likeCount=$lrow["userCount"];
								echo "<div class='commentDisplay'>
		  								<p class='name'>$CName</p>
		  								<p class='time'>$Ccomm_at</p>
      									<p class='comment'>$Ccomm_content</p>
      									<input type='hidden' id='commentID' value='$Cc_id'>

      									<div class='like' id='likeC' style='top:25px;'>
											<img src='img/like.png' style='height:35px;'>
											<div class='likeDetails' style='left:50px; bottom:50px;'>
												<div id='likeDetailsC' class='likeCount'>
													$likeCount
												</div>
												people like this
											</div>
										</div>	
	  									
									</div>";
								$cTemp=1;
							}

						}
						if($cTemp==0){
							echo "<div id='error'>No Comment to display</div>";
						}
					echo "</div>";

				echo "</div>
				</div>";
		}

 ?>
 	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#commentError").hide();
		$("#cc").hide();

		var blogID=$('#blogID').val();
		var commentID=$('#commentID').val();

		$("#commentSubmit").click(function(){
			var content=$('#commentContent').val();
			

			if(content==""){
				$("#commentError").show();
				$("#commentContent").focus();
			}
			else{
				$("#commentError").hide();
				var dataString="blogID="+blogID+"&content="+content;
				$.ajax({
					type:"POST",
					url:"comment.php",
					data: dataString,
					success: function(result){
						$("#cc").html(
							result+
							$("#cc").html());
						$("#commentContent").val("");
						$("#error").hide();
						alert("Comment Successfully Added");
					}
				});
			}
			return false;
		});

		$("#showComment").click(function(){
			$("#cc").toggle()
			if($("#showComment").text()=="Show Comment")
				$("#showComment").text("Hide Comment");
			else
				$("#showComment").text("Show Comment");
		})

		$("#like").click(function(){
			var dataString="blogId="+blogID;
			$.ajax({
				type:"POST",
				url:"like.php",
				data: dataString,
				success: function(result){
					$("#likeDetails").html(result);
				}
			});
		});

		$("#likeC").click(function(){
			var dataString="commentId="+commentID;
			$.ajax({
				type:"POST",
				url:"likec.php",
				data: dataString,
				success: function(result){
					$("#likeDetailsC").html(result);
				}
			});
		});
	});

	
		
	window.fbAsyncInit = function() {
    	FB.init({
      		appId      : '641670619510586',
      		xfbml      : true,
      		version    : 'v2.6'
    	});
  	};

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

    $('.blogShare').click(function () {
        FB.ui({
            method: 'feed',
            link: "http://localhost:5000/",
            picture: 'http://localhost:5000/src/assets/image.JPG',
            name: "The name who will be displayed on the post",
            description: "The description who will be displayed"
        }, function (response) {
            console.log(response);
        });
    });
	


	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
  		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
  		showSlides(slideIndex = n);
	}

	function showSlides(n) {
  		var i;
  		var slides = document.getElementsByClassName("mySlides");
  		var dots = document.getElementsByClassName("dot");
  		if (n > slides.length) {slideIndex = 1}    
  		if (n < 1) {slideIndex = slides.length}
  		for (i = 0; i < slides.length; i++) {
      		slides[i].style.display = "none";  
  		}
  		for (i = 0; i < dots.length; i++) {
      		dots[i].className = dots[i].className.replace(" active", "");
  		}
  		slides[slideIndex-1].style.display = "block";  
  		dots[slideIndex-1].className += " active";
	}

</script>

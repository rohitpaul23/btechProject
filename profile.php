<?php include("./inc/header.inc.php"); ?>

<?php 
	if(isset($_GET['u'])){
		$puser=mysqli_real_escape_string($conn,$_GET['u']);
		if(ctype_alnum($puser)){
			//check user exists
			$check= mysqli_query($conn,"SELECT u_id,username,first_name,last_name FROM users WHERE username='$puser'")or die("Something wrong");
			if(mysqli_num_rows($check)==1){
				$get=mysqli_fetch_assoc($check);
				$p_id=$get['u_id'];
				$puser=$get['username'];
			}
			else
			{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/series/Project17/index.php\">";
				exit();
			}

		}
	}

	$d = date("Y-m-d h:i:sa");
	$pfollow="Follow";
	$followQuery=mysqli_query($conn,"SELECT following_ID FROM follow WHERE follower_id='$u_id'")or die(mysqli_error($conn));
				
	while($followQueryRow=mysqli_fetch_assoc($followQuery)){
		if($followQueryRow["following_ID"]=="$p_id")
			$pfollow="Unfollow";	
	}	

	if(isset($_POST["followbtn"])){
		if($pfollow=="Follow"){
			$follow_Query=mysqli_query($conn,"INSERT INTO follow VALUES('','$u_id','$p_id','0','$d') ")or die(mysqli_error($conn));
			$pfollow="Unfollow";
		}
		else{
			$follow_Query="DELETE FROM follow WHERE follower_ID='$u_id' AND following_ID='$p_id'";
			mysqli_query($conn,$follow_Query);
			
			$pfollow="Follow";
		}
		
	}
 

	echo '<div class="contentWrap">
		 	<div class="profileDetail">';
		
			$profile_pic="img/default_pic.jpg";
			$getUserQuery=mysqli_query($conn,"SELECT first_name,last_name,email FROM users WHERE u_id=$p_id")or die(mysqli_error($conn));
			$getUser=mysqli_fetch_assoc($getUserQuery);
			$firstName=$getUser["first_name"];
			$lastName=$getUser["last_name"];
			$email=$getUser["email"];
			$myname=$firstName." ".$lastName;

			$getUserDetailsQuery=mysqli_query($conn,"SELECT profile_pic,bio FROM usersdetails WHERE user_id=$p_id")or die(mysqli_error($conn));
			$getUserDetails=mysqli_fetch_assoc($getUserDetailsQuery);
			if($getUserDetails){
				if($getUserDetails['profile_pic']){
					$profilePic=$getUserDetails['profile_pic'];
					$profile_pic="userdata/profile_pics/".$profilePic;
				}
				$bio=$getUserDetails['bio'];
			}else{
				$profile_pic="img/default_pic.jpg";
				$bio="My Bio";
			}

						
						
					
			echo "<img src='".$profile_pic."' width='70' />
					<div class='profileDec'>
						<h2>".$myname."</h2>
						<h3 style='background-color:#e4f9e5;'>".$email."</h3>
						".$bio."
					</div>";

			if($u_id!=$p_id){	
				echo "<div class='follow' style='margin:20px 0px 0px 85px;'>
						<form action='' method='post'>
							<input onclick='myfunction()' type='submit' name='followbtn' id='mySubmit' value='".$pfollow."'>
						</form>
					</div>";
			}

			$followerQuery=mysqli_query($conn,"SELECT COUNT(follower_ID) AS 'followerCount' FROM follow WHERE following_ID='$p_id'")or die(mysqli_error($conn));
			$followingQuery=mysqli_query($conn,"SELECT COUNT(following_ID) AS 'followingCount' FROM follow WHERE follower_ID='$p_id'")or die(mysqli_error($conn));

			$followerRow=mysqli_fetch_assoc($followerQuery);
			$followerCount=$followerRow["followerCount"];
			$followingRow=mysqli_fetch_assoc($followingQuery);
			$followingCount=$followingRow["followingCount"];

			echo "<div class='followNo'>
					<div onclick='follow(".$p_id.",0)' style='cursor:pointer;'>Follower:".$followerCount."</div>
					<div onclick='follow(".$p_id.",1)' style='cursor:pointer;'>Following:".$followingCount."</div>
				</div>";
		 ?>
	</div>
	<div class="followDetail" id="fd">
		<div class="followContent">
			<span class='closeDisplay' onclick='closeFollow()'>&times;</span>
			<div id="fdc"></div>

	</div>
	</div>


	<div class="mainContent" id="mc">

		<?php
			$temp=0;
			$j=1;
			$blogquery="SELECT * FROM blog WHERE added_id='$u_id' ORDER BY blog_id DESC LIMIT 5";
			$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
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
						
		
		

			echo "<div class='blogDisplayModal' id='blogDisplayModal'>
					<div class='blogDisplayModalContent'>
					
					<span class='closeDisplay' onclick='closeFunc()'>&times;</span>";
			if ($temp==1) {
						echo "
								<div class='blogBody' id='bd'></div>
							</div>
						</div>
						<button class='next' onclick='loadDoc(5)'>&#10095;</button>
					</div>";
			}
			else{
				echo "
					</div>
					</div>
				<div style='padding:50px 325px;'>You Have not blogged Yet!!
					<br>
					Start Blogging <a href='main.php' style='text-decoration:none;'>now</a>
				</div>";
			}			
			
		?>




</div>



<script type="text/javascript">

	var i=0;

	function myfunction(){
		if(document.getElementById("mySubmit").value=="Follow"){
			document.getElementById("mySubmit").value="Unfollow";
		}else{
			document.getElementById("mySubmit").value="Follow";
		}
	}



	var bdmodal = document.getElementById('blogDisplayModal');
	function closeFunc(){
    	bdmodal.style.display = "none";
	}




	function blogDisplay(bid){
		xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
      			document.getElementById("bd").innerHTML = this.responseText;
      			bdmodal.style.display = "block";
      			$("#mc").removeClass("mainContent");
    		}
  		};
  		xhttp.open("GET","displayBlog.php?q="+bid,true);
  		xhttp.send();
  	}

  	$("#mc").on("click",".accord",function(){
		$('#blogDisplayModal').show();
		$("#mc").removeClass("mainContent");
	})

	$("#mc").on("click",".closeDisplay",function(){
		$('#blogDisplayModal').hide();
		$("#mc").addClass("mainContent");
	})

  	var fmodal = document.getElementById('fd');
	function closeFollow(){
    	fmodal.style.display = "none";
	}

  	function follow(id,n){
  		xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
      			document.getElementById("fdc").innerHTML = this.responseText;
      			fmodal.style.display="block";
    		}
  		};
		xhttp.open("GET","displayFollow.php?q="+id+"&n="+n,true);
  		xhttp.send();
	}
	//slideshow
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

	function loadDoc(id){
		if (id%5!=0) {
			alert("No more element");
			return;
		}
		xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
      			var x=++i;
    			var idval="mc"+x;
    			var newElement=$("<div id='"+idval+"' class='mainContent'></div>").html(this.responseText);
    			$(".contentWrap").append(newElement);
      			//document.getElementById("mc").innerHTML = this.responseText;
    		}
  		};
  		xhttp.open("GET", "getblog.php?q="+id+"&p="+1, true);
  		xhttp.send();
		
	}

	function backDoc(){
		var id="#mc"+(i--);
		$(id).remove();
	}

</script>
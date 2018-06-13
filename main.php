<?php include("./inc/header.inc.php"); ?>

<?php 
$bgId="";

if(isset($_POST['blog_submit'])){
	$blog_submit= $_POST['blog_submit'];
	if ($blog_submit) {
		$blogAdded = date("Y-m-d h:i:sa");
		$addedId = $u_id;
		$blogTitle=$_POST['blog_title'];
		$blogType=$_POST['blog_type'];
		$blogContent=mysql_real_escape_string($_POST['blog_content']);
		$blogPicArray="";
		$i=0;
		$temp=1;
		$files[]="";

			
		if ((count($_FILES['blog_image']['error'][0])!=0)&&($_FILES['blog_image']['error'][0]!=4)){

			$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$rand_dir_name=substr(str_shuffle($chars),0,15);
			mkdir("userdata/blog_pics/$rand_dir_name");
			$target_dir="userdata/blog_pics/$rand_dir_name/";

			for($i=0;$i<count($_FILES['blog_image']['name']);$i++){
				$tmpFilePath=$_FILES['blog_image']['tmp_name'][$i];

				$target_file = $target_dir . basename($_FILES["blog_image"]["name"][$i]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    			
    			if ($_FILES["blog_image"]["size"][$i] > 2000000 || $_FILES["blog_image"]["size"][$i] == 0) {
    				echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span>Sorry, your file is too large.</div>'"; 
    					$temp=0;
				}
				else{
					if(getimagesize($_FILES["blog_image"]["tmp_name"][$i]) != false) {
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    						echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>'"; 
    						$temp=0;
						}
						else{
							if (move_uploaded_file($tmpFilePath, $target_file)) {
								$files[]=$_FILES['blog_image']['name'][$i];
								$temp=1;
        						

    						} else {
        						echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span>Sorry, there was an error uploading your file.</div>'";
        						$temp=0;
    						}
						}
					}
    				 else {
    					echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span>File is not an image.</div>'"; 
    					$temp=0;
    				}
				}
			}
    		if(is_array($files)){
        		foreach($files as $file){
        			if($file!=""){
    	    			$full=$rand_dir_name."/".$file.",";
						$blogPicArray=$blogPicArray.$full;
        			}
        		}
    		}
    		/*echo $blogPicArray."<br>";
    		
    		$array=explode(",", $blogPicArray,-1);
    		print_r($array);
    		count($array);*/
		}
		if($temp==1){	
			$blogCommand = "INSERT INTO blog VALUES('','$blogTitle','$blogType','$blogPicArray','$blogAdded','$blogContent','$addedId','0')";  
			$blogquery=mysqli_query($conn,$blogCommand)or die(mysqli_error($conn));
			echo "<script>window.alert('Successfully posted')</script>";
		}
		
	}
}



 ?>

<div class="contentWrap">
	<div class="publishBlog">
		<img src="./img/slogan.png"><br>
		<button id="blogBtn">Create a Blog</button>
	</div>
	<div id="blogModal" class="blogModal">
		<div class="blogModalContent">
			<span class="close">&times;</span>
			<form action="main.php" enctype="multipart/form-data" method="POST">
				<h3>Create a blog</h3>
				<input type="text" name="blog_title" size="50" id="blogTitle" placeholder="Blog Title" style="margin-left: 10px; width: 530px; padding: 6px;"><br/><br/>
				<select name="blog_type" id="blogType" style="margin-left: 10px; width: 530px; padding: 6px;">
					<option value="Personal">Personal</option>
					<option value="Cooking">Cooking</option>
					<option value="Travel">Travel</option>
					<option value="Fashion">Fashion</option>
					<option value="Sports">Sports</option>
					<option value="Cars">Cars</option>
					<option value="Culture">Culture</option>
					<option value="Education">Education</option>
					<option value="Environment">Environment</option>
					<option value="Life Experience">Life Experience</option>	
				</select><br/><br/>
				<input type="file" name="blog_image[]" id="blogImage" style="margin-left: 10px;" multiple="multiple"><br/><br/>
				<div class="tooltip">?
  					<span class="tooltiptext">*Use [[[b]]] and [[[/b]]] tag to bold text <br> *Use [[[img]]] and [[[/img]]] tag to display image anywhere between text</span>
				</div>
				<textarea name="blog_content" id="blogContent" cols="65" rows="15" style="margin-left: 10px;"></textarea><br/><br/>
				<input type="submit" name="blog_submit" value="Submit">
				
			</form>
		</div>
	</div>
	<div class="mainContent" id="mc">

		
		

		<?php
			$j=1;
			$blogquery="SELECT * FROM blog WHERE EXISTS(SELECT following_ID FROM follow WHERE (follower_ID=blog.added_id OR follower_ID='$u_id') AND (following_ID='$u_id' OR following_ID=blog.added_id))OR added_id='$u_id' OR EXISTS(SELECT user_id FROM usersdetails WHERE anonymous='0') ORDER BY blog_id DESC LIMIT 5";
			$getblog=mysqli_query($conn,$blogquery) or die(mysqli_error($conn));
				while($row=mysqli_fetch_assoc($getblog)){
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
				echo "<div class='blogBody' id='bd'></div><br><br>";
			
			echo "</div>
				</div>
				<button class='next' onclick='loadDoc(5)'>&#10095;</button>
				<div class='loader' id='wait' style='display: none;'></div>
			</div>
			";
		?>

	
</div>
<script>


</script>
<script type="text/javascript">
	var i=0;

	var bmodal = document.getElementById('blogModal');
	var bbtn = document.getElementById("blogBtn");
	var span = document.getElementsByClassName("close")[0];
	bbtn.onclick = function() {
    	bmodal.style.display = "block";
    	$("#mc").removeClass("mainContent");
	}
	span.onclick = function() {
    	bmodal.style.display = "none";
    	$("#mc").addClass("mainContent");
	}
	window.onclick = function(event) {
    	if (event.target == bmodal) {
        	bmodal.style.display = "none";
    	}
	}

/*
	$(document).ready(function(){
		$("form").submit(function(){
			var content=$('#commentContent').val();
			var blogID=$('#blogID').val();

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
	});
*/


	var bdmodal = document.getElementById('blogDisplayModal');
	function closeFunc(){
    	bdmodal.style.display = "none";
	}


	function blogDisplay(bid){
		xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			$("#wait").css("display", "none");
      			document.getElementById("bd").innerHTML = this.responseText;
      			bdmodal.style.display = "block";
      			$("#mc").removeClass("mainContent");
    		}else if((this.readyState==1)||(this.readyState==2)||(this.readyState==3)){
    			$("#wait").css("display", "block");
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
    			$("#wait").css("display", "none");
    			var x=++i;
    			var idval="mc"+x;
    			if(this.responseText==""){
    				alert("No more Blog");
    				return;
    			}
    			var newElement=$("<div id='"+idval+"' class='mainContent'></div>").html(this.responseText);
    			$(".contentWrap").append(newElement);
      			//document.getElementById("mc").innerHTML = this.responseText;
    		}else if((this.readyState==1)||(this.readyState==2)||(this.readyState==3)){
    			$("#wait").css("display", "block");
    		}
  		};
  		xhttp.open("GET", "getblog.php?q="+id+"&p="+2, true);
  		xhttp.send();
		
		/*$(document).ajaxStart(xhttp,function(){
        	$("#wait").css("display", "block");
    	});
    	$(document).ajaxComplete(xhttp,function(){
        	$("#wait").css("display", "none");
    	});*/
	}

	function backDoc(){
		var id="#mc"+(i--);
		$(id).remove();
	}

	function showComment(){
		var cc=document.getElementById("cc");
		cc.style.display="block";

	}




</script>
</body>
</html>
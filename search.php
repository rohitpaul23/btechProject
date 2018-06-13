<?php include("./inc/header.inc.php"); ?>

<div class="contentWrap">
	<?php 
		$fName="";
		$ftemp=0;
		$searched=$_REQUEST["q"];
		
		if(substr($searched,0,1)=='@'){
			$searched=str_ireplace("@", "", $searched);
			
			echo "<div class='tab'>
  					<button class='tablinks' onclick=\"openCity(event, 'London')\">Blog</button>
  					<button class='tablinks' onclick=\"openCity(event, 'Paris')\" >Profile</button>
  					<button class='tablinks' onclick=\"openCity(event, 'Newyork')\" id='defaultOpen'>Type</button>
				</div>";
		}else{
			echo "<h2>Your search result for \"$searched\"</h2>";
			echo "<div class='tab'>
  					<button class='tablinks' onclick=\"openCity(event, 'London')\">Blog</button>
  					<button class='tablinks' onclick=\"openCity(event, 'Paris')\" id='defaultOpen'>Profile</button>
  					<button class='tablinks' onclick=\"openCity(event, 'Newyork')\">Type</button>
				</div>";
		}

		
	echo "
		<div id='London' class='tabcontent'>
  			<p>";
			
			$blogQuery=mysqli_query($conn,"SELECT * FROM blog")or die(mysqli_error($conn));
			while($brow=mysqli_fetch_assoc($blogQuery)){
				$fblogId=$brow["blog_id"];
				$fblogTitle=$brow["blog_title"];
				$fblogType=$brow["blog_type"];
				$fblogAdded=$brow["blog_added"];
				$userID=$brow["added_id"];

				$followUserQuery=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$userID'")or die(mysqli_error($conn));
				if($urow=mysqli_fetch_assoc($followUserQuery)){
					$fFirstName=$urow["first_name"];
					$fLastName=$urow["last_name"];
					$fName=$fFirstName." ".$fLastName;
				}


				$blogTitleArray=explode(" ",$fblogTitle);
				/*print_r($blogTitleArray);*/
				if(is_array($blogTitleArray)){
        			foreach($blogTitleArray as $blogTitleWord){
        				if($blogTitleWord==$searched){
        					$ftemp=1;
    	    				echo "<button class='accord' onclick='blogDisplay(".$fblogId.")'>
								<div style='font-size:15px;'>".
									$fName."-".$fblogType."-".$fblogAdded."
								</div>";
							foreach ($blogTitleArray as $word) {
								if ($word==$searched) {
									echo "<span class='searchWord' style='color:#b50d0d;'>$word </span>";
								}
								else
									echo $word." ";
								}
							echo "</button>";
							break;
        				}
        			}
    			}
			}
		
		if($ftemp==0){
			echo "<h3>No Result Found</h3>";
		}
		
		
  			echo "</p>
		</div>

		<div id='Paris' class='tabcontent'>
  			<p>";
  			$utemp=0;
  			if ($searched!="") {
  				$searched=strtolower($searched);
  				$usearched=str_ireplace(" ", "_", $searched);
  				$len=strlen($usearched);

  				$userQuery=mysqli_query($conn,"SELECT u_id,first_name,last_name,username FROM users")or die(mysqli_error($conn));  	
  				while($urow=mysqli_fetch_assoc($userQuery)){
  					$uFirstName=$urow["first_name"];
  					$uLastName=$urow["last_name"];
  					$uUserName=$urow["username"];
  					$uUserID=$urow["u_id"];
  					$uName=$uFirstName."_".$uLastName;

  					if($user!=$uUserName){
  						$followerQuery=mysqli_query($conn,"SELECT COUNT(follower_ID) AS 'followerCount' FROM follow WHERE following_ID='$uUserID'")or die(mysqli_error($conn));
						$followingQuery=mysqli_query($conn,"SELECT COUNT(following_ID) AS 'followingCount' FROM follow WHERE follower_ID='$uUserID'")or die(mysqli_error($conn));

						$followerRow=mysqli_fetch_assoc($followerQuery);
						$followerCount=$followerRow["followerCount"];
						$followingRow=mysqli_fetch_assoc($followingQuery);
						$followingCount=$followingRow["followingCount"];

						if (stristr($usearched, substr($uName, 0,$len))) {
  							echo "<button class='accord'><a href='".$uUserName."' style='color:#00562a; text-decoration:none'>".$uFirstName." ".$uLastName." <div class='searchfollow'>Follower:$followerCount  Following:$followingCount </div></a></button>";
  							$utemp=1;
  						}
  					}
  				}
  				
  			}

  			if ($utemp==0) {
  				echo "<h3>No Result Found</h3>";
  			}
  				
  			echo "</p> 
		</div>
		<div id='Newyork' class='tabcontent'>
			<div class='dropdown'>
				<select name='blog_type' id='blogType' style='margin-left: 10px; width: 530px; padding: 6px;'>
					<option value='Personal'>Personal</option>
					<option value='Cooking'>Cooking</option>
					<option value='Travel'>Travel</option>
					<option value='Fashion'>Fashion</option>
					<option value='Sports'>Sports</option>
					<option value='Cars'>Cars</option>
					<option value='Culture'>Culture</option>
					<option value='Education'>Education</option>
					<option value='Environment'>Environment</option>
					<option value='Life Experience'>Life Experience</option>	
				</select>
				<input type='submit' id='submit' value='Search'>
			</div>
			<div id='cc'>
			";

			$ttemp=0;
			$blogTypeQuery=mysqli_query($conn,"SELECT * FROM blog WHERE blog_type='$searched'")or die(mysqli_error($conn));
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
		echo "</div>
		</div>
	</div>";
		echo "<div class='blogDisplayModal' id='blogDisplayModal'>
					<div class='blogDisplayModalContent'>
						<span class='closeDisplay' onclick='closeFunc()'>&times;</span>";
			echo "
					<div class='blogBody' id='bd' style='padding-bottom:100px;'></div>
					</div>
				</div>";

		
?>
	 ?>

</div>
<script type="text/javascript">


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
    		}
  		};
  		xhttp.open("GET","displayBlog.php?q="+bid,true);
  		xhttp.send();
	}
	function openCity(evt, cityName) {
    	var i, tabcontent, tablinks;
    	tabcontent = document.getElementsByClassName("tabcontent");
    	for (i = 0; i < tabcontent.length; i++) {
        	tabcontent[i].style.display = "none";
    	}
    	tablinks = document.getElementsByClassName("tablinks");
    	for (i = 0; i < tablinks.length; i++) {
        	tablinks[i].className = tablinks[i].className.replace(" active", "");
    	}
    	document.getElementById(cityName).style.display = "block";
    	event.currentTarget.className += " active";
	}
	document.getElementById("defaultOpen").click();

	$(document).ready(function(){
		
	})

	$("#submit").click(function(){
		var blogType=$("#blogType").val();
		var dataString="blogType="+blogType;
				$.ajax({
					type:"POST",
					url:"blogType.php",
					data: dataString,
					success: function(result){
						$("#blogType").val(blogType);
						$("#cc").html(result);
					}
				});
	})

	/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */

</script>
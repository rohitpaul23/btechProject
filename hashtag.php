<?php include("./inc/header.inc.php"); ?>

<div class="contentWrap">
<?php
	$searched=$_REQUEST["q"];

	echo "<h2>Your search result for \"#$searched\"</h2>";

	$blogQuery=mysqli_query($conn,"SELECT * FROM blog")or die(mysqli_error($conn));
			while($brow=mysqli_fetch_assoc($blogQuery)){
				$fblogId=$brow["blog_id"];
				$fblogTitle=$brow["blog_title"];
				$fblogType=$brow["blog_type"];
				$fblogAdded=$brow["blog_added"];
				$fblogContent=$brow["blog_content"];
				$fblogUId=$brow["added_id"];

				$followUserQuery=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$fblogUId'")or die(mysqli_error($conn));
			    if($urow=mysqli_fetch_assoc($followUserQuery)){
				    $fFirstName=$urow["first_name"];
				    $fLastName=$urow["last_name"];
				    $fName=$fFirstName." ".$fLastName;
			    }

				if(strstr($fblogContent,"#".$searched)!=FALSE){
    	    		echo "<button class='accord' onclick='blogDisplay(".$fblogId.")'>
								<div style='font-size:15px;'>".
									$fName."-".$fblogType."-".$fblogAdded."
								</div>";
								echo $fblogTitle;
							echo "</button>";
    			}
			}
					echo "<div class='blogDisplayModal' id='blogDisplayModal'>
					<div class='blogDisplayModalContent'>
						<span class='closeDisplay' onclick='closeFunc()'>&times;</span>";
					echo "
							<div class='blogBody' id='bd'></div>
							</div>
							</div>";

?>

</div>
<script type="text/javascript">
	function loadDoc(id){
		if (id%5!=0) {
			alert("No more element");
			return;
		}
		xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
      			document.getElementById("mc").innerHTML = this.responseText;
    		}
  		};
  		xhttp.open("GET", "getblog.php?q="+id, true);
  		xhttp.send();
		
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
    		}
  		};
  		xhttp.open("GET","displayBlog.php?q="+bid,true);
  		xhttp.send();
	}
</script>
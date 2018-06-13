<?php

include("./inc/connect.inc.php");
	session_start();

	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}


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
			$blogCommand = "INSERT INTO blog VALUES('','$blogTitle','$blogType','$blogPicArray','$blogAdded','$blogContent','$addedId','0')";  $blogquery=mysqli_query($conn,$blogCommand)or die(mysqli_error($conn));
			echo "<script>window.alert('Successfully posted')</script>";
		}
		
	}
}



?>
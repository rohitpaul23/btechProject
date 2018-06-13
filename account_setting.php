<?php
	include("/inc/header.inc.php");
	if($user){

	}	
	else
	{
		die("You must be logged in");
	}

?>
<?php 
	$old_password=$new_password=$repeat_password="";
	$senddata=$db_firstname=$db_lastname="";

		$get_info=mysqli_query($conn,"SELECT DOB, address, bio FROM usersdetails WHERE user_id='$u_id'")or die(mysqli_error($conn));
		$get_row=mysqli_fetch_assoc($get_info);
		$db_dob=$get_row['DOB'];
		$db_addr=$get_row['address'];
		$db_bio=$get_row['bio'];
		$get_infoo=mysqli_query($conn,"SELECT first_name,last_name FROM users WHERE u_id='$u_id'")or die(mysqli_error($conn));
		if($get_roww=mysqli_fetch_assoc($get_infoo)){
			$db_firstname=$get_roww['first_name'];
			$db_lastname=$get_roww['last_name'];
		}

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	
	$c_query=mysqli_query($conn,"SELECT user_id FROM usersdetails WHERE user_id='$u_id'");
	$p_check=mysqli_num_rows($c_query);
	if(!$p_check){
		$query = mysqli_query($conn,"INSERT INTO usersdetails VALUES ('$u_id','','','','','0')")or die("<h2>Something Wrong in query</h2>");
	}



	/*privacy*/


	$private="";
	$public="";
	$privacy_query=mysqli_query($conn,"SELECT anonymous FROM usersdetails WHERE user_id='$u_id'");
	$anony_row=mysqli_fetch_assoc($privacy_query);
	$anony=$anony_row['anonymous'];
	if ($anony==0) {
		$public="Checked";
	}
	else{
		$private="Checked";
	}
	if(isset($_POST["privacySubmit"])){
    	$submit=$_POST["privacySubmit"];
        if($submit){
        	$privacy=$_POST["privacy"];
            $anony_query=mysqli_query($conn,"UPDATE usersdetails SET anonymous='$privacy' WHERE user_id='$u_id'")or die("Database Error");      
        }
        else{
        	echo "Something Wrong";
        }
   }



   /*profile picture*/

	//check whether the user has uploaded a profile pic
	$profile_pic_db="";
	$check_pic=mysqli_query($conn,"SELECT profile_pic FROM usersdetails WHERE user_id='$u_id'");
	$get_pic_row=mysqli_fetch_assoc($check_pic);
	$profile_pic_db=$get_pic_row['profile_pic'];
	if ($profile_pic_db=="") {
		$profile_pic="img/default_pic.jpg";
	}
	else{
		$profile_pic="userdata/profile_pics/".$profile_pic_db;
	}

	//profile image
	if (isset($_FILES['profilepic'])) {
		if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif")) && (@$_FILES["profilepic"]["size"]<1048576))//1mb
		{
			
				if ($profile_pic_db) {
					$subs=substr($profile_pic_db,15);
					$profile_db=str_ireplace($subs," ",$profile_pic_db);

					move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$profile_db/".$_FILES["profilepic"]["name"]);

					$profile_pic_name=@$_FILES["profilepic"]["name"];
					$profile_pic_query=mysqli_query($conn,"UPDATE usersdetails SET profile_pic='$profile_db/$profile_pic_name' WHERE user_id='$u_id'")or die("Something Wrong in image upload");
				header("Location: account_setting.php");
				}
				else{
					$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					$rand_dir_name=substr(str_shuffle($chars),0,15);
					mkdir("userdata/profile_pics/$rand_dir_name");

					if(file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
						echo @$_FILES["profilepic"]["name"]."Already exists";
					}
					else{	
						move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);

						$profile_pic_name=@$_FILES["profilepic"]["name"];
						$profile_pic_query=mysqli_query($conn,"UPDATE usersdetails SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE user_id='$u_id'")or die("Something Wrong in image upload");
						header("Location: account_setting.php");
					}
				}
		}
		else{
			echo "Invalid File";
		}
	}


	/*Bio*/


	if (isset($_POST['uploadbio'])) {
		$uploadbio=@$_POST['uploadbio'];

		if ($uploadbio) {
			$bio=test_input(@$_POST['aboutyou']);
			$updatebio_query=mysqli_query($conn,"UPDATE usersdetails SET bio='$bio' WHERE user_id='$u_id'")or die(mysqli_error($conn));
			$message="Your Profile Information updated";
			echo "<script type='type/javascript'>window.alert('$message');</script>";

		}
		else{
			$message="Error";
			echo "<script type='type/javascript'>alert('$message');</script>";
		}
	}



	/*address*/

	if (isset($_POST['uploadaddr'])) {
		$uploadaddr=@$_POST['uploadaddr'];

		if ($uploadaddr) {
			$addr=test_input(@$_POST['addr']);
			$updateaddr_query=mysqli_query($conn,"UPDATE usersdetails SET address='$addr' WHERE user_id='$u_id'")or die(mysqli_error($conn));
			$message="Your Profile Information updated";
			echo "<script type='type/javascript'>window.alert('$message');</script>";

		}
		else{
			$message="Error";
			echo "<script type='type/javascript'>alert('$message');</script>";
		}
	}



	/*Date of Birth*/

	if (isset($_POST['uploaddob'])) {
		$uploaddob=@$_POST['uploaddob'];

		if ($uploaddob) {
			$dob=test_input(@$_POST['dob']);
			$updatedob_query=mysqli_query($conn,"UPDATE usersdetails SET dob='$dob' WHERE user_id='$u_id'")or die(mysqli_error($conn));
			$message="Your Profile Information updated";
			echo "<script type='type/javascript'>window.alert('$message');</script>";

		}
		else{
			$message="Error";
			echo "<script type='type/javascript'>alert('$message');</script>";
		}
	}


	/*password*/

	if (isset($_POST['senddata'])) {

		$senddata=$_POST['senddata'];
		$old_password=test_input($_POST['oldpassword']);
		$new_password=test_input($_POST['newpassword']);
		$repeat_password=test_input($_POST['newpassword2']);
		if($senddata){
		
			$password_query= mysqli_query($conn,"SELECT * FROM users WHERE username='$user'");
			while ($row=mysqli_fetch_assoc($password_query)) {
			$db_password=$row['password'];

			$old_password_md5=md5($old_password);
			
				if ($old_password_md5==$db_password) {
					if ($new_password==$repeat_password) {
						$new_password=md5($new_password);
						$password_update_query=mysqli_query($conn,"UPDATE users SET password='$new_password' WHERE username='$user'");
						$message="Success your password updated";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
					$message="New Password and Repeat Password does not match";
					echo "<script type='type/javascript'>window.alert('$message');</script>";
					}
				}
				else
				{
					$message="Old Password is incorrect";
					echo "<script type='type/javascript'>window.alert('$message');</script>";
				}
			}
		}
	
	}



	/*Name*/

	if (isset($_POST['updatedata'])) {
		$updatedata=@$_POST['updatedata'];

		if ($updatedata) {
			$firstname=test_input(@$_POST['fname']);
			$lastname=test_input(@$_POST['lname']);
			$updatedata_query=mysqli_query($conn,"UPDATE usersdetails SET first_name='$firstname', last_name='$lastname' WHERE username='$user'")or die(mysqli_error($conn));
			$message="Your Profile Information updated";
			echo "<script type='type/javascript'>window.alert('$message');</script>";

		}
		else{
			$message="Error";
			echo "<script type='type/javascript'>alert('$message');</script>";
		}
	}
 ?>

<div class="contentWrap">
	<h2>Edit your setting!!</h2>
	<button class="accordion">Privacy: Who can see your post</button>
	<div class="panel">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  			<input type="radio" name="privacy" style="margin: 10px;" value=0 <?php echo $public; ?>> Public: Allow Anonymous Questions <br>
  			<input type="radio" name="privacy" style="margin: 10px;" value=1 <?php echo $private; ?>> Private<br>
  			<input type="submit" name="privacySubmit">
		</form>
	</div>

	<button class="accordion">Update your Profile</button>
	<div class="panel">
		<p>Upload your Profile Photo</p>
		<form action="" method="POST" enctype="multipart/form-data">
			<img src="<?php echo $profile_pic; ?>" width="70" />
			<input type="file" name="profilepic" />
			<input type="submit" name="uploadpic" value="Upload Image"></br>
			<hr>
			About You: <textarea name="aboutyou" id="aboutyou" cols="40" rows="8" placeholder="<?php echo $db_bio;?>"></textarea>
			<input type="submit" name="uploadbio" value="Submit"></br>
			<hr>
			City currently in:<input type="text" name="addr" value="<?php echo $db_addr; ?>">
			<input type="submit" name="uploadaddr" value="Submit">
			<hr>
			Date of Birth:<input type="date" name="dob" value="<?php echo $db_dob; ?>">
			<input type="submit" name="uploaddob" value="Submit">
		</form>
	</div>

	<button class="accordion">Security</button>
	<div class="panel">
		<p>Change Your Password</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			Your Old Password: <input type="text" name="oldpassword" id="oldpassword" size="30"><br/>
			Your New Password: <input type="text" name="newpassword" id="newpassword" size="30"><br/>
			Repeat Password  : <input type="text" name="newpassword2" id="newpassword2" size="30"><br/>
			<input type="submit" name="senddata" id="senddata" value="Update Information">
		</form>
	</div>
	<button class="accordion">Edit your Name</button>
	<div class="panel">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			First Name:<input type="text" name="fname" id="fname" size="40" value="<?php echo $db_firstname;?>"><br/>
			Last Name:<input type="text" name="lname" id="lname" size="40" value="<?php echo $db_lastname;?>"><br/>
			<input type="submit" name="updatedata" id="updatedata" value="Update Information">
		</form>
	</div>
</div>


<script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>

</body>
</html>
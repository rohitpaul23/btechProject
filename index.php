<?php include("./inc/header.inc.php"); ?>


<?php
if (!isset($_SESSION["user_login"])) {
}
else
{
	echo "<meta http-equiv=\"refresh\" content=\"0; url=main.php\">";	
}
//SIGN UP

$reg = @$_POST['reg'];
//declaring variables to prevent errors
$fn = ""; //First Name
$ln = ""; //Last Name
$un = ""; //Username
$em = ""; //Email
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$d = ""; // Sign up Date
$u_check = ""; // Check if username exists
//registration form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['uname']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d h:i:sa"); // Year - Month - Day'


$sign_err="";

if ($reg) {

	// Check if user already exists
	$u_check=mysqli_query($conn,"SELECT username FROM users WHERE username='$un'") or die(mysqli_error($conn));
	// Count the amount of rows where username = $un
	$check=mysqli_num_rows($u_check);
	//mysqli_free_result($u_check);
	//Check whether Email already exists in the database
	$e_check=mysqli_query($conn,"SELECT email FROM users WHERE email='$em'")or die(mysqli_error($conn));
	//Count the number of rows returne1d
	$email_check=mysqli_num_rows($e_check);
	//mysqli_free_result($e_check);

	if ($check == 0) {
		if ($email_check == 0) {
			//check all of the fields have been filed in
			if ($fn&&$ln&&$un&&$em&&$pswd&&$pswd2) {
				// check that passwords match
				if ($pswd==$pswd2) {
					// check the maximum length of username/first name/last name does not exceed 25 characters
					if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
						$sign_err= "The maximum limit for username/first name/last name is 25 characters!";
					}
					else
					{
						// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
						if (strlen($pswd)>30||strlen($pswd)<5) {
							$sign_err= "Your password must be between 5 and 30 characters long!";
						}
						else
						{
							//encrypt password and password 2 using md5 before sending to database
							$pswd = md5($pswd);
							$pswd2 = md5($pswd2);
							$query = mysqli_query($conn,"INSERT INTO users VALUES ('','$un','$fn','$ln','$em','$pswd','$d','0')")or die("<h2>Something Wrong</h2>");
							echo "<div class='success'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span><strong>Success!</strong> Account has been created</div>'";
							
						}
					}
				}
				else 
				{
					$sign_err= "Your passwords don't match!";
				}
			}
			else
			{
				$sign_err="Please fill in all of the fields";
			}
		}
		else
		{
			$sign_err= "Sorry, but it looks like someone has already used that email!";
		}
	}
	else
	{
		$sign_err= "Username already taken ...";
	}
	
	
	
}
?>



<?php

//LOGIN

$login_err="";
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	$user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["user_login"]); // filter everything but numbers and letters
 
    $password_login_md5 = md5(strip_tags($_POST["password_login"]));

    $sql = mysqli_query($conn,"SELECT u_id FROM users WHERE username='$user_login' AND password='$password_login_md5'")or die("<h2>Something Wrong in login</h2>"); // query the person

	//Check for their existance
	$userCount = mysqli_num_rows($sql); //Count the number of rows returned
	if ($userCount == 1) {
		while($row = mysqli_fetch_array($sql)){ 
			$u_id = $row["u_id"];
		}
		$_SESSION["u_id"] = $u_id;
		$_SESSION["user_login"] = $user_login;
		$_SESSION["password_login"] = $password_login;
		header("location: main.php");
		exit("<meta http-equiv=\"refresh\" content=\"0\">");
	} else {
		echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span>That information is incorrect, try again</div>'";
	}
}
?>


<div class="contentWrap">
	

	<div class="loginWrap">
				<h2 style="padding-bottom: 20px;">Get Started with Wander</h2>
					<form action="#" method="POST" style="background-color: #fdfffd;">
					 <input type="text" name="fname" size="25" placeholder="First Name"><br/><br/>
					 <input type="text" name="lname" size="25" placeholder="Last Name"><br/><br/>
					 <input type="text" name="uname" size="25" placeholder="User Name"><br/><br/>
					 <input type="text" name="email" size="25" placeholder="EMail"><br/><br/>
					 <input type="password" name="password" size="25" placeholder="Password"><br/><br/>
					 <input type="password" name="password2" size="25" placeholder="Confirm Password"><br/><br/>
					 <input type="submit" name="reg" value="Sign Up!">	
					 <div id="error"><?php echo $sign_err; ?></div>
				</form>
				<div style="float:left;">
					<h3>Already a Member?</h3>
				</div>
				<button id="myBtn" class="button">Log In</button>	
				<div id="myModal" class="signupModal">
  					<div class="signupContent">
    					<span class="close">&times;</span>
    					
    					
						<form action="index.php" method="POST" style="padding-left: 75px;">
							<h3>Log In</h3>
							<input type="text" name="user_login" size="25" placeholder="Username"><br/><br/>
							<input type="password" name="password_login" size="25" placeholder="Password"><br/><br/>
							<input type="submit" name="login" value="Login">
						</form>
    					 
  					</div>
				</div>
	</div>
</div>	
<script type="text/javascript">
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtn");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
    	modal.style.display = "block";
	}
	span.onclick = function() {
    	modal.style.display = "none";
	}
	window.onclick = function(event) {
    	if (event.target == modal) {
        	modal.style.display = "none";
    	}
	}
</script>
</body>
</html>
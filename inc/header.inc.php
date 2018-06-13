
<?php 
include("./inc/connect.inc.php"); 
session_start();

	$user="";
	$u_id="";
	if(isset($_SESSION["user_login"])){
		$user=$_SESSION["user_login"];
		$u_id=$_SESSION["u_id"];
	}
	else
	{
		$user="";
		$path=$_SERVER['PHP_SELF'];
		if ($path!="/series/Advanced/index.php") {
				echo "<script>alert('You must logged in');</script>";
				echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
			}	
	}

	$search="";
	if (isset($_POST["q"])) {
		$search=$_POST["q"];
		if(substr($search, 0,1)=="#"){
			$hashtag=substr($search, 1);
			echo "<script>window.location = 'http://localhost/series/Advanced/hashtag.php?q=".$hashtag."'</script>";
		}
		else
			echo "<script>window.location = 'http://localhost/series/Advanced/search.php?q=".$search."'</script>";
	}
 ?>


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
	<div class="headerMenu">
		<div id="wrapper">
			<div class="logo">
				<a href="main.php"><img src="./img/logo.png"/></a>
			</div>

			<?php
			if($user){
				echo '<div id="menu">
					<div class="search_box">
						<form action="#" method="POST" id="search">
							<input type="text" name="q" size="60" placeholder="Search...">
						</form>
					</div>				
					<a href="'.$user.'"><img src="./img/profile.png" title="'.$user.'" width="50" height="50" "></a>
					<div class="search_box">
						<form action="#" method="POST" id="search">
							<input type="text" name="q" size="60" placeholder="Search...">
						</form>
					</div>
					<a href="people.php"><img src="./img/request.png" title="News Feed" width="50" height="50" ></a>
					<a href="account_setting.php"><img src="./img/setting.png" title="Setting" width="50" height="50"></a>
					<a href="logout.php"><img src="./img/logout.png" title="Log Out" width="50" height="50" ></a>
				</div>';
			}
			?>

		</div>

	</div>
	
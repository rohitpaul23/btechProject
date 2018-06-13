<?php 
	$sub=@$_POST['sub'];
	$ans=@$_POST['ans'];
	if($sub){
		if($ans==""){
			echo "<div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none'\">&times;</span><strong>Success!</strong> Account has been created</div>'";

		}
		else{
			$subs=substr($ans,-1);
			echo $subs;
			echo "<br>";
			echo str_ireplace($subs," ",$ans);
			$s=$subs.$ans;
			echo $s;
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	.alert {
    	padding: 20px;
    	background-color: #f44336;
    	color: white;
    	width: 350px;
    	margin: 250px 0px 0px 435px;
    	z-index: 1;
	}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
	</style>
</head>
<body>
	<div class="1" style="background-color: #aba434; height: 500px; width: 600px;">
		<form action="#" method="post">
			<input type="text" name="ans">
			<input type="submit" name="sub">
		</form>
		<div class="a">
			a
			<button onclick="a()">button a</button>
			<div class="b">
				b
				<button onclick="b()">button b</button>
			</div>
		</div>
		<div class="c">
			c
			<button onclick="c()">button c</button>
		</div>
			
	</div>
	<?php 
		echo date("Y-m-d h:i:sa");
	 ?>

</body>
<script type="text/javascript">
	function a(){
		var para="Hey";
		var element=document.getElementsByClassName("a")
		element.appendChild(para);
	}
	function b(){

	}
	function c(){

	}
</script>
</html>
<?php
     
	$conn=mysqli_connect("host","user","password","database");
	mysqli_set_charset($conn,'utf8');

 	$Id=$_POST['id'];
	$Password=$_POST['password'];
 	$Name=$_POST['name'];
 	$Email=$_POST['email'];
	 
	$sql2 = "SELECT * FROM membership WHERE id='$Id'";
	$res2 = mysqli_query($conn,$sql2);
	$count=mysqli_num_rows($res2);
    if ($count==1) {
		echo "<script>alert(\"아이디 중복을 확인해주세요\");</script>";
		echo "<script>window.history.back();</script>";
      	return;
    }
	else{
		$sql = "INSERT INTO membership (id, password, name, email) VALUES ('$Id','$Password','$Name','$Email')";
		$res = mysqli_query($conn,$sql);
		header("location: real-login.php");
	}
	mysqli_free_result(res);
	mysqli_close($conn);
?>
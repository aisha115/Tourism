<?php
error_reporting(0);
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$mnumber=$_POST['mobilenumber'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':fname',$fname,PDO::PARAM_STR);
	$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':password',$password,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
		echo '<script>alert("You are Scuccessfully registered. Now you can login")</script>';
	}
	else 
	{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}
}
?>
<!--Javascript for check email availabilty-->
<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data:'emailid='+$("#email").val(),
			type: "POST",
			success:function(data){
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
</script>
<div class="register-form-container">
    <i class="fas-fa-time" id="reg-close"></i>
    <form name="signup" method="post">
        <h3>Register Now</h3>
        <input type="text" class="box" placeholder="Name" name="fname">
        <input type="number" class="box" placeholder="Contact Number" name="mobilenumber">
        <input type="email" class="box" placeholder="Email" name="email">
        <input type="password" class="box" placeholder="Password" name="password">
        <button class="btn" type="submit" name="submit">Create</button>
        <button class="btn">Cancel</button>
    </form>
</div>
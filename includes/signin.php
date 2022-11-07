<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['log']))
{
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $sql ="SELECT * FROM tblusers WHERE EmailId=:email and Password=:password";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':email', $email, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $result)
    { 
      $_SESSION['login']=$_POST['email'];
      $_SESSION['login2']=$result->FullName;
    }
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
  } else{

    echo "<script>alert('Invalid Details');</script>";

  }
}
?>

<div class="login-form-container">
    <i class="fas-fa-time" id="form-close"></i>
    <form method="post">
        <h3>Login</h3>
        <input type="email" class="box" placeholder="enter your email" name="email">
        <input type="password" class="box" placeholder="enter your password" name="password">
        <input type="submit" value="login now" class="btn" name="log">
        <!-- <p>forget password?<a id="forget-btn">click here</a></p> -->
        <p>don't have an account?<a id="register-btn">register now</a></p>
    </form>
</div>
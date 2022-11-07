<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!-- <?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
  $pname=$_POST['packagename'];
  $ptype=$_POST['packagetype']; 
  $plocation=$_POST['packagelocation'];
  $pprice=$_POST['packageprice']; 
  $pfeatures=$_POST['packagefeatures'];
  $pdetails=$_POST['packagedetails']; 
  $pimage=$_FILES["packageimage"]["name"];
  move_uploaded_file($_FILES["packageimage"]["tmp_name"],"pacakgeimages/".$_FILES["packageimage"]["name"]);
  $sql="INSERT INTO TblTourPackages(PackageName,PackageType,PackageLocation,PackagePrice,PackageFetures,PackageDetails,PackageImage) VALUES(:pname,:ptype,:plocation,:pprice,:pfeatures,:pdetails,:pimage)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':pname',$pname,PDO::PARAM_STR);
  $query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
  $query->bindParam(':plocation',$plocation,PDO::PARAM_STR);
  $query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
  $query->bindParam(':pfeatures',$pfeatures,PDO::PARAM_STR);
  $query->bindParam(':pdetails',$pdetails,PDO::PARAM_STR);
  $query->bindParam(':pimage',$pimage,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    $msg="Package Created Successfully";
  }
  else 
  {
    $error="Something went wrong. Please try again";
  }

}
?> -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../css/common.css">
    </head>
    <body>
        <input type="checkbox" id="sidebar-toggle">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Travel</h3>
                <label for="sidebar-toggle" class="fas fa-bars"></label>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                    <li><a href="package.php"><i class="fas fa-clipboard-list"></i><span>Package Managements</span></a></li>
                    <li><a href="booking.php"><i class="fas fa-book"></i><span>Bookings</span></a></li>
                    <li><a href="Users.php"><i class="fas fa-user"></i><span>Users</span></a></li>
                    <li><a href="ManageUser.php"><i class="fas fa-users"></i><span>User Managements</span></a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <header>
                <div class="search-wrapper">
                    <span class="fas fa-search"></span>
                    <input type="search" placeholder="Search">
                </div>
                <div class="user-profile">
                    <span class="fas fa-circle-user"></span>
                    <h2>Admin</h2>
                </div>
            </header>
            <main>
                <div class="top">
                    <h2>Package</h2>
                    <a class="change" href="package.php">Manage Packages</a>
                </div>
                <?php 
                  if($error){?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>:<?php echo htmlentities($error); ?> 
                    </div>
                    <?php 
                  } 
                  else if($msg){?>
                    <div class="succWrap">
                      <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
                    </div>
                    <?php
                  }?>
                <div class="inputBox">
                    <form method="post" enctype="multipart/form-data">
                        <h3>National Park Name</h3>
                        <input type="text" placeholder="Name" name="packagename">
                        <h3>National Park Type</h3>
                        <input type="text" placeholder="Outdoor/Indoor" name="packagetype">
                        <h3>National Park Location</h3>
                        <input type="text" placeholder="Location" name="packagelocation">
                        <h3>Price in USD</h3>
                        <input type="number" placeholder="Price" name="packageprice">
                        <h3>National Park Features</h3>
                        <input type="text" placeholder="Features Eg-free Pickup-drop facility" name="packagefeatures">
                        <h3>Attach National Park Image</h3>
                        <input type="file" name="packageimage">
                        <h3>National Park Details</h3>
                        <textarea placeholder="Details" name="packagedetails" cols="30" rows="10"></textarea>                            
                        <button class="btn" type="submit" name="submit">Create</button>
                        <button class="btn">Reset</button>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html> 
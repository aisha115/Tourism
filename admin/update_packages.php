<?php
// include('includes/checklogin.php');
// check_login();
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$pid=intval($_GET['pid']);  
if(isset($_POST['submit']))
{
  $pname=$_POST['packagename'];
  $ptype=$_POST['packagetype']; 
  $plocation=$_POST['packagelocation'];
  $pprice=$_POST['packageprice']; 
  $pfeatures=$_POST['packagefeatures'];
  $pdetails=$_POST['packagedetails']; 
  $pimage=$_FILES["packageimage"]["name"];
  $sql="update TblTourPackages set PackageName=:pname,PackageType=:ptype,PackageLocation=:plocation,PackagePrice=:pprice,PackageFetures=:pfeatures,PackageDetails=:pdetails where PackageId=:pid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':pname',$pname,PDO::PARAM_STR);
  $query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
  $query->bindParam(':plocation',$plocation,PDO::PARAM_STR);
  $query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
  $query->bindParam(':pfeatures',$pfeatures,PDO::PARAM_STR);
  $query->bindParam(':pdetails',$pdetails,PDO::PARAM_STR);
  $query->bindParam(':pid',$pid,PDO::PARAM_STR);
  $query->execute();
  $msg="Package Updated Successfully";
}
?>
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
            <a href="../index.php" class="logo"><h3>Travel</h3></a>
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
                  <h2>Update Packages</h2>
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

                  <?php 
                  $pid=intval($_GET['pid']);
                  $sql = "SELECT * from TblTourPackages where PackageId=:pid";
                  $query = $dbh -> prepare($sql);
                  $query -> bindParam(':pid', $pid, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    { 
                      ?>
                      <form name="package" method="post" enctype="multipart/form-data">
                        <h3>Package Name</h3>
                        <input type="text" placeholder="Name" name="packagename" value="<?php echo htmlentities($result->PackageName);?>">
                        <h3>Package Type</h3>
                        <input type="text" placeholder="Outdoor/Indoor" name="packagetype" value="<?php echo htmlentities($result->PackageType);?>">
                        <h3>Package Location</h3>
                        <input type="text" placeholder="Location" name="packagelocation" value="<?php echo htmlentities($result->PackageLocation);?>">
                        <h3>Package Price in USD</h3>
                        <input type="number" placeholder="Price" name="packageprice" value="<?php echo htmlentities($result->PackagePrice);?>">
                        <h3>Package Features</h3>
                        <input type="text" placeholder="Features Eg-free Pickup-drop facility" name="packagefeatures" value="<?php echo htmlentities($result->PackageFetures);?>">
                        <h3>Package Image</h3>
                        <input type="file" name="packageimage">
                        <img src="../images/<?php echo htmlentities($result->PackageImage);?>" width="200">&nbsp;&nbsp;&nbsp;<a href="change_image.php?imgid=<?php echo htmlentities($result->PackageId);?>">Change Image</a>
                        <h3>Package Details</h3>
                        <textarea placeholder="Details" name="packagedetails" id="" cols="30" rows="10"><?php echo htmlentities($result->PackageDetails);?></textarea>                            
                        <div class="form-group">
                          <label for="focusedinput" class="col-sm-2 control-label">Last Updation Date</label>
                          <div class="col-sm-8">
                            <?php echo htmlentities($result->UpdationDate);?>
                          </div>
                        </div>
                        <button class="btn" type="submit" name="submit">Update</button>
                      </form>
                      <?php 
                    }
                  } ?>
                </div>
              </main>
        </div>
    </body>
</html> 
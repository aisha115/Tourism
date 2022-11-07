<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
	$pid=intval($_GET['pkgid']);
	$useremail=$_SESSION['login'];
	$fromdate=$_POST['fromdate'];
	$todate=$_POST['todate'];
	$comment=$_POST['comment'];
	$status=0;
	$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':pid',$pid,PDO::PARAM_STR);
	$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
	$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
	$query->bindParam(':todate',$todate,PDO::PARAM_STR);
	$query->bindParam(':comment',$comment,PDO::PARAM_STR);
	$query->bindParam(':status',$status,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
		echo '<script>alert("Booked Scuccessfully . Thank you")</script>';
	}
	else 
	{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tourism Management System</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/common.css">
    </head>
    <body>    
        <header>
            <div id="menu-bar" class="fas fa-bars"></div>
            <a href="#" class="logo"><span>T</span>ravel</a>
            <nav class="navbar">
                <a href="./index.html#home">Home</a>
                <a href="./index.html#packages">Packages</a>
                <a href="./index.html#services">Services</a>
                <a href="./index.html#gallery">Gallery</a>
                <a href="./index.html#review">Review</a>
                <a href="./index.html#contact">Contact</a>
            </nav>
            <div class="icons">
                <i class="fas fa-search" id="search-btn"></i>
            </div>
            <form action="" class="search-bar-container">
                <input type="search" id="search-bar" placeholder="search here...">
                <label for="search-bar" class="fas fa-search"></label>
            </form>
        </header>
        <section class="book" id="book">
            <h1 class="heading">
                <span>b</span>
                <span>o</span>
                <span>o</span>
                <span>k</span>
                <span class="space"></span>
                <span>n</span>
                <span>o</span>
                <span>w</span>
            </h1>
            <div class="row">
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
					<?php 
					$pid=intval($_GET['pkgid']);
					$sql = "SELECT * from tbltourpackages where PackageId=:pid";
					$query = $dbh->prepare($sql);
					$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					$cnt=1;
					if($query->rowCount() > 0)
					{
						foreach($results as $result)
						{ 
							?>
                            <div class="image">
                                <img src="images/<?php echo htmlentities($result->PackageImage);?>" alt="">
                            <div class="content">
                                <h3><?php echo htmlentities($result->PackageName);?></h3><br>
						        <p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
					        	<p><i class="fas fa-map-marker-alt"></i><?php echo htmlentities($result->PackageLocation);?></p>
                                <p><b>Features :</b> <?php echo htmlentities($result->PackageFetures);?></p><br>
                                <h3>Package Details :</h3>
						        <p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p> 
                            </div>
                        </div>
                <form name="book" method="post">
                    <div class="inputBox">
                        <h3>where to</h3>
                        <input type="text" placeholder="place name">
                    </div>
                    <div class="inputBox">
                        <h3>how many</h3>
                        <input type="number" placeholder="number of guests">
                    </div>
                    <div class="inputBox">
                        <h3>arrivals</h3>
                        <input type="date">
                    </div>
                    <div class="inputBox">
                        <h3>leaving</h3>
                        <input type="date">
                    </div>
                    <?php if($_SESSION['login'])
					{?>
                    <input type="submit" value="book now" class="btn">
                    <?php 
					} else {?>
                    <a href="#" data-toggle="modal" data-target="#myModal4"  class="btn" > Book</a>
                    <?php
					} ?>
                </form>
							
							<?php 
						}
					} ?>
                    </div>
            <!-- <div class="row">
                <div class="image">
                    <img src="images/<?php echo htmlentities($result->PackageImage);?>" alt="">
                    <div class="content">
                        <h3><i class="fas fa-map-marker-alt"></i> <?php echo htmlentities($result->PackageName);?></h3>
                        <p><?php echo htmlentities($result->PackageType);?>
                        <br><?php echo htmlentities($result->PackageLocation);?>
                        <br><?php echo htmlentities($result->PackageFetures);?>
                        </p>
                    </div>
                </div>
                <form action="">
                    <div class="inputBox">
                        <h3>where to</h3>
                        <input type="text" placeholder="place name">
                    </div>
                    <div class="inputBox">
                        <h3>how many</h3>
                        <input type="number" placeholder="number of guests">
                    </div>
                    <div class="inputBox">
                        <h3>arrivals</h3>
                        <input type="date">
                    </div>
                    <div class="inputBox">
                        <h3>leaving</h3>
                        <input type="date">
                    </div>
                    <?php if($_SESSION['login'])
					{?>
                    <input type="submit" value="book now" class="btn">
                    <?php 
					} else {?>
                    <a href="#" data-toggle="modal" data-target="#myModal4"  class="btn" > Book</a>
                    <?php
					} ?>
                </form>
            </div> -->
        </section>
        <script src="js/script.js"></script> 
    </body>
</html>
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// if(isset($_POST['login']))
// {
//   $username=$_POST['username'];
//   $password=md5($_POST['password']);
//   $sql ="SELECT * FROM tbladmin WHERE UserName=:username and Password=:password";
//   $query=$dbh->prepare($sql);
//   $query-> bindParam(':username', $username, PDO::PARAM_STR);
//   $query-> bindParam(':password', $password, PDO::PARAM_STR);
//   $query-> execute();
//   $results=$query->fetchAll(PDO::FETCH_OBJ);
//   if($query->rowCount() > 0)
//   {
//     foreach ($results as $result) 
//     {
//       $_SESSION['odmsaid']=$result->ID;
//       $_SESSION['login']=$result->username;
//       $_SESSION['names']=$result->FirstName;
//       $_SESSION['permission']=$result->AdminName;
//       $get=$result->Status;
//     }
//     $aa= $_SESSION['odmsaid'];
//     $sql="SELECT * from tbladmin  where ID=:aa";
//     $query = $dbh -> prepare($sql);
//     $query->bindParam(':aa',$aa,PDO::PARAM_STR);
//     $query->execute();
//     $results=$query->fetchAll(PDO::FETCH_OBJ);
//     $cnt=1;
//     if($query->rowCount() > 0)
//     {
//       foreach($results as $row)
//       {            
//         if($row->Status=="1")
//         { 
//           echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";              
//         } else
//         { 
//           echo "<script>
//           alert('Your account was disabled Approach Admin');document.location ='index.php';
//           </script>";
//         }
//       } 
//     } 
//   } else{
//     echo "<script>alert('Invalid Details');</script>";
//   }
// }
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
                <h2>Dashboard</h2>
                <div class="dash-cards">
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total Booking</h5>
                                <?php $sql1 = "SELECT BookingId from tblbooking";
                                    $query1 = $dbh -> prepare($sql1);
                                    $query1->execute();
                                    $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                                    $cnt1=$query1->rowCount();
                                ?>
                                <h4><?php echo htmlentities($cnt1);?></h4>
                            </div>
                            <i class="fas fa-calendar-minus"></i>
                        </div> 
                    </div>
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total Package</h5>
                                <?php $sql3 = "SELECT PackageId from tbltourpackages";
                                    $query3= $dbh -> prepare($sql3);
                                    $query3->execute();
                                    $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                    $cnt3=$query3->rowCount();
                                ?>
                                <h4><?php echo htmlentities($cnt3);?></h4>
                            </div>
                            <i class="fas fa-cart-shopping"></i>
                        </div> 
                    </div>
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total User</h5>
                                <?php $sql = "SELECT id from tblusers";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=$query->rowCount();
                                ?>    
                                <h4><?php echo htmlentities($cnt);?></h4>
                            </div>
                            <i class="fas fa-users"></i>
                        </div> 
                    </div>
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total Admin</h5>
                                <?php $sql = "SELECT id from tbladmin";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt2=$query->rowCount();
                                ?>    
                                <h4><?php echo htmlentities($cnt2);?></h4>
                            </div>
                            <i class="fa-sharp fa-solid fa-comments"></i>
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </body>
</html> 
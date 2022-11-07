<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!-- <?php
include('includes/checklogin.php');
check_login();
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
                <h2>Users</h2>
                <?php if($error){?>
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
                <div class="list">
                        <table>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>RegDate</th>
                                <!-- <th>Updation Date</th> -->
                            </tr>
                            <tbody>
                            <?php $sql = "SELECT * from tblusers";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {       
                            ?>    
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->FullName);?></td>
                                        <td><?php echo htmlentities($result->MobileNumber);?></td>
                                        <td><?php echo htmlentities($result->EmailId);?></td>
                                        <td><?php echo htmlentities($result->RegDate);?></td>
                                        <!-- <td><?php echo htmlentities($result->UpdationDate);?></td> -->
                                    </tr>
                            <?php $cnt=$cnt+1;
                                } 
                            }?>
                            </tbody>
                        </table>
                        <div class="row">
                                <ul>
                                    <li class="btn">
                                        <a href="#">Previous</a>
                                    </li>
                                    <li class="btn">
                                        <a href="#">1</a>
                                    </li>
                                    <li class="btn">
                                        <a href="#">Next</a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html> 
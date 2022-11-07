<?php
// include('includes/checklogin.php');
// check_login();
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// code for cancel
if(isset($_REQUEST['bkid']))
{
  $bid=intval($_GET['bkid']);
  $status=2;
  $cancelby='a';
  $sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE  BookingId=:bid";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':status',$status, PDO::PARAM_STR);
  $query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
  $query-> bindParam(':bid',$bid, PDO::PARAM_STR);
  $query -> execute();
  if ( $query -> execute()) {
   echo '<script>alert("Booking Cancelled successfully")</script>';
 }else{
  echo '<script>alert("Something Went Wrong. Please try again")</script>';
}
}
if(isset($_REQUEST['bckid']))
{
  $bcid=intval($_GET['bckid']);
  $status=1;
  $cancelby='a';
  $sql = "UPDATE tblbooking SET status=:status WHERE BookingId=:bcid";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':status',$status, PDO::PARAM_STR);
  $query-> bindParam(':bcid',$bcid, PDO::PARAM_STR);
  $query -> execute();
  if ( $query -> execute()) {
    echo '<script>alert("Booking Confirmed successfully")</script>';
  }else{
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }

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
                <h2>Booking</h2>
                <div class="list">
                        <table>
                            <tr>
                                <th>Booking Id</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>RegDate</th>
                                <th>From/To</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                            <?php $sql = "SELECT tblbooking.BookingId as bookid,tblusers.FullName as fname,tblusers.MobileNumber as mnumber,tblusers.EmailId as email,tbltourpackages.PackageName as pckname,tblbooking.PackageId as pid,tblbooking.FromDate as fdate,tblbooking.ToDate as tdate,tblbooking.Comment as comment,tblbooking.status as status,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate from tblusers join  tblbooking on  tblbooking.UserEmail=tblusers.EmailId join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {       ?>    
                                <tr>
                                    <td>#BK-<?php echo htmlentities($result->bookid);?></td>
                                    <td><?php echo htmlentities($result->fname);?></td>
                                    <td><?php echo htmlentities($result->mnumber);?></td>
                                    <td><?php echo htmlentities($result->email);?></td>
                                    <td><a href="update_packages.php?pid=<?php echo htmlentities($result->pid);?>"><?php echo htmlentities($result->pckname);?></a></td>
                                    <td><?php echo htmlentities($result->fdate);?> To <?php echo htmlentities($result->tdate);?></td>
                                    <td><?php echo htmlentities($result->comment);?></td>
                                    <td>
                                <?php 
                                if($result->status==0)
                                {
                                    echo "Pending";
                                }
                                if($result->status==1)
                                {
                                    echo "Confirmed";
                                }
                                if($result->status==2 and  $result->cancelby=='a')
                                {
                                    echo "Canceled by you at " .$result->upddate;
                                } 
                                if($result->status==2 and $result->cancelby=='u')
                                {
                                    echo "Canceled by User at " .$result->upddate;
                                }
                                ?>
                                </td>
                                <?php 
                                if($result->status==2){
                                ?>
                                <td>Cancelled</td>
                                <?php 
                                }
                                elseif($result->status==1){
                                ?>
                                <td>Confirmed</td>
                                <?php
                                } 
                                else {
                                ?>
                                <td>
                                    <a href="manage_bookings.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Do you really want to cancel booking')" >Cancel</a>&nbsp;<a href="manage_bookings.php?bckid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Do you really want to confirm booking')" >Confirm</a>
                                </td>
                                <?php 
                                }?>
                            </tr>
                            <?php $cnt=$cnt+1;
                            } 
                            }?>
                            </tbody>
                                <!-- <tr>
                                  <td>#BK-13</td>
                                  <td>Gerald Brain</td>
                                  <td>0770546590</td>
                                  <td>gerald@gmail.com</td>
                                  <td>Queen Elizabeth</td>
                                  <td>2020-12-11 To 2020-12-11</td>
                                  <td>Real i need to tour that place</td>
                                  <td>Confirmed</td>
                                  <td>Confirmed</td>
                                </tr>
                                <tr>
                                    <td>#BK-14</td>
                                    <td>Gerald Brain</td>
                                    <td>0770546590</td>
                                    <td>gerald@gmail.com</td>
                                    <td>Entebbe Zoo</td>
                                    <td>2021-01-12 To 2021-01-15</td>
                                    <td>kk</td>
                                    <td>Canceled by User at 2021-01-14 16:50:42</td>
                                    <td>Cancelled</td>
                                </tr>
                                <tr>
                                    <td>#BK-15</td>
                                    <td>Gerald Brain</td>
                                    <td>0770546590</td>
                                    <td>gerald@gmail.com</td>
                                    <td>Lake Mburo NP</td>
                                    <td>2021-01-14 To 2021-01-16</td>
                                    <td>tour</td>
                                    <td>Canceled by User at 2021-02-15 14:26:58</td>
                                    <td>Cancelled</td>
                                </tr>
                                <tr>
                                    <td>#BK-16</td>
                                    <td>Gerald Brain</td>
                                    <td>0770546590</td>
                                    <td>gerald@gmail.com</td>
                                    <td>Entebbe Zoo</td>
                                    <td>2021-03-26 To 2021-03-31</td>
                                    <td>Real i need to tour that place</td>
                                    <td>Pending</td>
                                    <td>Cancel Confirm</td>
                                </tr>
                                <tr>
                                    <td>#BK-17</td>
                                    <td>John Simith</td>
                                    <td>0770546590</td>
                                    <td>admin@gmail.com</td>
                                    <td>Bwindi NP</td>
                                    <td>2021-07-28 To 2021-07-30</td>
                                    <td>Test</td>
                                    <td>Canceled by you at 2021-07-24 15:34:22</td>
                                    <td>Cancelled</td>
                                </tr>
                                <tr >
                                    <td>#BK-18</td>
                                    <td>John Simith</td>
                                    <td>0770546590</td>
                                    <td>admin@gmail.com</td>
                                    <td>kidepo valley Np</td>
                                    <td>2021-07-24 To 2021-07-26</td>
                                    <td>smart travel test</td>
                                    <td>Confirmed</td>
                                    <td>Confirmed</td>
                                </tr> -->
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
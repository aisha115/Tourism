<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="update tbladmin set Status='0' where ID='$rid'";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()){
    echo "<script>alert('User blocked');</script>"; 
    echo "<script>window.location.href = 'user_register.php'</script>";
  }else{
    echo '<script>alert("update failed! try again later")</script>';
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
            <div class="register-form-container">
                <i class="fas-fa-time" id="reg-close"></i>
                <form action="" style="width: 35rem;">
                    <h3 style="font-size: 2rem;">Register Now</h3>
                    <input type="text" class="box" style="font-size: 1.2rem;" placeholder="Name">
                    <input type="email" class="box" style="font-size: 1.2rem;" placeholder="Email">
                    <input type="password" class="box" style="font-size: 1.2rem;" placeholder="Password">
                    <input type="password" class="box" style="font-size: 1.2rem;" placeholder="Confirm Password">
                    <input type="number" class="box" style="font-size: 1.2rem;" placeholder="Contact Number">
                    <input type="submit" value="register now" class="btn">
                </form>
            </div>
            <main>
                <h2>Users</h2>
                <div class="list">
                    <div class="row">
                        <a id="register-btn" class="btn"><i class="fas fa-add"></i>Registere User</a>
                    </div>
                        <table>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Date Registered</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql="SELECT * from tbladmin where Status='1'  ";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {    
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php  echo htmlentities($row->FirstName);?>&nbsp;<?php  echo htmlentities($row->LastName);?></td>
                                    <td>0<?php  echo htmlentities($row->MobileNumber);?></td>
                                    <td><?php  echo htmlentities($row->Email);?></td>
                                    <td>
                                    <span ><?php  echo htmlentities(date("d-m-Y", strtotime($row->AdminRegdate)));?></span>
                                    </td>
                                    <td>
                                    <a href="#"  class=" edit_data  btn btn-sm btn-primary" id="<?php echo  ($row->ID); ?>" title="click for edit" >Edit</a>
                                    <a href="ManageUser.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');" title="Delete this User" class="btn btn-sm btn-danger">Block</a> </td>
                                </tr>
                                <?php $cnt=$cnt+1;
                                }
                            } ?>
                            </tbody>
                            <!-- <tr>
                                <td>1</td>
                                <td>John Simith</td>
                                <td>0770546590</td>
                                <td>admin@gmail.com</td>
                                <td>21-06-2021</td>
                                <td>
                                    <a href="" class="btn">Edit</a>
                                    <a href="" class="btn">Block</a>
                                </td>
                            </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Harry Ronald</td>
                                  <td>0757537271</td>
                                  <td>harry@gmail.com</td>
                                  <td>21-06-2021</td>
                                  <td>
                                    <a href="" class="btn">Edit</a>
                                    <a href="" class="btn">Block</a>
                                  </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>JHappy Morgan</td>
                                    <td>0770546590</td>
                                    <td>morgan@gmail.com</td>
                                    <td>21-07-2021</td>
                                    <td>
                                        <a href="" class="btn">Edit</a>
                                        <a href="" class="btn">Block</a>
                                    </td>
                                </tr> -->
                        </table>
                    </div>
                </div>
            </main>
        </div>
        <script src="script.js"></script>
    </body>
</html>
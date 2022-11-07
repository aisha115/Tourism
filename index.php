<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
            <a href="./admin/index.php" class="logo"><span>T</span>ravel</a>
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#packages">Packages</a>
                <a href="#services">Services</a>
                <a href="#gallery">Gallery</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="icons">
                <i class="fas fa-search" id="search-btn"></i>
                <i class="fas fa-user" id="login-btn"></i>
            </div>
            <form action="" class="search-bar-container">
                <input type="search" id="search-bar" placeholder="search here...">
                <label for="search-bar" class="fas fa-search"></label>
            </form>
        </header>
        <?php include("includes/signin.php");?>
        <?php include("includes/signup.php");?>
        <!-- <div class="forget">
            <i class="fas-fa-time" id="forget-close"></i>
            <form action="">
                <h3>New Password</h3>
                <input type="password" class="box" placeholder="create new password">
                <input type="password" class="box" placeholder="confirm new password">
                <input type="submit" value="Change" class="btn">
            </form>
        </div> -->
        <section class="home" id="home">
            <div class="content">
                <h3>Adventure is worthwhile</h3>
                <p>Discover New Places With Us, Adventure Awaits</p>
                <a href="#gallery" class="btn">discover more</a>
            </div>
            <div class="controls">
                <span class="vid-btn active" data-src="images/v1.mp4"></span>
                <span class="vid-btn" data-src="images/v2.mp4"></span>
                <span class="vid-btn" data-src="images/v3.mp4"></span>
                <span class="vid-btn" data-src="images/v4.mp4"></span>
            </div>
            <div class="video-container">
                <video src="images/v1.mp4" id="video-slider" loop autoplay muted></video>
            </div>
        </section>
        <section class="packages" id="packages">
            <h1 class="heading">
                <span>p</span>
                <span>a</span>
                <span>c</span>
                <span>k</span>
                <span>a</span>
                <span>g</span>
                <span>e</span>
                <span>s</span>
            </h1>
            <div class="box-container">
            <?php 
            $sql = "SELECT * from tbltourpackages order by rand() ";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
                foreach($results as $result)
                { 
            ?>
                    <div class="box">
                        <img src="images/<?php echo htmlentities($result->PackageImage);?>" alt="">
                        <div class="content">
                            <h3>Park Name: <?php echo htmlentities($result->PackageName);?></h3>
                            <p><b>Park Type:</b> <?php echo htmlentities($result->PackageType);?></p>
                            <p><b><i class="fas fa-map-marker-alt"></i>Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
                            <p><b>Features: </b> <?php echo htmlentities($result->PackageFetures);?></p>
                            <h3 style="padding: 1rem 0rem;">USD <?php echo htmlentities($result->PackagePrice);?></h3>
                            <a href="booking.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="btn">book now</a>
                        </div>
                    </div>
            <?php 
                }
            } 
            ?>
            </div>
        </section>
        <section class="services" id="services">
            <h1 class="heading">
                <span>s</span>
                <span>e</span>
                <span>r</span>
                <span>v</span>
                <span>i</span>
                <span>c</span>
                <span>e</span>
                <span>s</span>
            </h1>
            <div class="box-container">
                <div class="box">
                    <i class="fas fa-hotel"></i>
                    <h3>affordable hotels</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
                <div class="box">
                    <i class="fas fa-utensils"></i>
                    <h3>food and drinks</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
                <div class="box">
                    <i class="fas fa-bullhorn"></i>
                    <h3>safty guide</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
                <div class="box">
                    <i class="fas fa-globe-asia"></i>
                    <h3>around the world</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
                <div class="box">
                    <i class="fas fa-plane"></i>
                    <h3>fastest travel</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
                <div class="box">
                    <i class="fas fa-hiking"></i>
                    <h3>adventures</h3>
                    <p>The real voyage of discovery consists not in seeking new landscapes, but in having new eyes.</p>    
                </div>
            </div>
        </section>
        <section class="gallery" id="gallery">
            <h1 class="heading">
                <span>g</span>
                <span>a</span>
                <span>l</span>
                <span>l</span>
                <span>e</span>
                <span>r</span>
                <span>y</span>
            </h1>
            <div class="box-container">
                <div class="box">
                    <img src="images/t7.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p> 
                    </div>
                </div>
                <div class="box">
                    <img src="images/t8.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p> 
                    </div>
                </div>
                <div class="box">
                    <img src="images/t9.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p> 
                    </div>
                </div>
                <div class="box">
                    <img src="images/t10.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/t11.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/t12.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/t13.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/t14.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/t15.jpg" alt="">
                    <div class="content">
                        <h1>Kerla</h1> 
                        <p>Best place to Travel</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact" id="contact">
            <h1 class="heading">
                <span>c</span>
                <span>o</span>
                <span>n</span>
                <span>t</span>
                <span>a</span>
                <span>c</span>
                <span>t</span>
            </h1>  
            <div class="row">
                <div class="image">
                    <img src="images/t16.webp" alt="">
                </div>
                <form action="">
                    <div class="inputBox">
                        <input type="text" placeholder="name">
                        <input type="email" placeholder="email">
                        <input type="number" placeholder="number">
                        <input type="text" placeholder="subject">
                    </div>
                    <textarea placeholder="message" name="" id="" cols="30" rows="10"></textarea>
                    <input type="submit" class="btn" value="send message">
                </form>
            </div>  
        </section>
        <footer>
            <div class="footer-content">
                <h3>Contact</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 1397 oracle street, aracle,1234</p>
                    <p><i class="fa fa-phone"></i> +63 123-567-890 &nbsp; <i class="fa fa-envelope"></i> abc.cde@travel.com</p>
                <ul class="socials">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                 </ul>        
            </div>    
        </footer>
       <script src="js/script.js"></script> 
    </body>
</html>
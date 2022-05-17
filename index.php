<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="IE-edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, intial-scale=1.0" name="viewport">
    <title>TuneSource</title>
    <!--fav-icon---------------->
    <link rel="shortcut icon" href="Images/icon.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--style----->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: poppins;
        }
    </style>
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
</head>

<body>
<h1> I Fixed code</h1>
    <?php

    session_start();

    if (isset($_POST['login'])) {

        $u = $_SESSION['email'];

        echo "Welcome $u";
    }


    ?>
    <nav>
        <!--social-links-and-phone-number----------------->
        <div class="social-call">
            <!--social-links--->
            <div class="social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <!--phone-number------>
            <div class="phone">
                <span>Call: +000000000</span>
            </div>
        </div>
        <!--menu-bar----------------------------------------->
        <div class="navigation">
            <!--logo------------>
            <a href="index.php" class="logo"><img src="Images/icon.png">
                <span class="shop-name">TuneSource</span></a>



            <!--menu----------------->
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li class="shop"><a href="#">Shop</a></li>
                <li><a href="#">Sale</a>
                    <!--label---->
                    <span class="sale-label">99% Off</span>
                </li>

                <li><a href="about.php">About Us</a></li>
            </ul>
            <!--right-menu----------->
            <div class="right-menu">
                <a href="javascript:void(0);" class="search">
                    <i class="fas fa-search"></i>
                </a>
                <a href="javascript:void(0);" class="user">
                    <i class="far fa-user"></i>
                </a>
                <a href="#">
                    <i class="fas fa-shopping-cart">
                        <span class="num-cart-product">0</span>
                    </i>
                </a>
            </div>
        </div>
    </nav>
    <!--search-bar----------------------------------->
    <form method="post">
        <div class="search-bar">

            <input class="search-btn" type="submit" name="searchbtn" value="Search" />
            <!--search-input------->
            <div class="search-input">

                <input type="text" placeholder="Search For Product" name="search" />


                <!--cancel-btn--->
                <a href="javascript:void(0);" class="search-cancel">
                    <i class="fas fa-times"></i>
                </a>


            </div>

            <?php


            $connect = mysqli_connect('localhost', 'root', '', 'tunesourcedb');

            if (isset($_POST['searchbtn'])) {

                $searchname = $_POST['search'];


                $sql = "SELECT * FROM song where song_name ='$searchname' ";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {




            ?>
                    <!--product-box-1---------->
                    <div class="product-box">
                        <!--product-img------------>
                        <div class="product-img">
                            <!--add-cart---->
                            <a class="add-cart">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <!--img------>
                            <a href="detail.php?id=<?php echo $row['song_id'] ?>" class="p-name"><?php echo $row['song_name'] ?> <img src="<?php echo $row['song_img'] ?>"></a>

                        </div>
                        <!--product-details-------->
                        <div class="product-details">
                            <a href="detail.php?id=<?php echo $row['song_id'] ?>" class="p-name"><?php echo $row['song_name'] ?> </a>
                            <span class="p-price"><?php echo $row['song_price'] ?> </span>

                        </div>

                    </div><?php
                        }
                    }
                            ?>



            }
            ?>



    </form>
    </div>
    <!---login-and-sign-up--------------------------------->
    <div class="form">

        <!--login---------->
        <div class="login-form">
            <!--cancel-btn---------------->
            <a href="javascript:void(0);" class="form-cancel">
                <i class="fas fa-times"></i>
            </a>
            <strong>Log In</strong>
            <!--inputs-->
            <form method="POST">
                <input type="email" name="email" placeholder="Example@gmail.com" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="login" value="Log In" />

                <?php

                //Kết nối theo Mysqli procedural
                $connect = mysqli_connect('localhost', 'root', '', 'tunesourcedb');

                // Nếu click vào nút login thì mới thực hiện 
                if (isset($_POST['login'])) {

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if ($email == "admin@gmail.com" && $password == "admin") {
                        echo "<script> alert('Move to Admin Page')</script>";

                        echo "<script> window.location.assign('AddProduct.php'); </script>";
                        exit;
                    } else {
                        // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                        $sql = "SELECT * FROM users WHERE u_email ='$email' AND password = '$password'";


                        // Thực thi truy vấn
                        $result = mysqli_query($connect, $sql);
                        // Trả về kết quả , chính là các dòng được truy vấn
                        $row = mysqli_num_rows($result);
                        // Nếu $row > 0 --> có trên 1 dòng trong CSDL trùng với dữ liệu nhập vào form -> đăng nhập thành công 
                        if ($row > 0) {
                            echo "<script> alert('Successful')</script>";
                            //session
                            $_SESSION['email'] = $email;
                        } else {
                            echo "<script> alert('Failed')</script>";
                        }
                    }
                }
                ?>
            </form>
            <!--forget-and-sign-up-btn-->
            <div class="form-btns">
                <a href="#" class="forget">Forget Your Password?</a>
                <a href="javascript:void(0);" class="sign-up-btn">Create Account</a>
            </div>
        </div>
        <!--Sign-up---------->
        <div class="sign-up-form">
            <!--cancel-btn---------------->
            <a href="javascript:void(0);" class="form-cancel">
                <i class="fas fa-times"></i>
            </a>
            <strong>Sign Up</strong>
            <!--inputs-->
            <form method="POST">
                <input type="text" name="fullname" placeholder="Full Name" required />
                <input type="text" name="username" placeholder="Username" required />
                <input type="email" name="email" placeholder="Example@gmail.com" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="signup" value="Sign Up" />


                <?php

                //Kết nối theo Mysqli procedural
                $connect = mysqli_connect('localhost', 'root', '', 'tunesourcedb');

                // Nếu click vào nút login thì mới thực hiện 
                if (isset($_POST['signup'])) {
                    $fullname = $_POST['fullname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                    $sql = "SELECT * FROM users WHERE u_email ='$email' AND password = '$password'";


                    // Thực thi truy vấn
                    $result = mysqli_query($connect, $sql);
                    // Trả về kết quả , chính là các dòng được truy vấn
                    $row = mysqli_num_rows($result);
                    // Nếu $row > 0 --> có trên 1 dòng trong CSDL trùng với dữ liệu nhập vào form -> đăng nhập thành công 
                    if ($row > 0) {
                        echo "<script> alert('email exist try again')</script>";
                        //session

                        $_SESSION['email'] = $email;
                    } else {
                        $sql = "INSERT INTO `users`(`user_id`, `u_email`, `username`, `password`, `fullname`) VALUES ('','$email','$username','$password','$fullname')";
                        $result = mysqli_query($connect, $sql);
                        if ($result) {

                            echo "<script> alert('Welcome $username')</script>";
                        }
                    }
                }
                ?>
            </form>
            <!--forget-and-sign-up-btn-->
            <div class="form-btns">
                <a href="javascript:void(0);" class="already-account">
                    Already Have Account?</a>

            </div>
        </div>
    </div>

    <!--NEW ARRIVAL-------------------------------->
    <section class="new-arrival">

        <!--heading-------->
        <div class="arrival-heading">
            <strong>New Arrival</strong>
            <p>We Provide You New Inspirations of Music Art</p>
        </div>
        <!--products----------------------->
        <div class="product-container">
            <?php
            $connect = mysqli_connect('localhost', 'root', '', 'tunesourcedb');
            if (!$connect) {
                echo "Failed";
            }
            $sql = "SELECT * FROM `song` INNER JOIN genre ON song.genre_id = genre.genre_id";


            $result = mysqli_query($connect, $sql);


            while ($row = mysqli_fetch_array($result)) {
                

            ?>
                <!--product-box-1---------->
                <div class="product-box">
                    <!--product-img------------>
                    <div class="product-img">
                        <!--add-cart---->
                        <a class="add-cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <!--img------>
                        <a href="detail.php?id=<?php echo $row['song_id'] ?>"><img src="<?php echo $row['song_img'] ?>"></a>
                    </div>
                    <!--product-details-------->
                    <div class="product-details">
                        <a href="detail.php?id=<?php echo $row['song_id'] ?>" class="p-name"><?php echo $row['song_name'] ?> </a>
                        <a href="detail.php?id=<?php echo $row['song_id'] ?>" class="p-name"><?php echo $row['song_desc'] ?> </a>
                        <audio controls controlsList="nodownload" ontimeupdate="myAudio(this)" style="width: 250px;">
                           <source src="<?php echo $row['song_file'] ?>" type="audio/mpeg">
                       </audio>
                       <script type="text/javascript">
                           function myAudio(event){
                               if(event.currentTime>10){
                                   event.currentTime=0;
                                   event.pause();
                                   alert("Sample session is over please subscribe to our services")
                               }
                           }
                       </script>
                        <span class="p-price"><?php echo $row['song_price'] ?> </span>

                    </div>

                </div><?php
                    }
                        ?>

    </section>


    <script src="js/JQuery.js"></script>
    <script>
        /*-----For Search Bar-----------------------------*/
        $(document).on('click', '.search', function() {
            $('.search-bar').addClass('search-bar-active')
        });

        $(document).on('click', '.search-cancel', function() {
            $('.search-bar').removeClass('search-bar-active')
        });
        /*---For Login and Sign-up----------------------------*/
        $(document).on('click', '.user,.already-account', function() {
            $('.form').addClass('login-active').removeClass('sign-up-active')
        });

        $(document).on('click', '.sign-up-btn', function() {
            $('.form').addClass('sign-up-active').removeClass('login-active')
        });

        $(document).on('click', '.form-cancel', function() {
            $('.form').removeClass('login-active').removeClass('sign-up-active')
        });
    </script>


</body>

</html>
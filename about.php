<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="IE-edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, intial-scale=1.0" name="viewport">
    <title>Awazons</title>
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
                <span class="shop-name">Awazons</span></a>



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

            //Kết nối theo Mysqli procedural
            $connect = mysqli_connect('localhost', 'root', '', 'mydb');

            if (isset($_POST['searchbtn'])) {

                $searchname = $_POST['search'];

                // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                $sql = "SELECT * FROM product where pname ='$searchname' ";
                $result = mysqli_query($connect, $sql);
                //Tìm và trả về kết quả dưới dạng 1 mảng và lấy từng dòng dữ liệu


                while ($row = mysqli_fetch_array($result)) {


                    //lấy ra từng dòng dữ liệu truy vấn được và hiển thị
                    //$row['product_id'];
                    //$row['product_name'];
                    //$row['product_img'];
                    //$row['product_price'];

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
                            <a href="detail.php?id=<?php echo $row['pid'] ?>" class="p-name"><?php echo $row['pname'] ?> <img src="<?php echo $row['pimg'] ?>"></a>

                        </div>
                        <!--product-details-------->
                        <div class="product-details">
                            <a href="detail.php?id=<?php echo $row['pid'] ?>" class="p-name"><?php echo $row['pname'] ?> </a>
                            <span class="p-price"><?php echo $row['pprice'] ?> </span>

                        </div>

                    </div><?php
                        }
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
                $connect = mysqli_connect('localhost', 'root', '', 'mydb');

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
                        $sql = "SELECT * FROM customer WHERE cemail ='$email' AND cpassword = '$password'";


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
                <input type="email" name="email" placeholder="Example@gmail.com" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="signup" value="Sign Up" />


                <?php

                //Kết nối theo Mysqli procedural
                $connect = mysqli_connect('localhost', 'root', '', 'mydb');

                // Nếu click vào nút login thì mới thực hiện 
                if (isset($_POST['signup'])) {
                    $xname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // Truy vấn từ bảng user cột username = giá trị username nhập từ form và cột password = giá trị password nhập từ form
                    $sql = "SELECT * FROM customer WHERE cemail ='$email' AND cpassword = '$password'";


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
                        $sql = "INSERT INTO customer VALUES('$email','$password')";
                        $result = mysqli_query($connect, $sql);
                        if ($result) {

                            echo "<script> alert('Welcome $xname')</script>";
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
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">About Us
        </h1>
        <p class="lead fw-normal">With TuneSource, it’s easy to find the right music or podcast for every moment – on your phone, your computer, your tablet and more.

            There are millions of tracks and episodes on TuneSource. So whether you’re behind the wheel, working out, partying or relaxing, the right music or podcast is always at your fingertips. Choose what you want to listen to, or let TuneSource surprise you.

            You can also browse through the collections of friends, artists, and celebrities, or create a radio station and just sit back.

            Soundtrack your life with TuneSource. Subscribe or listen for free.</p>

    </div>
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">Customer Service and Support
        </h1>
        <p class="lead fw-normal">
        <ol role="list" class="TypeList__TypeListComponent-sc-1jhixr6-0-ol AboutTuneSource__OrderedList-sc-1lhqzk3-0 habVFT dKFlOL">
            <li class="Type__TypeElement-goli3j-0 VNztd TypeListItem-q1l2mf-0 AboutTuneSource__ListItem-sc-1lhqzk3-2 icEGuI bGdpfz"><span class="Type__TypeElement-goli3j-0 hTccvd"><span class="LinkContainer-sc-1koxosv-0 jJmmXI"><a href="https://support.TuneSource.com">Help site</a>. Check out our help site for answers to your questions and to learn how to get the most out of TuneSource and your music.</span></span></li>
            <li class="Type__TypeElement-goli3j-0 VNztd TypeListItem-q1l2mf-0 AboutTuneSource__ListItem-sc-1lhqzk3-2 icEGuI bGdpfz"><span class="Type__TypeElement-goli3j-0 hTccvd"><span class="LinkContainer-sc-1koxosv-0 jJmmXI"><a href="https://community.TuneSource.com">Community</a>. Get fast support from expert TuneSource users. If there isn’t already an answer there to your question, post it and someone will quickly answer. You can also suggest and vote on new ideas for TuneSource or simply discuss music with other fans.</span></span></li>
            <li class="Type__TypeElement-goli3j-0 VNztd TypeListItem-q1l2mf-0 AboutTuneSource__ListItem-sc-1lhqzk3-2 icEGuI bGdpfz"><span class="Type__TypeElement-goli3j-0 hTccvd"><span class="LinkContainer-sc-1koxosv-0 jJmmXI"><a href="https://support.TuneSource.com/us/contact-TuneSource-support">Contact us</a>. Contact our Customer Support if you don’t find a solution on our support site or Community.</span></span></li>
            <li class="Type__TypeElement-goli3j-0 VNztd TypeListItem-q1l2mf-0 AboutTuneSource__ListItem-sc-1lhqzk3-2 icEGuI bGdpfz"><span class="Type__TypeElement-goli3j-0 hTccvd"><span class="LinkContainer-sc-1koxosv-0 jJmmXI"><a href="https://twitter.com/TuneSourceCares">@TuneSourceCares</a>. </span>Feeling sociable? Simply tweet the team and they’ll do all they can to help.</span></li>
        </ol>
        </p>

    </div>


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
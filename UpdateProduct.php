<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE-edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, intial-scale=1.0" name="viewport">
    <title>Tune Source</title>
    <!--fav-icon---------------->
    <link rel="shortcut icon" href="Images/icon.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">

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
    echo 'Welcome Admin';
    ?>
<nav>
        <!--social-links-and-phone-number----------------->

        <!--menu-bar----------------------------------------->
        <div class="navigation">
            <!--logo------------>
            <a href="index.php" class="logo"><img src="Images/icon.png"><span class="shop-name">Tune Source</span></a>
            
            

            <!--menu----------------->
            <ul class="menu">
                <li><a href="index.php">Home Page</a></li>
                <li class="shop"><a href="AddProduct.php">Add Product</a></li>
                <li><a href="UpdateProduct.php">Update Product</a>
                    
                </li>
                <li><a href="DeleteProduct.php">Delete Product</a></li>
                
            <!--right-menu----------->
            
        </div>
    </nav>

    <form method="POST" enctype="multipart/form-data">
	<table class="product-container">
		<tr> 
			<td> Product ID</td>
			<td><input type="text" name="product_id"> </td>
		</tr>
		<tr>
				<td> Product Name</td>
				<td><input type="text" name="product_name"> </td>
			</tr>
			<tr>
				<td> Product Description</td>
				<td><input type="text" name="product_desc"> </td>
			</tr>
			<tr>
				<td> Product Price</td>
				<td><input type="text" name="product_price"> </td>
			</tr>
			<tr>
				<td> Product Img</td>
				<td><input type="file" name="product_img"> </td>

			</tr>
			<tr>
				<td> Product File</td>
				<td><input type="file" name="product_file"> </td>

			</tr>
			<tr>
				<td> Product Genre</td>
				<td><input type="text" name="product_genre"> </td>

			</tr>
		<tr> 
			<td> </td>
			<td><input type="submit" name="update_product" value="Update"> </td>
		</tr>
	</table>
    </form>
    <?php 
                $connect = mysqli_connect('localhost','root','','tunesourcedb');
				if(!$connect){
					echo "Connection failed";
				}

				if(isset($_POST['update_product'])){
					$product_id= $_POST['product_id'];
					$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];


		$product_img = $_FILES['product_img']['name'];

		$product_img_tmp = $_FILES['product_img']['tmp_name'];
		move_uploaded_file($product_img_tmp, "Images/$product_img");

		$product_file = $_FILES['product_file']['name'];
		$product_file_tmp = $_FILES['product_file']['tmp_name'];
		move_uploaded_file($product_file_tmp, "Music/$product_file");
		$product_genre = $_POST['product_genre'];
		$product_genre_tmp = "";
		switch ($product_genre) {
			case "J-pop":
				$product_genre_tmp = 1;
				break;
			case "Pop";
				$product_genre_tmp = 2;
				break;
			case "Rock n Roll":
				$product_genre_tmp = 3;
				break;
			case "Hip Hop":
				$product_genre_tmp = 4;
				break;
			case "Jazz":
				$product_genre_tmp = 5;
				break;
			case "Folk music":
				$product_genre_tmp = 6;
				break;
			case "Classical music":
				$product_genre_tmp = 7;
				break;
			case "Rock":
				$product_genre_tmp = 8;
				break;
			case "Funk":
				$product_genre_tmp = 9;
				break;
		}
					//Check
                    $sql ="SELECT song_id FROM song WHERE song_id ='$product_id'";
                    $result = mysqli_query($connect,$sql);
                    if(!$result){
                        echo"<script>alert('Product Doesn't Exist') </script>";
                    }else{
					$sql = "UPDATE song SET song_name='$product_name',song_desc='$product_desc',song_price='$product_price',song_img='Images/$product_img', song_file='Music/$product_file',genre_id ='$product_genre_tmp' where song_id='$product_id'";
					$result = mysqli_query($connect,$sql);
					if($result){
						echo"<script>alert('Product Updated') </script>";
						echo"<script> window.open('UpdateProduct.php','_self') </script>";
					}
					else{
						echo"<script>alert('Error please try again') </script>";
					}
                }
            }
				
?>

<section class="new-arrival">

        
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
                      
                        <span class="p-price"><?php echo $row['song_price'] ?> </span>
						<a href="detail.php?id=<?php echo $row['song_id'] ?>" class="p-name">ID:<?php echo $row['song_id'] ?> </a>
                    </div>

                </div><?php
                    }
                        ?>

    </section>



    
    



</body>
</html>
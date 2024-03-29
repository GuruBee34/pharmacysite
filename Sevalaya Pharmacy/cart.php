<?php include 'connection.php';
if(isset($_POST['add_product'])) {
    $product_name = $_POST['p_name'];
    $product_brand = $_POST['p_brand'];
    $product_price = $_POST['MRP'];
    $product_image = $_FILES['p_img']['name'];
    $product_image_temp_name = $_FILES['p_img']['tmp_name'];
    $product_image_folder = 'images/'.$product_image;

    $insert_query = mysqli_query($conncart, "insert into `products` (p_name,p_brand,MRP,p_img) values('$product_name','$product_brand',' $product_price','$product_image')") or die("Insert query values filed");
    
    if($insert_query){
        move_uploaded_file($product_image_temp_name,$product_image_folder);
        $display_message = "Product inserted successfully";
    } else{
        $display_message = "There is some error";
    }

    

}





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products cart</title>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Style sheet-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">

    <!--Fonts Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- connection -->
    <?php include ("connection.php"); ?>
</head>
<body>
<?php include "header.php"; ?>

<!-- view bar -->
<nav class="navbar">
        <div class="navbar-links">
            <p class="navbar-link"> <a href="cart.php">Add Products</a> </p>
            <p class="navbar-link"> <a href="viewproducts.php">View products</a> </p>
        </div>
</nav>

<div class="cart_container">

    <!-- message -->
    <?php
    if(isset($display_message)) {
        echo "<div class='message'>
        <span>$display_message</span>
        <i class='fa-solid fa-xmark' onclick = 'this.parentElement.style.display=`none`';></i>
    </div>";

    }

?>

        <section>
        <img src="img/cart.png" class="cart_img">
            <h1>Add Products</h1>
            <form action="" class="add_product" method="post" enctype="multipart/form-data">

            <p> <i class="fa-solid fa-box"></i> Product Name</p>
            <input type="text" name="p_name" placeholder="eg.cerelac f6" required="">

            <p> <i class="fa-solid fa-box"></i> Product Brand</p>
            <input type="text" name="p_brand" placeholder="eg.Nestele" required="">

            <p> <i class="fa-solid fa-indian-rupee-sign"></i> Product Price</p>
            <input type="number" min="0" name="MRP" placeholder="eg.265.00" required="">

            <p>  <i class="fa-solid fa-image"></i> Choose Image</p> 
            <input type="file" name="p_img"   accept="image/png, image/jpg, image/jpeg"> 
            
            <input type="submit" name="add_product" value="Add Product">
            </form>
        </section>
    </div>












     <!-- Javascript -->
     <script src="index.js"></script>

</body>
</html>
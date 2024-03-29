<?php include 'connection.php';

if(isset($_POST['addtocart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    // allow data to insert only once
    $select_cart = mysqli_query($conncart,"Select * from `cart` where name='$product_name'");
    if(mysqli_num_rows($select_cart) > 0){
        $display_message[] =  "Product already added to your cart";
    }
    else{

    // insert data into cart table
    $insert_query = mysqli_query($conncart, "insert into `cart` (name,mrp,image,quantity) values('$product_name',' $product_price','$product_image','$product_quantity')");
    $display_message[] =  "Successfully added to your cart.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop page</title>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
    <!--Style sheet-->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="view.css"> -->
    <link rel="stylesheet" href="css/shop.css">

    <!--Fonts Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
</head>
<body>

<?php include "header.php"; ?>

    <div class="container">

            <!-- message -->
            <?php
    if(isset($display_message)) {
        foreach($display_message as $display_message) {
        echo "<div class='message'>
        <span>$display_message</span>
        <i class='fa-solid fa-xmark' onclick = 'this.parentElement.style.display=`none`';></i>
    </div>";
        }
    }

?>

        <h1>Shop Mediproducts</h1>
        <div class="product_container">

        <?php
        $select_products = mysqli_query($conncart,"Select * from `products`");
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)) {
        ?>

<form method="post" action="">

<div class="edit_form">
    <img src="images/<?php echo $fetch_product['p_img']   ?>" alt="" height="100px" >
    <h3><?php echo $fetch_product['p_name']   ?></h3>
    <p> <?php echo $fetch_product['p_brand']   ?></p>
    <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $fetch_product['MRP']   ?></p>
    <input type="hidden" name="product_name" value="<?php echo $fetch_product['p_name']   ?>" >
    <input type="hidden" name="product_price" value="<?php echo $fetch_product['MRP']   ?>" >
    <input type="hidden" name="product_image" value="<?php echo $fetch_product['p_img']   ?>" >
    <input type="submit"  value= "Add to cart" name="addtocart" >  
</div>

</form>

<?php

            }
        } else{
            echo "No products";
        }


?>
         
        
           

        </div>


    </div>
    
      <!-- Javascript -->
      <script src="index.js"></script>
</body>
</html>
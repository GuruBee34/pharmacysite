<?php include 'connection.php'; 
// update logic

if(isset($_POST['update_product'])) {
    $update_product_id = $_POST['update_id'];
    $update_product_name = $_POST['update_name'];
    $update_product_brand = $_POST['update_brand'];
    $update_product_mrp = $_POST['update_mrp'];
    $update_product_img = $_FILES['update_img']['name'];
    $update_product_image_temp_name = $_FILES['update_img']['tmp_name'];
    $update_product_image_folder = 'images/'.$update_product_img;
    

// update query
    $update_products = mysqli_query($conncart,"UPDATE `products` SET p_name = '$update_product_name',p_brand = '$update_product_brand' , MRP ='$update_product_mrp', p_img = '$update_product_img'  WHERE id = $update_product_id ");
    if($update_products){
        move_uploaded_file($update_product_image_temp_name,$update_product_image_folder);
        header('location:viewproducts.php');
    }else {
        $display_message = "There is some error in updating product.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
     <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Style sheet-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="css/edit.css">


    <!--Fonts Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<?php include "header.php"; ?>



<section class="edit_container">

    <!-- message -->
    <?php
    if(isset($display_message)) {
        echo "<div class='message'>
        <span>$display_message</span>
        <i class='fa-solid fa-xmark' onclick = 'this.parentElement.style.display=`none`';></i>
    </div>";

    }

?>

<!-- php code -->
<?php
if(isset($_GET["update"])){
    $edit_id = $_GET["update"];
//    echo $edit_id;
    $edit_query=mysqli_query($conncart,"SELECT * FROM `products` WHERE id =  $edit_id ");
    if(mysqli_num_rows($edit_query) > 0){
    ($fetch_data = mysqli_fetch_assoc($edit_query));
            // $row = $fetch_data['MRP'];
            // echo $row;
        ?>

<!-- form -->
<form action="" method="post" enctype="multipart/form-data" >
    <img src="images/<?php echo $fetch_data['p_img']?>" alt=" <?php echo $fetch_data['p_name'] ?>" height="100px" >
    <input type="hidden" value="<?php echo $fetch_data['id']?>" name="update_id">
    <input type="text" value="<?php echo $fetch_data['p_name']?>" name="update_name" placeholder="Enter new product name" required>
    <input type="text" value="<?php echo $fetch_data['p_brand']?>" name="update_brand" placeholder="Enter new product brand" required>
    <input type="number" value="<?php echo $fetch_data['MRP']?>" name="update_mrp" placeholder="Enter new product price" required>
    <input type="file" required accept="image/png, image/jpg, image/jpeg" name="update_img" >
    <input type="submit" value="Update product" class="update_btn" name="update_product"  >
    <input type="reset" id="cancel-update" value="Cancel" class="cancel_btn">
</form>

<?php      
}
    }

?>


</section>
    
  <!-- Javascript -->
  <script src="index.js"></script>
    
</body>
</html>
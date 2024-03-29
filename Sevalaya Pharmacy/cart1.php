<?php include "connection.php"; 
if (isset($_POST['update_quantity_btn'])) {
    $update_value = $_POST['update_quantity'];
    // echo $update_value;
    $update_id = $_POST['update_quantity_id'];
    // echo $update_id;
    $update_quantity_query = mysqli_query($conncart, "Update `cart` set quantity = $update_value where id = $update_id");
    if ($update_quantity_query) {
        header("location:cart1.php");
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    // echo $remove_id;
    mysqli_query($conncart,"delete from `cart` where id = $remove_id ");
    header("location:cart1.php");
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conncart,"delete from `cart`");
    header("location:cart1.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart page</title>

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
        <section class="shopping_cart">
            <h1>My cart</h1>
            <table>

            <?php
            $select_cart_products = mysqli_query($conncart, "Select * from `cart`");
            $num=01;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart_products) > 0) {
                echo"
            <thead>
                <th>Sl.No</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>";
                while($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
                    

?>
              <tr>
                    <td><?php echo $num  ?></td>
                    <td><?php echo $fetch_cart_products['name']  ?></td>
                    <td>
                        <img src="images/<?php echo $fetch_cart_products['image'] ?> " alt="BP monitor image" height="100px" >
                    </td>
                    <td> <i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $fetch_cart_products['mrp'] ?> /-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart_products['id'] ?>" name="update_quantity_id" >
                        <div class="quantity_box">
                            <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity'] ?>" name="update_quantity" >
                            <input type="submit" value="Update" class="update_quantity" name="update_quantity_btn" >
                        </div>
                        </form>
                    </td>
                    <td><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $total = number_format( $fetch_cart_products['mrp'] * $fetch_cart_products['quantity']) ?> /-</td>
                    <td>
                        <a href="cart1.php?remove=<?php echo $fetch_cart_products['id'] ?>" onclick=" return confirm('Are you sure want to remove the product')" ><i class="fa-solid fa-trash"></i> Remove</a>
                    </td> 
                    </tr>
<?php 
$grand_total += ( $fetch_cart_products['mrp'] * $fetch_cart_products['quantity']);
$num++;
                }
            }
            else {
                echo "<div class='empty'> No products </div>";
            }


?>
             
                </tbody>
            </table>

<?php   
if($grand_total > 0){

    echo "<div class='table_bottom'>
    <a href='shopproducts.php' class='bottom_btn' >Continue Shopping</a>
    <h3 class='bottom_btn'>Grand Total: $grand_total /-</h3>
    <a href='checkout.php' class='bottom_btn' >Proceed to Check Out</a>
    
</div>";

?>
       <a href="cart1.php?delete_all" onclick=" return confirm('Are you sure want to delete all product')" class="clear_all_btn" ><i class="fa-solid fa-trash"></i> Clear My Cart</a>     
<?php
}
else {
    echo "";
}
?>
            
        </section>
    </div>

      <!-- Javascript -->
      <script src="index.js"></script>
</body>
</html>
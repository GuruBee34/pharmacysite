<?php include ("connection.php");


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Style sheet-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/view.css">

    <!--Fonts Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- connection -->
     <?php include ("connection.php"); ?>

</head>
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

         <!-- search bar -->
         <div class="products_center">
    
    <!-- <form action=""> -->
        <form action="" method="GET">
    <div>
        <input type="text" class="searchbar" value= "<?php if(isset($_GET['item'])) {echo $_GET['item'];} ?>"  name="item" placeholder="search for health suppliments, devices, and cosmetics ">
        <button type="submit">Search</button>
    </form>

<div class="view_container">

<div class="table_container">
    <h2 >Search Results</h2>
<section  class="view_table_heading">

<table>
        <thead>
            <tr>
                <th>Product Id</th>
                <th class="bg_color" >Product Image</th>
                <th>Product Name</th>
                <th>Manufacturer</th>
                <th>MRP</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
          
        </tbody>

        <?php


if (isset($_GET['item'])) {
    $link = mysqli_connect('localhost','root','','sevalaya');
    $filtervalue = $_GET['item']; 
    $filterdata = "SELECT * FROM products where CONCAT(id,p_name,p_brand,MRP,p_img) LIKE '%$filtervalue%'";
    $filterdata_run = mysqli_query($link, $filterdata);

     if(mysqli_num_rows($filterdata_run) > 0) 
            {
                foreach($filterdata_run as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?> </td>
                        <td> <img src="images/<?php echo $row['p_img']; ?>" alt="<?php echo $row['p_name']; ?>" height="100px"> </td>
                        <td><?php echo $row['p_name']; ?> </td>
                        <td><?php echo $row['p_brand']; ?> </td>
                        <td><?php echo $row['MRP']; ?> </td>
                        <td>
                         <a href="deletebutton.php?delete=<?php echo $row['id']; ?>" class="delete_button" onclick="return confirm('Are you sure want to delete this product.');" ><i class="fa-solid fa-trash"></i></a>
                         <a href="updatebutton.php?update=<?php echo $row['id']; ?>" class="edit_button" ><i class="fa-solid fa-square-pen"></i></a>
                        </td>
                    </tr>

                    <?php
                }

            }
            else
            {
                ?>

                <tr>
                    <td colspan="6"> <i class="fa-solid fa-circle-exclamation"></i> No Tablet found</td>
                </tr>

                <?php
            }
        }
        
        ?>
        
</section>








</div>

  <!-- Javascript -->
  <script src="index.js"></script>
    
</body>
</html>
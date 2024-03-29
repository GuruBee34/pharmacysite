<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sevalaya</title>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Style sheet-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/searchtable.css">

    <!--Fonts Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php include "connection.php"; ?>
</head>
<body>

<?php include "header.php"; ?>


          <!-- search bar -->
<div class="products_center">
    <!-- <form action=""> -->
        <form action="" method="GET">
    <div>
        <input type="text" value= "<?php if(isset($_GET['search'])) {echo $_GET['search'];} ?>"  name="search" placeholder="search for tablets">
        <button type="submit">Search</button>
    </form>

</div>  



<div class="table_container">
    <h2 >Tablets Information</h2>

    <table class="table_data">
        <thead>
            <tr>
                <th>Tablet Name</th>
                <th>Uses</th>
                <th>Composition</th>
                <th>Tablet Information</th>
                <th>MRP</th>
                <th>Manufacturer</th>
            </tr>
        </thead>
        <tbody>
<?php


if (isset($_GET['search'])) {
    $link = mysqli_connect('localhost','root','','sevalaya');
    $filtervalue = $_GET['search']; 
    $filterdata = "SELECT * FROM medicines where CONCAT(Tabname,Uses,composition,TAbinfo,MRP,Manufacturer) LIKE '%$filtervalue%'";
    $filterdata_run = mysqli_query($link, $filterdata);

     if(mysqli_num_rows($filterdata_run) > 0) 
            {
                foreach($filterdata_run as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Tabname']; ?> </td>
                        <td><?php echo $row['Uses']; ?> </td>
                        <td><?php echo $row['composition']; ?> </td>
                        <td><?php echo $row['Tabinfo']; ?> </td>
                        <td><?php echo $row['MRP']; ?> </td>
                        <td><?php echo $row['Manufacturer']; ?> </td>
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
        </tbody>
    </table>
</div>
    


  <!-- Javascript -->
  <script src="index.js"></script>

</body>
</html>
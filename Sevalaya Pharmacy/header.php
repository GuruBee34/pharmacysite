    <!--Nav bar-->
    <nav class="navbar">
        <h1>Sevalaya Pharmacy </h1>
        <div class="navbar-links">
            <p class="navbar-link"> <a href="index.html">Home</a> </p>
            <p class="navbar-link"> <a href="cart.php">Products</a> </p>
            <p class="navbar-link"> <a href="search.php">Medicines</a> </p>
            <p class="navbar-link"> <a href="shopproducts.php">Shop</a> </p> 
            <p class="navbar-link"> <a href="">About Us</a> </p>
            <p class="navbar-link"> <a href="login.html">Login</a> </p>

            <?php
            $select_product = mysqli_query($conncart,"Select * from `cart`") or die('Query failed');
            $row_count = mysqli_num_rows($select_product);
            ?>

            <p class="navbar-link"> <a href="cart1.php"> <i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $row_count ?></sup></span></a> 
        </div>

        <div class="navbar-menu-toggle" onclick="showNavbar()">
            <i class="fa-solid fa-bars"></i>
        </div>
    </nav>

    <!-- side navbar -->
    <div class="side-navbar">
        <p style="text-align: right;" onclick="closeNavbar()">
            <i class="fa-solid fa-xmark"></i>
        </p>

        <div class="side-navbar-links">
            <p class="side-navbar-link"> <a href="index.html">Home</a> </p>
            <p class="side-navbar-link"> <a href="cart.php">Products</a> </p>
            <p class="side-navbar-link"> <a href="search.php">Medicines</a> </p>
            <p class="side-navbar-link"> <a href="">About Us</a> </p>
            <p class="navbar-link"> <a href="login.html">Login</a> </p>
        </div>
    </div>

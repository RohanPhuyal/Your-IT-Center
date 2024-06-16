<!-- navbar.php -->
<?php
$currentPage = $_SERVER['PHP_SELF'];
?>

<div class="container-fluid" style="background-color:#111827;">
    <!-- Inside the container div -->
    <div class="container">
        <div style="height: 20px;"></div>
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg custom-navbar" style="background-color:#111827;">
            <a class="navbar-brand" href="index.php">
            <img src="img/Logo.png" alt="Company Logo" class="logo">
                <!-- Logo and Company Name -->
                <!-- <i class="fa-solid fa-diamond fa-1.5x"></i> -->
                <!-- Company Name -->
            </a>
            <!-- Cart and Login/Register -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php" <?php echo ($currentPage === '/YourITCenter/cart.php') ? 'style="color: #de5832 !important;"' : ''; ?>>
                        <i class="fas fa-shopping-cart"></i> Cart (
                        <?php echo isset($_SESSION['totalCartItems']) ? $_SESSION['totalCartItems'] : '0';
                        ?> items)
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true) {
                        echo '<div class="dropdown nav-link" ';
                        echo ($currentPage === '/YourITCenter/myprofile.php') || ($currentPage === '/YourITCenter/address.php') || (($currentPage === '/YourITCenter/myorders.php')) ? 'style="color: #de5832 !important;"' : '';
                        echo '>
                        <i class="fa-solid fa-user" id="profileDropdown" role="button"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> <a id="profileDropdown" role="button"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo $_SESSION['full_name'] ?>
                        <?php echo '</a>
                        <div class="dropdown-menu dropdown-menu-right" style="background-color:#1f2937;" aria-labelledby="profileDropdown">
                          <a class="dropdown-item" href="myprofile.php" style="color:#fff;">My Profile</a>
                          <a class="dropdown-item" href="myorders.php" style="color:#fff;">My Orders</a>
                          <a class="dropdown-item" href="logout.php" style="color:#fff;">Logout</a>
                        </div>
                      </div>';
                    } else {
                        echo '<a class="nav-link" href="signin.php" ';
                        echo ($currentPage === '/YourITCenter/signin.php') ? 'style="color: #de5832 !important;"' : '';
                        echo '><i class="fa-solid fa-user"></i> Sign in</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
        <!-- Gap between top and bottom navbars -->
        <div style="height: 25px;"></div>
        <!-- Bottom Navbar -->
        <nav class="navbar navbar-expand-lg custom-navbar" style="background-color:#1f2937;">

            <!-- Navbar Toggler for small screens -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bottomNavbar"
                aria-controls="bottomNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
            </button>

            <!-- Search and Navbar Links -->
            <div class="collapse navbar-collapse" id="bottomNavbar">
                <!-- Home and Accessories -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" <?php echo ($currentPage === '/YourITCenter/index.php') ? 'style="color: #de5832 !important;"' : ''; ?>>Home</a>
                    </li><!-- Add a small whitish line between nav items -->
                    <span class="d-none d-lg-inline-block nav-divider"></span>
                    <li class="nav-item">
                        <a class="nav-link" href="accessories.php" <?php echo ($currentPage === '/YourITCenter/accessories.php') ? 'style="color: #de5832 !important;"' : ''; ?>>Accessories</a>
                    </li>
                    <span class="d-none d-lg-inline-block nav-divider"></span>
                    <li class="nav-item">
                        <a class="nav-link" href="components.php" <?php echo ($currentPage === '/YourITCenter/components.php') ? 'style="color: #de5832 !important;"' : ''; ?>>Components</a>
                    </li>
                    <span class="d-none d-lg-inline-block nav-divider"></span>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php" <?php echo ($currentPage === '/YourITCenter/contactus.php') ? 'style="color: #de5832 !important;"' : ''; ?>>Contact Us</a>
                    </li>
                    <span class="d-none d-lg-inline-block nav-divider"></span>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php" <?php echo ($currentPage === '/YourITCenter/aboutus.php') ? 'style="color: #de5832 !important;"' : ''; ?>>About Us</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-auto" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" name="search"
                            aria-describedby="search-icon" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-light custom-search" type="submit" id="search-icon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>
</div>
<div style="height: 25px;"></div>
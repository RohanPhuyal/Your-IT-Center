<!-- Top Bar -->
<?php
$currentPage = $_SERVER['PHP_SELF'];
?>
<div class="top-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 d-flex align-items-center">
                    <button class="navbar-toggler d-block d-sm-none" type="button" data-toggle="collapse"
                        data-target="#collapseSidebar" aria-expanded="false" aria-controls="collapseSidebar">
                        <i class="fa-solid fa-bars" style="color: #FFD43B;"></i>
                    </button>
                    <?php 
                    if($currentPage === '/Admin/index.php'){
                        echo '<h2 class="text-white mb-0">Dashboard</h2>';
                    }
                    else if($currentPage === '/Admin/products.php'){
                        echo '<h2 class="text-white mb-0">Products</h2>';
                    }
                    else if($currentPage === '/Admin/orders.php'){
                        echo '<h2 class="text-white mb-0">Orders</h2>';
                    }
                    else if($currentPage === '/Admin/customers.php'){
                        echo '<h2 class="text-white mb-0">Customers</h2>';
                    }
                    else if($currentPage === '/Admin/viewreceipt.php'){
                        echo '<h2 class="text-white mb-0">Receipt</h2>';
                    }
                     ?>
                </div>
                <div class="col-6 text-right">
                    <div class="dropdown">
                        <i class="fas fa-user-circle fa-2x your-profile-icon" id="profileDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown" style="z-index:999;">
                            <a class="dropdown-item" href="#">Admin</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
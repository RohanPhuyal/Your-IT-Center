<!-- sidebar.php -->
<?php
$currentPage = $_SERVER['PHP_SELF'];
?>
<style>
    .custom-link i{
        color:#de5832 !important;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="collapse d-sm-block" id="collapseSidebar">
                <div id="sidebar">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-box fa-4x" style="color:#fff;"></i></a>
                        <nav class="navbar navbar-expand-lg navbar-dark">
                            <ul class="navbar-nav flex-column">
                                <li class="nav-item <?php echo ($currentPage === '/Admin/index.php') ? 'custom-link' : ''; ?>">
                                    <a class="nav-link" href="index.php" style="font-size: 1.5em;"><i class="fas fa-home"></i> Dashboard</a>
                                </li>
                                <li class="nav-item <?php echo ($currentPage === '/Admin/orders.php') ? 'custom-link' : ''; ?>">
                                    <a class="nav-link" href="orders.php" style="font-size: 1.5em;"><i class="fas fa-shopping-cart"></i> Orders</a>
                                </li>
                                <li class="nav-item <?php echo ($currentPage === '/Admin/products.php') ? 'custom-link' : ''; ?>">
                                    <a class="nav-link" href="products.php" style="font-size: 1.5em;"><i class="fas fa-cube"></i> Products</a>
                                </li>
                                <li class="nav-item <?php echo ($currentPage === '/Admin/customers.php') ? 'custom-link' : ''; ?>">
                                    <a class="nav-link" href="customers.php" style="font-size: 1.5em;"><i class="fas fa-users"></i> Customers</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


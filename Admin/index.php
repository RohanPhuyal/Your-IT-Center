<?php
session_start();
if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] === false) {
  header("Location: login.php");
  exit();
}
require_once("db/dbconnect.php");

// Prepare statements
$stmtProduct = $conn->prepare("SELECT COUNT(*) as product_count FROM products");
$stmtCustomers = $conn->prepare("SELECT COUNT(*) as customer_count FROM customers");
$stmtOrders = $conn->prepare("SELECT COUNT(*) as orders_count FROM Orders");
$stmtTotalOrders = $conn->prepare("SELECT SUM(price) AS total_price FROM Orders WHERE payment_status = 'Completed' AND order_status!='Cancelled'");

// Execute statements
$stmtProduct->execute();
$productResult = $stmtProduct->get_result();
$productCount = $productResult->fetch_assoc()['product_count'];

$stmtCustomers->execute();
$customerResult = $stmtCustomers->get_result();
$customerCount = $customerResult->fetch_assoc()['customer_count'];

$stmtOrders->execute();
$ordersResult = $stmtOrders->get_result();
$ordersCount = $ordersResult->fetch_assoc()['orders_count'];
$stmtTotalOrders->execute();
$totalOrdersResult = $stmtTotalOrders->get_result();
$totalOrderPrice = $totalOrdersResult->fetch_assoc()['total_price'];

if($totalOrderPrice===null){
  $totalOrderPrice=0;
}

// Close statements
$stmtProduct->close();
$stmtCustomers->close();
$stmtOrders->close();

?>
<!-- index.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-Dk4Hp2xl3tS+YiPP32iFlJ8zPWZZK4r44z6tQtW7zRmipkVTe3F2bBHQk+lwYfCsk/dn4a63tcjzg+wGRC2HYw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="styles.css" />
  <title>Dashboard</title>
</head>

<body>
  <!-- Include the navbar -->
  <?php include 'topbar.php'; ?>
  <?php include 'sidebar.php'; ?>
  <div id="content">
    <div class="container mt-4">
      <div class="row">
        <!-- Total Orders -->
        <div class="col-md-3">
          <div class="card text-white" style="background-color: #2563eb; border: 1px solid #FFFFFF;">
            <div class="card-body">
              <h5 class="card-title">Total Orders</h5>
              <p class="card-text"><?php echo $ordersCount; ?></p>
            </div>
          </div>
        </div>

        <!-- Total Products -->
        <div class="col-md-3">
          <div class="card text-white" style="background-color: #16a34a; border: 1px solid #FFFFFF;">
            <div class="card-body">
              <h5 class="card-title">Total Products</h5>
              <p class="card-text">
                <?php echo $productCount; ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Total Customers -->
        <div class="col-md-3">
          <div class="card text-white" style="background-color: #ea580c; border: 1px solid #FFFFFF;">
            <div class="card-body">
              <h5 class="card-title">Total Customers</h5>
              <p class="card-text">
                <?php echo $customerCount ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-md-3">
          <div class="card text-white" style="background-color: #9333ea; border: 1px solid #FFFFFF;">
            <div class="card-body">
              <h5 class="card-title">Total Revenue</h5>
              <p class="card-text">Rs. <?php echo $totalOrderPrice; ?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Include the graph -->
      <?php
       include 'graph.php'; 
       ?>

    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
    crossorigin="anonymous"></script>
  <!-- Font Awesome script -->
  <script src="https://kit.fontawesome.com/e9e35ad4cc.js" crossorigin="anonymous"></script>
</body>

</html>
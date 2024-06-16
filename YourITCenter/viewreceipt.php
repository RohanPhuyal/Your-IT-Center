<!-- index.php -->
<?php
// Start the session
session_start();
require_once("db/dbconnect.php");
if (!isset($_SESSION["isLoggedIn"]) && $_SESSION['isLoggedIn'] != true) {
    header("Location: index.php");
}
// if(!isset($_POST['transaction_id'])&&$_POST['transaction_id']===null||!isset($_GET['transaction_id'])){
//     header("Location: index.php");
// }
?>
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
    <style>
    body {
      padding: 20px;
      color: #fff; /* Set text color to white */
      /* background-color: #1f2937; Set background color */
    }
    .receipt-container {
        background-color: #1f2937;
      max-width: 600px;
      margin: 0 auto;
      border: 1px solid #111827; /* Add border */
      padding: 20px;
      border-radius: 8px; /* Add border radius */
    }
    .list-group-item {
      background-color: #111827; /* Set background color for list items */
      border: none; /* Remove border */
    }
    .list-group-item:last-child {
      border-bottom: none; /* Remove bottom border for the last list item */
    }
  </style>
    <title>Sign In</title>
</head>

<body>
    <!-- including navbar  -->
    <?php include 'nav_foot/navbar.php'; ?>

    <div class="container">
        <!-- including signin  -->
        <?php
        if(isset($_POST['transaction_id'])){
            $transaction_id=$_POST['transaction_id'];
        }
        else if(isset($_GET['transaction_id'])){
            $transaction_id=$_GET['transaction_id'];

        }else{
            header("Location: index.php");
        }
            $stmt_receipt = $conn->prepare("SELECT description,status FROM receipt WHERE transaction_id = ?");
            $stmt_receipt->bind_param("s",$transaction_id);
            $stmt_receipt->execute();
            $result_receipt = $stmt_receipt->get_result();
            $product = $result_receipt->fetch_assoc();
            echo $product['description'];
            if($product['status']==="Paid"){
                echo '<span class="ml-5"><strong>Payment Status: </strong>Paid</span></p></div>';
            }
            if($product['status']==="Unpaid"){
                echo '<span class="ml-5"><strong>Payment Status: </strong>Unpaid</span></p></div>';
            }
        ?>
    </div>
    <div style="height: 55px;"></div>
    <!-- including footer  -->
    <?php include 'nav_foot/footer.php'; ?>
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
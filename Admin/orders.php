<!-- index.php -->
<?php
session_start();
if(isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin']===false){
    header("Location: login.php");
    exit();
}
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
    <title>Orders</title>
</head>

<body>
    <!-- Include the navbar -->
    <?php include 'topbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div id="content">
            <div class="w-100 mx-auto"> <!-- Use Bootstrap w-75 class to set width to 75% -->
            <?php include 'orderslist.php'; ?>
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
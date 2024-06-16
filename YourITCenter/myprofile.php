<!-- index.php -->
<?php
// Start the session
session_start();
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
  <title>My Profile</title>
  <style>
    .active {
      background-color: #de5832 !important;
      border-bottom: 1px solid #fff !important;
      border-top: #16a34a !important;
      border-left: #16a34a !important;
      border-right: #16a34a !important;
    }
  </style>
</head>

<body>
  <!-- including navbar  -->
  <?php include 'nav_foot/navbar.php'; ?>

  <!-- Bootstrap Toast for login success -->
  <div class="toast editSuccess" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Edit Complete</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      You have successfully Edited info.
    </div>
  </div>
  <!-- Bootstrap Toast for wrong password -->
  <div class="toast wrongPassword" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #dc3545;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Failed: Wrong Password</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Please Enter Correct Password.
    </div>
  </div>

  <div class="container">
    <!-- including profilenav  -->
    <?php include 'profile/profilenav.php'; ?>
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

  <!-- toast  -->
  <script>
    // Check if the session variable is set and display toast accordingly
    <?php
    if (isset($_SESSION['isEditedSuccess']) && $_SESSION['isEditedSuccess'] === true) {
      ?>
      // Show toast message
      $('.editSuccess').toast('show');
      <?php
      unset($_SESSION['isEditedSuccess']); // Clear the session variable
    }
    if (isset($_SESSION['isIncorrectPassword']) && $_SESSION['isIncorrectPassword'] === true) {
      ?>
      // Show toast message
      $('.wrongPassword').toast('show');
      document.getElementById("password_error").style.display = "block";
      <?php
      unset($_SESSION['isIncorrectPassword']); // Clear the session variable
    }
    ?>
  </script>
</body>

</html>
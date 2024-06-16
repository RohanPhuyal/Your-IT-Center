<!-- index.php -->
<?php
// Start the session
session_start();
if (isset($_SESSION["isLoggedIn"]) && $_SESSION['isLoggedIn'] === true) {
  header("Location: index.php");
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
  <title>Sign In</title>
</head>

<body>
  <!-- including navbar  -->
  <?php include 'nav_foot/navbar.php'; ?>

  <div class="container">
    <!-- including signin  -->
    <?php include 'logins/signinform.php'; ?>
  </div>
  <div style="height: 55px;"></div>

  <!-- Bootstrap Toast for login failed -->
  <div class="toast loginFailed" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #dc3545;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Login Failed</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Please Check your Credentials.
    </div>
  </div>

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

  <script>
    // Check if the session variable is set and display toast accordingly
    <?php
    if (isset($_SESSION['login_failed']) && $_SESSION['login_failed'] === true) {
      ?>
      // Show toast message
      $('.loginFailed').toast('show');
      document.getElementById("password_error").style.display = "block";
      <?php
      unset($_SESSION['login_failed']); // Clear the session variable
    }
    ?>
  </script>
</body>

</html>
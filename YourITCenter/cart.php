<!-- cart.php -->
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
  <title>Cart</title>
</head>

<body>
  <!-- including navbar  -->
    <?php include 'nav_foot/navbar.php'; ?>
  <div class="container">
    <!-- including cart  -->
    <?php include 'products/carttable.php'; ?>
  </div>
  <!-- Bootstrap Toast for cart success -->
  <div class="toast cartSession" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Add to cart success.(Not Logged In)
    </div>
  </div>
  <!-- Bootstrap Toast for cart quantity success -->
  <div class="toast cartSessionQuantity" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Quantity Increased.(Not Logged In)
    </div>
  </div>
  <!-- Bootstrap Toast for cart db success -->
  <div class="toast cartDB" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Add to cart success.(User)
    </div>
  </div>
  <!-- Bootstrap Toast for cart  db success -->
  <div class="toast cartDBQuantity" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Quantity Increased.(User)
    </div>
  </div>
  <!-- Bootstrap Toast for cart  db success -->
  <div class="toast removeSuccess" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #16a34a;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Success: Remove Item</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Item Removed.
    </div>
  </div>
  <!-- Bootstrap Toast for cart(pidmiss) failed -->
  <div class="toast cartFailed" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #dc3545;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Failed: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Please Try Again.
    </div>
  </div>
  <!-- Bootstrap Toast for cart(pidmiss) failed -->
  <div class="toast notEnoughQuantity" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
    style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header" style="background-color: #dc3545;color:#fff">
      <!-- <img src="..." class="rounded mr-2" alt="..."> -->
      <strong class="mr-auto">Failed: Add to Cart</strong>
      <small style="color:#e2e2e2;">0 second ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body" style="background-color: #1f2937;color:#fff">
      Not Enough Stock.
    </div>
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
    if (isset($_SESSION['cartSession']) && $_SESSION['cartSession'] === true) {
      ?>
      // Show toast message
      $('.cartSession').toast('show');
      <?php
      unset($_SESSION['cartSession']); // Clear the session variable
    }
    if (isset($_SESSION['cartSessionQuantity']) && $_SESSION['cartSessionQuantity'] === true) {
      ?>
      // Show toast message
      $('.cartSessionQuantity').toast('show');
      <?php
      unset($_SESSION['cartSessionQuantity']); // Clear the session variable
    }
    if (isset($_SESSION['cartFailed']) && $_SESSION['cartFailed'] === true) {
      ?>
      // Show toast message
      $('.cartFailed').toast('show');
      <?php
      unset($_SESSION['cartFailed']); // Clear the session variable
    }
    if (isset($_SESSION['cartDB']) && $_SESSION['cartDB'] === true) {
      ?>
      // Show toast message
      $('.cartDB').toast('show');
      <?php
      unset($_SESSION['cartDB']); // Clear the session variable
    }
    if (isset($_SESSION['cartDBQuantity']) && $_SESSION['cartDBQuantity'] === true) {
      ?>
      // Show toast message
      $('.cartDBQuantity').toast('show');
      <?php
      unset($_SESSION['cartDBQuantity']); // Clear the session variable
    }
    if (isset($_SESSION['notEnoughQuantity']) && $_SESSION['notEnoughQuantity'] === true) {
      ?>
      // Show toast message
      $('.notEnoughQuantity').toast('show');
      <?php
      unset($_SESSION['notEnoughQuantity']); // Clear the session variable
    }
    if (isset($_SESSION['removeSuccess']) && $_SESSION['removeSuccess'] === true) {
      ?>
      // Show toast message
      $('.removeSuccess').toast('show');
      <?php
      unset($_SESSION['removeSuccess']); // Clear the session variable
    }
    ?>
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var quantityForms = document.querySelectorAll('.quantity-form');

      quantityForms.forEach(function (form) {
        var quantityInput = form.querySelector('input[name="quantity"]');
        var decreaseButton = form.querySelector('[data-action="decrease"]');
        var increaseButton = form.querySelector('[data-action="increase"]');

        decreaseButton.addEventListener('click', function () {
          var currentValue = parseInt(quantityInput.value);
          if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            form.submit(); // Submit the form after updating the quantity
          }
        });

        increaseButton.addEventListener('click', function () {
          var currentValue = parseInt(quantityInput.value);
          quantityInput.value = currentValue + 1;
          form.submit(); // Submit the form after updating the quantity
        });

        // Automatically submit the form when the quantity changes
        quantityInput.addEventListener("change", function () {
          form.submit();
        });
      });
    });
  </script>

</body>

</html>
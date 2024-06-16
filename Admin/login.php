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
    <title>Sign In</title>
</head>

<body>
    <br>
    <div class="container">
        <!-- Logo Section -->
        <div class="text-center mb-5">
            <img src="img/Logo.png" alt="Company Logo" class="logo">
            <h2 class="display-4">Welcome to</h2>
            <h1 class="display-1 font-weight-bold text-uppercase">Admin Panel</h1>
        </div>
        <!-- Sign In Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center"
                        style="background-color:#1f2937; color:#fff; font-size:24px; font-weight:700;  border-bottom: 1px solid white;">
                        Sign In
                    </div>
                    <div class="card-body" style="background-color:#1f2937; color:#fff;">
                        <form action="db/signin.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <!-- Error message for password mismatch -->
                                <div id="password_error" class="text-danger" style="display: none;">Email or Password do
                                    not match</div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
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
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
    <title>Your IT Center</title>
    <style>
        .custom-header {
            color: #de5832;
        }
        .icon-margin-right {
            margin-right: 15px;
            margin-top: 5px;
            /* color: #de5832; */
        }
    </style>
</head>

<body>
    <!-- including navbar  -->
    <?php include 'nav_foot/navbar.php'; ?>
    <div style="height:10px"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="custom-header">WHO WE ARE?</h2>
                    <p>Your IT Center, established in 2018 and located in New Road, Kathmandu, specializes in building
                        custom desktops and selling PC accessories and components in Nepal. We import high-quality
                        components, primarily from China, and have built a reputation as one of the best shops for
                        desktops and computer peripherals for home or office use.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-shipping-fast fa-2x icon-margin-right"></i>
                            <div>
                                <h4 class="custom-header">Nationwide Shipping</h4>
                                <p>We offer reliable worldwide shipping for our genuine products, ensuring they reach
                                    you no matter which city you are.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-money-check-alt fa-2x icon-margin-right"></i>
                            <div>
                                <h4 class="custom-header">Secure Payment</h4>
                                <p>We ensure your payment information is secure and confidential, offering a safe
                                    shopping experience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-thumbs-up fa-2x icon-margin-right"></i>
                            <div>
                                <h4 class="custom-header">Best Quality</h4>
                                <p>We never compromise on quality. Our products are genuine and authentic, ensuring you
                                    get the best value for your money.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="far fa-heart fa-2x icon-margin-right"></i>
                            <div>
                                <h4 class="custom-header">Best Offers</h4>
                                <p>Take advantage of our special offers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height:10px"></div>
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
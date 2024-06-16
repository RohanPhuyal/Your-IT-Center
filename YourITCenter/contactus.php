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
            color:#de5832
        }
    </style>
</head>

<body>
    <!-- including navbar  -->
    <?php include 'nav_foot/navbar.php'; ?>
    <div style="height:30px"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <h1 class="custom-header">Say Hello.</h1>
                    <p>Need help? Contact us right now!</p>
                    <hr>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map icon-margin-right"></i>Nachche Galli, Newroad, Kathmandu, Nepal, 44600
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope icon-margin-right"></i>yekraj@youritcenter.com
                        </li>
                        <li class="mb-2" style="color:#de5832">
                                <i class="fas fa-phone icon-margin-right"></i>01-5713548
                        </li>
                        <li>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d525.1047794398411!2d85.31272151320525!3d27.702777037423342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b5d3c8f515%3A0x29212ef8bb24d3c3!2sYour%20IT%20Center!5e0!3m2!1sen!2snp!4v1717252101293!5m2!1sen!2snp" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="custom-header">Ask Your Queries</h3>
                <form id="contact-form" method="post" action="#">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #de5832 !important; border-color:#de5832 !important;">SEND MESSAGE</button>
                </form>
            </div>
        </div>
    </div>
    <div style="height:30px"></div>
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
<script>
    // Function to validate password and confirm password fields
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        // Check if passwords match
        if (password != confirm_password) {
            // Show error message
            document.getElementById("password_error").style.display = "block";
            return false;
        }
        return true;
    }
</script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="background-color:#1f2937; color:#fff; font-size:24px; font-weight:700; border-bottom: 1px solid white;">
                    Register
                </div>
                <div class="card-body" style="background-color:#1f2937; color:#fff;">
                    <form action="logins/verify/registerdb.php" method="POST" onsubmit="return validatePassword();">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <!-- Error message for password mismatch -->
                            <div id="password_error" class="text-danger" style="display: none;">Password and Confirm Password do not match</div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                    <p class="mt-3 mb-0">Already have an account? <a href="signin.php">Sign In</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

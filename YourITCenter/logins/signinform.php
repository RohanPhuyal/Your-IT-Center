<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="background-color:#1f2937; color:#fff; font-size:24px; font-weight:700;  border-bottom: 1px solid white;">
                        Sign In
                    </div>
                    <div class="card-body" style="background-color:#1f2937; color:#fff;">
                        <form action="logins/verify/signindb.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <!-- Error message for password mismatch -->
                            <div id="password_error" class="text-danger" style="display: none;">Email or Password do not match</div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </form>
                        <p class="mt-3 mb-0">Don't have an ID yet? <a href="register.php">Register Now</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
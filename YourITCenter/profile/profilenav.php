<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="myprofile.php"
                    class="list-group-item list-group-item-action custom-list active">Profile</a>
                <a href="address.php" class="list-group-item list-group-item-action custom-list">Address</a>
                <a href="myorders.php" class="list-group-item list-group-item-action custom-list">My Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <div id="profile" class="mb-5">
                <h3>Profile</h3>
                <form action="profile/db/profiledb.php" method="POST">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" name="fullName" placeholder="<?php echo $_SESSION['full_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword"
                            placeholder="Enter your current password">
                            <!-- Error message for password mismatch -->
                            <div id="password_error" class="text-danger" style="display: none;">Please enter correct password</div>
                    </div>
                    <button type="submit" class="btn btn-success">Save Profile</button>
                </form>

            </div>
        </div>
    </div>
</div>
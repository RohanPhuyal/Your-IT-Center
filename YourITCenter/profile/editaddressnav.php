<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="myprofile.php" class="list-group-item list-group-item-action custom-list">Profile</a>
                <a href="address.php" class="list-group-item list-group-item-action custom-list active">Address</a>
                <a href="myorders.php" class="list-group-item list-group-item-action custom-list">My Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <div id="address" class="mb-5">
                <h3>Edit Address Book</h3>
                <form action="profile/db/addressdb.php" method="POST">
                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" name="province" placeholder="Enter your province">
                    </div>
                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" name="district" placeholder="Enter your district">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter your address">
                    </div>

                    <!-- Shipping Address -->
                    <h4>Shipping Address</h4>
                    <div class="form-group">
                        <label for="shippingProvince">Province</label>
                        <input type="text" class="form-control" name="shippingProvince"
                            placeholder="Enter shipping province">
                    </div>
                    <div class="form-group">
                        <label for="shippingDistrict">District</label>
                        <input type="text" class="form-control" name="shippingDistrict"
                            placeholder="Enter shipping district">
                    </div>
                    <div class="form-group">
                        <label for="shippingAddress">Address</label>
                        <input type="text" class="form-control" name="shippingAddress"
                            placeholder="Enter shipping address">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Address</button>
                </form>


            </div>
        </div>
    </div>
</div>
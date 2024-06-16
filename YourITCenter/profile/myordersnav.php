<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="myprofile.php" class="list-group-item list-group-item-action custom-list">Profile</a>
                <a href="address.php" class="list-group-item list-group-item-action custom-list">Address</a>
                <a href="myorders.php" class="list-group-item list-group-item-action custom-list active">My Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <div id="myOrders" class="mb-5">
                <!-- <h3>My Orders</h3> -->
                <!-- My Orders Content Goes Here -->
                <p><?php include 'myorderslist.php'; ?></p>
            </div>
        </div>
    </div>
</div>
<?php
require_once("db/dbconnect.php");
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM customers WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Fetching row
    $row = $result->fetch_assoc();

    // Check if the values are not null
    if ($row['phone'] === null || $row['address'] === null || $row['shipping_address'] === null) {
        echo '<div class="container mt-5">
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
                        <h3>Address Book</h3>
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
        </div>';
    } else {
        echo '<div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="myprofile.php" class="list-group-item list-group-item-action custom-list">Profile</a>
                        <a href="address.php" class="list-group-item list-group-item-action custom-list active">Address</a>
                        <a href="myorders.php" class="list-group-item list-group-item-action custom-list">My Orders</a>
                    </div>
                </div>
                <div class="col-md-9">';
        echo '<!-- Customer -->
                    <div class="row mt-4">
                      <div class="col-md-16">
                        <div class="card border" style="background-color: #09090b; border: 1px solid #FFFFFF;">
                          <div class="card-body">
                            <h3 class="text-white mb-4">My Address</h3>
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th style="color:#a1a19b;">Name</th>
                                    <th style="color:#a1a19b;">Email</th>
                                    <th style="color:#a1a19b;">Phone</th>
                                    <th style="color:#a1a19b;">Address</th>
                                    <th style="color:#a1a19b;">Shipping Address</th>
                                    <th style="color:#a1a19b;">Edit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td class="text-white">'.$row['name'].'</td>
                                    <td class="text-white">'.$row['email'].'</td>
                                    <td class="text-white">'.$row['phone'].'</td>
                                    <td class="text-white">'.$row['address'].'</td>
                                    <td class="text-white">'.$row['shipping_address'].'</td>
                                    <td>
                                    <a href="editaddress.php">
                                      <button class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      </a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    ';
        echo '</div>
            </div>
        </div>';
    }
} else {
    // No rows found
    echo "No data found";
}

$stmt->close();
?>
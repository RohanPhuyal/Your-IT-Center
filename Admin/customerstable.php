<?php
// session_start();
?>
<!-- Customer -->
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card border" style="background-color: #09090b; border: 1px solid #FFFFFF;">
      <div class="card-body">
        <h3 class="text-white mb-4">Customers</h3>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="color:#a1a19b;">Customer ID</th>
                <th style="color:#a1a19b;">Name</th>
                <th style="color:#a1a19b;">Email</th>
                <th style="color:#a1a19b;">Phone</th>
                <th style="color:#a1a19b;">Address</th>
                <th style="color:#a1a19b;">Shipping Address</th>
                <th style="color:#a1a19b;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once("db/dbconnect.php");

              // Prepare and bind statement
              $stmt = $conn->prepare("SELECT * FROM customers");

              // Execute the statement
              if ($stmt->execute() === TRUE) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {

                  $customerID = $row["customer_id"];
                  $name = $row["name"];
                  $email = $row["email"];
                  $phone = $row["phone"];
                  $address = $row["address"];
                  $shippingAddress = $row["shipping_address"];

                  echo '
                        <tr>
                          <td class="text-white">#C' . $customerID . '</td>
                          <td class="text-white">' . $name . '</td>
                          <td class="text-white">' . $email . '</td>
                          <td class="text-white">' . $phone . '</td>
                          <td class="text-white">' . $address . '</td>
                          <td class="text-white">' . $shippingAddress . '</td>
                          <td>
                            <button class="btn btn-primary me-2">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </td>
                        </tr>';
                }

              } else {
                // Error occurred while updating address
                echo "Error: " . $stmt->error;
              }

              $stmt->close();
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
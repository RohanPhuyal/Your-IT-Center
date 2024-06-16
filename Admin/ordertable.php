<!-- Orders and Revenue -->
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card border" style="background-color: #09090b; border: 1px solid #FFFFFF;">
      <div class="card-body">
        <h3 class="text-white mb-4">Orders</h3>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="color:#a1a19b;">Order ID</th>
                <th style="color:#a1a19b;">Product ID</th>
                <th style="color:#a1a19b;">Image</th>
                <th style="color:#a1a19b;">Name</th>
                <th style="color:#a1a19b;">Customer ID</th>
                <th style="color:#a1a19b;">Customer Email</th>
                <th style="color:#a1a19b;">Price</th>
                <th style="color:#a1a19b;">Status</th>
                <!-- <th style="color:#a1a19b;">Action</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              require_once("db/dbconnect.php");
              // Prepare and bind statement
              $stmt = $conn->prepare("SELECT * FROM Orders");

              // Execute the statement
              if ($stmt->execute() === TRUE) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                  $productID = $row['product_id'];
                  $orderID = $row['order_id'];
                  $name = $row['name'];
                  $customer_id = $row['customer_id'];
                  $customer_email = $row['customer_email'];
                  $status = $row['status'];
                  $price = $row['price'];
                  $transaction_id = $row['transaction_id'];

                  $stmt_product = $conn->prepare("SELECT image_path FROM products WHERE product_id = ?");
                  $stmt_product->bind_param("i", $productID);
                  $stmt_product->execute();
                  $result_product = $stmt_product->get_result();
                  $product = $result_product->fetch_assoc();

                  $imagepath = $product['image_path'];
                  $imagePathArray = explode(',', $imagepath);
                  $firstImage = $imagePathArray[0];

                  echo '
                  <tr id="clickable-row" onclick="openProduct(\'' . $transaction_id . '\')">
                        <td class="text-white">#O' . $orderID . '</td>
                        <td class="text-white">#P' . $productID . '</td>
                        <td><img src="../YourITCenter/' . $firstImage . '" alt="img" style="max-height: 90px; max-width:60px;"</td>
                        <td class="text-white">' . $name . ' 12</td>
                        <td class="text-white">#C' . $customer_id . '</td>
                        <td class="text-white">' . $customer_email . '</td>
                        <td class="text-white">Rs. ' . $price . '</td>
                        <td>';
                  if ($status === "Completed") {
                    echo '<a href="#"><span class="badge badge-success" onclick="updateStatus(' . $orderID . ', \'' . $status . '\')">' . $status . '</span></a>';
                  }
                  if ($status === "Pending") {
                    echo '<a href="#"><span class="badge badge-warning" onclick="updateStatus(' . $orderID . ', \'' . $status . '\')">' . $status . '</span></a>';
                  }
                  if ($status === "Refunded") {
                    echo '<a href="#"><span class="badge badge-info" onclick="updateStatus(' . $orderID . ', \'' . $status . '\')">' . $status . '</span></a>';
                  }
                  if ($status === "Initiated") {
                    echo '<a href="#"><span class="badge badge-primary" onclick="updateStatus(' . $orderID . ', \'' . $status . '\')">' . $status . '</span></a>';
                  }
                  if ($status === "Inactive") {
                    echo '<a href="#"><span class="badge badge-danger" onclick="updateStatus(' . $orderID . ', \'' . $status . '\')">' . $status . '</span></a>';
                  }
                  echo '</td>
                      </tr>';
                  /*
                  <td>
                      <button class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>*/
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function updateStatus(orderID, currentStatus) {
    // Send an AJAX request to update the status
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Update the UI if the status was successfully updated
          // You can handle the response from the server here if needed
          location.reload(); // Refresh the page to reflect the updated status
        } else {
          console.error("Error updating status");
        }
      }
    };
    xhr.send("orderID=" + orderID + "&currentStatus=" + currentStatus);
  }
    function openProduct(transaction_id){
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'http://localhost/Admin/viewreceipt.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'transaction_id';
        input.value = transaction_id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script>
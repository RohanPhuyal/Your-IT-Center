<!-- Orders and Revenue -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border" style="background-color: #09090b; border: 1px solid #FFFFFF;">
            <div class="card-body">
                <h3 class="text-white mb-4">My Orders</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="color:#a1a19b;">Order ID</th>
                                <th style="color:#a1a19b;">Image</th>
                                <th style="color:#a1a19b;">Name</th>
                                <th style="color:#a1a19b;">Ordered By</th>
                                <th style="color:#a1a19b;">Total Amount</th>
                                <th style="color:#a1a19b;">Status</th>
                                <!-- <th style="color:#a1a19b;">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("db/dbconnect.php");
                            // Prepare and bind statement
                            $stmt = $conn->prepare("SELECT * FROM Orders WHERE customer_id=?");
                            $stmt->bind_param("i", $_SESSION['user_id']);

                            // Execute the statement
                            if ($stmt->execute() === TRUE) {
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $productID = $row['product_id'];
                                    $transaction_id = $row['transaction_id'];
                                    $orderID = $row['order_id'];
                                    $name = $row['name'];
                                    $customer_id = $row['customer_id'];
                                    $customer_email = $row['customer_email'];
                                    $status = $row['status'];
                                    $price = $row['price'];

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
                        <td><img src="' . $firstImage . '" alt="img" style="max-height: 90px; max-width:60px;"</td>
                        <td class="text-white">' . $name . '</td>
                        <td class="text-white">' . $_SESSION['full_name'] . '</td>
                        <td class="text-white">Rs. ' . $price . '</td>
                        <td>';
                                    if ($status === "Completed") {
                                        echo '<span class="badge badge-success">Completed</span>';
                                    }
                                    if ($status === "Pending") {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    }
                                    if ($status === "Refunded") {
                                        echo '<span class="badge badge-info">Refunded</span>';
                                    }
                                    if ($status === "Initiated") {
                                        echo '<span class="badge badge-primary">Initiated</span>';
                                    }
                                    if ($status === "Inactive") {
                                        echo '<span class="badge badge-danger">Inactive</span>';
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
    function openProduct(transaction_id){
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'http://localhost/YourITCenter/viewreceipt.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'transaction_id';
        input.value = transaction_id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script>
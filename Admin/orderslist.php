<!-- <div class="order-container" style="background-color: #1f2937; padding: 15px;">
    <div class="row" style="border-bottom: 1px solid #ccc;">
        <div class="col-md-8">
            <div class="order-info">
                <p class="order-number">Order #207667559292503</p>
                <p class="order-date">Placed on 05 Feb 2024 20:32:21</p>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a href="#" class="btn btn-primary">Manage</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-2">
            <img src="image.jpg" alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-2">
            <p>Title</p>
        </div>
        <div class="col-md-2">
            <p>Qty:</p>
        </div>
        <div class="col-md-6">
            <span class="delivered-text">Delivered</span>
        </div>
    </div>
</div> -->

<?php
require_once("db/dbconnect.php");

// Execute a separate query to count the total number of items
$countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM orders");
$countStmt->execute();
$countResult = $countStmt->get_result();
$countRow = $countResult->fetch_assoc();
$totalItems = $countRow['total'];

// Calculate the current page number
$currentPage = isset ($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset based on the current page number and items per page
$offset = ($currentPage - 1) * 6; // Assuming you want 4 items per page


// Prepare and execute SQL statement to retrieve orders for the logged-in customer
$stmt_orders = $conn->prepare("SELECT * FROM orders LIMIT 6 OFFSET ?");
$stmt_orders->bind_param('i', $offset);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
$num_rows = $result_orders->num_rows;
if($num_rows>0){
    

// Loop through each order
while ($order_row = $result_orders->fetch_assoc()) {
    $order_id = $order_row['order_id'];
    // $quantity = $order_row['quantity'];
    $product_ids = explode(',', $order_row['product_id']);
    $quantity = explode(',', $order_row['quantity']);
    $i=0;

    echo '<div class="order-container" style="background-color: #1f2937; padding: 15px;">
            <div class="row" style="border-bottom: 1px solid #ccc;">
                <div class="col-md-8">
                    <div class="order-info">
                        <p class="order-number">Order <a href="viewreceipt.php?transaction_id='.$order_row['transaction_id'].'">#O' . $order_id . '</a></p>
                        <p class="order-date"><span class="text-muted">Placed on ' . $order_row['time_created'] . '</span></p><p>Total: Rs. '.$order_row['price'].'<span class="ml-4">Method: '.$order_row['payment_method'].'</span></p>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a href="#" class="btn" style="color:#fff;background-color:#de5832" data-toggle="modal" data-target="#statusEditModal' . $order_row['order_id'] . '">Edit Status</a>
                    ';
                    if($order_row['order_status']==="Cancelled"){
                        echo '';
                    }else{
                    echo'<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal' . $order_row['order_id'] . '">Cancel</a>';
                    }
                    echo'
                </div>
            </div>';
            echo '<div class="modal fade" id="statusEditModal' . $order_row['order_id']  . '" tabindex="-1" role="dialog" aria-labelledby="statusEditModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="background-color:#1f2937;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        style="color:#fff">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Your form goes here -->
                                <form id="orderStatusEdit" action="updatestatus.php" method="POST">
                                    <div class="modal-body">
        
                                        <div class="form-group">
                                        <input type="hidden" name="orderID" value="';
                  echo $order_row['order_id'] ;
                  echo '" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="order">Edit Order Status</label>
                                            <select class="form-control" name="orderStatus" id="orderStatus" required>
                                                <option value="-1">Select Order Status</option>
                                                <option value="Processing Order">Processing Order</option>
                                                <option value="On the way">On the way</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';
                    echo '<!-- Modal for delete confirmation -->
                    <div class="modal fade" id="deleteConfirmationModal' . $order_row['order_id'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel' . $order_row['order_id'] . '" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#1f2937;">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel' . $order_row['order_id'] . '">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to cancel the order?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form method="post" action="cancel_order.php">
                              <input type="hidden" name="orderID" value="' . $order_row['order_id'] . '">
                              <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>';

    // Loop through each product ID in the order
    foreach ($product_ids as $product_id) {
        // Retrieve product details from the products table
        $stmt_product = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt_product->bind_param('s', $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $product_row = $result_product->fetch_assoc();
        $imagepath=$product_row['image_path'];
        $imagePathArray = explode(',', $imagepath);
                $firstImage = $imagePathArray[0];

        // Display product details within a row
        echo '<div class="row mt-3">
                <div class="col-md-2">
                    <img src="../YourITCenter/' . $firstImage . '" alt="Product Image" class="img-fluid delivery-img">
                </div>
                <div class="col-md-2">
                    <p>' . $product_row['name'] . '</p>
                </div>
                <div class="col-md-2">
                    <p>Qty: '.$quantity[$i].'</p>
                </div>
                <div class="col-md-6">
                    <span class="delivered-text">'.$order_row['order_status'].'</span>
                    <span class="ml-5" >Price: Rs. '.$product_row['price'].'</span>
                </div>
            </div>';
    }

    echo '</div> <div style="height: 10px; background-color:#111827;"></div>'; // Close order-container div
}

}else{
    echo '<h3>No Orders</h3>';
}

// Close prepared statements and database connection
// $stmt_orders->close();
// $stmt_product->close();
// $conn->close();
?>

<?php
// Calculate the total number of pages
$totalPages = ceil($totalItems / 4); // Assuming you want 4 items per page

// for ($i = 1; $i <= $totalPages; $i++) {
//   echo '<a class="navbar-brand" href="accessories.php?page=' . $i . '">' . $i . '</a>';
// }
?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <!-- <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li> -->
    <?php for ($i = 1; $i <= $totalPages; $i++){
        if(isset($_GET['page'])&& intval($_GET['page']) === $i){
            echo '<li class="page-item active"><a class="page-link" href="orders.php?page=' . $i . '">' . $i . '</a></li>';
        }else if(isset($_GET['page'])){
            echo '<li class="page-item"><a class="page-link" href="orders.php?page=' . $i . '">' . $i . '</a></li>';
        }else if($i===1){
            echo '<li class="page-item active"><a class="page-link" href="orders.php?page=' . $i . '">' . $i . '</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="orders.php?page=' . $i . '">' . $i . '</a></li>';
        }
    }
     ?>
    <!-- <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li> -->
  </ul>
</nav>
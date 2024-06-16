<!-- accessoriesproducts.php -->
<style>
    .card-img-top {
        height: 210px;
        /* Set the desired height */
        object-fit: cover;
        /* Ensure the image covers the entire space */
    }

    /* Style anchor tags inside the product cards */
    .product-card a {
        color: inherit;
        /* Inherit the color from the parent */
        text-decoration: none;
        /* Remove the underline */
    }
</style>

<div style="height: 35px;"></div>
<div class="container">
    <h2 class="text-left mb-4">Accessories</h2>
    <div class="row">
        <!-- Product Card -->
        <?php
        require_once ("db/dbconnect.php");
        // Execute a separate query to count the total number of items
        $countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM products WHERE category LIKE '%Components' AND stock>0");
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $countRow = $countResult->fetch_assoc();
        $totalItems = $countRow['total'];
        $countStmt->close();

        // Calculate the current page number
        $currentPage = isset ($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page number and items per page
        $offset = ($currentPage - 1) * 4; // Assuming you want 4 items per page
        
        // Prepare and bind statement with LIMIT and OFFSET
        $stmt = $conn->prepare("SELECT * FROM products WHERE category LIKE '%Components' AND stock>0 LIMIT 4 OFFSET ?");
        $stmt->bind_param("i", $offset);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $imagepath = $row['image_path'];
                $imagePathArray = explode(',', $imagepath);
                $firstImage = $imagePathArray[0];
                $descriptionTag = $row['description'];
                $description = strip_tags($descriptionTag);
                echo '
                <div class="col-lg-3 col-md-6">
                    <a href="singleproduct.php?product_id=' . $row['product_id'] . '">
                        <div class="card product-card">
                            <img src="' . $firstImage . '" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">' . mb_strimwidth($row['name'], 0, 17, '...') . '</h5>
                                <p class="card-text"><strong style="color:#f86736;">Price: Rs.' . $row['price'] . '</strong></p>
                                <p class="card-text">' . mb_strimwidth($description, 0, 40, "...") . '</p> <div style="height: 1px;"></div>
                                <div class="d-flex justify-content-between">';
                if ($row['stock'] <= 0) {
                    echo '<button type="button" class="btn btn-sm" style="background-color:#6c757d!important;color:#fff !important; font-size:13px !important;">Out of Stock</button>';
                } else {
                    echo '
                                <form action="addtocart.php" method="POST">
                                    <!-- Hidden input field to send the product_id -->
                                    <input type="hidden" name="product_id" value="' . $row['product_id'] . '"readonly>
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-sm" style="background-color:#de5832!important;color:#fff !important">Add to Cart</button>
                                </form>
                                ';
                }
                echo '
                                    <a href="singleproduct.php?product_id=' . $row['product_id'] . '" class="btn btn-outline-secondary btn-sm">Read More</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                ';
            }
        }
        ?>
    </div>
    
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
            echo '<li class="page-item active"><a class="page-link" href="components.php?page=' . $i . '">' . $i . '</a></li>';
        }else if(isset($_GET['page'])){
            echo '<li class="page-item"><a class="page-link" href="components.php?page=' . $i . '">' . $i . '</a></li>';
        }else if($i===1){
            echo '<li class="page-item active"><a class="page-link" href="components.php?page=' . $i . '">' . $i . '</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="components.php?page=' . $i . '">' . $i . '</a></li>';
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
</div>

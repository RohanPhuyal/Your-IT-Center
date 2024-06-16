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

<!-- cards.php -->
<div style="height: 35px;"></div>
<div class="container">
    <h2 class="text-left mb-4">Trending Products</h2>
    <div class="row">
        <!-- Product Card -->
        <?php
        require_once("db/dbconnect.php");
        // Prepare and bind statement
        $stmt = $conn->prepare("SELECT * FROM products  WHERE stock>0 ORDER BY product_id DESC");

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            $num = 1;
            while ($row = $result->fetch_assoc()) {
                $imagepath = $row['image_path'];
                $imagePathArray = explode(',', $imagepath);
                $firstImage = 'Admin/../' . $imagePathArray[0];
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
                $num++;
                if ($num > 4) {
                    break;
                }
            }
        }
        ?>
    </div>
</div>
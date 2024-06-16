<?php
require_once("db/dbconnect.php");
$productid = $_GET['product_id'];
// Prepare and bind statement
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
$stmt->bind_param("i", $productid);

// Execute the statement
if ($stmt->execute() === TRUE) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $imagepath = $row['image_path'];
    $imagePathArray = explode(',', $imagepath);

    echo '<div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="product-images">
                        <figure class="large-image">
                            <!-- Open the modal on image click -->
                            <a href="#" data-toggle="modal" data-target="#largeImageModal">
                                <img src="' . $imagePathArray[0] . '" alt="Main Product Image" width="344px" height="394px">
                            </a>
                        </figure>
                        <div class="thumbnails">';
    // Check if there are more than one images
    if (count($imagePathArray) > 1) {
        // Loop through the remaining images and display them as thumbnails
        for ($i = 1; $i < count($imagePathArray); $i++) {
            echo '<a href="#" data-toggle="modal" data-target="#smallImageModal' . $i . '"><img src="' . $imagePathArray[$i] . '" alt="Thumbnail ' . $i . '" width="103px" height="103px"></a>&nbsp;&nbsp;&nbsp;&nbsp;';
        }
    }
    echo '</div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h2 class="entry-title">' . $row['name'] . '</h2>
            <h5 style="color: #16a34a;">Rs. ' . $row['price'] . '</h5>
            <p>' . $row['description'] . '</p>';
            if ($row['stock'] <= 0) {
                echo '<button type="button" class="btn btn-sm" style="background-color:#6c757d!important;color:#fff !important; font-size:13px !important;">Out of Stock</button>';
            }else{echo'
            <div class="addtocart-bar">
            <form action="addtocart.php" method="POST">
            <!-- Hidden input field to send the product_id -->
            <input type="hidden" name="product_id" value="' . $row['product_id'] . '"readonly>
            <!-- Submit button -->
            <button type="submit" class="btn btn-sm" style="background-color:#de5832!important;color:#fff !important"><strong>Add to Cart</strong></button>
        </form>
        </div>';
            }
            echo'
        </div>
    </div>
</div>';

    // Modals for both large and small images
    // Main Product Image Modal
    echo '<div class="modal fade" id="largeImageModal" tabindex="-1" role="dialog" aria-labelledby="largeImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeImageModalLabel">Main Product Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="' . $imagePathArray[0] . '" class="img-fluid" alt="Main Product Image">
                    </div>
                </div>
            </div>
        </div>';

    // Modals for Small Thumbnails
    for ($i = 1; $i < count($imagePathArray); $i++) {
        echo '<div class="modal fade" id="smallImageModal' . $i . '" tabindex="-1" role="dialog" aria-labelledby="smallImageModalLabel' . $i . '" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="smallImageModalLabel' . $i . '">Thumbnail ' . $i . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="' . $imagePathArray[$i] . '" class="img-fluid" alt="Thumbnail ' . $i . '">
                        </div>
                    </div>
                </div>
            </div>';
    }
}
?>
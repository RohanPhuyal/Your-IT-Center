<!-- index.php -->
<?php
session_start();
if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] === false) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-Dk4Hp2xl3tS+YiPP32iFlJ8zPWZZK4r44z6tQtW7zRmipkVTe3F2bBHQk+lwYfCsk/dn4a63tcjzg+wGRC2HYw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tiny.cloud/1/9a3ed93opg4i5kr60ctcs35jbsy940qgw5pbz0mc52tom2wf/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="styles.css" />
    <title>Products</title>
</head>

<body>
    <!-- Include the navbar -->
    <?php include 'topbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <div class="flex justify-end">
            <!-- <a href="addproduct.php"> -->
            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#productModal">
                <i class="fas fa-plus-circle mr-2"></i>Add Product
            </button>
            <!-- </a> -->
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background-color:#1f2937;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="color:#fff">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Your form goes here -->
                        <form id="productForm" action="addproduct.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="productName">Name</label>
                                    <input type="text" class="form-control" name="productName"
                                        placeholder="Enter product name" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="-1">Select Category</option>
                                        <option value="Peripherals">Accessories</option>
                                        <option value="Components">Components</option>
                                    </select>
                                </div>
                                <div class="form-group" id="subCategoryGroup">
                                    <label for="subcategory">Sub-Category</label>
                                    <select class="form-control" name="subcategory" id="subcategory" required>
                                        <option value="-1">Select a Category First</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3"
                                        placeholder="Enter product description">Write Description Here</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price"
                                        placeholder="Enter product price" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Number of Stock</label>
                                    <input type="number" class="form-control" name="stock"
                                        placeholder="Enter stock quantity" required>
                                </div>
                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                    <small id="imageHelp" class="form-text text-muted">You can upload up to 4
                                        images.</small>
                                    <!-- Error message for image -->
                                    <div id="image_error" class="text-danger" style="display: none;">Please select 1-4
                                        Images.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 mx-auto"> <!-- Use Bootstrap w-75 class to set width to 75% -->
            <?php include 'producttable.php'; ?>
        </div>

    </div>
    <!-- Bootstrap Toast for login success -->
    <div class="toast addProductSuccess" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="position: fixed; top: 20px; right: 20px; display:none;">
        <div class="toast-header" style="background-color: #16a34a;color:#fff">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Success: Add Complete</strong>
            <small style="color:#e2e2e2;">0 second ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" style="background-color: #1f2937;color:#fff">
            You have successfully Added Product.
        </div>
    </div>
    <!-- Bootstrap Toast for login success -->
    <div class="toast editProductSuccess" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="position: fixed; top: 20px; right: 20px; display:none;">
        <div class="toast-header" style="background-color: #16a34a;color:#fff">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Success: Edit Complete</strong>
            <small style="color:#e2e2e2;">0 second ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" style="background-color: #1f2937;color:#fff">
            You have successfully Edited Product.
        </div>
    </div>
    <!-- Bootstrap Toast for login success -->
    <div class="toast productDeleteSuccess" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="position: fixed; top: 20px; right: 20px; display:none;">
        <div class="toast-header" style="background-color: #16a34a;color:#fff">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Success: Delete Complete</strong>
            <small style="color:#e2e2e2;">0 second ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" style="background-color: #1f2937;color:#fff">
            You have successfully Deleted Product.
        </div>
    </div>
    <!-- Bootstrap Toast for login failed -->
    <div class="toast productDeleteError" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="position: fixed; top: 20px; right: 20px; display:none;">
        <div class="toast-header" style="background-color: #dc3545;color:#fff">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Failed: Delete Product</strong>
            <small style="color:#e2e2e2;">0 second ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" style="background-color: #1f2937;color:#fff">
            Cannot Delete Product.
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <!-- Initialize TinyMCE -->
    <script>
        tinymce.init({
            selector: 'textarea',  // Replace all textarea elements with the rich text editor
            plugins: 'code table',  // Enable the code and table plugins
            toolbar: 'undo redo | bold italic underline | bullist numlist | table | code ',  // Customize the toolbar buttons
            menubar: false,  // Hide the default menubar
            height: 300,  // Set the height of the editor
        });
        // Prevent Bootstrap dialog from blocking focusin
        $(document).on('focusin', function (e) {
            if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
                e.stopImmediatePropagation();
            }
        });

    </script>
    <!-- Font Awesome script -->
    <script src="https://kit.fontawesome.com/e9e35ad4cc.js" crossorigin="anonymous"></script>
    <script>
        <?php
        if (isset($_SESSION['addProductSuccess']) && $_SESSION['addProductSuccess'] === true) {
            ?>
            // Show toast message
            $('.addProductSuccess').css('display', 'block');
            $('.addProductSuccess').toast('show');
            $('.addProductSuccess').css('display', 'none');
            <?php
            unset($_SESSION['addProductSuccess']); // Clear the session variable
        }
        if (isset($_SESSION['editProductSuccess']) && $_SESSION['editProductSuccess'] === true) {
            ?>
            // Show toast message
            $('.editProductSuccess').css('display', 'block');
            $('.editProductSuccess').toast('show');
            $('.editProductSuccess').css('display', 'none');
            <?php
            unset($_SESSION['editProductSuccess']); // Clear the session variable
        }
        if (isset($_SESSION['productDeleteSuccess']) && $_SESSION['productDeleteSuccess'] === true) {
            ?>
            // Show toast message
            $('.productDeleteSuccess').css('display', 'block');
            $('.productDeleteSuccess').toast('show');
            $('.productDeleteSuccess').css('display', 'none');
            <?php
            unset($_SESSION['productDeleteSuccess']); // Clear the session variable
        }
        if (isset($_SESSION['productDeleteSuccess']) && $_SESSION['productDeleteSuccess'] === false) {
            ?>
            // Show toast message
            $('.productDeleteError').css('display', 'block');
            $('.productDeleteError').toast('show');
            $('.productDeleteError').css('display', 'none');
            <?php
            unset($_SESSION['productDeleteSuccess']); // Clear the session variable
        }
        ?>

        document.getElementById('productForm').addEventListener('submit', function (event) {
            var files = document.getElementById('images').files;
            if (files.length < 1 || files.length > 4) {
                document.getElementById("image_error").style.display = "block";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById("image_error").style.display = "none"; // Hide the error message if displayed
            }
        });

        // SUB CAT 
        document.getElementById('category').addEventListener('change', function () {
            var category = this.value;
            var subCategoryDropdown = document.getElementById('subcategory');
            // Remove existing options
            subCategoryDropdown.innerHTML = '';

            if (category === 'Peripherals') {
                var accessoriesOptions = [
                    { text: 'Mouse', value: 'Mouse' },
                    { text: 'Mouse', value: 'Headphone' },
                    { text: 'Keyboard', value: 'Keyboard' }
                ];
                // Add options for Accessories
                addOptions(subCategoryDropdown, accessoriesOptions);
            } else if (category === 'Components') {
                var componentsOptions = [
                    { text: 'SSD', value: 'SSD' },
                    { text: 'RAM', value: 'RAM' },
                    { text: 'Cooler', value: 'Cooler' },
                    { text: 'Motherboard', value: 'Motherboard' },
                    { text: 'Power Supply', value: 'Power Supply' }
                ];
                // Add options for Components
                addOptions(subCategoryDropdown, componentsOptions);
            }
        });

        // Function to add options to a dropdown
        function addOptions(selectElement, options) {
            options.forEach(function (option) {
                var optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.textContent = option.text;
                selectElement.appendChild(optionElement);
            });
        }
    </script>
</body>

</html>
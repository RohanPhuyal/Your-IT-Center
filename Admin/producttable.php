<!-- Product -->
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card border" style="background-color: #09090b; border: 1px solid #FFFFFF;">
      <div class="card-body">
        <h3 class="text-white mb-4">Orders</h3>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="color:#a1a19b;">Product ID</th>
                <th style="color:#a1a19b;">Name</th>
                <th style="color:#a1a19b;">Category</th>
                <th style="color:#a1a19b;">Price</th>
                <th style="color:#a1a19b;">Stock</th>
                <th style="color:#a1a19b;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once("db/dbconnect.php");
              // Prepare and bind statement
              $stmt = $conn->prepare("SELECT product_id, name, category, description, price, stock FROM products");

              // Execute the statement
              if ($stmt->execute() === TRUE) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                  $productID = $row['product_id'];
                  $name = $row['name'];
                  $category = $row['category'];
                  $description = $row['description'];
                  $price = $row['price'];
                  $stock = $row['stock'];

                  echo '<tr>
                          <td class="text-white">#P' . $productID . '</td>
                          <td class="text-white">' . $name . '</td>
                          <td class="text-white">' . $category . '</td>
                          <td class="text-white">' . $price . '</td>
                          <td class="text-white">' . $stock . '</td>
                          <td>
                            <button class="btn btn-primary me-2" data-toggle="modal" data-target="#productEditModal' . $productID . '">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal' . $productID . '">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </td>
                        </tr>';
                  echo '<div class="modal fade" id="productEditModal' . $productID . '" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
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
                                <form id="productFormEdit" action="editproducts.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
        
                                        <div class="form-group">
                                        <input type="hidden" name="productID" value="';
                  echo $productID;
                  echo '" readonly>
                                            <label for="productName">Name</label>
                                            <input type="text" class="form-control" name="productName"
                                                value="' . $name . '" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category'.$productID.'" required>
                                                <option value="-1">Select Category</option>
                                                <option value="Peripherals">Accessories</option>
                                                <option value="Components">Components</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="subCategoryGroup">
                                            <label for="subcategory">Sub-Category</label>
                                            <select class="form-control" name="subcategory" id="subcategory'.$productID.'" required>
                                                <option value="-1">Select a Category First</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" rows="3">' . $description . '</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" name="price"
                                                value="' . $price . '" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Number of Stock</label>
                                            <input type="number" class="form-control" name="stock"
                                                value="' . $stock . '" required>
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
                    <div class="modal fade" id="deleteConfirmationModal' . $productID . '" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel' . $productID . '" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#1f2937;">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel' . $productID . '">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this product?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form method="post" action="delete_product.php">
                              <input type="hidden" name="productID" value="' . $productID . '">
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>';
                    echo "<script>
  
                    // SUB CAT 
                    document.getElementById('category".$productID."').addEventListener('change', function () {
                        var category = this.value;
                        var subCategoryDropdown = document.getElementById('subcategory".$productID."');
                        // Remove existing options
                        subCategoryDropdown.innerHTML = '';
            
                        if (category === 'Peripherals') {
                            var accessoriesOptions = [
                                { text: 'Mouse', value: 'Mouse' },
                                { text: 'Headphone', value: 'Headphone' },
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
              </script>";
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
<!-- Modal -->
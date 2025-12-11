<?php
// add_product.php
session_start();
require_once 'includes/db.php';
require_once 'layouts/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Product</h5>
            </div>
            <div class="card-body">
                <form action="actions/add_product_logic.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Category</label>
                            <select name="categorie_id" class="form-select" required>
                                <option value="">Select Category...</option>
                                <?php
                                // Fetch categories for the dropdown
                                $cats = $pdo->query("SELECT * FROM categories");
                                while($c = $cats->fetch()) {
                                    echo "<option value='{$c['id']}'>{$c['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                            <div class="form-text">Allowed formats: JPG, PNG, GIF</div>
                        </div>
                        <div class="col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="0">
                        </div>
                        <div class="col-md-4">
                            <label>Buying Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="buy_price" step="0.01" class="form-control" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Selling Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="sale_price" step="0.01" class="form-control" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Add Product</button>
                        <a href="products.php" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>
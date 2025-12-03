<?php
// edit_product.php
session_start();
require_once 'includes/db.php';
require_once 'layouts/header.php';

// 1. Check if ID is in URL
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

// 2. Fetch current product data
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found!";
    exit();
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Edit Product: <?php echo $product['name']; ?></h5>
            </div>
            <div class="card-body">
                <form action="actions/edit_product_logic.php" method="POST">
                    
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" 
                                   value="<?php echo $product['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Category</label>
                            <select name="categorie_id" class="form-select" required>
                                <option value="">Select Category...</option>
                                <?php
                                $cats = $pdo->query("SELECT * FROM categories");
                                while($c = $cats->fetch()) {
                                    // LOGIC: If category ID matches product's category, select it
                                    $selected = ($c['id'] == $product['categorie_id']) ? 'selected' : '';
                                    echo "<option value='{$c['id']}' {$selected}>{$c['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" 
                                   value="<?php echo $product['quantity']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Buying Price</label>
                            <input type="number" name="buy_price" step="0.01" class="form-control" 
                                   value="<?php echo $product['buy_price']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Selling Price</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" 
                                   value="<?php echo $product['sale_price']; ?>">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning">Update Product</button>
                        <a href="products.php" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>
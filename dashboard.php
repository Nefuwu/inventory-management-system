<?php
session_start();
// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Page Configuration
$page = 'dashboard';
$pageTitle = 'Dashboard Overview';

require_once 'includes/db.php';
require_once 'layouts/header.php';

// --- DASHBOARD LOGIC (Stats) ---
// We use COUNT(*) to get totals efficiently
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
// Check for low stock (Logic: Quantity <= 5)
$low_stock = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity <= 5")->fetchColumn();
?>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Products</div>
            <div class="card-body">
                <h2 class="card-title"><?php echo $total_products; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <h2 class="card-title"><?php echo $total_categories; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Low Stock Items</div>
            <div class="card-body">
                <h2 class="card-title"><?php echo $low_stock; ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info mt-4">
    <i class="bi bi-info-circle-fill"></i> 
    System Ready. Start by adding Categories, then Products.
</div>

<?php require_once 'layouts/footer.php'; ?>
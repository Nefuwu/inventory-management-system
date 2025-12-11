<?php
// products.php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$page = 'products';
$pageTitle = 'Product Inventory';
require_once 'layouts/header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Inventory List</h2>
    <a href="add_product.php" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add New Product
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Buy Price</th>
                    <th>Sale Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // JOIN query to get Category Name instead of ID
                $sql = "SELECT p.*, c.name AS cat_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.categorie_id = c.id 
                        ORDER BY p.id DESC";
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch()) {
                    // 1. Logic for Stock Alert Colors
                    $stockClass = '';
                    if ($row['quantity'] == 0) {
                        $stockClass = 'text-danger fw-bold';
                    } elseif ($row['quantity'] <= 10) {
                        $stockClass = 'text-warning fw-bold';
                    }

                    // 2. Logic for Image Display
                    // Check if database has a filename AND if that file actually exists in the folder
                    if (!empty($row['image']) && file_exists("uploads/" . $row['image'])) {
                        $imgSrc = "uploads/" . $row['image'];
                    } else {
                        // Fallback if no image uploaded
                        $imgSrc = "https://via.placeholder.com/50?text=No+Img";
                    }

                    // 3. Render the Table Row
                    echo "<tr>";
                    
                    // Image Column
                    echo "<td><img src='$imgSrc' width='50' height='50' class='rounded border'></td>";
                    
                    // Data Columns
                    echo "<td>{$row['name']}</td>";
                    echo "<td><span class='badge bg-secondary'>{$row['cat_name']}</span></td>";
                    echo "<td class='{$stockClass}'>{$row['quantity']}</td>";
                    echo "<td>\${$row['buy_price']}</td>";
                    echo "<td>\${$row['sale_price']}</td>";
                    
                    // Action Buttons
                    echo "<td>
                            <a href='edit_product.php?id={$row['id']}' class='btn btn-sm btn-outline-primary'>
                                <i class='bi bi-pencil'></i>
                            </a>
                            
                            <a href='actions/delete_product.php?id={$row['id']}' 
                            class='btn btn-sm btn-outline-danger'
                            onclick='return confirm(\"Delete this item?\")'>
                            <i class='bi bi-trash'></i>
                            </a>
                        </td>";
                        
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>
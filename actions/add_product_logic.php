<?php
// actions/add_product_logic.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Collect Data
    $name = $_POST['name'];
    $cat_id = $_POST['categorie_id'];
    $qty = $_POST['quantity'];
    $buy = $_POST['buy_price'];
    $sale = $_POST['sale_price'];

    // 2. Simple Validation
    if(empty($name) || empty($cat_id)) {
        header("Location: ../add_product.php?error=Name and Category are required");
        exit();
    }

    // 3. Insert into Database
    $sql = "INSERT INTO products (name, categorie_id, quantity, buy_price, sale_price, date_updated) 
            VALUES (:name, :cat, :qty, :buy, :sale, NOW())";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':name' => $name,
            ':cat' => $cat_id,
            ':qty' => $qty,
            ':buy' => $buy,
            ':sale' => $sale
        ]);
        header("Location: ../products.php?success=Product Added");
    } catch (PDOException $e) {
        // Debugging tip: shows specific SQL error
        die("Error: " . $e->getMessage());
    }

} else {
    header("Location: ../products.php");
}
?>
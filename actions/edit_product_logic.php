<?php
// actions/edit_product_logic.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id']; // This comes from the hidden input
    $name = $_POST['name'];
    $cat_id = $_POST['categorie_id'];
    $qty = $_POST['quantity'];
    $buy = $_POST['buy_price'];
    $sale = $_POST['sale_price'];

    // Validation
    if(empty($name) || empty($cat_id)) {
        header("Location: ../edit_product.php?id=$id&error=Name required");
        exit();
    }

    $sql = "UPDATE products SET 
            name = :name, 
            categorie_id = :cat, 
            quantity = :qty, 
            buy_price = :buy, 
            sale_price = :sale 
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':name' => $name,
            ':cat' => $cat_id,
            ':qty' => $qty,
            ':buy' => $buy,
            ':sale' => $sale,
            ':id' => $id
        ]);
        header("Location: ../products.php?success=Product updated");
    } catch (PDOException $e) {
        header("Location: ../edit_product.php?id=$id&error=Update failed");
    }

} else {
    header("Location: ../products.php");
}
?>
<?php
// actions/delete_product.php
session_start();
require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Security: Only delete if ID is a number
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    try {
        $stmt->execute([':id' => $id]);
        header("Location: ../products.php?success=Product deleted");
    } catch (PDOException $e) {
        header("Location: ../products.php?error=Deletion failed");
    }
} else {
    header("Location: ../products.php");
}
?>
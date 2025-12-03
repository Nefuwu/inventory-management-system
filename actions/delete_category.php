<?php
session_start();
require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
    try {
        $stmt->execute([':id' => $id]);
        header("Location: ../categories.php?success=Deleted successfully");
    } catch (PDOException $e) {
        header("Location: ../categories.php?error=Deletion failed");
    }
} else {
    header("Location: ../categories.php");
}
?>
<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);

    if (!empty($name)) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        try {
            $stmt->execute([':name' => $name]);
            header("Location: ../categories.php?success=Category added");
        } catch (PDOException $e) {
            header("Location: ../categories.php?error=Database error");
        }
    } else {
        header("Location: ../categories.php?error=Name required");
    }
}
?>
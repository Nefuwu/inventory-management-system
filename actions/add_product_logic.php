<?php
// actions/add_product_logic.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Collect Text Data
    $name = $_POST['name'];
    $cat_id = $_POST['categorie_id'];
    $qty = $_POST['quantity'];
    $buy = $_POST['buy_price'];
    $sale = $_POST['sale_price'];
    $imgName = NULL; // Default to null if no image uploaded

    // 2. Validate Text
    if(empty($name) || empty($cat_id)) {
        header("Location: ../add_product.php?error=Name and Category are required");
        exit();
    }

    // --- 3. IMAGE UPLOAD LOGIC START ---
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        
        $file = $_FILES['product_image'];
        $fileName = $file['name'];
        $fileTmp  = $file['tmp_name'];
        
        // Get extension (e.g., 'jpg')
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Valid extensions
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileExt, $allowed)) {
            // Generate Unique Name (e.g., 65a123bc.jpg) to prevent overwriting
            $imgName = uniqid() . '.' . $fileExt;
            
            // Destination path
            $destination = '../uploads/' . $imgName;
            
            // Move file from temporary memory to our folder
            move_uploaded_file($fileTmp, $destination);
        } else {
            header("Location: ../add_product.php?error=Invalid file type");
            exit();
        }
    }
    // --- IMAGE UPLOAD LOGIC END ---

    // 4. Insert into Database (Note the new :img placeholder)
    $sql = "INSERT INTO products (name, categorie_id, quantity, buy_price, sale_price, image, date_updated) 
            VALUES (:name, :cat, :qty, :buy, :sale, :img, NOW())";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':name' => $name,
            ':cat' => $cat_id,
            ':qty' => $qty,
            ':buy' => $buy,
            ':sale' => $sale,
            ':img'  => $imgName
        ]);
        header("Location: ../products.php?success=Product Added");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

} else {
    header("Location: ../products.php");
}
?>
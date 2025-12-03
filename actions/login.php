<?php
// actions/login.php
session_start();
require_once '../includes/db.php';

// 1. Check if data came from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 2. Clean the input (Security Best Practice)
    // trim() removes spaces from start/end
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 3. Validation: Are fields empty?
    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=All fields are required");
        exit();
    }

    // 4. Check Database
    $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    // 5. Verify Password
    // We check if $user exists AND if the password matches the hash
    if ($user && password_verify($password, $user['password'])) {
        
        // SUCCESS: Login the user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Update last_login time
        $update = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
        $update->execute([':id' => $user['id']]);

        header("Location: ../dashboard.php");
        exit();
    } else {
        // FAILURE: Incorrect credentials
        header("Location: ../index.php?error=Incorrect username or password");
        exit();
    }

} else {
    // If someone tries to visit actions/login.php directly without submitting the form
    header("Location: ../index.php");
    exit();
}
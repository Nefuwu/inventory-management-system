<?php
// index.php
// We start the session immediately to check if the user is already logged in
session_start();

// If user is already logged in, redirect them to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom CSS to center the login box perfectly */
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #0d6efd;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="text-center mb-4">Inventory Login</h3>
        
        <form action="actions/login.php" method="POST">
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            
            <button type="submit" class="btn btn-custom w-100">Sign In</button>
        </form>
    </div>

</body>
</html>
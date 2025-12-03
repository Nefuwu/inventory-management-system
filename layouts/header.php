<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    /* Simple Sidebar Styles */
    .sidebar { min-height: 100vh; background-color: #343a40; color: white; }
    .sidebar a { color: #cfd2d6; text-decoration: none; padding: 10px 15px; display: block; }
    .sidebar a:hover, .sidebar a.active { background-color: #495057; color: white; }
    .main-content { padding: 20px; background-color: #f8f9fa; min-height: 100vh; }
  </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar d-flex flex-column p-3" style="width: 250px;">
        <h4 class="mb-4 text-center">Inventory</h4>
        <a href="dashboard.php" class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="products.php" class="<?php echo ($page == 'products') ? 'active' : ''; ?>">
            <i class="bi bi-box-seam me-2"></i> Products
        </a>
        <a href="categories.php" class="<?php echo ($page == 'categories') ? 'active' : ''; ?>">
            <i class="bi bi-tags me-2"></i> Categories
        </a>
        <a href="#" class="<?php echo ($page == 'users') ? 'active' : ''; ?>">
            <i class="bi bi-people me-2"></i> Users
        </a>
        <hr>
        <a href="actions/logout.php" class="text-danger">
            <i class="bi bi-box-arrow-left me-2"></i> Logout
        </a>
    </div>

    <div class="flex-grow-1">
        <nav class="navbar navbar-light bg-white shadow-sm mb-4 px-4">
            <span class="navbar-brand mb-0 h1">
                <?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?>
            </span>
            <span class="text-muted">
                Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            </span>
        </nav>
        
        <div class="main-content">

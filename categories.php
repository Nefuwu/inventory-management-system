<?php
// categories.php
session_start();
require_once 'includes/db.php';

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$page = 'categories';
$pageTitle = 'Manage Categories';

// Handle Success/Error messages from the URL
$message = '';
if (isset($_GET['success'])) $message = "<div class='alert alert-success'>{$_GET['success']}</div>";
if (isset($_GET['error'])) $message = "<div class='alert alert-danger'>{$_GET['error']}</div>";

require_once 'layouts/header.php'; 
?>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-plus-circle me-1"></i> Add New Category
            </div>
            <div class="card-body">
                <form action="actions/add_category.php" method="POST">
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Electronics" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Category</button>
                </form>
            </div>
        </div>
        <?php echo $message; ?>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul me-1"></i> Existing Categories
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch categories from DB
                        $stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
                        while ($row = $stmt->fetch()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td><strong>{$row['name']}</strong></td>";
                            echo "<td>
                                    <a href='actions/delete_category.php?id={$row['id']}' 
                                       class='btn btn-sm btn-danger'
                                       onclick='return confirm(\"Are you sure? This will delete all products in this category!\")'>
                                       <i class='bi bi-trash'></i> Delete
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>
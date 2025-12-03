<?php
session_start();

// Security Gate: If user is not logged in, kick them out
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<p>You have successfully logged in.</p>
<a href="actions/logout.php">Logout</a>
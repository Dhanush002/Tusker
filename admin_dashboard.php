<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'header.php';
?>

<h2>Welcome, Admin</h2>
<ul>
    <li><a href="create_project.php">Create Project</a></li>
    <li><a href="index.php">Upload Task</a></li>
    <li><a href="view_projects.php">View All Projects</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<h3>Add New User</h3>
<form method="POST" action="add_user.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="designer">Designer</option>
        <option value="dm">DM</option>
        <option value="admin">Admin</option>
    </select><br>

    <button type="submit" name="add_user">Add User</button>
</form>

<?php include 'footer.php'; ?>

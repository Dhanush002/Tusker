<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['designer', 'dm'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
include 'header2.php';

$username = $_SESSION['username'];
$tasks = $conn->query("SELECT * FROM tasks WHERE assignee = '$username'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- User icon and dropdown -->
<div class="user-icon">
    <img src="user_icon.png" alt="User Icon" id="userIcon" onclick="toggleDropdown()">
    <div id="userDropdown" class="dropdown-content">
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2>My Tasks</h2>
<table>
    <tr><th>Task</th><th>Status</th><th>Action</th><th>Document</th></tr>
    <?php while($row = $tasks->fetch_assoc()): ?>
    <tr>
        <td><?= $row['task_name'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <form method="POST" action="update_task_status.php">
                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="in progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </td>
        <td>
            <form action="upload_document.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                <input type="file" name="document" required>
                <button type="submit">Upload</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("userDropdown");
        dropdown.classList.toggle("show");
    }
    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.user-icon img')) {
            var dropdown = document.getElementById("userDropdown");
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
</script>

</body>
</html>

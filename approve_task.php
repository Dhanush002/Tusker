<?php 
include 'db.php';

// Check if 'id' is passed in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = $_POST['comment'];
        // Update task status to 'approved' and save the comment
        $conn->query("UPDATE tasks SET status='approved', comment='$comment' WHERE id=$id");
        // Redirect to the index page after the update
        header("Location: index.php");
        exit();
    }

    // Fetch the task data for the given ID
    $res = $conn->query("SELECT * FROM tasks WHERE id=$id");
    $row = $res->fetch_assoc();
} else {
    // If 'id' is not set or is invalid, show an error message
    echo "Invalid Task ID.";
    exit();
}
?>

<form method="post">
  <h2>Approve Task</h2>
  Task: <?= htmlspecialchars($row['title']) ?><br>
  Add Comment: <textarea name="comment"></textarea><br>
  <button type="submit">Approve</button>
</form>

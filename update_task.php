<?php include 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $conn->query("UPDATE tasks SET status='$status' WHERE id=$id");
    header("Location: index.php");
}
$res = $conn->query("SELECT * FROM tasks WHERE id=$id");
$row = $res->fetch_assoc();
?>
<form method="post">
  <h2>Update Task Status</h2>
  Title: <?= $row['title'] ?><br>
  Current Status: <?= $row['status'] ?><br>
  Update Status: 
  <select name="status">
    <option value="in_progress">In Progress</option>
    <option value="review">Review</option>
    <option value="completed">Completed</option>
  </select><br>
  <button type="submit">Update</button>
</form>

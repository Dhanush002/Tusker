<?php include 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $conn->query("UPDATE tasks SET status='approved', comment='$comment' WHERE id=$id");
    header("Location: index.php");
}
$res = $conn->query("SELECT * FROM tasks WHERE id=$id");
$row = $res->fetch_assoc();
?>
<form method="post">
  <h2>Approve Task</h2>
  Task: <?= $row['title'] ?><br>
  Add Comment: <textarea name="comment"></textarea><br>
  <button type="submit">Approve</button>
</form>

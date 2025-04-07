<?php include '../db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $status = $_POST['status'];
  $comment = $_POST['comment'];
  $conn->query("UPDATE content_calendar SET status='$status', comment='$comment' WHERE id=$id");
  header("Location: view_calendars.php");
}
$res = $conn->query("SELECT * FROM content_calendar WHERE id=$id");
$row = $res->fetch_assoc();
?>
<form method="POST">
  <h2>Review Calendar</h2>
  Title: <?= $row['title'] ?><br>
  Status: <?= $row['status'] ?><br>
  Update Status: 
  <select name="status">
    <option value="approved">Approve</option>
    <option value="rejected">Reject</option>
  </select><br>
  Comment: <textarea name="comment"></textarea><br>
  <button type="submit">Update</button>
</form>

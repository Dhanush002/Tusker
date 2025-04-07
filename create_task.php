<?php include 'db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $assigned = $_POST['assigned_to'];
    $role = $_POST['role'];
    $due = $_POST['due_date'];
    $conn->query("INSERT INTO tasks (title, description, assigned_to, role, due_date)
                  VALUES ('$title', '$desc', '$assigned', '$role', '$due')");
    header("Location: index.php");
}
?>
<form method="post">
  <h2>Create Task</h2>
  Title: <input name="title"><br>
  Description: <textarea name="desc"></textarea><br>
  Assign To: <input name="assigned_to"><br>
  Role: 
  <select name="role">
    <option value="designer">Designer</option>
    <option value="developer">Developer</option>
    <option value="marketer">Marketer</option>
  </select><br>
  Due Date: <input type="date" name="due_date"><br>
  <button type="submit">Create</button>
</form>

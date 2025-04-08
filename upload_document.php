<?php
session_start();
include 'db.php';

if ($_FILES['document']['error'] === 0) {
    $task_id = $_POST['task_id'];
    $target_dir = "uploads/";
    $filename = basename($_FILES["document"]["name"]);
    $target_file = $target_dir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("UPDATE tasks SET document = ? WHERE id = ?");
        $stmt->bind_param("si", $target_file, $task_id);
        $stmt->execute();
        echo "<p style='color: green;'>Document uploaded successfully.</p>";
    } else {
        echo "<p style='color: red;'>Upload failed.</p>";
    }
}
?>
<a href="dashboard.php">Go Back</a>

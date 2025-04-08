<?php
session_start();
include 'db.php';

$task_id = $_POST['task_id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $task_id);
$stmt->execute();

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>

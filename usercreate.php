<?php
include 'db.php';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (username, password, role) VALUES ('admin', '$password', 'admin')");
?>

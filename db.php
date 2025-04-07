<?php
$conn = new mysqli("localhost", "root", "", "tusker");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

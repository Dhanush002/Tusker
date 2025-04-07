<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $project_name, $description);
    if ($stmt->execute()) {
        echo "<p style='color: lightgreen;'>Project created successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error creating project.</p>";
    }
}
?>

<?php include 'header.php'; ?>

<form method="POST">
    <h2>Create New Project</h2>
    <input type="text" name="project_name" placeholder="Project Name" required>
    <textarea name="description" placeholder="Project Description" rows="4" required></textarea>
    <button type="submit">Create Project</button>
</form>

<?php include 'footer.php'; ?>

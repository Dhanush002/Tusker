<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task_name'];
    $assignee = $_POST['assignee'];
    $project_id = $_POST['project_id'];
    $status = 'pending';

    $stmt = $conn->prepare("INSERT INTO tasks (task_name, assignee, status, project_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $task_name, $assignee, $status, $project_id);
    $stmt->execute();
    echo "<p style='color: lightgreen;'>Task uploaded successfully.</p>";
}
?>
<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Task</title>
    <style>
        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
        }
        form {
            background: #111;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 100px auto;
            box-shadow: 0 0 15px rgba(0, 255, 100, 0.2);
        }
        input, select, button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            background: #1e1e1e;
            color: #e0e0e0;
            border: 1px solid #0f3;
            border-radius: 8px;
        }
        button {
            background-color: #006400;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        h2 {
            color: #0f3;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
        .button-container a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #006400;
            color: white;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .button-container a:hover {
            background-color: #004d00;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Upload New Task</h2>
        <input type="text" name="task_name" placeholder="Task Name" required>
        <input type="text" name="assignee" placeholder="Assign to (name or email)" required>

        <select name="project_id" required>
            <option value="">Select Project</option>
            <?php
            $projects = $conn->query("SELECT id, name FROM projects");
            while($p = $projects->fetch_assoc()) {
                echo "<option value='{$p['id']}'>{$p['name']}</option>";
            }
            ?>
        </select>

        <button type="submit">Upload Task</button>
    </form>

    <div class="button-container">
        <!-- Button to view all projects -->
        <a href="view_projects.php">View All Projects</a>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>


<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month_year = $_POST['month_year'];
    $project_id = $_POST['project_id'];
    $status = 'pending';

    $upload_dir = "uploads/calendar/";
    $filename = basename($_FILES['calendar_file']['name']);
    $target_file = $upload_dir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['calendar_file']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO content_calendar (month_year, calendar_file, status, project_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $month_year, $target_file, $status, $project_id);
        $stmt->execute();
        echo "<p style='color: lightgreen;'>Calendar uploaded successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error uploading file.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Calendar</title>
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
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Upload Content Calendar</h2>
        <input type="text" name="month_year" placeholder="Month & Year (e.g., April 2025)" required>
        
        <select name="project_id" required>
            <option value="">Select Project</option>
            <?php
            $projects = $conn->query("SELECT id, name FROM projects");
            while($p = $projects->fetch_assoc()) {
                echo "<option value='{$p['id']}'>{$p['name']}</option>";
            }
            ?>
        </select>

        <input type="file" name="calendar_file" required>

        <button type="submit">Upload Calendar</button>
    </form>
</body>
</html>

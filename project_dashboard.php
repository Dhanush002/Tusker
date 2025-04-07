<?php
$project_id = $_GET['id'];
include 'db.php';

// Project Info
$p = $conn->query("SELECT * FROM projects WHERE id=$project_id")->fetch_assoc();
echo "<h2>Project: {$p['name']}</h2><p>Client: {$p['client_name']}</p><hr>";

// Tasks
echo "<h3>Tasks</h3>";
$tasks = $conn->query("SELECT * FROM tasks WHERE project_id=$project_id");
while($task = $tasks->fetch_assoc()) {
  echo "<p>{$task['task_name']} - Status: {$task['status']}</p>";
}

// Calendars
echo "<h3>Content Calendars</h3>";
$cals = $conn->query("SELECT * FROM content_calendar WHERE project_id=$project_id");
while($cal = $cals->fetch_assoc()) {
  echo "<p>{$cal['month_year']} - Status: {$cal['status']} 
         <a href='calendar/uploads/calendar/{$cal['calendar_file']}'>View</a></p>";
}
?>

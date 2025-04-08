<?php
include 'db.php';

// Fetch tasks for the admin dashboard
$tasks_result = $conn->query("SELECT task_name, assignee, project_id, status FROM tasks");
$task_status_count = [
    'pending' => 0,
    'in_progress' => 0,
    'completed' => 0
];

// Count tasks based on status
while ($row = $tasks_result->fetch_assoc()) {
    $status = $row['status'];
    if (array_key_exists($status, $task_status_count)) {
        $task_status_count[$status]++;
    }
}


// Fetch project names for the drop-down options
$projects = $conn->query("SELECT id, name FROM projects");
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h2 {
            color: #0f3;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #0b3d2e;
            color: #fff;
        }
        tr:hover {
            background-color: #262626;
        }
        .chart-container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
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

    <div class="container">
        <h2>Admin Dashboard</h2>

        <!-- Task List -->
        <table>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Assignee</th>
                    <th>Project</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display tasks in the table
                $tasks_result->data_seek(0); // Reset the pointer to the beginning
                while ($row = $tasks_result->fetch_assoc()) {
                    // Fetch project name with a check to ensure $project_id is valid
                    $project_id = $row['project_id'];
                    if (is_numeric($project_id) && $project_id > 0) {
                        // Use prepared statements to avoid SQL injection
                        $stmt = $conn->prepare("SELECT name FROM projects WHERE id = ?");
                        $stmt->bind_param("i", $project_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $project_name = $result->fetch_assoc()['name'];
                        $stmt->close();
                    } else {
                        $project_name = 'Unknown'; // Default value in case of invalid project ID
                    }

                    echo "<tr>
                            <td>{$row['task_name']}</td>
                            <td>{$row['assignee']}</td>
                            <td>{$project_name}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Chart Section -->
        <div class="chart-container">
            <h3>Task Status Distribution</h3>
            <canvas id="taskStatusChart"></canvas>
        </div>

        <div class="button-container">
            <a href="view_projects.php">View All Projects</a>
        </div>
    </div>

    <script>
    // Pie Chart for Task Status Distribution
    const ctx = document.getElementById('taskStatusChart').getContext('2d');
    const taskStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                label: 'Task Status Distribution',
                data: [<?php echo $task_status_count['pending']; ?>, <?php echo $task_status_count['in_progress']; ?>, <?php echo $task_status_count['completed']; ?>],
                backgroundColor: ['#ff9999', '#66b3ff', '#99ff99'],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>


</body>
</html>

<?php include 'footer.php'; ?>

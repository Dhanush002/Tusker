<?php
include 'db.php';
include 'header.php';

// Fetch all tasks from the database
$res = $conn->query("SELECT * FROM tasks");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Approve or Reject a task based on the status sent
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    
    // Update task status to 'approved' or 'rejected'
    $conn->query("UPDATE tasks SET status='$status' WHERE id=$task_id");

    // Redirect back to the tasks page
    header("Location: view_tasks.php");
    exit();
}
?>

<h2>Manage Tasks</h2>
<table>
    <thead>
        <tr>
            <th>Task Name</th>
            <th>Assignee</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title'] ?? '') ?></td> <!-- Use null coalescing to prevent passing null -->
                <td><?= htmlspecialchars($row['assignee'] ?? '') ?></td> <!-- Use null coalescing to prevent passing null -->
                <td><?= htmlspecialchars($row['status'] ?? '') ?></td> <!-- Use null coalescing to prevent passing null -->
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                        <?php if ($row['status'] != 'approved'): ?>
                            <button type="submit" name="status" value="approved">Approve</button>
                        <?php endif; ?>
                        <?php if ($row['status'] != 'rejected'): ?>
                            <button type="submit" name="status" value="rejected">Reject</button>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

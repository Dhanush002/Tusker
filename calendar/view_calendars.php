<?php include '../db.php'; ?>
<h2>All Calendars</h2>
<table border="1">
  <tr><th>Title</th><th>Designer</th><th>Month</th><th>Status</th><th>Action</th></tr>
  <?php
    $res = $conn->query("SELECT * FROM content_calendar ORDER BY id DESC");
    while($row = $res->fetch_assoc()) {
      echo "<tr>
              <td>{$row['title']}</td>
              <td>{$row['designer']}</td>
              <td>{$row['month_year']}</td>
              <td>{$row['status']}</td>
              <td>
                <a href='uploads/calendar/{$row['calendar_file']}' target='_blank'>View</a> | 
                <a href='approve_calendar.php?id={$row['id']}'>Approve</a>
              </td>
            </tr>";
    }
  ?>
</table>

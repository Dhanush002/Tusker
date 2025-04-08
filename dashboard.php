<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

switch ($_SESSION['role']) {
    case 'admin':
        header("Location: admin_dashboard.php");
        break;
    case 'designer':
        header("Location: designer_dashboard.php");
        break;
    case 'dm':
        header("Location: dm_dashboard.php");
        break;
    default:
        echo "Invalid role";
        break;
}
?>

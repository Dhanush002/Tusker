<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Plain text password

    // Debugging: Check if POST data is received
    if (empty($username) || empty($password)) {
        echo "Username or password is empty!";
    }

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if ($stmt === false) {
        die('MySQL Error: ' . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debugging: Check the fetched user details
        // Uncomment the next line if you need to debug the user details
        // var_dump($user);

        // Compare the entered password with the hashed password in the database
        if (password_verify($password, $user['password'])) {
            // Store user session and redirect to the appropriate page
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit;
            } else if ($user['role'] == 'designer' || $user['role'] == 'dm') {
                header("Location: designer_dashboard.php");
                exit;
            }
        } else {
            echo "Invalid credentials. Password mismatch!";
        }
    } else {
        echo "Invalid credentials. User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #1e1e1e;
            padding: 20px;
            max-width: 400px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 100, 0.2);
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #0f3;
            border-radius: 8px;
            background-color: #2b2b2b;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0b3d2e;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #21c48c;
        }

        h2 {
            text-align: center;
            color: #0f3;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>User Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

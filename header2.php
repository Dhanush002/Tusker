<?php
// header.php - This file is included at the top of every page.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tusker - Digital Marketing</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add any CSS specific to the header here, or leave this for external styling */
        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #111;
            padding: 10px 20px;
            text-align: center;
        }
        nav a {
            color: #e0e0e0;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }
        nav a:hover {
            color: #0f3;
        }
        /* Styling for the user icon and dropdown */
.user-icon {
    position: fixed;
    top: 20px;
    right: 20px;
    cursor: pointer;
    z-index: 10;
}

.user-icon img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ddd;
    padding: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 50px;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}

h2 {
    text-align: center;
    color: #4CAF50;
    margin-top: 80px;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #4CAF50;
    color: white;
}

table td {
    background-color: #f9f9f9;
}

form {
    display: inline-block;
    margin: 0;
}

input[type="file"] {
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 5px;
}

select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

button[type="submit"] {
    width: 100%;
}

form[action="logout.php"] {
    margin-top: 20px;
    text-align: center;
}

form[action="logout.php"] button {
    width: auto;
    padding: 10px 20px;
    background-color: #ff4d4d;
}

form[action="logout.php"] button:hover {
    background-color: #ff3333;
}

footer {
    text-align: center;
    margin-top: 40px;
    padding: 20px;
    background-color: #333;
    color: white;
}

    </style>
</head>
<body>
    <nav>
        
    </nav>
    <div class="container">
    <!-- Container ends at the footer.php -->

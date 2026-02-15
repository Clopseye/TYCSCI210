<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body style="color: white">
    <?php
        echo "<h2>Your Input:</h2>";
        echo "First Name: " . ($_SESSION['fname'] ?? 'Not submitted');
        echo "<br>";

        echo "Last Name: " . ($_SESSION['lname'] ?? 'Not submitted');
        echo "<br>";

        echo "Email: " . ($_SESSION['email'] ?? 'Not submitted');
        echo "<br>";
    ?>
</body>
</html>
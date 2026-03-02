<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Output Page</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                // Get and sanitize data
                $fname = tinput($_POST["fname"]);
                $lname = tinput($_POST["lname"]);
                $email = tinput($_POST["email"]);
                $password = $_POST["password"];

                // Check again
                $errors = [];

                if (!preg_match("/^[a-zA-Z-' ]+$/", $fname)) {
                    $errors[] = "First Name: Only letters and white space allowed.";
                }

                if (!preg_match("/^[a-zA-Z-' ]+$/", $lname)) {
                    $errors[] = "Last Name: Only letters and white space allowed.";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
                    $errors[] = "Password does not meet security requirements.";
                }

                if (empty($errors)) {
                    // Hash and show the data
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    echo "<h1>Success</h1>";
                    echo "<p><strong>First Name:</strong> $fname</p>";
                    echo "<p><strong>Last Name:</strong> $lname</p>";
                    echo "<p><strong>Email:</strong> $email</p>";
                } else {
                    // Show the errors found during the check
                    echo "<h1>Validation Failed</h1>";
                    echo "<ul style='color: red;'>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "<a href='login.php' style='color: #3498db;'>Go back and try again</a>";
                }
            } else {
                // If someone tries to access without logging in
                echo "<h1>Access Denied</h1>";
                echo "<p>Please submit the login form first.</p>";
            }

                function tinput($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;        
                }
        ?>

    </body>
</html>
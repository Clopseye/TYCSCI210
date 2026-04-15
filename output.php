<?php
    session_start();
    include 'datacon.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_user = tinput($_POST["username"]);
        $form_pass = $_POST["password"]; // Don't sanitize passwords; it can break them

        // Prepare statement to find the user
        $stmt = $conn->prepare("SELECT CustomerID, Password FROM Authentication WHERE Username = ?");
        $stmt->bind_param("s", $form_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Use password_verify to compare input to the database hash
            if (password_verify($form_pass, $row['Password'])) {
                
                // Get name from the Customers table using ID
                $custID = $row['CustomerID'];
                $nameQuery = $conn->query("SELECT FirstName, LastName FROM Customers WHERE CustomerID = $custID");
                $user = $nameQuery->fetch_assoc();

                $_SESSION['userID'] = $custID;
                $_SESSION['first_name'] = $user['FirstName'];
                $_SESSION['username'] = $form_user;
                $_SESSION['is_logged_in'] = true;

                // Send to home page
                header("Location: index.php");
                exit();
                
                
            } else {
                echo "<h1>Login Failed</h1>";
                echo "<p style='color: red;'>Invalid password.</p>";
            }
        } else {
            echo "<h1>Login Failed</h1>";
            echo "<p style='color: red;'>Username not found.</p>";
        }
        $stmt->close();
    }

    function tinput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
?>

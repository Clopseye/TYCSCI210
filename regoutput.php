<?php 
    include 'datacon.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from registery form
        $fname = tinput($_POST['fname']);
        $lname = tinput($_POST['lname']);
        $username = tinput($_POST['username']);
        $email = tinput($_POST['email']);

        // Hash password
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Start connection
        $conn->begin_transaction();

        try {
            // Insert into customer table
            $stmt1 = $conn->prepare("INSERT INTO Customers (FirstName, LastName, Email) VALUES (?, ?, ?)");
            $stmt1->bind_param("sss", $fname, $lname, $email);
            $stmt1->execute();

            // Get ID of new customer
            $newCustomerID = $conn->insert_id;

            // Insert into authentication table
            $stmt2 = $conn->prepare("INSERT INTO Authentication (CustomerID, Username, Password) VALUES (?, ?, ?)");
            $stmt2->bind_param("iss", $newCustomerID, $username, $hashed_password);
            $stmt2->execute();

            // Commit changes
            $conn->commit();
            echo "Registration successful! Welcome, " . htmlspecialchars($username);
            header("refresh:3;url=login.php");

        } catch (mysqli_sql_exception $exception) {
            // Rollback if something fails
            $conn->rollback();

            if ($conn->errno == 1062) {
                echo "Error: USer or Email already exists.";
            } else {
                echo "Registration failed: " . $exception->getMessage();
            }
        }

        $stmt1->close();
        $stmt2->close();
    }
    $conn->close();

    function tinput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
    }
?>
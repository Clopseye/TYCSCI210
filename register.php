<?php
    $fname =  $lname = $email = $password = "";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>

        <div id="navbar">
            <?php include 'nav.php'; ?>
        </div>
        
        <script src="navbarhide.js"></script>

        <main class="page-content">
        <div class="wrapper">
            
            <form method ="post" action="<?php echo htmlspecialchars("output.php"); ?>">

                <!-- Stop auto password fill on email field -->
                <input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" aria-hidden="true">
                <input type="password" name="password_fake" id="password_fake" value="" style="display:none;" aria-hidden="true">
                
                <h1>Register</h1>

                <div class="input-box">

                    <!-- First name input box -->
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter your first name"
                    pattern="^[a-zA-Z-' ]+$" title="Only letters and spaces allowed" required>

                    <!-- Last name input box -->
                    <input type="text" id="lname" name="lname" placeholder="Enter your last name"
                    pattern="^[a-zA-Z-' ]+$" title="Only letters and spaces allowed" required>
                </div>

                <!-- Email input box -->
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                    autocomplete="email" required>
                </div>

                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password"
                    pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Minimum 8 characters, at least one uppercase letter and one number"
                    autocomplete="current-password" required>
                </div>

                <button type="submit" class="login-btn">Create Account</button>
            </form> 
        </div>
        </main>
        
    </body>
</html>
<?php
    $fname = $lname = $email = "";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log-In</title>
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
            <form method="post" action="<?php echo htmlspecialchars("output.php"); ?>">
                
                <!-- Stop auto password fill on email field -->
                <input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" aria-hidden="true">
                <input type="password" name="password_fake" id="password_fake" value="" style="display:none;" aria-hidden="true">

                <h1>Login</h1>

                <div class="input-box">
                    <label for="username">Username</label>
                    <input type="username" id="username" name="username" placeholder="Enter your username"
                    autocomplete="username" required>
                </div>

                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                    pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Minimum 8 characters, at least one uppercase letter and one number"
                    autocomplete="current-password" required>
                </div>
                
                <div class="remember-forgot">
                    <label id="check"><input type="checkbox">&nbsp;Remember me</label>
                    <a href="#" id="Reg">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Submit</button>

                <div class="register-link">
                    <p>Don't have an account? <a href="register.php" id="Reg">Register</a></p>
                </div>
            </form> 
        </div>
        </main>
    </body>
</html>
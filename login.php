<?php
    session_start(); // Start session to store data

    // Define variables
    $fnameErr = $lnameErr = $emailErr = $passwordErr = "";
    $fname =  $lname = $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = tinput($_POST["fname"]);
        $lname = tinput($_POST["lname"]);
        $email = tinput($_POST["email"]);
        $password = tinput($_POST["password"]);


        
        // Store in session variables
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        session_write_close();
        header("Location: output.php");
        exit();
    }

    function tinput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;        
    }
?>
        
<!DOCTYPE html>
<html>
    <head>
        <title>Log-In</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script src="navbarhide.js"></script>
    </head>

    <body>
        

        <div id="nav-placeholder"></div>
        <script>
            fetch('nav.html')
                .then(function(response){ return response.text(); })
                .then(function(html){ 
                    document.getElementById('nav-placeholder').innerHTML = html;
                    // Load navbarhide.js
                    var script = document.createElement('script');
                    script.src = 'navbarhide.js';
                    document.head.appendChild(script);
                });
        </script>

        <main class="page-content">
        <div class="wrapper">
            
            <form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h1>Login</h1>

                <div class="input-box">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter your first name"
                    required>

                    <input type="text" id="lname" name="lname" placeholder="Enter your last name"
                    required>
                </div>

                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email"
                    required>
                </div>

                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password"
                    required>
                </div>
                
                <div class="remember-forgot">                   
                    <label id="check"><input type="checkbox">&nbsp;Remember me</label>
                    <a href="#" id="Reg">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Submit</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="register.html" id="Reg">Register</a></p>
                </div>
            </form> 
        </div>
        </main>
        
    </body>
</html>
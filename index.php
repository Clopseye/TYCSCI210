<?php 
    session_start(); 

    if (isset($_POST['confirm_order'])) {
        unset($_SESSION['cart']);
        $order_success = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    
    <body>

        <div id="navbar">
            <?php include 'nav.php'; ?>
        </div>
        
        <script src="navbarhide.js"></script>

        <main class="page-content">
            <section class="hero">
                <div class="hero-overlay">
                    <h1>Home Page</h1>
                    <p>Hello, <?php echo $_SESSION['first_name'] ?? 'Guest'; ?>.</p>
                </div>
            </section>
        </main>
        
    </body>
</html>
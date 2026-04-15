<header class="site-header">
    <div class="container header-inner">
        <div class="brand">My Site</div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                
                <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']=== true): ?>
                    <!-- Show this when logged in -->
                     <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['first_name']); ?>)</a> </li>
                <?php else: ?>
                    <!-- Show this when logged out -->
                     <li><a href="login.php">Log-In</a></li>
                     <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

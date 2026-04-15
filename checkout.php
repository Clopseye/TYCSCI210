<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script src="navbarhide.js"></script>
    </head>
    
    <body>

        <div id="navbar">
            <?php include 'nav.php'; ?>
        </div>
        
        <script src="navbarhide.js"></script>

        <main class="page-content">
        <div class="wrapper">
            <form action="index.php" method="POST">
            
                <div class="input-box">
                    <label for="address">Shipping Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter shipping address" required>
                </div>

                <div class="input-box">
                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cname" placeholder="Enter name on card" required>
                </div>

                <div class="input-box">
                    <label for="cnum">Card Number</label>
                    <input type="text" id="cnum" name="cnum" placeholder="**** **** **** ****" 
                    inputmode="numeric" maxlength="19" required>
                </div>

                

                <div class="Exp-CVV">
                    <div class="input-group">
                        <label for="exp">Expiration</label>
                        <input type="text" id="exp" name="exp" placeholder="MM/YY" required>
                    </div>

                    <div class="input-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" 
                        maxlength="4" inputmode="numeric" required>
                    </div>
                </div>

                <button type="submit" name="confirm_order" class="checkout">Checkout</button>
            
            </form>
        </div>
        </main>
        <script>
            // Card Number Format
            const cardInput = document.getElementById('cnum');

            cardInput.addEventListener('input', function (e) {
                // Remove non-numbers
                let value = e.target.value.replace(/\D/g, '');

                // Space every 4 numbers
                let formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');

                // Set input to format
                e.target.value = formattedValue;
            });

            // Expiration Format
            const expInput = document.getElementById('exp');

            expInput.addEventListener('input', function (e) {

                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 2) {
                    e.target.value = value.substring(0, 2) + '/' + value.substring(2, 4);
                } else {
                    e.target.value = value;
                }
            });

            // CVV Format
            const cvvInput = document.getElementById('cvv');

            cvvInput.addEventListener('input', function (e) {
                // Only numbers
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        </script>
    </body>
</html>
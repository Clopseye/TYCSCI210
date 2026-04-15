<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>

        <div id="navbar">
            <?php include 'nav.php'; ?>
        </div>

        <?php
            include 'datacon.php';

            // Adding an item
            if (isset($_POST['add_to_cart'])) {
                $item_array = array(
                    'id'    => $_POST['product_id'],   
                    'name'  => $_POST['product_name'], 
                    'price' => $_POST['product_price'],
                    'qty'   => $_POST['quantity']      
                );
                
                $product_id = $_POST['product_id'];
                $_SESSION['cart'][$product_id] = $item_array;
            }

            // Removing an item
            if (isset($_GET['action']) && $_GET['action'] == "remove") {
                $id_to_remove = $_GET['id'];
                
                // Check if it exists before unsetting
                if (isset($_SESSION['cart'][$id_to_remove])) {
                    unset($_SESSION['cart'][$id_to_remove]);
                }
                
                header("Location: cart.php");
                exit;
            }
        ?>
        
        <script src="navbarhide.js"></script>

        <main class="cart-page-content">
            <h1>Your Shopping Cart</h1>

            <?php if (!empty($_SESSION['cart'])): ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grand_total = 0;
                        foreach ($_SESSION['cart'] as $item): 
                            $subtotal = $item['price'] * $item['qty'];
                            $grand_total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['qty']; ?></td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <a  style="color: grey" href="cart.php?action=remove&id=<?php echo $item['id']; ?>" 
                                    onclick="return confirm('Remove this item?')">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="total-row">
                            <td colspan="3" align="right"><strong>Grand Total:</strong></td>
                            <td colspan="2"><strong>$<?php echo number_format($grand_total, 2); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                
                <form action="checkout.php" method="POST" class="cart-actions">
                    <div>
                        <a href="products.php" class="btn" style="color: grey">Continue Shopping</a>
                        <button class="btn btn-checkout">Proceed to Checkout</button>
                    </div>
                </form>

            <?php else: ?>
                <div class="empty-cart-msg">
                    <p>Your cart is currently empty.</p>
                    <a href="products.php" style="color: grey">Go back to products</a>
                </div>
            <?php endif; ?>
        </main>        
    </body>
</html>
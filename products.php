<?PHP session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>

        <div id="navbar">
            <?php include 'nav.php'; ?>
        </div>
        
        
        <?php
            include 'datacon.php';

            $search = $_POST['search'] ?? '';
            $filter = $_POST['filters'] ?? ''; 

            $query = "SELECT * FROM Products WHERE 1=1"; // Query table
            $params = []; // Search parameters (Search and Filter)
            $types = ""; // Store type for bind_param later

            if (!empty(trim($search))) {
                $query .= " AND ProductName LIKE ?"; // Query table using search
                $params[] = "%$search%";
                $types .= "s";
            }

            if (!empty(trim($filter))) {
                $query .= " AND Description LIKE ?"; // Query table using filter
                $params[] = "%$filter%";
                $types .= "s";
            }

            $stmt = $conn->prepare($query);

            if (!empty($params)) {
                $stmt->bind_param($types, ...$params); // Bind Search, Filter, or both
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $result = $conn->query("SELECT * FROM Products"); // Show all products if there are no parameters
            }

            $isSearch = !empty($search) || !empty($filter);
        ?>

        <script src="navbarhide.js"></script>

        <main class="page-content">

            <!-- Search Bar -->
             <div class="search-container">
                <form method="POST" action="products.php">
                    <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
                    
                    <select name="filters" id="filters" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="screen" <?= $filter == 'screen' ? 'selected' : '' ?>>Screens</option>
                        <option value="wired" <?= $filter == 'wired' ? 'selected' : '' ?>>Wired</option>
                    </select>

                    <button type="submit">Apply</button>
                    
                    <?php if ($isSearch): ?>
                        <a href="products.php">Clear</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="hero-products" <?php if ($isSearch) echo 'style="display:none"'; ?>>
                <div class="hero-overlay">
                    <h1>Products</h1>
                </div>
            </div>

            <section class="products">
                <div class="product-grid">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                                <article class="product-card">
                                    <img src="images/<?php echo htmlspecialchars($row['ImageFile']); ?>" alt="<?php echo $row['ProductName']; ?>">

                                    <h2><?php echo htmlspecialchars($row['ProductName']); ?></h2>
                                    <p><?php echo htmlspecialchars($row['Description']); ?></p>
                                    <p><strong>$<?php echo number_format($row['Price'], 2); ?></strong></p>

                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['ProductName']); ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                                        
                                        <label>Qty: <input type="number" name="quantity" value="1" min="1"></label>
                                        
                                        <button type="submit" name="add_to_cart">Add to Cart</button>
                                    </form>

                                    <?php if ($row['StockQuantity'] <= 5): ?>
                                        <p style="color: red; font-size: 0.8em;">Only <?php echo $row['StockQuantity']; ?> left!</p>
                                    <?php endif; ?>
                                </article>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No products match your search.</p>
                        <?php endif; ?>
                </div>
            </section>
        </main>

        <script>
            $(document).ready(function() {
                $('.product-card').click(function() {
                    const $this = $(this);

                    // Reset if card is expanded
                    if ($this.hasClass('is-expanded')) {
                        $('.product-card').removeClass('is-hidden is-expanded');
                        $('.hero').css('display', 'flex'); // Show hero again
                    } 

                    // if not, expand card and hide others
                    else {
                        $this.addClass('is-expanded');
                        $this.siblings().addClass('is-hidden');
                        $('.hero').css('display', 'none'); // Hide hero to make room
                    }

                    $('.product-card form').click(function(e) {
                        e.stopPropagation();
                    });
                });
            });
        </script>
    </body>
</html>
<?php
session_start();

// Dummy product data for demonstration
$products = [
    1 => ['pname' => 'Centrum', 'price' => 350],
    2 => ['pname' => 'Caltrate', 'price' => 760],
    3 => ['pname' => 'Ester-C', 'price' => 500],
    4 => ['pname' => 'Glucosamine', 'price' => 1200],
];

// Function to get the price of a product
function get_product_price($pid) {
    global $products;
    return isset($products[$pid]) ? $products[$pid]['price'] : 0;
}

// Function to get all products
function get_products() {
    global $products;
    return $products;
}

// Function to calculate total in cart
function calculate_total($cart) {
    $total = 0;
    foreach ($cart as $pid => $quantity) {
        $price = get_product_price($pid);
        $total += $price * $quantity;
    }
    return $total;
}

// Check if the user is a member (for demonstration purpose, setting it as false)
$is_member = isset($_SESSION['username']) && !empty($_SESSION['username']); // This should be replaced with actual member check logic

// Initialize the cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pid'])) {
        $pid = $_POST['pid'];
        $quantity = $_POST['quantity'];
        
        // Add product to cart
        $_SESSION['cart'][$pid] = isset($_SESSION['cart'][$pid]) ? $_SESSION['cart'][$pid] + $quantity : $quantity;

        // Calculate total
        $total = calculate_total($_SESSION['cart']);


        if ($is_member) {
            // แสดงข้อเสนอให้ซื้อสินค้าเพิ่มอีกหนึ่งชิ้น
            echo "<p>คุณสามารถเลือกซื้อสินค้าเพิ่มอีกหนึ่งชิ้นได้!</p>";
            echo "<form action='cart.php' method='post'>";
            echo "<label for='additional_pid'>เลือกสินค้าหนึ่งชิ้น:</label>";
            echo "<select name='additional_pid' id='additional_pid'>";
            
            // แสดงรายการสินค้าทั้งหมดในระบบ
            // สมมุติว่ามีฟังก์ชัน get_products() ที่คืนค่ารายการสินค้า
            $available_products = get_products();
            foreach ($available_products as $product_id => $product) {
                if ($product['price'] >= 500) {
                    echo "<option value='{$product_id}'>{$product['pname']} - Price: {$product['price']}</option>";
                }
            }
    
            echo "</select>";
            echo "<input type='submit' value='เพิ่มสินค้า'>";
            echo "</form>";
        } else if (!$is_member && $total >= 500) {
            echo "<p>Your total is $total Baht. You are eligible to choose an additional product!</p>";
            echo "<form action='cart.php' method='post'>";
            echo "<label for='additional_pid'>Select an additional product (Price ≤ 500 Baht):</label>";
            echo "<select name='additional_pid' id='additional_pid'>";

            // Show products priced at or below 500 Baht
            $available_products = get_products();
            foreach ($available_products as $product_id => $product) {
                if ($product['price'] <= 500) {
                    echo "<option value='{$product_id}'>{$product['pname']} - Price: {$product['price']}</option>";
                }
            }

            echo "</select>";
            echo "<input type='submit' value='Add Product'>";
            echo "</form>";
        }
    }

    // Handle adding additional product
    if (isset($_POST['additional_pid'])) {
        $additional_pid = $_POST['additional_pid'];
        $_SESSION['cart'][$additional_pid] = isset($_SESSION['cart'][$additional_pid]) ? $_SESSION['cart'][$additional_pid] + 1 : 1;
        echo "<p>You have added an additional product to your cart!</p>";
    }
}

// Display current cart items
if (!empty($_SESSION['cart'])) {
    echo "<h2>Your Cart:</h2>";
    foreach ($_SESSION['cart'] as $pid => $quantity) {
        $product_name = $products[$pid]['pname'];
        $product_price = get_product_price($pid);
        echo "<p>$product_name: $quantity x $product_price Baht</p>";
    }
} else {
    echo "<p>Your cart is empty.</p>";
}


?>
<a href='logout.php'>ออกจากระบบ</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
</body>
</html>

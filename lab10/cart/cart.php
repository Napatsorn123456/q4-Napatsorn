<?php
session_start();
include "connect.php";

// Check if user is logged in
if (empty($_SESSION["username"])) {
    header("location: login-form.php");
    exit();
}

// Add item to cart logic
if ($_GET["action"] == "add") {
    // Your existing code...
} elseif ($_GET["action"] == "update") {
    // Your existing code...
} elseif ($_GET["action"] == "delete") {
    // Your existing code...
}

if ($_GET["action"] == "add") {
    $pid = $_GET['pid'];
    $stmt = $pdo->prepare("SELECT stock FROM product WHERE pid = ?");
    $stmt->bindParam(1, $pid);
    $stmt->execute();
    $product = $stmt->fetch();

    // ตรวจสอบว่าเลือกจำนวนที่มีในสต็อกหรือไม่
    if ($_POST['qty'] > $product['stock']) {
        echo "จำนวนสินค้าที่เลือกเกินจำนวนที่มีในสต็อก";
    } else {
        // เพิ่มลงในตะกร้า
        $cart_item = array(
            'pid' => $pid,
            'pname' => $_GET['pname'],
            'price' => $_GET['price'],
            'qty' => $_POST['qty']
        );

        if (empty($_SESSION['cart']))
            $_SESSION['cart'] = array();

        if (array_key_exists($pid, $_SESSION['cart'])) {
            $_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
        } else {
            $_SESSION['cart'][$pid] = $cart_item;
        }
        
        // ลดจำนวน stock
        $new_stock = $product['stock'] - $_POST['qty'];
        $update_stmt = $pdo->prepare("UPDATE product SET stock = ? WHERE pid = ?");
        $update_stmt->execute([$new_stock, $pid]);
    }
}
?>

<html>
<head>
<script>
    // Function to update quantity
    function update(pid) {
        var qty = document.getElementById(pid).value;
        // Update session quantity
        document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
    }
</script>
</head>
<body>
<form>
<table border="1">
<?php 
$sum = 0;
foreach ($_SESSION["cart"] as $pid => $item) {
    // Fetch product details including stock from database
    $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
    $stmt->bindParam(1, $pid);
    $stmt->execute();
    $product = $stmt->fetch();

    // Calculate total sum
    $sum += $product["price"] * $item["qty"];
?>
    <tr>
        <td><?=$product["pname"]?></td>
        <td><?=$product["price"]?></td>
        <td>
            <input type="number" id="<?=$pid?>" value="<?=$item['qty']?>" min="1" max="<?=$product['stock_quantity']?>"> <!-- Limit max to stock quantity -->
            <a href="#" onclick="update(<?=$pid?>)">แก้ไข</a>
            <a href="?action=delete&pid=<?=$pid?>">ลบ</a>
        </td>
    </tr>
<?php } ?>
<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
</table>
</form>

<a href="index.php">< เลือกสินค้าต่อ</a>
</body>
</html>

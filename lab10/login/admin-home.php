<?php
session_start();
include "connect.php";



// Fetch all products and their stock levels
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
$products = $stmt->fetchAll();
?>

<html>
<body>
<h1>Admin Panel</h1>
<h2>Product Stock</h2>
<table border="1">
    <tr>
        <th>Product Name</th>
        <th>Stock Quantity</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?=$product["pname"]?></td>
            <td><?=$product["stock_quantity"]?></td> <!-- Show stock quantity -->
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

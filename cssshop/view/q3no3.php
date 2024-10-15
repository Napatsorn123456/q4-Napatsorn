<?php include "connect.php"; ?>

<?php
// รับค่า pid จาก URL
$pid = $_GET['pid'];

// SQL query to fetch order details for the specific product
$stmt = $pdo->prepare("
    SELECT orders.ord_id, orders.username, orders.ord_date, item.quantity,
    IFNULL(SUM(item.quantity), 0) AS quantity
    FROM orders
    JOIN item ON orders.ord_id = item.ord_id
    WHERE item.pid 
");
$stmt->execute([$pid]);
$orderDetails = $stmt->fetchAll();
?>

<html>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Order Details for Product ID: <?php echo $pid; ?></h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Quantity Ordered</th>
        </tr>
        <?php foreach ($row as $row): ?>
        <tr>
            <td><?php echo $row["ord_id"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["ord_date"]; ?></td>
            <td><?php echo $row["quantity"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

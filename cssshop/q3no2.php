<?php include "connect.php"; ?>

<?php
// SQL query to fetch products and the count of orders for each product
$stmt = $pdo->prepare("
    SELECT product.pid, product.pname, product.pdetail, product.price, 
    IFNULL(SUM(item.quantity), 0) AS order_count
    FROM product 
    LEFT JOIN item ON product.pid = item.pid
    GROUP BY product.pid
");
$stmt->execute();
$row = $stmt->fetchAll();
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
    <h2>Product List with Order Count</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Detail</th>
            <th>Price</th>
            <th>Number of Orders</th>

        </tr>
        <?php foreach ($row as $row): ?>
        <tr>
            <td><?php echo $row["pid"]; ?></td>
            <td><?php echo $row["pname"]; ?></td>
            <td><?php echo $row["pdetail"]; ?></td>
            <td><?php echo $row["price"]; ?> บาท</td>
            <td><?php echo $row["order_count"]; ?></td>
            <td><a href="q3no3.php?pid=<?php echo $row["pid"]; ?>">View Orders</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
session_start();
include "connect.php";

// ตรวจสอบสิทธิ์ admin
if ($_SESSION["role"] !== "admin") {
    header("Location: login-form.php");
}

$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
?>

<html>
<head><meta charset="utf-8"></head>
<body>
<h1>สินค้าคงเหลือ</h1>
<table border="1">
<tr>
    <th>ชื่อสินค้า</th>
    <th>ราคา</th>
    <th>จำนวนคงเหลือ</th>
</tr>
<?php while ($row = $stmt->fetch()): ?>
<tr>
    <td><?= $row["pname"] ?></td>
    <td><?= $row["price"] ?> บาท</td>
    <td><?= $row["stock"] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>

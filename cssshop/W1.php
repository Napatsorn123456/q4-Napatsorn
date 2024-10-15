<?php include "connect.php" ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
$row = $stmt->fetchAll() 
?>
<html>
<style>
    table, th, td {
    border: 1px solid black;
    }
</style>
<head><meta charset="utf-8"></head>
<body>
    <table >
    <tr>
    <th>รหัสสินค้า</th>
    <th>ชื่อสินค้า</th>
    <th>รายละเอียดสินค้า</th>
    <th>ราคา</th>
  </tr>
  <tr> 
    <?php foreach ($row as $row): ?>
    <td><?php echo  $row ["pid"]; ?></td>
    <td><?php echo  $row ["pname"]; ?></td>
    <td><?php echo  $row ["pdetail"]; ?></td>
    <td><?php echo  $row ["price"]; ?> บาท</td>
  </tr>
  <?php endforeach;?>
    </table>

</body>
</html>
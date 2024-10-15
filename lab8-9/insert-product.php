<?php include "connect.php" ?>
<?php
$stmt = $pdo->prepare("INSERT INTO product VALUES ('', ?, ?, ?)");
$stmt->bindParam(1, $_POST["pname"]);
$stmt->bindParam(2, $_POST["pdetail"]);
$stmt->bindParam(3, $_POST["price"]);
$stmt->execute(); // เริ่มเพิ่มข้อมูล
$pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มส าเร็จ
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
เพิ่มสนค้าส ิ าเร็จ รหัสสนค้าใหม่ คือ ิ <?=$pid?>
</body>
</html>
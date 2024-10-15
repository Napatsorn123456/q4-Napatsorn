<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8">
<script>
function confirmDelete(pid) { // ฟังก์ชนจะถูกเรียกถ้าผู้ใช ั คลิกที่ ้ link ลบ
var ans = confirm("ต ้องการลบสนค ้ารหัส ิ " + pid); // แสดงกล่องถามผู้ใช ้
if (ans==true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
document.location = "delete.php?pid=" + pid; // สงรหัสส ่ นค ้าไปให ้ไฟล์ ิ delete.php
}
</script>
</head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
while ($row = $stmt->fetch()) {
echo "รหัสสนค ้า ิ : " . $row ["pid"] . "<br>";
echo "ชอสนค ้า ิ : " . $row ["pname"] . "<br>";
echo "รายละเอียดสนค ้า ิ : " . $row ["pdetail"] . "<br>";
echo "ราคา: " . $row ["price"] . " บาท <br>";
echo "<a href='editform.php?pid=" . $row ["pid"] . "'>แก ้ไข</a> | ";
echo "<a href='#' onclick='confirmDelete(" . $row ["pid"] . ")'>ลบ</a>";
echo "<hr>\n";
}
?>
</body>
</html>
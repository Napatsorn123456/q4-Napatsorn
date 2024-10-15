<?php include "connect.php" ?>
<?php
// เตรียมค าสง

$stmt = $pdo->prepare("DELETE FROM member WHERE name=?");
$stmt->bindParam(1, $_GET["name"]); // ก าหนดค่าลงในต าแหน่ง ?
if ($stmt->execute()) // เริ่มลบข้อมูล
header("location: memberlist.php"); // กลับไปแสดงผลหน้าข้อมูล

?>
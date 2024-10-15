<?php include "connect.php"; ?>

<?php
// เตรียมคำสั่ง SQL สำหรับแก้ไขข้อมูล
$stmt = $pdo->prepare("UPDATE member SET username=?, password=?, address=?, mobile=?, email=? WHERE name=?");

// กำหนดค่าจากฟอร์ม
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->bindParam(3, $_POST["address"]);
$stmt->bindParam(4, $_POST["mobile"]);
$stmt->bindParam(5, $_POST["email"]);
$stmt->bindParam(6, $_POST["old_name"]); // ใช้ name เดิมในการค้นหาและแก้ไข

// เริ่มแก้ไขข้อมูล
if ($stmt->execute()) {
    echo "แก้ไข " . $_POST["name"] . " สำเร็จ";
} else {
    echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล";
}
?>

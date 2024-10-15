<?php
include "connect.php"; // เชื่อมต่อฐานข้อมูล
session_start(); // เริ่มต้น session

// ตรวจสอบว่าผู้ใช้มีสิทธิ์ Admin
if ($_SESSION['role'] != 'admin') {
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้.";
    exit; // ออกจากระบบหากไม่มีสิทธิ์
}

// รับชื่อผู้ใช้จากพารามิเตอร์ URL
$username = $_GET['username']; 

// ดึงข้อมูลรายการ Order ของผู้ใช้
$stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?"); 
$stmt->bindParam(1, $username);
$stmt->execute();

echo "<h2>รายการ Order ของผู้ใช้: $username</h2>";

// ตรวจสอบว่ามีรายการ Order หรือไม่
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
        echo "Order ID: " . htmlspecialchars($row["ord_id"]) . "<br>";
        echo "วันที่: " . htmlspecialchars($row["ord_date"]) . "<br>";
        echo "สถานะ: " . htmlspecialchars($row["status"]) . "<br>";
        echo "<hr>";
    }
} else {
    echo "ไม่พบรายการ Order สำหรับผู้ใช้: $username";
}
?>

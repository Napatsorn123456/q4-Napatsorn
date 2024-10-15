<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
  
<?php
$stmt = $pdo->prepare("SELECT name, address, email FROM member");
$stmt->execute();
$index = 1; // ตัวแปรนับสำหรับชื่อรูปภาพ (เริ่มจาก 1)
    
// วนลูปเพื่อแสดงผลลัพธ์จากฐานข้อมูล
while ($row = $stmt->fetch()) {
    // ใช้ตัวแปร $index เพื่อกำหนดชื่อไฟล์ภาพ
    $imagePath = "image/$index.jpg"; 
    echo "<div style='padding: 15px; text-align: left'>";
    echo "<img src='$imagePath' width='100'><br>";
    echo $row["name"] . "<br>";
    echo $row["address"] . "<br>";
    echo $row["email"];
    echo "</div>";
    $index++; // เพิ่มค่าตัวแปร $index ทุกครั้งที่วนลูป
}

?>

</body>
</html>


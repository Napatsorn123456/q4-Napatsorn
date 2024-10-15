<?php include "connect.php"; ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<form>
    <input type="text" name="keyword" placeholder="ค้นหาสมาชิก">
    <input type="submit" value="ค้นหา">
</form>

<div style="display: flex; flex-wrap: wrap;">
<?php
// ตรวจสอบว่ามีการส่งค่า keyword มาจากฟอร์มหรือไม่
if (!empty($_GET['keyword'])) {
    $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ?");
    $value = '%' . $_GET["keyword"] . '%';
    $stmt->bindParam(1, $value);
    $stmt->execute();
    
    $index = 1; // ตัวแปรนับสำหรับชื่อรูปภาพ (เริ่มจาก 1)
    
    // วนลูปเพื่อแสดงผลลัพธ์จากฐานข้อมูล
    while ($row = $stmt->fetch()) {
        // ใช้ตัวแปร $index เพื่อกำหนดชื่อไฟล์ภาพ
        $imagePath = "image/$index.jpg"; 
        echo "<div style='padding: 15px; text-align: center'>";
        echo "<img src='$imagePath' width='100'><br>";
        echo $row["name"] . "<br>";
        echo $row["address"] . "<br>";
        echo $row["mobile"] . "<br>";
        echo $row["email"];
        echo "</div>";
        $index++; // เพิ่มค่าตัวแปร $index ทุกครั้งที่วนลูป
    }
} else {
    echo "<p>กรุณาใส่คำค้นหาก่อนกดค้นหา</p>";
}
?>
</div>
</body>
</html>

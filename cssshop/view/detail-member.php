<?php include "connect.php"; ?>
<html>
<head><meta charset="utf-8"></head>
<body>

<?php
// เตรียมคำสั่ง SQL สำหรับดึงข้อมูลสมาชิก
$stmt = $pdo->prepare("SELECT * FROM member WHERE name = ?");
$stmt->bindParam(1, $_GET["name"]); // ดึงค่าที่ส่งมากับ URL เป็นเงื่อนไข
$stmt->execute(); // เริ่มค้นหา
$row = $stmt->fetch(); // ดึงผลลัพธ์ (มีข้อมูล 1 แถว จึงใช้ fetch ครั้งเดียว)

// กำหนดตัวแปร index สำหรับชื่อรูปภาพ
$index = 1; // คุณสามารถปรับเริ่มต้น index ตามลำดับของสมาชิกในระบบ
?>

<div style="display:flex">
    <div>
         <!-- แสดงรูปภาพโดยใช้ index เป็นชื่อไฟล์รูปภาพ เช่น 1.jpg, 2.jpg -->
         <img src='image/<?=$index?>.jpg' width='100'>
    </div>
    <div style="padding: 15px">
        <!-- แสดงข้อมูลสมาชิก -->
        <?=$row["name"]?><br>
        ที่อยู่: <?=$row["address"]?><br>
        อีเมล: <?=$row["email"]?><br><br>
    </div>
</div>

<?php
// เพิ่มค่า index เพื่อใช้ในรอบถัดไป (หากต้องการแสดงข้อมูลหลายคนในลูป)
$index++;
?>

</body>
</html>

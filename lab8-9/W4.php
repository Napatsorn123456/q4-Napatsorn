<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<div style="display:flex">
<?php
$stmt = $pdo->prepare("SELECT * FROM member");
$stmt->execute();
$index = 1; // ตัวแปรนับสำหรับชื่อรูปภาพ (เริ่มจาก 1)
?>

<?php while ($row = $stmt->fetch()) : ?>
    <div style="padding: 15px; text-align: center">
        <!-- ลิงก์ไปยังรายละเอียดของสมาชิก -->
        <a href="detail-member.php?name=<?=$row["name"]?>">
            <!-- แสดงรูปภาพโดยใช้ index เป็นชื่อไฟล์ เช่น 1.jpg, 2.jpg, 3.jpg -->
            <img src='image/<?=$index?>.jpg' width='100'>
        </a><br>
        <!-- แสดงข้อมูลสมาชิก -->
        <?=$row["name"]?><br>
        <?=$row["address"]?><br>
        <?=$row["email"]?><br><br>
    </div>
    <?php $index++; // เพิ่มค่า $index ทีละ 1 ?>
<?php endwhile; ?>
</div>
</body>
</html>

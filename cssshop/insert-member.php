<?php include "connect.php"; ?>
<?php
    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลสมาชิก
    $stmt = $pdo->prepare("INSERT INTO member VALUES (?, ?, ?, ?, ?, ?)");

    // กำหนดค่าตัวแปรจากฟอร์ม
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->bindParam(3, $_POST["name"]);
    $stmt->bindParam(4, $_POST["address"]);
    $stmt->bindParam(5, $_POST["mobile"]);
    $stmt->bindParam(6, $_POST["email"]);

    // เริ่มเพิ่มข้อมูล
    $stmt->execute();

    // ขอคีย์หลักที่เพิ่มสำเร็จ (ID ของสมาชิกที่เพิ่ม)
    $mid = $pdo->lastInsertId();

    header("location: detail-member.php?pid=" . $pid);
?>

<html>
<head><meta charset="UTF-8"></head>
<body>
    เพิ่มสมาชิกสำเร็จ ชื่อสมาชิก: <?=htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8')?>
</body>
</html>

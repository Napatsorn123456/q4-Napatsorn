<?php include "connect.php"; ?>
<?php
// ดึงข้อมูลสมาชิกตาม `name`
$stmt = $pdo->prepare("SELECT * FROM member WHERE name = ?");
$stmt->bindParam(1, $_GET["name"]);
$stmt->execute();
$row = $stmt->fetch();
?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <form action="edit-member.php" method="post">
        Username: <input type="text" name="username" value="<?=$row['username']?>" required><br><br>
        Password: <input type="password" name="password" value="<?=$row['password']?>" required><br><br>
        ชื่อ: <input type="text" name="name" value="<?=$row['name']?>" required><br><br>
        ที่อยู่: <textarea name="address" rows="3" cols="40" required><?=$row['address']?></textarea><br><br>
        Phone: <input type="text" name="mobile" value="<?=$row['mobile']?>" required><br><br>
        Email: <input type="email" name="email" value="<?=$row['email']?>" required><br><br>
        <input type="hidden" name="old_name" value="<?=$row['name']?>"> <!-- ส่งค่า name เดิม -->
        <input type="submit" value="Edit"><br>
    </form>
</body>
</html>

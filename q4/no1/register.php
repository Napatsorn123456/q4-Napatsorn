<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO member (username, password, name, address, mobile, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['username'], $_POST['password'], $_POST['name'], $_POST['address'], $_POST['mobile'], $_POST['email']]);
    echo "ลงทะเบียนสำเร็จ";
}
?>

<form method="post">
    ชื่อผู้ใช้: <input type="text" name="username" required><br>
    รหัสผ่าน: <input type="password" name="password" required><br>
    ชื่อ-นามสกุล: <input type="text" name="name" required><br>
    ที่อยู่: <input type="text" name="address" required><br>
    เบอร์โทร: <input type="text" name="mobile" required><br>
    อีเมล: <input type="email" name="email" required><br>
    <input type="submit" value="ลงทะเบียน">
</form>

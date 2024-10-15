<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    $stmt->execute([$_POST["username"], $_POST["password"]]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: products.php"); // เปลี่ยนไปยังหน้าสินค้า
        exit();
    } else {
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>

<form method="post">
    ชื่อผู้ใช้: <input type="text" name="username" required><br>
    รหัสผ่าน: <input type="password" name="password" required><br>
    <input type="submit" value="เข้าสู่ระบบ">
</form>

<!-- ปุ่มสำหรับไปยังหน้าสินค้าโดยไม่ต้องล็อกอิน -->
<a href="products.php">
    <button type="button">เลือกซื้อสินค้าโดยไม่ล็อกอิน</button>
</a>

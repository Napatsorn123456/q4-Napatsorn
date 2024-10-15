<?php
  include "connect.php";
  
  session_start();

  $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
  $stmt->bindParam(1, $_POST["username"]);
  $stmt->bindParam(2, $_POST["password"]);
  $stmt->execute();
  $row = $stmt->fetch();

  // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
  $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();

if (!empty($row)) {
    $_SESSION["fullname"] = $row["name"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"]; // เพิ่มการเก็บ role
    
    // เพิ่มตรวจสอบสิทธิ์ admin
    if ($row["role"] == "admin") { // เปลี่ยนเป็นเงื่อนไขที่เหมาะสมสำหรับ admin
        $_SESSION["role"] = "admin";
        header("Location: admin-home.php"); // หน้าสำหรับ admin
    } else {
        $_SESSION["role"] = "user";
        header("Location: user-home.php"); // หน้าสำหรับ user
    }
} else {
    echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
    echo "<a href='login-form.php'>เข้าสู่ระบบอีกครั้ง</a>"; 
  // กรณี username และ password ไม่ตรงกัน
  } 
?>

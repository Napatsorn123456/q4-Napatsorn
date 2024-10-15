<?php
// รับค่า keyword จาก URL
$keyword = $_GET["keyword"];

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "sec1_25", "Wstd25", "vcsLxVK8");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าภาษาให้เป็น UTF-8
$conn->set_charset("utf8");

// SQL query ค้นหาข้อมูลสมาชิกที่มีชื่อเหมือนกับ keyword
$sql = "SELECT * FROM member WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$keyword = "%$keyword%";
$stmt->bind_param("s", $keyword);
$stmt->execute();
$result = $stmt->get_result();

// แสดงผลในรูปแบบตาราง
echo "<table border='1'>";
echo "<tr><th>Username</th><th>Name</th><th>Address</th><th>Mobile</th><th>Email</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["mobile"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "</tr>";
}

echo "</table>";

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>

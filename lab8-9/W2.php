<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
  
<?php
$stmt = $pdo->prepare("SELECT name, address, email FROM member");
$stmt->execute();
    
// วนลูปเพื่อแสดงผลลัพธ์จากฐานข้อมูล
while ($row = $stmt->fetch()) {
    echo "<div style='padding: 15px; text-align: left'>";
    echo $row["name"] . "<br>";
    echo $row["address"] . "<br>";
    echo $row["email"];
    echo "</div>";
    echo "<hr>\n";
}

?>

</body>
</html>


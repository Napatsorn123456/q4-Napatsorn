<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8">
<script>
function confirmDelete(name) { 
    var ans = confirm("ต้องการลบสมาชิกชื่อ " + name + " ใช่หรือไม่?"); // แสดงกล่องถามผู้ใช้
    if (ans == true) { // ถ้าผู้ใช้กด OK
        document.location = "delete-member.php?name=" + encodeURIComponent(name); // ส่งรหัสสมาชิกไปที่ deletemem.php
    }
}

function confirmEdit(name) { 
    var ans = confirm("ต้องการแก้ไขสมาชิกชื่อ " + name + " ใช่หรือไม่?"); // แสดงกล่องถามผู้ใช้
    if (ans == true) { // ถ้าผู้ใช้กด OK
        document.location = "edit-from.php?name=" + encodeURIComponent(name); // ส่งรหัสสมาชิกไปที่ editform.php
    }
}

function confirmAdd(name) { 
    var ans = confirm("ต้องการเพิ่มสมาชิกชื่อ " + name + " ใช่หรือไม่?"); // แสดงกล่องถามผู้ใช้
    if (ans == true) { // ถ้าผู้ใช้กด OK
        document.location = "add-member.php?name=" + encodeURIComponent(name); // ส่งรหัสสมาชิกไปที่ editform.php
    }
}
</script>
</head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM member");
$stmt->execute();
while ($row = $stmt->fetch()) {
    echo $row["name"] . "<br>";
    echo $row["address"] . "<br>";
    echo $row["email"] . "<br>";
    echo "<a href='#' onclick='confirmEdit(\"" . $row["name"] . "\")'>แก้ไข</a> | ";
    echo "<a href='#' onclick='confirmDelete(\"" . $row["name"] . "\")'>ลบ</a> | ";
    echo "<a href='#' onclick='confirmAdd(\"" . $row["name"] . "\")'>เพิ่ม</a> ";
    echo "<hr>\n";
}
?>
</body>
</html>

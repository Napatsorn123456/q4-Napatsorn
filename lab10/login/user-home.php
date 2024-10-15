<?php session_start(); ?>
<?php include "connect.php"; ?>

<html>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>
<h2>ข้อมูลของคุณ</h2>

<?php
    // ตรวจสอบว่าผู้ใช้มีสิทธิ์อะไร
    if ($_SESSION["role"] == "user") {
        // แสดงรายการสั่งซื้อของผู้ใช้
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
        $stmt->bindParam(1, $_SESSION["username"]);
        $stmt->execute();

        echo " <a href='../cart/cart.php?'>สั่งซื้อสินค้า</a><br>";
        if ($stmt->rowCount() > 0) {
            echo "<h3>รายการสั่งซื้อของคุณ:</h3>";
            while ($order = $stmt->fetch()) {
                echo "Order ID: " . $order["ord_id"] . "<br>";
                echo "วันที่: " . $order["ord_date"] . "<br>";
                echo "สถานะ: " . $order["status"] . "<br>";
                echo "<hr>";
            }
        } else {
            echo "คุณยังไม่มีรายการสั่งซื้อ.";
        }

    } elseif ($_SESSION["role"] == "admin") {
        // แสดงจำนวน Order ของผู้ใช้แต่ละคน
        $stmt = $pdo->prepare("SELECT username, COUNT(ord_id) as total_orders FROM orders GROUP BY username");
        $stmt->execute();

        echo "<h3>จำนวนรายการสั่งซื้อของผู้ใช้แต่ละคน:</h3>";
        while ($row = $stmt->fetch()) {
            echo "ผู้ใช้: " . $row["username"] . " - จำนวน Order: " . $row["total_orders"];
            echo " <a href='order-detail.php?username=" . $row["username"] . "'>ดูรายละเอียด</a><br>";
        }
    }
?>

หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
</body>
</html>

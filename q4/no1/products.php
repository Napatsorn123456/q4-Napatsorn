<?php
session_start();
include "connect.php";

$stmt = $pdo->query("SELECT * FROM product");

while ($row = $stmt->fetch()) {
    echo $row['pname'] . " - ราคา: " . $row['price'] . " บาท <br>";
    echo "<form method='post' action='cart.php'>";
    echo "<input type='hidden' name='pid' value='" . $row['pid'] . "'>";
    echo "<input type='number' name='quantity' min='1' max='" . $row['stock'] . "' required>";
    echo "<input type='submit' value='ซื้อ'>";
    echo "</form><br>";
}
?>

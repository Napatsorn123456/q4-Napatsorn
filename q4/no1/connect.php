<?php
try {
	$pdo = new PDO("mysql:host=localhost;dbname=sec1_25;charset=utf8", "Wstd25", "vcsLxVK8");
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>
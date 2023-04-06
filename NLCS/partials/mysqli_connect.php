<?php

// Tắt các báo cáo lỗi
mysqli_report(MYSQLI_REPORT_OFF);

// Ký tự @ dùng để tắt các cảnh báo (warning) sinh ra bởi câu lệnh
$conn = mysqli_connect('localhost', 'root', '', 'ct275_lab3');
if (!$conn) {
	echo '<p class="error">Không thể kết nối đến CSDL vì:<br>' .
		mysqli_connect_error() . '.</p>';
	
	exit();
}
mysqli_set_charset($conn, 'utf8');
session_start();
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
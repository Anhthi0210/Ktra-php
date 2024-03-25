<?php
// Khởi động session
session_start();

// Xóa tất cả các biến session
session_unset();

// Hủy phiên đăng nhập
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("Location: login.php");
exit;
?>
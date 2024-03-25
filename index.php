<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if(!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit;
}

// Hiển thị trang chính
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chính</title>
</head>
<body>
    <h2>Xin chào, <?php echo $_SESSION['Fullname']; ?></h2>
    <p>Vai trò của bạn: <?php echo $_SESSION['Role']; ?></p>
    <?php
    if($_SESSION['Role'] == 'admin'){
        echo '<a href="AddNhanvien.php">Thêm nhân viên</a>';
    }
    ?>
    <a href="ListNhanvien.php">Danh sách nhân viên</a>
    <a href="Logout.php">Đăng xuất</a>
</body>
</html>

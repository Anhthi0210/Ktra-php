<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng đến trang chính
if(isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit;
}

// Kiểm tra nếu người dùng đã gửi biểu mẫu đăng nhập
if(isset($_POST['login'])) {
    require_once('config/db.class.php');

    $db = new DB();
    
    $username = $_POST['username']; // Thay đổi từ "Username" thành "username"
    $password = $_POST['password']; // Thay đổi từ "Password" thành "password"

    $sql = "SELECT * FROM `user` WHERE `Username` = '$username' AND `Password` = '$password'";
    $result = $db->query_execute($sql);

    if($result->num_rows > 0) {
        // Đăng nhập thành công
        $user = $result->fetch_assoc();

        // Lưu thông tin người dùng vào session
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['Fullname'] = $user['Fullname'];
        $_SESSION['Role'] = $user['Role'];

        // Chuyển hướng đến trang chính
        header("Location: index.php");
        exit;
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="login">Đăng nhập</button>
    </form>
</body>
</html>

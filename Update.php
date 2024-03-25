<?php
// Include file db.class.php
require_once('config/db.class.php');

// Khởi tạo đối tượng kết nối đến cơ sở dữ liệu
$db = new DB();

// Kiểm tra nếu không có ID nhân viên được truyền vào, chuyển hướng người dùng điều hướng về trang danh sách nhân viên
if(!isset($_GET['id'])) {
    header("Location: ListNhanvien.php");
    exit;
}

// Lấy ID nhân viên từ URL và chống SQL Injection
$id = $db->escapestring($_GET['id']);

// Truy vấn cơ sở dữ liệu để lấy thông tin của nhân viên dựa trên ID
$sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$id'";
$result = $db->query_execute($sql);

// Kiểm tra xem có dữ liệu nhân viên hay không
if($result->num_rows > 0) {
    // Lưu thông tin nhân viên vào biến $employee
    $employee = $result->fetch_assoc();

    // Xử lý dữ liệu được gửi từ biểu mẫu khi người dùng nhấn nút Cập nhật
    if(isset($_POST["btnSubmit"])) {
        // Lấy thông tin nhân viên được gửi từ biểu mẫu
        $tenNV = $db->escapestring($_POST["txtTenNV"]);
        $gioiTinh = $db->escapestring($_POST["txtGioiTinh"]);
        $noiSinh = $db->escapestring($_POST["txtNoiSinh"]);
        $maPhong = $db->escapestring($_POST["txtMaPhong"]);
        $luong = $db->escapestring($_POST["txtLuong"]);

        // Cập nhật thông tin nhân viên vào cơ sở dữ liệu
        $update_sql = "UPDATE nhanvien SET Ten_NV = '$tenNV', Phai = '$gioiTinh', Noi_Sinh = '$noiSinh', Ma_Phong = '$maPhong', Luong = '$luong' WHERE Ma_NV = '$id'";
        $update_result = $db->query_execute($update_sql);

        if($update_result) {
            // Nếu cập nhật thành công, chuyển hướng về trang danh sách nhân viên
            header("Location: ListNhanvien.php");
            exit;
        } else {
            // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
            $error = "Có lỗi xảy ra khi cập nhật thông tin nhân viên.";
        }
    }
} else {
    // Nếu không tìm thấy nhân viên, chuyển hướng về trang danh sách nhân viên
    header("Location: ListNhanvien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin nhân viên</title>
</head>
<body>
    <h2>Cập nhật thông tin nhân viên</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post">
        <label for="txtTenNV">Tên nhân viên:</label>
        <input type="text" id="txtTenNV" name="txtTenNV" value="<?php echo htmlspecialchars($employee['Ten_NV']); ?>"><br><br>
        <label for="txtGioiTinh">Giới tính:</label>
        <input type="text" id="txtGioiTinh" name="txtGioiTinh" value="<?php echo htmlspecialchars($employee['Phai']); ?>"><br><br>
        <label for="txtNoiSinh">Nơi sinh:</label>
        <input type="text" id="txtNoiSinh" name="txtNoiSinh" value="<?php echo htmlspecialchars($employee['Noi_Sinh']); ?>"><br><br>
        <label for="txtMaPhong">Mã phòng:</label>
        <input type="text" id="txtMaPhong" name="txtMaPhong" value="<?php echo htmlspecialchars($employee['Ma_Phong']); ?>"><br><br>
        <label for="txtLuong">Lương:</label>
        <input type="text" id="txtLuong" name="txtLuong" value="<?php echo htmlspecialchars($employee['Luong']); ?>"><br><br>
        <button type="submit" name="btnSubmit">Cập nhật</button>
    </form>
</body>
</html>

<?php
// Include file db.class.php
require_once('config/db.class.php');

// Khởi tạo đối tượng kết nối đến cơ sở dữ liệu
$db = new DB();

// Kiểm tra nếu tồn tại id của nhân viên cần xóa
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Thực hiện truy vấn xóa nhân viên từ cơ sở dữ liệu
    $sql = "DELETE FROM nhanvien WHERE Ma_NV = '$id'";
    $result = $db->query_execute($sql);

    if($result) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách nhân viên
        header("Location: ListNhanvien.php");
        exit;
    } else {
        // Nếu xảy ra lỗi, hiển thị thông báo lỗi
        echo "Đã xảy ra lỗi khi xóa nhân viên.";
    }
}
?>

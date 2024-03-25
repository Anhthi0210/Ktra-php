<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Nhân Viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>

<?php
session_start();
// Include file db.class.php
require_once('config/db.class.php');

// Khởi tạo đối tượng kết nối đến cơ sở dữ liệu
$db = new DB();

// Thiết lập số trang
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 5; 
$start_index = ($page_number - 1) * $items_per_page;


if(isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}



// Truy vấn danh sách nhân viên từ cơ sở dữ liệu
$sql = "SELECT n.*, p.Ten_Phong 
        FROM nhanvien n
        INNER JOIN phongban p ON n.Ma_Phong = p.Ma_Phong
        LIMIT $start_index, $items_per_page";

$result = $db->query_execute($sql);

if ($result->num_rows > 0) {
    // Hiển thị danh sách nhân viên
    echo "<table>";
    echo "<tr><th>Mã Nhân Viên</th><th>Tên Nhân Viên</th><th>Giới Tính</th><th>Nơi Sinh</th><th>Tên Phòng</th><th>Lương</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Ma_NV"] . "</td>";
        echo "<td>" . $row["Ten_NV"] . "</td>";
        echo "<td>";
        if ($row["Phai"] == "NU") {
            echo "<img src='img/woman.png' alt='woman'>";
        } else {
            echo "<img src='img/user.png' alt='man'>";
        }
        echo $row["Phai"] . "</td>";
        echo "<td>" . $row["Noi_Sinh"] . "</td>";
        echo "<td>" . $row["Ten_Phong"] . "</td>"; // Lấy tên phòng từ cột Ten_Phong trong bảng phongban
        echo "<td>" . $row["Luong"] . "</td>";
        echo "<td>";
        if($_SESSION['Role'] == 'admin') {
            echo "<a href='Delete.php?id=" . $row['Ma_NV'] . "'><img src='img/delete.png' alt='delete'></a>";
            echo "<a href='Update.php?id=" . $row['Ma_NV'] . "'><img src='img/maintenance.png' alt='delete'></a>";
        }else{
            
        }
        echo "</tr>";
    }
    echo "</table>";

    // Hiển thị link phân trang
$total_rows_query = "SELECT COUNT(*) as total FROM NhanVien";
$total_rows_result = $db->query_execute($total_rows_query);
$total_rows = $total_rows_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $items_per_page);
echo "<br>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}
}
?>



</body>
</html>

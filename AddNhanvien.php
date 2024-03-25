<?php
// Include file db.class.php
require_once('config/db.class.php');

// Khởi tạo đối tượng kết nối đến cơ sở dữ liệu
$db = new DB();

if(isset($_POST["btnsubmit"])){
    $Ma_NV = $_POST["txtMaNV"];
    $Ten_NV = $_POST["txtTenNV"];
    $Phai = $_POST["txtGioiTinh"];
    $Noi_Sinh = $_POST["txtNoiSinh"];
    $Ma_Phong = $_POST["txtMaPhong"];
    $Luong = $_POST["txtLuong"];

    // Thực hiện truy vấn thêm nhân viên vào cơ sở dữ liệu
    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$Ma_NV', '$Ten_NV', '$Phai', '$Noi_Sinh', '$Ma_Phong', '$Luong')";

    $result = $db->query_execute($sql);

    if($result) {
        echo "Thêm nhân viên thành công";
    } else {
        echo "Có lỗi xảy ra khi thêm nhân viên";
    }
}
?>

<?php
    if(isset($_GET["inserted"])){
        echo "<h2>Thêm nhân viên thành công</h2>";
        header("Location: ListNhanvien.php");
    } elseif(isset($_GET["failure"])) {
        echo "<h2>Có lỗi xảy ra khi thêm nhân viên. Vui lòng thử lại.</h2>";
    }
?>

<form method="post">

    <div class="row">
        <div class="lbltitle">
            <label>Mã nhân viên</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtMaNV" value="<?php echo isset($_POST["txtMaNV"]) ? $_POST["txtMaNV"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Tên nhân viên</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtTenNV" value="<?php echo isset($_POST["txtTenNV"]) ? $_POST["txtTenNV"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Giới tính</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtGioiTinh" value="<?php echo isset($_POST["txtGioiTinh"]) ? $_POST["txtGioiTinh"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Nơi sinh</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtNoiSinh" value="<?php echo isset($_POST["txtNoiSinh"]) ? $_POST["txtNoiSinh"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Mã phòng</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtMaPhong" value="<?php echo isset($_POST["txtMaPhong"]) ? $_POST["txtMaPhong"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Lương</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtLuong" value="<?php echo isset($_POST["txtLuong"]) ? $_POST["txtLuong"] : ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm nhân viên "/>
        </div>
    </div>
</form>

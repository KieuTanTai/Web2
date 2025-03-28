<?php
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();

$result = $db->execute("SELECT * FROM provincial");
$rowsProvin = array();

// Kiểm tra và lấy dữ liệu từ kết quả truy vấn
if ($result !== false && $result->num_rows > 0) {
    while ($row2 = $result->fetch_assoc()) {
        $rowsProvin[] = $row2; // Thêm dòng dữ liệu vào mảng
    }
}

$result2 = $db->execute("SELECT * FROM category");
$rowsCate = array();

// Kiểm tra và lấy dữ liệu từ kết quả truy vấn
if ($result2 !== false && $result2->num_rows > 0) {
    while ($row3 = $result2->fetch_assoc()) {
        $rowsCate[] = $row3; // Thêm dòng dữ liệu vào mảng
    }
}

// require_once('View/Admin/addNewTour.php');

// if(isset($_GET['action'])){
//     $action = $_GET['action'];
// } else {
//     $action = '';
// }

if (isset($_REQUEST['btnAddTour'])) {
    $LastID = $db->getLastID('product');
    $result = $LastID->fetch_assoc();
    $id = $result['id']+1;
    // $id = date('dmyHis');
    $title = $_REQUEST['title'];
    $category = $_REQUEST['category'];
    $provincial = $_REQUEST['provincial'];
    $price = $_REQUEST['price'];
    $content = $_REQUEST['content'];
    $address = $_REQUEST['address'];
    $currentDate = date("Y-m-d");
    $acount = $_REQUEST['acount'];
    $category = $_REQUEST['category'];

    $isSuccess = $db->InsertTour($id, $category, 1, $provincial, $title, $price, $content, $address, $currentDate, $acount);
    if($isSuccess){
        echo "<script> alert('Thêm Tour thành công') </script>";
    } else echo "<script> alert('Thêm Tour thất bại') </script>";
    if (!empty($_FILES['img1']['tmp_name']) && getimagesize($_FILES['img1']['tmp_name']) !== false) {
        $img1 = addslashes(file_get_contents($_FILES['img1']['tmp_name']));
        $db->InsertImg($id, '1', $img1);
    }
    
    if (!empty($_FILES['img2']['tmp_name']) && getimagesize($_FILES['img2']['tmp_name']) !== false) {
        $img2 = addslashes(file_get_contents($_FILES['img2']['tmp_name']));
        $db->InsertImg($id, '2', $img2);
    }
    
    if (!empty($_FILES['img3']['tmp_name']) && getimagesize($_FILES['img3']['tmp_name']) !== false) {
        $img3 = addslashes(file_get_contents($_FILES['img3']['tmp_name']));
        $db->InsertImg($id, '3', $img3);
    }
} else echo "That bai";
$db->disconnect();
echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=tour';</script>";
    exit;
// header('index.php?controller=trang-admin&action=tour');
?>

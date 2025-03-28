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
if(isset($_REQUEST['idEdit'])){
    $idEdit = $_REQUEST['idEdit'];
}

if (isset($_REQUEST['btnAddTour'])) {
    $title = $_REQUEST['title'];
    $id = $_REQUEST['idTour'];
    $category = $_REQUEST['category'];
    $provincial = $_REQUEST['provincial'];
    $price = $_REQUEST['price'];
    $content = $_REQUEST['content'];
    $address = $_REQUEST['address'];
    $currentDate = date("Y-m-d");
    $category = $_REQUEST['category'];
    echo $idEdit;
    $isSuccess = $db->UpdateTour($idEdit, $category, 1, $provincial, $title, $price, $content, $currentDate, $address);
    
    $rsImg = false;
    $rsImg1 = false;
    $rsImg2 = false;
    $rsInsImg = false;
    $rsInsImg1 = false;
    $rsInsImg2 = false;
    $rsDele1 = false;
    $rsDele2 = false;
    $rsDele3 = false;
    if (!empty($_FILES['img1']['tmp_name']) && getimagesize($_FILES['img1']['tmp_name']) !== false) {
        $img1 = addslashes(file_get_contents($_FILES['img1']['tmp_name']));
        if(isset($_REQUEST['idImg0'])){
            $idimg = $_REQUEST['idImg0'];
            echo $idimg;
            $rsImg = $db->UpdateImg($idimg, $img1);
        } else $rsInsImg = $db->InsertImg($id, '1', $img1);
    } else {
        if(isset($_REQUEST['deleteImg0']) && isset($_REQUEST['idImg0'])){
            if($_REQUEST['deleteImg0']==1){
            $idimg = $_REQUEST['idImg0'];
            $rsDele1 = $db->DeleteImg($idimg);}
        }
    }
    
    if (!empty($_FILES['img2']['tmp_name']) && getimagesize($_FILES['img2']['tmp_name']) !== false) {
        $img2 = addslashes(file_get_contents($_FILES['img2']['tmp_name']));
        if(isset($_REQUEST['idImg1'])){
            $idimg = $_REQUEST['idImg1'];
            $rsImg1 = $db->UpdateImg($idimg, $img2);
        } else $rsInsImg1 = $db->InsertImg($id, '2', $img2);
    } else {
        if(isset($_REQUEST['deleteImg1']) && isset($_REQUEST['idImg1'])){
            if($_REQUEST['deleteImg1']==1){
            $idimg = $_REQUEST['idImg1'];
            $rsDele2 = $db->DeleteImg($idimg);}
        }
    }
    
    if (!empty($_FILES['img3']['tmp_name']) && getimagesize($_FILES['img3']['tmp_name']) !== false) {
        $img3 = addslashes(file_get_contents($_FILES['img3']['tmp_name']));
        if(isset($_REQUEST['idImg2'])){
            $idimg = $_REQUEST['idImg2'];
            $rsImg2 = $db->UpdateImg($idimg, $img3);
        } else $rsInsImg2 = $db->InsertImg($id, '3', $img3);
    } else {
        if(isset($_REQUEST['deleteImg2']) && isset($_REQUEST['idImg2'])){
            if($_REQUEST['deleteImg2']==1){
            $idimg = $_REQUEST['idImg2'];
            $rsDele3 = $db->DeleteImg($idimg);}
        }
    }

    if($isSuccess || $rsImg || $rsImg1 || $rsImg2 || $rsInsImg || $rsInsImg1 || $rsInsImg2 || $rsDele1 || $rsDele2 || $rsDele3){
        echo "<script> alert('Cập nhật thành công') </script>";
    } else echo "<script> alert('Không có gì thay đổi') </script>";
} else 
echo "error";
$db->disconnect();
echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=tour';</script>";
    exit;
// header('index.php?controller=trang-admin&action=tour');
?>

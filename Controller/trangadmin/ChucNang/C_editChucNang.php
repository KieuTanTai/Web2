<?php
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();
if (isset($_REQUEST['nameCN'])) {
    $name = $_REQUEST['nameCN'];
    $id = $_REQUEST['id'];
    $result = $db->UpdateNameChucNang($id, $name);
    if($result != false) {
        echo "<script>alert('Sửa thành công');</script>";
    } else echo "<script>alert('Sửa thất bại rầu');</script>";
}

echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=chucnang';</script>";

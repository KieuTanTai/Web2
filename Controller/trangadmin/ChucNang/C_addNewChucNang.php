<?php 
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();
if(isset($_REQUEST['nameCN'])){
    $name = $_REQUEST['nameCN'];
    $result = $db->InsertChucNang($name);
    if($result !== false) {
        echo "<script>alert('Thêm thành công');</script>";
    }
}

echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=chucnang';</script>";

?>
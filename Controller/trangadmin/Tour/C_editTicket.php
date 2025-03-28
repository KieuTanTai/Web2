<?php
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();
if(isset($_REQUEST['updateTicket'])){
    $idTour = $_REQUEST['id'];
    $id = $_REQUEST['idTicket'];
    $name = $_REQUEST['name'];
    // $price = $_REQUEST['price'];
    $dateStart = $_REQUEST['dateStart'];
    $dateEnd = $_REQUEST['dateEnd'];
    $sove = $_REQUEST['numTicket'];
    $status = $_REQUEST['status'];
    $rs = $db->updateTicket($id, $name, $dateStart, $dateEnd, $sove, $status);
    if($rs){
        echo "<script> alert('Cập nhật thành công') </script>";
    } else echo "<script> alert('Không có gì thay đổi') </script>";

    echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=ticket&id=$idTour';</script>";
}
$db->disconnect();
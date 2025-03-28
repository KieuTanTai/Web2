<?php
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();
if (isset($_REQUEST['addTicket'])) {
    $idTour = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    // $price = $_REQUEST['price'];
    $dateStart = $_REQUEST['dateStart'];
    $dateEnd = $_REQUEST['dateEnd'];
    $sove = $_REQUEST['numTicket'];
    $rs = $db->addTicket($idTour, $name, $dateStart, $dateEnd, $sove);
    if ($rs) {
        echo "<script> alert('Thêm thành công') </script>";
    } else echo "<script> alert('Thêm thất bại') </script>";

    echo "<script>window.location.href = '/WEB2/index.php?controller=trang-admin&action=ticket&id=$idTour';</script>";
}
$db->disconnect();

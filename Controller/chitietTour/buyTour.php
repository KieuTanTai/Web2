<?php

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    $action = '';
}
session_start();
if (isset($_SESSION['idUserLogin'])) {
    $idUser = $_SESSION['idUserLogin'];
}
include("../../Model/DBConfig.php");
$db = new Database();
$db->connect();
if (isset($_REQUEST['id'])) {
    $idTour = $_REQUEST['id'];
}

$idUser = (isset($_SESSION['idUserLogin']))?$_SESSION['idUserLogin']:0;
$result = $db->execute("SELECT * FROM product WHERE id = '$idTour'");
$rowTour = $db->getData();
$result2 = $db->execute("SELECT * FROM feedback WHERE product_id = '$idTour'");
$resultVoucher = $db->execute("SELECT * FROM discountuser WHERE id_user = '$idUser'");

$listTicket0 = $db->getListTicketByidTour($idTour);
$listTicket = $db->getListTicketByidTour($idTour);

require_once('../../View/User/chitietTour/chitietTour.php');
switch ($action) {
    case 'book-tour': {
            if (isset($_REQUEST['buy-now']) && isset($_REQUEST['id'])) {
                $idPro = $_REQUEST['id'];
                // if($db->checkAvailableTour($idPro) == false){
                //     echo '<script>alert("Tour này đã hết!")</script>';
                //     break;
                // }
                // Xử lý khi người dùng nhấn nút "Mua ngay"
                //date này là date book tour
                $dateBook = $_REQUEST['datePhp'];
                $priceAtour = $_REQUEST['priceTourNe'];
                //date này là ngày mua
                $date = date('y-m-d');
                $totalPrice = $_REQUEST['totalMoneyphp'];
                $hoten = $_REQUEST['hoTen'];
                $email = $_REQUEST['email'];
                $sdt = $_REQUEST['sodienthoai'];
                $diachi = $_REQUEST['diachi'];
                $note = $_REQUEST['note-book-tour'];
                $soLuong = $_REQUEST['numTicketphp'];
                $LastID = $db->getLastID('orders');
                $result = $LastID->fetch_assoc();
                $id = $result['id'] + 1;


                $idTicket = $_REQUEST['idTicket'];
                $rs0 = $db->buyTicket($idTicket, $soLuong);
                // $id = date('dmyHis');
                $idVoucher = $_REQUEST['idVoucher'];
                $rs = $db->InsertOrder($id, $idUser, $hoten, $email, $sdt, $diachi, $note, $date, $totalPrice, $idVoucher);
                $rs2 = $db->InsertDetailOrder($id, $idPro, $priceAtour, $soLuong, $priceAtour*$soLuong,  $dateBook);
                if($rs && $rs2 && $rs0) echo '<script>alert("Mua tour này thành công!")</script>';
                if ($idVoucher != 0) $db->XoaVoucherKhiAddMa($idVoucher, $idUser);
                //nếu muốn dùng idOrder để truyền vào DetailOrder thì dùng biến id này
                echo "<script>window.location.href='../chitietTour/buyTour.php?id=$idPro';</script>";
                // exit();
            }
            break;
        }
    case 'send-cmt': {
            if (isset($_REQUEST['send-cmt']) && isset($_REQUEST['id'])) {
                $cmt = $_REQUEST['text-cmt'];
                $currentDate = date("Y-m-d H:i:s");
                $star = $_REQUEST['rating'];
                $idPro = $_REQUEST['id'];
                $rs = $db->InsertCmt($idUser, $idPro, $cmt, $currentDate, $star);
                if($rs) echo '<script>alert("Gửi bình luận thành công!")</script>';
                $db->updateStarOfTour($idPro);
                echo "<script>window.location.href='../chitietTour/buyTour.php?id=$idPro';</script>";
                // exit();
            }
            break;
        }
    case 'add-cart': {

            if (isset($_REQUEST['add-cart'])) {
                if (isset($_REQUEST['id'])) {
                    // echo "<script>alert('a');</script>";
                    $idPro = $_REQUEST['id'];
                    $numTicket = $_REQUEST['numTicketphp'];
                    $idTicket = $_REQUEST['idTicketCart'];
                    $db->InsertOrUpdateCart($idUser, $idPro, $numTicket, $idTicket, 1);
                }
                // Xử lý khi người dùng nhấn nút "Thêm vào giỏ hàng"

                // echo "<script>window.location.href='../chitietTour/index.php';</script>";
                // exit();
            }
            break;
        }
}
$db->disconnect();

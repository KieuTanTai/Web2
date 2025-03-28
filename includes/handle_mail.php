<?php
require_once(__DIR__ . "/phpmailer/Exception.php");
require_once(__DIR__ . "/phpmailer/PHPMailer.php");
require_once(__DIR__ . "/phpmailer/SMTP.php");
require_once(__DIR__ . "/function.php");


// if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
// 	die("Lỗi: REQUEST_METHOD không được định nghĩa hoặc không phải là POST.");
//  }
 

// // Kiểm tra xem có dữ liệu được gửi qua phương thức POST không
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
// 	// $hostname = 'localhost';
// 	// $username = 'root';
// 	// $password = '';
// 	// $dbname = 'web2';
// 	// $conn = new mysqli($hostname, $username, $password, $dbname);
// 	// if ($conn->connect_error) {
// 	// 	die("Kết nối CSDL thất bại: " . $conn->connect_error);
// 	// }
// 	$email = $_POST['email'];
// 	// $discount_name = "Khuyến mãi cho người dùng mới";
// 	// $code = "NGUOIDUNGMOI" . rand();
// 	// $percent = 10;
// 	// $date_start = date('Y/m/d');
// 	// $date_end = date('Y/m/d', strtotime($date_start . ' +1 month'));
// 	// $description = "Hãy trải nghiệm những dịch vụ hấp dẫn của chúng tôi";
// 	// $sql = "INSERT INTO discount (discount_name, code, percent, date_start, date_end, description) 
// 	//         VALUES (?, ?, ?, ?, ?, ?)";
// 	// $stmt = $conn->prepare($sql);
// 	// $stmt->bind_param("ssisss", $discount_name, $code, $percent, $date_start, $date_end, $description);
// 	// if ($stmt->execute()) {
// 	// 	// Gửi email
// 	sendMail($email, 'Welcome to Klook', $code);
// 	// 	echo "Đã thêm mã giảm giá vào cơ sở dữ liệu và gửi email thành công.";
// 	// } else {
// 	// 	echo "Có lỗi xảy ra khi thêm mã giảm giá vào cơ sở dữ liệu: " . $conn->error;
// 	// }
// 	// // Đóng kết nối
// 	// $conn->close();
// }

if (isset($_POST['email_forgot'])) {
	include "../Model/DBConfig.php";
	$email_forgot = $_POST['email-forgot'];
	$db = new Database();
	$db->connect();

	$sql = 'SELECT * FROM nguoiDung where email like "' . $_POST['email_forgot'] . '"';
	$checkHasEmail = $db->getAllDataBySql($sql);
	$emailExists = false;
	if ($db->num_rows() > 0) {
		$emailExists = true;
	}
	if ($emailExists) {
		$idNguoiDung = $db->getIdByEmail($_POST['email_forgot']);
		setcookie("userIDForReset", $idNguoiDung, time() + 1800, "/");
		sendMailForgot($_POST['email_forgot'], $idNguoiDung);
		echo "foundEmailToSentForgot";
	} else {
		echo "Email not found in the database";
	}
}

if (isset($_POST['status'])) {
	include "../Model/DBConfig.php";
	$orderId = $_POST['orderId'];
	$oldStatus = $_POST['old_status'];
	$newStatus = $_POST['status'];
	$totalAllMoney = $_POST['total_all_money'];
	$db = new Database();
	$db->connect();
	$db->updateOrder($orderId, $newStatus);
	$email = $db->getMailByIdOrder($orderId);
	$result = $db->getDetailOrderByOrderId($orderId);
	$listOrderDetail = $db->getAll();
	sendMailUpdateOrder($email, $orderId, $oldStatus, $newStatus, $listOrderDetail, $totalAllMoney);
	header("location: http://localhost/WEB2/index.php?controller=trang-admin&action=detailOrder&id=$orderId");
}

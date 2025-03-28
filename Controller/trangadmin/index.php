<?php

use GuzzleHttp\Promise\Is;

if (isset($_GET['controller']) && $_GET['controller'] == 'trang-admin') {
	include_once("View/admin/header-admin.php");
}


if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = '';
}


$alert;

switch ($action) {
	case 'add': {
			$listRoleTable = "role";
			$roles = $db->getAllData($listRoleTable);
			require_once('View/admin/add.php');
			break;
		}

	case 'edit': {
			// if (isset($_GET['id'])) {
			// 	$id = $_GET['id'];
			// 	$listUsersTable = "nguoidung";
			// 	$dataID = $db->getDataId($listUsersTable, $id);
			// 	if (isset($_POST['edit_user'])) {
			// 		$fullname = $_POST['fullname'];
			// 		$email = $_POST['email'];
			// 		$phone_number = $_POST['phone_number'];
			// 		$create_at = $_POST['create_at'];
			// 		$status = $_POST['status'];
			// 		$address = $_POST['address'];

			// 		if ($db->updateEditData($id, $fullname, $email, $phone_number, $create_at, $address)) {
			// 			header('location: index.php?controller=trang-admin&action=indexAdmin');
			// 		}
			// 	}
			// }
			$listRoleTable = "role";
			$roles = $db->getAllData($listRoleTable);
			require_once('View/admin/edit.php');
			break;
		}

	case 'editHaveAcount': {
			// if (isset($_GET['id'])) {
			// 	$id = $_GET['id'];
			// 	$listUsersTable = "nguoidung";
			// 	$dataID = $db->getDataId($listUsersTable, $id);
			// 	if (isset($_POST['edit_user'])) {
			// 		$fullname = $_POST['fullname'];
			// 		$email = $_POST['email'];
			// 		$phone_number = $_POST['phone_number'];
			// 		$create_at = $_POST['create_at'];
			// 		$status = $_POST['status'];
			// 		$address = $_POST['address'];

			// 		if ($db->updateEditData($id, $fullname, $email, $phone_number, $create_at, $address)) {
			// 			header('location: index.php?controller=trang-admin&action=indexAdmin');
			// 		}
			// 	}
			// }
			$listRoleTable = "role";
			$roles = $db->getAllData($listRoleTable);
			require_once('View/admin/editHaveAcount.php');
			break;
		}

	case 'editrole': {
			// $listRoleTable = "role";
			// $roles = $db->getAllData($listRoleTable);

			// if (isset($_GET['id'])) {
			// 	$id = $_GET['id'];
			// 	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// 		if (isset($_POST['role'])) {
			// 			$role = $_POST['role'];
			// 			if ($db->roleAccount($id, $role)) {
			// 				header('location: index.php?controller=trang-admin&action=indexAdmin');
			// 			}
			// 		}
			// 	}
			// }
			require_once('View/admin/editrole.php');
			break;
		}


	case 'delete': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$listUsersTable = "nguoidung";

				if ($dataID = $db->deleteUser($listUsersTable, $id)) {
					header('location: index.php?controller=trang-admin&action=indexAdmin');
				}
			}
			break;
		}

	case 'banuser': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$dataID = $db->blockUser($id);
			}
			header('location: index.php?controller=trang-admin&action=indexAdmin');

			break;
		}

	case 'unbanuser': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$dataID = $db->unblockUser($id);
			}
			header('location: index.php?controller=trang-admin&action=indexAdmin');

			break;
		}

	case 'trangChuAdmin': {
			$soLuongND = $db->getSoLuong('nguoidung', 'id > 0');
			$soLuongSP = $db->getSoLuong('product', 'id > 0');
			$soLuongDH = $db->getSoLuong('orders', 'id > 0');
			$soLuongFB = $db->getSoLuong('feedback', 'id > 0');

			$soLuongNDPercent = 0;
			$soLuongSPPercent = 0;
			$soLuongDHPercent = 0;
			$soLuongFBPercent = 0;

			$soLuongNDToDay = $db->getCountToday('product', 'create_at');
			$soLuongNDYesterday = $db->getCountYesterday('product', 'create_at');

			$soLuongSPToDay = $db->getCountToday('product', 'create_at');
			$soLuongSPYesterday = $db->getCountYesterday('product', 'create_at');

			$soLuongDHToDay = $db->getCountToday('orders', 'date_order');
			$soLuongDHYesterday = $db->getCountYesterday('orders', 'date_order');

			$soLuongFBToDay = $db->getCountToday('feedback', 'create_at');
			$soLuongFBYesterday = $db->getCountYesterday('feedback', 'create_at');

			if ($soLuongNDToDay > 0 && $soLuongNDYesterday >= 0) {
				$soLuongNDPercent = ($soLuongNDToDay / $soLuongND - $soLuongNDYesterday / $soLuongND) * 100;
				$soLuongNDPercent = round($soLuongNDPercent, 2);
			}

			if ($soLuongSPToDay > 0 && $soLuongSPYesterday >= 0) {
				$soLuongSPPercent = ($soLuongSPToDay / $soLuongSP - $soLuongSPYesterday / $soLuongSP) * 100;
				$soLuongSPPercent = round($soLuongSPPercent, 2);
			}

			if ($soLuongDHToDay > 0 && $soLuongDHYesterday >= 0) {
				$soLuongDHPercent = ($soLuongDHToDay / $soLuongDH - $soLuongDHYesterday / $soLuongDH) * 100;
				$soLuongDHPercent = round($soLuongDHPercent, 2);
			}

			if ($soLuongFBToDay > 0 && $soLuongFBYesterday >= 0) {
				$soLuongFBPercent = ($soLuongFBToDay / $soLuongFB - $soLuongFBYesterday / $soLuongFB) * 100;
				$soLuongFBPercent = round($soLuongFBPercent, 2);
			}

			$result = $db->getTourSellToday();
			$tourSellToday = $db->getAll();

			$dataPoints1 = array();

			// Lấy dữ liệu từ cơ sở dữ liệu
			$toursSellThisWeek = $db->getTourSellThisWeek(); // Thay thế 'getTourSellPerDay()' bằng hàm thích hợp để lấy dữ liệu từ cơ sở dữ liệu của bạn
			while ($tour = mysqli_fetch_assoc($toursSellThisWeek)) {
				$dataPoints1[] = $tour['total_tours_sold'];
			}

			$dataPoints2 = array();

			// Lấy dữ liệu từ cơ sở dữ liệu
			$toursSellLastWeek = $db->getTourSellLastWeek(); // Thay thế 'getTourSellPerDay()' bằng hàm thích hợp để lấy dữ liệu từ cơ sở dữ liệu của bạn
			while ($tour = mysqli_fetch_assoc($toursSellLastWeek)) {
				$dataPoints2[] = $tour['total_tours_sold'];
			}
			// foreach ($dataPoints1 as $key) {
			// 		echo "Key: " . $key."<br>";
			// 	}
			// hồi quy tuyến tính
			$monthly_sales_last_year = $db->getMonthlySalesLastYear();
			// foreach ($monthly_sales_last_year as $key => $value) {
			// 	echo "Key: " . $key . ", Value: " . $value . "<br>";
			// }
			$months = range(1, 12);
			$sales = array_values($monthly_sales_last_year);
			$n = count($months);
			$sum_x = array_sum($months);
			$sum_y = array_sum($sales);
			$sum_x2 = 0;
			$sum_xy = 0;

			foreach ($months as $key => $month) {
				$sum_x2 += pow($month, 2);
				$sum_xy += $month * $sales[$key];
			}

			$slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - pow($sum_x, 2));
			$intercept = ($sum_y - $slope * $sum_x) / $n;

			// Dự đoán số lượng tour bán được trong các tháng của năm nay
			$predicted_sales_this_year = array();
			$current_year = date('Y');
			for ($i = 1; $i <= 12; $i++) {
				// Chỉ lưu số lượt bán vào mảng
				$predicted_sales_this_year[] = round($intercept + $slope * $i);
			}

			// biểu đồ tròn
			$result = $db->getTourHuy();
			while ($tour = mysqli_fetch_assoc($result)) {
				$tongTour = $tour['total_tours'];
				$tourHuy = $tour['tour_huy'];
			}


			require_once('View/admin/trangChuAdmin.php');
			break;
		}

	case 'indexAdmin': {
			$table = "nguoidung";
			$listUsersTable = "nguoidung";
			// $data = $db->getAllData($listUsersTable);
			// $dataTourHuy = $db->getTourHuyAndUser();
			require_once('View/admin/indexAdmin.php');
			break;
		}

	case 'headeradmin': {
			$listUsersTable = "nguoidung";
			$data = $db->getAllData($listUsersTable);
			require_once('View/admin/header-admin.php');
			break;
		}

	case 'products': {
			require_once('View/admin/products.php');
			break;
		}
	case 'thongke': {
			require_once('View/admin/thongke.php');
			break;
		}
	case 'role': {
			$data = $db->getAllData("role");
			require_once('View/admin/Role/listRole.php');
			break;
		}
	case 'addRole': {
			require_once('View/admin/Role/addNewRole.php');
			break;
		}
	case 'editRole': {
			require_once('View/admin/Role/editRole.php');
			break;
		}
	case 'deleteRole': {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$db->DeleteRole($id);
			}
			$data = $db->getAllData("role");
			require_once('View/admin/Role/listRole.php');
			break;
		}
	case 'chucnang': {
			$data = $db->getAllData("chucnang");
			require_once('View/admin/chucnang/listChucNang.php');
			break;
		}
	case 'addChucNang': {
			require_once('View/admin/ChucNang/addNewChucNang.php');
			break;
		}
	case 'editChucNang': {
			require_once('View/admin/ChucNang/editChucNang.php');
			break; //deleteChucnang
		}
	case 'deleteChucNang': {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$db->DeleteChucNang($id);
			}
			$data = $db->getAllData("chucnang");
			require_once('View/admin/chucnang/listChucNang.php');
			break;
		}
		//tour
	case 'tour': {
			$table = "product";
			// $data = $db->getAllData("product");
			require_once('View/admin/DSTour/listTour.php');
			break;
		}
	case 'editTour': {
			require_once('View/admin/DSTour/editTour.php');
			break;
		}
	case 'ticket': {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
			}
			$tour = $db->getDataId("product", $id);
			$tickets = $db->getListTicketByidTour($id);
			require_once('View/admin/DSTour/ticket.php');
			break;
		}
	case 'addTicket': {
			require_once('View/admin/DSTour/addTicket.php');
			break;
		}
	case 'deleteTicket': {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
			}
			if (isset($_REQUEST['idTicket'])) {
				$idTicket = $_REQUEST['idTicket'];
				$db->deleteTicket($idTicket);
			}
			$tour = $db->getDataId("product", $id);
			$tickets = $db->getListTicketByidTour($id);
			require_once('View/admin/DSTour/ticket.php');
			break;
		}
	case 'editTicket': {
			$id = $_REQUEST['idTicket'];
			$ticket = $db->getDataId("tickettour", $id);
			require_once('View/admin/DSTour/editTicket.php');
			break;
		}
	case 'deleteTour': {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$db->DeleteTour($id);
			}
			$data = $db->getAllData("product");
			require_once('View/admin/DSTour/listTour.php');
			break;
		}
	case 'addTour': {
			require_once('View/admin/DSTour/addNewTour.php');

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
			if (isset($_REQUEST['btnAddTour'])) {
				$id = date('dmyHis');
				$title = $_REQUEST['title'];
				$category = $_REQUEST['category'];
				$provincial = $_REQUEST['provincial'];
				$price = $_REQUEST['price'];
				$content = $_REQUEST['content'];
				$address = $_REQUEST['address'];
				$currentDate = date("Y-m-d");
				$acount = $_REQUEST['acount'];
				$category = $_REQUEST['category'];

				$db->InsertTour($id, $category, 1, $provincial, $title, $price, $content, $address, $currentDate, $acount);

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
			}
			$db->disconnect();
			break;
		}
	case 'dsbl':

		$sql = "SELECT feedback.*, nguoidung.*, product.*,feedback.id as id_f 
						FROM feedback 
						JOIN nguoidung  ON feedback.user_id = nguoidung.id
						JOIN product  ON feedback.product_id = product.id
						ORDER BY feedback.id DESC";
		$result = $db->execute($sql);
		$listbinhluan = $db->getAll();
		include "View/admin/list_feedback.php";


		break;
	case 'xoabl':

		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$commentId = $_GET['id'];
			$result = $db->deleteComment($commentId);

			//nếu thành công thì hiện thị lại ds bình luận
			if ($result) {
				$sql = "SELECT feedback.*, nguoidung.*, product.* ,feedback.id as id_f
						FROM feedback 
						JOIN nguoidung  ON feedback.user_id = nguoidung.id
						JOIN product  ON feedback.product_id = product.id
						ORDER BY feedback.id DESC";
				$result = $db->execute($sql);
				$listbinhluan = $db->getAll();
				include "View/admin/list_feedback.php";
			}
		}


		break;
	case 'dsvoucher':
		$table = "discount";
		$sql = "SELECT * FROM discount order by id desc";
		$result = $db->execute($sql);
		$listvoucher = $db->getAll();
		include "View/admin/list_voucher.php";
		break;
	case 'xoavoucher':
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$voucherId = $_GET['id'];
			$result = $db->deleteVoucher($voucherId);

			//nếu thành công thì hiện thị lại ds voucher
			if ($result) {
				$sql = "SELECT * FROM discount order by id desc";
				$result = $db->execute($sql);
				$listvoucher = $db->getAll();
				include "View/admin/list_voucher.php";
			}
		}
		break;
	case 'suavoucher':
		if (isset($_GET['id']) && $_GET['id'] > 0) {

			$voucherId = $_GET['id'];

			$voucherDetails = $db->getVoucherDetailsById($voucherId);
		}
		include "View/admin/editVoucher.php";
		break;

	case 'capnhatvoucher':
		if (isset($_POST['btnedit']) && ($_POST['btnedit'])) {
			$id = $_POST['id'];
			$ten_voucher = $_POST['ten_voucher'];
			$ma_voucher = $_POST['ma_voucher'];
			$gia_tri = $_POST['gia_tri'];
			$ngay_bat_dau = $_POST['ngay_bat_dau'];
			$ngay_ket_thuc = $_POST['ngay_ket_thuc'];
			$mo_ta = $_POST['mo_ta'];
			$status = $_POST['status'];

			if ($db->updateVoucher($id, $ten_voucher, $ma_voucher, $gia_tri, $ngay_bat_dau, $ngay_ket_thuc, $mo_ta, $status)) {
				$alert = 'add_success';
			}
		}

		//cập nhật xong thì hiện thị lại ds voucher đã cập nhật
		$table = "discount";
		$sql = "SELECT * FROM discount order by id desc";
		$result = $db->execute($sql);
		$listvoucher = $db->getAll();
		include "View/admin/list_voucher.php";
		break;
	case 'themvoucher':
		if (isset($_POST['btnadd']) && ($_POST['btnadd'])) {
			$ten_voucher = $_POST['ten_voucher'];
			$ma_voucher = $_POST['ma_voucher'];
			$gia_tri = $_POST['gia_tri'];
			$ngay_bat_dau = $_POST['ngay_bat_dau'];
			$ngay_ket_thuc = $_POST['ngay_ket_thuc'];
			$mo_ta = $_POST['mo_ta'];

			if ($db->insertVoucher($ten_voucher, $ma_voucher, $gia_tri, $ngay_bat_dau, $ngay_ket_thuc, $mo_ta)) {
				$alert = 'add_success';
			}
		}
		include "View/admin/addVoucher.php";
		break;
	case 'dthongke':
		include_once "View/ThongKe/thongke.php";
		break;
	case 'order':
		$table = "orders";
		// $sql = "SELECT * FROM orders order by id desc";
		// $result = $db->execute($sql);
		// $listOrder = $db->getAll();
		include_once "View/admin/order/order.php";
		break;
	case 'deleteOrder':
		if (isset($_GET['id'])) {

			$orderId = $_GET['id'];
			$result = $db->deleteOrder($orderId);

			//nếu thành công thì hiện thị lại ds voucher
			// if ($result) {
			// 	$sql = "SELECT * FROM orders order by id desc";
			// 	$result = $db->execute($sql);
			// 	$listOrder = $db->getAll();
			// 	include "View/admin/order/order.php";
			// }
		}
		break;
	case 'detailOrder':
		if (isset($_GET['id'])) {
			$orderId = $_GET['id'];
			$result = $db->getDetailOrderByOrderId($orderId);
			$listOrderDetail = $db->getAll();
			$status = $db->getStatusOrderByOrderId($orderId);
			$result = $db->getInfoPersonOrder($orderId);
			$infoPersonOrder = $db->getAll();
			$totalAllMoney = $db->getTotalMoneyByIdOrder($orderId);
			$email = $db->getMailOrderByIdOrder($orderId);
			$totalOrderByUser = $db->getTotalOrderByUser($email);
			$totalRejectOrderByUser = $db->getTotalRejectOrderByUser($email);
			if ($totalOrderByUser > 0) {
				$rejectPercentage = ($totalRejectOrderByUser / $totalOrderByUser) * 100;
			} else {
				// Handle the case when there are no orders
				$rejectPercentage = 0;
			}
			$successPercentage = round(100 - $rejectPercentage, 2);
			include "View/admin/order/orderDetail.php";
		}
		break;
}

<?php
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = '';
}


switch ($action) {
	case 'shoping': {
			if (isset($_POST['login'])) {
				header('location: index.php?controller=trang-admin&action=indexAdmin');
			}
			require_once('View/trangchu/shoping.php');
			break;
		}

	case 'login': {
			session_start();
			ob_start();
			$ban = 1;
			if (isset($_REQUEST['login'])) {
				$username = $_REQUEST['username'];
				$password = $_REQUEST['password'];
				$resuiltCheckLogin = $db->checkLogin($username, $password);
				$rowCheckLogin = $resuiltCheckLogin->fetch_assoc();
				if ($rowCheckLogin) {
					$objuser = array($username, $password);
					$_SESSION['objuser'] = $objuser;
					$idUser = $rowCheckLogin['id'];
					$_SESSION['idUserLogin'] = $idUser;
					$flagLogin = 1;
					$_SESSION['isLogin'] = $flagLogin;
					$idRole = $rowCheckLogin['id_role'];

					$resuiltidAcount = $db->getUserByIdAcount($idUser);
					$rowidAcount = $resuiltidAcount->fetch_assoc();
					// $statusUser = $rowidAcount['status'];


					if ($idRole != 0 && $rowidAcount['status'] != 0) {
						header("Location: index.php?controller=trang-admin&action=trangChuAdmin");
					} else if ($idRole == 0 && $rowidAcount['status'] != 0) {
						header("Location: index.php?controller=trang-chu");
					} else if ($rowidAcount['status'] == 0) {
						header("Location: index.php?controller=trang-chu&action=login");
						$_SESSION['error_message'] = "Tài khoản đã bị vô hiệu hóa!";
					}

					exit();
				} else {
					$flagLogin = 0;
					$_SESSION['isLogin'] = $flagLogin;
					http_response_code(401);
					$_SESSION['error_username_password'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
				}
			}
			require_once('View/trangchu/login.php');
			break;
		}
	case "showproduct": // cua Huu Loc
		require_once('Controller/showproductController/showproduct.php');
		break;
	case "cart":
		session_start();

		// lầy id user trên session
		$idUser = $_SESSION['idUserLogin'];
		$sql = "SELECT cart.*, product.*, tickettour.*,tickettour.id AS ticket_id, cart.id AS cart_id
		FROM cart 
		INNER JOIN product ON cart.id_product = product.id
		INNER JOIN tickettour ON cart.idTicket = tickettour.id
		WHERE cart.id_user = $idUser";

		$result = $db->execute($sql);

		if ($result && $result->num_rows > 0) {
			// Tìm nạp tất cả các mục trong giỏ hàng vào một mảng
			$listCart = $db->getAll();
		} else {
			//Nếu không tìm thấy mục nào trong giỏ hàng, hãy khởi tạo một mảng trống
			$listCart = array();
		}
		include "View/Cart/cart.php";
		break;
	case 'deleteItemCart':
		session_start();

		if (isset($_GET['id']) && $_GET['id'] > 0) {
			// Kiểm tra quyền truy cập ở đây nếu cần

			$ItemId = $_GET['id'];
			$result = $db->deleteItemCart($ItemId);

			// Nếu xóa thành công, hiển thị lại danh sách giỏ hàng
			if ($result) {
				$idUser = $_SESSION['idUserLogin'];

				$sql = "SELECT cart.*, product.*, tickettour.*,tickettour.id AS ticket_id, cart.id AS cart_id
				FROM cart 
				INNER JOIN product ON cart.id_product = product.id
				INNER JOIN tickettour ON cart.idTicket = tickettour.id
				WHERE cart.id_user = $idUser";

				$result = $db->execute($sql);

				if ($result && $result->num_rows > 0) {
					$listCart = $db->getAll();
				} else {
					$listCart = array();
				}

				include "View/Cart/cart.php";
			} else {
				// Xử lý khi xóa không thành công nếu cần
			}
		}
		break;
	case "userprofile":
		require_once('View/User/user.php');
		break;
	case "forgotPassword":
		if (isset($_GET['$idNguoiDung'])) {
			$idUserForReset = $_GET['$idNguoiDung'];
		}
		header("location: View/trangchu/forgotPassword.php");
		break;
	case "resetPassword":
		header("location: View/trangchu/resetPassword.php");
		break;
	case '': {
			if (isset($db)) {
				$listUsersTable = "product";
				$dataHotProduct = $db->getAllData($listUsersTable);
				$listCategory = $db->getAllData("category");
				require_once('View/trangchu/trangchu.php');
				break;
			}
		}
}
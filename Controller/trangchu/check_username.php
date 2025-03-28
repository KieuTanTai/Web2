<?php
require_once '../../Model/DBConfig.php';

$db = new Database();
$conn = $db->connect();

$accounts = $db->getAllAccounts();
$nguoidungs = $db->getAllNguoiDung();

if (
	isset($_POST['username']) &&
	$_POST['fullname'] !== '' &&
	$_POST['password'] !== '' &&
	$_POST['email'] !== '' &&
	$_POST['phone_number'] !== '' &&
	$_POST['address'] !== '' &&
	isset($_POST['checkValid']) && $_POST['checkValid'] == 1

) {
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
	$id_role = "0";
	$status = "1";
	$create_at = date('Y/m/d');
	$accountEND = end($accounts);
	$id_acount = $accountEND['id'] + 1;
	$usernameExists = false;
	$emailExists = false;
	$phone_numberExists = false;
	foreach ($accounts as $account) {
		if ($account['user_name'] === $username) {
			$usernameExists = true;
			break;
		}
	}

	foreach ($nguoidungs as $nguoidung) {
		if ($nguoidung['email'] === $email) {
			$emailExists = true;
			break;
		}
		if ($nguoidung['phone_number'] === $phone_number) {
			$phone_numberExists = true;
			break;
		}
	}


	if ($usernameExists) {
		echo "exists username";
	} else if ($emailExists) {
		echo "exists email";
	} else if ($phone_numberExists) {
		echo "exists phone";
	} else if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
		echo "invalid email";
	} else if (!preg_match("/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/", $phone_number)) {
		echo "invalid phone";
	} else {
		$db->registerAcount($username, $password, $id_role, $status);
		$db->registerNguoiDung($fullname, $email, $phone_number, $create_at, $status, $address, $id_acount);
		echo "valid";
	}
} else {
	echo "invalid request";
}

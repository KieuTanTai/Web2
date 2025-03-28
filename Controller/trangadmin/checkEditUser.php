<?php
require_once '../../Model/DBConfig.php';

$db = new Database();
$conn = $db->connect();

$accounts = $db->getAllAccounts();
$nguoidungs = $db->getAllNguoiDung();

if (
	$_POST['fullname'] !== '' &&
	$_POST['email'] !== '' &&
	$_POST['phone_number'] !== '' &&
	$_POST['address'] !== '' &&
	$_POST['userID'] !== '' &&
	isset($_POST['checkValid']) && $_POST['checkValid'] == 1

) {

	$username;
	$password;
	if (
		isset($_POST['username']) && isset($_POST['password'])
	) {
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	$emailOfUser = $_POST['emailOfUser'];
	$phoneOfUser = $_POST['phoneOfUser'];

	$fullname = $_POST['fullname'];
	$userID = $_POST['userID'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
	$create_at = $_POST['create_at'];
	$role = $_POST['role'];
	$status = "1";



	$usernameExists = false;
	$emailExists = false;
	$phone_numberExists = false;

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

	$id_acount;
	foreach ($nguoidungs as $nguoidung) {
		if ($nguoidung['id'] === $userID) {
			$id_acount = $nguoidung['id_acount'];
			break;
		}
	}


	if ($emailExists && $email != $emailOfUser) {
		echo "exists email";
	} else if ($phone_numberExists && $phone_number != $phoneOfUser) {
		echo "exists phone";
	} else if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
		echo "invalid email";
	} else if (!preg_match("/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/", $phone_number)) {
		echo "invalid phone";
	} else {
		$updateResult = $db->updateEditData($userID, $fullname, $email, $phone_number, $create_at, $address);
		if (
			$updateResult && $db->roleAccount($id_acount, $role)
		) {
			echo "valid1";
		} elseif ($db->roleAccount($id_acount, $role)) {
			echo "valid1";
		} elseif ($updateResult) {
			echo "valid1";
		} else {
			echo "inva";
		}
	}
} else {
	echo "invalid request";
}

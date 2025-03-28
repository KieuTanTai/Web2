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
	&& isset($_POST['role'])
) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$accountEND = end($accounts);
	$id_acount = $accountEND['id'] + 1;
	$status = "1";

	$emailOfUser = $_POST['emailOfUser'];
	$phoneOfUser = $_POST['phoneOfUser'];

	$fullname = $_POST['fullname'];
	$userID = $_POST['userID'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];

	$create_at = $_POST['create_at'];

	$status = "1";
	
	$role = 0;
	if (isset($_POST['role'])) {
		$role = $_POST['role'];
	}

	$usernameExists = false;
	$emailExists = false;
	$phone_numberExists = false;
	$usernameExists = false;

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

	foreach ($accounts as $account) {
		if ($account['user_name'] === $username) {
			$usernameExists = true;
			break;
		}
	}


	if ($emailExists && $email != $emailOfUser) {
		echo "exists email";
	} else if ($phone_numberExists && $phone_number != $phoneOfUser) {
		echo "exists phone";
	} else if ($usernameExists) {
		echo "exists username";
	} else if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) {
		echo "invalid email";
	} else if (!preg_match("/^\d{10}$/", $phone_number)) {
		echo "invalid phone";
	} else if (strlen($username) < 6) {
		echo "invalid username";
	} else if (strlen($password) < 6) {
		echo "invalid password";
	} else {

		$updateResult = $db->updateEditData($userID, $fullname, $email, $phone_number, $create_at, $address);
		$accountEND = end($accounts);
		$id_acount = $accountEND['id'] + 1;
		if (
			$updateResult
			&& $db->registerAcount($username, $password, $role, $status)
			&& $db->roleAccount($userID, $role)
			&& $db->updateEditDataEdit($userID, $fullname, $email, $phone_number, $create_at, $address, $id_acount)
		) {
			echo "valid1";
		} elseif ($db->roleAccount($userID, $role)) {
			echo "valid1";
		} else if ($db->registerAcount($username, $password, $role, $status)) {
			$db->idAccount($userID, $id_acount);
			echo "valid1";
		} else if ($db->updateEditDataEdit($userID, $fullname, $email, $phone_number, $create_at, $address, $id_acount)) {
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

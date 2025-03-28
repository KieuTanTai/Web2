<style>
	.container {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}

	.themuser {
		width: 400px;
		padding: 20px;
		border: 1px solid #ccc;
		border-radius: 5px;
		background-color: #f9f9f9;
	}

	.themuser h3 {
		text-align: center;
		margin-bottom: 20px;
	}

	.themuser form label {
		display: block;
		margin-bottom: 5px;
	}

	.themuser form input[type="text"],
	.themuser form input[type="email"],
	.themuser form input[type="password"],
	.themuser form input[type="date"] {
		width: 100%;
		padding: 8px;
		margin-bottom: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	.themuser form input[type="submit"] {
		width: 100%;
		padding: 10px;
		border: none;
		border-radius: 4px;
		background-color: #4CAF50;
		color: white;
		cursor: pointer;
	}

	.themuser form input[type="submit"]:hover {
		background-color: #45a049;
	}

	.alert {
		color: green;
		text-align: center;
	}

	.form--inner {
		display: flex;
		gap: 30px;
	}

	.editrole {
		margin-left: 50px;
		margin-top: 20px;
	}

	.editrole-heading {}

	.editrole-form {
		display: flex;
		margin-top: 20px;
		gap: 20px;
	}

	.editrole-form--inner {}

	.editrole-label {}

	.editrole-select {
		height: 25px;
		border-radius: 5px;
	}

	.editrole-option {}

	.editrole-btn {
		background-color: #ccc;
	}
</style>

<body>
	<?php
	if (isset($_GET['id']) && $_GET['id'] > 0) {
		// Get the voucher ID from the URL
		$userID = $_GET['id'];

		// Fetch voucher details from the database based on the ID
		// Assuming you have a method to fetch voucher details by ID in your DBConfig class
		$user = $db->getUserById($userID);

		// Check if voucher details are retrieved successfully
		if ($user) {
			// Extract voucher details into variables
			extract($user);
		}
	}
	?>
	<script>
		// Bây giờ bạn có thể sử dụng biến userID trong JavaScript
	</script>

	<div class="container">
		<div class="themuser">
			<h3>Sửa thành viên</h3>
			<form action="" method="POST" class="form" onsubmit="return validateForm()">
				<div class="form--inner">
					<div class="flex">
						<label for="fullname">Họ Tên:</label><br>
						<input type="text" id="fullname" name="fullname" value="<?= isset($fullname) ? $fullname : '' ?>"><br>
						<span id="validation" class="error_msg" style="color: red;"></span>

						<label for="email">Email:</label><br>
						<input type="email" id="email" name="email" value="<?= isset($email) ? $email : '' ?>"><br>
						<span id="validation" class="error_msg" style="color: red;"></span>

						<label for="phone_number">Số Điện Thoại:</label><br>
						<input type="text" id="phone_number" name="phone_number" value="<?= isset($phone_number) ? $phone_number : '' ?>"><br>
						<span id="validation" class="error_msg" style="color: red;"></span>

					</div>
					<div class="flex">
						<label for="create_at">Ngày Tạo:</label><br>
						<input type="date" id="create_at" name="create_at" value="<?= isset($create_at) ? $create_at : '' ?>"><br>
						<span id="validation" class="error_msg" style="color: red;"></span>

						<label for="address">Địa Chỉ:</label><br>
						<input type="text" id="address" name="address" value="<?= isset($address) ? $address : '' ?>"><br><br>
						<span id="validation" class="error_msg" style="color: red;"></span>

						<div class="editrole-form--inner">
							<label for="role" class="editrole-label">Chọn quyền:</label>
							<select name="role" id="role" class="editrole-select">
								<option class="editrole-option" value="0" selected>--Chọn quyền--</option>
								<?php $data = $db->getDataId('acount', $_REQUEST['id']); ?>
								<?php foreach ($roles as $role) :
									$selected = ($data['id_role'] == $role['id']) ? 'selected' : ''; ?>
									<option <?= $selected ?> class="editrole-option" value="<?= $role['id'] ?>"><?= $role['decription'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>


				</div>
				<input type="submit" name="edit_user" value="Sửa">
			</form>
		</div>
	</div>
</body>

</html>

<script>
	let checkValid = 0;

	let fullname = document.getElementById("fullname");
	let email = document.getElementById("email");
	let phone_number = document.getElementById("phone_number");
	let address = document.getElementById("address");
	let create_at = document.getElementById("create_at");
	let spansValidation = document.querySelectorAll('#validation');

	// Hàm kiểm tra điều kiện và hiển thị thông báo lỗi
	function validateField(input, mess, span) {
		if (input.value.trim() === "") {
			span.textContent = mess;
			return false;
		} else {
			span.textContent = "";
			return true;
		}
	}

	function validateFieldRegex(input, regex, mess, span) {
		if (!regex.test(input.value)) {
			span.textContent = mess;
			return false;
		} else {
			span.textContent = "";
			return true;
		}
	}

	// Lắng nghe sự kiện blur và thực hiện validation
	fullname.addEventListener("blur", function() {
		validateField(fullname, "Vui lòng nhập họ và tên", spansValidation[0]);
	});

	email.addEventListener("blur", function() {
		validateFieldRegex(email, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[1]);
	});

	phone_number.addEventListener("blur", function() {
		validateFieldRegex(phone_number, /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[2]);
	});

	create_at.addEventListener("blur", function() {
		validateField(create_at, "Vui lòng nhập ngày tạo", spansValidation[3]);
	});

	address.addEventListener("blur", function() {
		validateField(address, "Vui lòng nhập địa chỉ", spansValidation[4]);
	});



	function validateForm() {
		const isValidFullName = validateField(fullname, "Vui lòng nhập họ và tên", spansValidation[0]);
		const isValidEmail = validateFieldRegex(email, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[1]);
		const isValidPhoneNumber = validateFieldRegex(phone_number, /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[2]);
		const isValidAddress = validateField(address, "Vui lòng nhập địa chỉ", spansValidation[3]);
		const isValidCreate_at = validateField(create_at, "Vui lòng nhập địa chỉ", spansValidation[4]);

		if (isValidFullName && isValidEmail && isValidPhoneNumber &&
			isValidAddress && isValidCreate_at) {
			checkValid = 1;
		} else {
			checkValid = 0;
		}
	}

	let userID = <?php echo json_encode($userID); ?>;
	let emailOfUser = <?php echo json_encode($email); ?>;
	let phoneOfUser = <?php echo json_encode($phone_number); ?>;


	$(document).ready(function() {
		$('.form').submit(function(e) {
			e.preventDefault(); // Ngăn chặn việc gửi form mặc định
			// Thu thập dữ liệu từ form
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var phone_number = $('#phone_number').val();
			var address = $('#address').val();
			var create_at = $('#create_at').val();
			var role = $('#role').val();


			// Gửi AJAX request
			$.ajax({
				type: 'POST',
				url: 'Controller/trangadmin/checkEditUser.php',
				data: {
					fullname: fullname,
					email: email,
					phone_number: phone_number,
					address: address,
					create_at: create_at,
					role: role,
					userID: userID,
					emailOfUser: emailOfUser,
					phoneOfUser: phoneOfUser,
					checkValid: checkValid
				},
				// Xử lý phản hồi từ server ở đây
				success: function(response) {
					if (response.trim() === "exists email") {
						alert("Email đã tồn tại, vui lòng nhập lại!");
					} else if (response.trim() === "invalid email") {
						alert("Nhập sai Email, vui lòng nhập lại!");
					} else if (response.trim() === "invalid phone") {
						alert("Nhập sai số điện thoại, vui lòng nhập lại!");
					} else if (response.trim() === "exists phone") {
						alert("Số điện thoại đã tồn tại, vui lòng nhập lại!");
					} else if (response.trim() === "valid1") {
						alert("Sửa thành công");
						window.location.href = `index.php?controller=trang-admin&action=indexAdmin`;
					} else if (response.trim() === "valid2") {
						alert("Sửa thành công");
						window.location.href = `index.php?controller=trang-admin&action=indexAdmin`;
					} else if (response.trim() === "valid3") {
						alert("Sửa thành công");
						window.location.href = `index.php?controller=trang-admin&action=indexAdmin`;
					} else if (response.trim() === "inva") {
						alert("Không có dữ liệu được cập nhật");
					} else {
						alert("Vui lòng nhập đầy đủ thông tin");
					}

				},

				error: function(xhr, status, error) {
					// Xử lý lỗi nếu có
					console.error(xhr.responseText);
				}
			});
		});
	});
</script>
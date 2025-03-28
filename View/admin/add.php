<body>

	<div class="add-user-box">
		<h2 class="add-user--heading">Thêm người dùng</h2>
		<div class="add-user--inner">
			<form action="" method="post" class="form--add-user" onsubmit="return validateForm()">
				<div class=" form--inner">
					<div class="form--inner-left">
						<div class="form--inner--fill">
							<label class="add-user--label" for="fullname">Họ Tên:</label><br>
							<input placeholder="Họ tên" class="add-user--input" type="text" id="fullname" name="fullname"><br>
							<span id="validation" class="error_msg" style="color: red;"></span>
						</div>
						<div class="form--inner--fill">
							<label class="add-user--label" for="email">Email:</label><br>
							<input placeholder="Email" class="add-user--input" type="email" id="email" name="email"><br>
							<span id="validation" class="error_msg" style="color: red;"></span>

						</div>
						<div class="form--inner--fill">
							<label class="add-user--label" for="phone_number">Số Điện Thoại:</label><br>
							<input placeholder="Phone number" class="add-user--input" type="text" id="phone_number" name="phone_number"><br>
							<span id="validation" class="error_msg" style="color: red;"></span>

						</div>
					</div>
					<div class="form--inner--right">
						<!-- <div class="form--inner--fill">
							<label class="add-user--label" for="status">Trạng Thái:</label><br>
							<input placeholder="Trạng thái" class="add-user--input" type="text" id="status" name="status"><br>

						</div> -->
						<div class="form--inner--fill">
							<label class="add-user--label" for="address">Địa Chỉ:</label><br>
							<input placeholder="Địa chỉ" class="add-user--input" type="text" id="address" name="address"><br>
							<span id="validation" class="error_msg" style="color: red;"></span>

						</div>

						<div class="form--inner--fill">
							<label class="add-user--label" for="username">Tài khoản</label><br>
							<input placeholder="Tài khoản" class="add-user--input" type="text" id="username" name="username"><br><br>
							<span id="validation" class="error_msg" style="color: red;"></span>
						</div>

						<div class="form--inner--fill">
							<label class="add-user--label" for="password">Mật khẩu</label><br>
							<input placeholder="Mật khẩu" class="add-user--input" type="text" id="password" name="password"><br><br>
							<span id="validation" class="error_msg" style="color: red;"></span>
						</div>
						<div class="form--inner--fill">
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
				<input placeholder="" class="add-user--btn" type="submit" name="add_user" value="Thêm">
			</form>
		</div>


	</div>
</body>
<script>
	let checkValid = 0;

	let fullname = document.getElementById("fullname");
	let email = document.getElementById("email");
	let phone_number = document.getElementById("phone_number");
	let address = document.getElementById("address");
	let create_at = document.getElementById("create_at");
	let spansValidation = document.querySelectorAll('#validation');

	// Function to validate a field and display error message
	function validateField(input, mess, span) {
		if (input.value.trim() === "") {
			span.textContent = mess;
			return false;
		} else {
			span.textContent = "";
			return true;
		}
	}

	function validateFieldUserName(input, mess, span) {
		if (input.value.length > 0 && input.value.length < 6) {
			span.textContent = mess;
			return false;
		} else {
			span.textContent = "";
			return true;
		}
	}

	// Function to validate a field against a regular expression and display error message
	function validateFieldRegex(input, regex, mess, span) {
		if (!regex.test(input.value)) {
			span.textContent = mess;
			return false;
		} else {
			span.textContent = "";
			return true;
		}
	}

	// Event listeners to trigger validation on blur
	fullname.addEventListener("blur", function() {
		validateField(fullname, "Vui lòng nhập họ và tên", spansValidation[0]);
	});

	email.addEventListener("blur", function() {
		validateFieldRegex(email, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[1]);
	});

	phone_number.addEventListener("blur", function() {
		validateFieldRegex(phone_number, /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[2]);
	});

	address.addEventListener("blur", function() {
		validateField(address, "Vui lòng nhập địa chỉ", spansValidation[3]);
	});

	username.addEventListener("blur", function() {
		validateField(username, "Vui lòng nhập tài khoản", spansValidation[4]);
	});

	password.addEventListener("blur", function() {
		validateField(password, "Vui lòng nhập mật khẩu", spansValidation[5]);
	});



	// Function to validate the entire form
	function validateForm() {
		const isValidFullName = validateField(fullname, "Vui lòng nhập họ và tên", spansValidation[0]);
		const isValidEmail = validateFieldRegex(email, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[1]);
		const isValidPhoneNumber = validateFieldRegex(phone_number, /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[2]);
		const isValidAddress = validateField(address, "Vui lòng nhập địa chỉ", spansValidation[3]);
		const isValidUsername = validateFieldUserName(username, "Tài khoản phải có ít nhất 6 ký tự", spansValidation[4]);
		const isValidPassword = validateFieldUserName(password, "Mật khẩu phải có ít nhất 6 ký tự", spansValidation[5]);


		if (isValidFullName && isValidEmail && isValidPhoneNumber && isValidAddress) {
			checkValid = 1;
		} else {
			checkValid = 0;
		}
	}


	$(document).ready(function() {
		$('.add-user--inner form').submit(function(e) {
			e.preventDefault(); // Ngăn chặn việc gửi form mặc định
			// Thu thập dữ liệu từ form
			var fullname = $('#fullname').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var email = $('#email').val();
			var phone_number = $('#phone_number').val();
			var address = $('#address').val();
			var role = $('#role').val();

			// Gửi AJAX request
			$.ajax({
				type: 'POST',
				url: 'Controller/trangadmin/checkAddUser.php',
				data: {
					fullname: fullname,
					username: username,
					password: password,
					email: email,
					phone_number: phone_number,
					address: address,
					role: role,
					checkValid: checkValid
				},
				// Xử lý phản hồi từ server ở đây
				success: function(response) {
					if (response.trim() === "exists username") {
						alert("Tài khoản đã tồn tại, vui lòng nhập lại!");
					} else if (response.trim() === "exists email") {
						alert("Email đã tồn tại, vui lòng nhập lại!");
					} else if (response.trim() === "invalid email") {
						alert("Nhập sai Email, vui lòng nhập lại!");
					} else if (response.trim() === "invalid phone") {
						alert("Nhập sai số điện thoại, vui lòng nhập lại!");
					} else if (response.trim() === "invalid username") {
						alert("Tài khoản phải lớn hơn 6 kí tự, vui lòng nhập lại!");
					} else if (response.trim() === "invalid password") {
						alert("Mật khẩu phải lớn hơn 6 kí tự, vui lòng nhập lại!");
					} else if (response.trim() === "exists phone") {
						alert("Số điện thoại đã tồn tại, vui lòng nhập lại!");
					} else if (response.trim() === "valid") {
						alert("Đăng kí người dùng thành công");
						window.location.href = `index.php?controller=trang-admin&action=indexAdmin`;
					} else if (response.trim() === "valid1") {
						alert("Đăng kí người dùng có tài khoản thành công");
						window.location.href = `index.php?controller=trang-admin&action=indexAdmin`;
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

</html>
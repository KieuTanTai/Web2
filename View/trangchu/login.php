<?php
include_once 'includes/login_orther.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/user/style.css" />
</head>

<body>
    <style>
        .orther-login {
            display: flex;
            margin-top: 20px;
            gap: 5px;
        }

        .login-google,
        .login-facebook {
            cursor: pointer;
        }
    </style>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="formSign_in">
                <h1>Sign In</h1>
                <input type="hidden" name="action" value="login">
                <div class="form--inner--fill">
                    <!-- <label class="add-user--label" for="fullname">Tài khoản:</label><br> -->
                    <input type="text" name="username" id="user_name_login" placeholder="User Name">

                </div>
                <div class="form--inner--fill">
                    <!-- <label class="add-user--label" for="email">Mật khẩu:</label><br> -->
                    <input type="password" name="password" id="password_login" placeholder="Password">
                </div>
                <a href="?action=forgotPassword" style="color: red">Quên mật khẩu </a>
                <button type="submit" name="login" value="yes" onclick="loginAjax()">Log In</button>

                <div class="orther-login">
                    <div class="login-facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                            <path d="M34 17C34 7.6111 26.3889 -6.10352e-05 17 -6.10352e-05C7.61116 -6.10352e-05 0 7.6111 0 17C0 25.4852 6.21666 32.5181 14.3438 33.7935V21.914H10.0274V17H14.3438V13.2546C14.3438 8.99401 16.8818 6.64057 20.7649 6.64057C22.6249 6.64057 24.5703 6.9726 24.5703 6.9726V11.1562H22.4267C20.3149 11.1562 19.6563 12.4666 19.6563 13.811V17H24.3711L23.6174 21.914H19.6563V33.7935C27.7834 32.5181 34 25.4852 34 17Z" fill="#1877F2" />
                        </svg>
                    </div>
                    <div class="login-google">
                        <a href="<?php echo $client->createAuthUrl() ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                                <circle cx="17.9824" cy="17" r="16.5" fill="white" stroke="#757575" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.416 13.1802C10.7697 12.4189 11.2695 11.7546 11.8556 11.1536C13.1818 9.79329 14.7875 8.92223 16.6882 8.62512C19.3487 8.20923 21.7297 8.8231 23.7873 10.5568C23.9173 10.6664 23.9494 10.7304 23.8081 10.8659C23.0818 11.5618 22.367 12.2691 21.648 12.9723C21.5743 13.0444 21.5245 13.1325 21.3935 13.015C19.582 11.3908 16.625 11.4093 14.7001 13.1611C14.0392 13.7625 13.5693 14.4832 13.2616 15.3095C13.2167 15.2807 13.1695 15.255 13.1272 15.2231C12.2231 14.5426 11.3196 13.8613 10.416 13.1802Z" fill="#D7282A" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2396 18.6267C13.4992 19.2721 13.8219 19.8823 14.3015 20.4006C15.521 21.7185 17.0326 22.287 18.8438 22.103C19.6852 22.0175 20.452 21.7386 21.1683 21.3101C21.2371 21.3702 21.3025 21.4344 21.3749 21.4899C22.2133 22.1304 23.0529 22.7696 23.892 23.4092C22.9667 24.2692 21.874 24.8417 20.645 25.1457C17.7471 25.8625 15.0759 25.4095 12.7039 23.5778C11.7233 22.8205 10.9519 21.8851 10.4082 20.7778C11.3521 20.0608 12.2958 19.3437 13.2396 18.6267Z" fill="#45AC43" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.8926 23.4096C23.0534 22.7701 22.2139 22.1308 21.3755 21.4903C21.3031 21.4349 21.2377 21.3706 21.1689 21.3105C21.7371 20.8862 22.2112 20.3843 22.5226 19.7467C22.6467 19.4925 22.734 19.2264 22.8165 18.9573C22.8734 18.7718 22.8558 18.6996 22.6213 18.7016C21.2246 18.7132 19.8278 18.7074 18.431 18.7073C18.1352 18.7073 18.1349 18.7071 18.1349 18.4078C18.1348 17.4814 18.1394 16.5549 18.1309 15.6285C18.1293 15.4499 18.1613 15.3813 18.3668 15.3818C20.943 15.3892 23.5193 15.3876 26.0956 15.3842C26.2347 15.384 26.3221 15.3941 26.3463 15.5596C26.6668 17.7645 26.4099 19.8712 25.2305 21.8171C24.8695 22.4128 24.4356 22.9568 23.8926 23.4096Z" fill="#5D7FBE" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2402 18.6269C12.2964 19.3439 11.3526 20.0609 10.4088 20.778C9.94788 19.9395 9.68203 19.0386 9.558 18.1004C9.3431 16.4748 9.57924 14.9107 10.284 13.4191C10.3227 13.3372 10.3717 13.26 10.4159 13.1804C11.3195 13.8614 12.223 14.5427 13.1271 15.2233C13.1694 15.2552 13.2166 15.2809 13.2615 15.3096C12.8829 16.4132 12.9018 17.519 13.2402 18.6269Z" fill="#F4C300" />
                            </svg>
                        </a>
                    </div>
                </div>

            </form>
        </div>
        <div class="form-container sign-up">
            <form id="signup_form" method="post" onsubmit="return validateForm()">
                <h1>Create Account</h1>
                <input type="hidden" name="action" value="signup">
                <!-- Các trường nhập -->
                <input type="text" id="fullname_signup" name="fullname_signup" placeholder="Full Name">
                <span id="validation" class="error_msg" style="color: red;"></span>

                <input type="text" id="user_name_signup" name="user_name_signup" placeholder="User Name">
                <span id="validation" class="error_msg" style="color: red;"></span>


                <input type="password" id="password_signup" name="password_signup" placeholder="Password">
                <span id="validation" class="error_msg" style="color: red;"></span>

                <input type="email" id="email_signup" name="email_signup" placeholder="Email">
                <span id="validation" class="error_msg" style="color: red;"></span>

                <input type="tel" id="phone_number_signup" name="phone_number_signup" placeholder="Phone Number" />
                <span id="validation" class="error_msg" style="color: red;"></span>

                <input type="text" id="address_signup" name="address_signup" placeholder="Address" />
                <span id="validation" class="error_msg" style="color: red;"></span>

                <!-- Nút Submit -->
                <button type='submit' name="btnRegister">Sign Up</button>
            </form>
        </div>
        <div id="result"></div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hiddenLoc" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hiddenLoc" id="signup">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const container = document.getElementById("container");
    const signupBtn = document.getElementById("signup");
    const loginBtn = document.getElementById("login");

    signupBtn.addEventListener("click", () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener("click", () => {
        container.classList.remove("active");
    });
</script>
<script>
    let checkValid = 0;

    let fullname = document.getElementById("fullname_signup");
    let username = document.getElementById("user_name_signup");
    let password = document.getElementById("password_signup");
    let email = document.getElementById("email_signup");
    let phoneNumber = document.getElementById("phone_number_signup");
    let address = document.getElementById("address_signup");
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

    username.addEventListener("blur", function() {
        validateField(username, "Vui lòng nhập tên đăng nhập", spansValidation[1]) && validateFieldRegex(username,
            /^.{6,}$/,
            "Tên người dùng phải có ít nhất 6 ký tự", spansValidation[1]);
    });

    password.addEventListener("blur", function() {
        validateField(password, "Vui lòng nhập password", spansValidation[2]) && validateFieldRegex(password,
            /^.{6,}$/,
            "Mật khẩu phải có ít nhất 6 ký tự", spansValidation[2]);
    });

    email.addEventListener("blur", function() {
        validateFieldRegex(email, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[3]);
    });

    phoneNumber.addEventListener("blur", function() {
        validateFieldRegex(phoneNumber, /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[4]);
    });

    address.addEventListener("blur", function() {
        validateField(address, "Vui lòng nhập địa chỉ", spansValidation[5]);
    });

    function validateForm() {
        const isValidFullName = validateField(fullname, "Vui lòng nhập họ và tên", spansValidation[0]);
        const isValidUsername = validateField(username, "Vui lòng nhập tên đăng nhập", spansValidation[1]) && validateFieldRegex(username,
            /^.{6,}$/,
            "Tên người dùng phải có ít nhất 6 ký tự", spansValidation[1]);
        const isValidPassword = validateField(password,
            "Vui lòng nhập password", spansValidation[2]) && validateFieldRegex(password,
            /^.{6,}$/,
            "Mật khẩu phải có ít nhất 6 ký tự", spansValidation[2]);
        const isValidEmail = validateFieldRegex(email,
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ", spansValidation[3]);
        const isValidPhoneNumber = validateFieldRegex(phoneNumber,
            /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/, "Số điện thoại không hợp lệ", spansValidation[4]);
        const isValidAddress = validateField(address,
            "Vui lòng nhập địa chỉ", spansValidation[5]);

        if (isValidFullName && isValidUsername && isValidPassword && isValidEmail && isValidPhoneNumber && isValidAddress) {
            checkValid = 1;
        } else {
            checkValid = 0;
        }
    }




    $(document).ready(function() {
        $('.sign-up form').submit(function(e) {
            e.preventDefault(); // Ngăn chặn việc gửi form mặc định
            // Thu thập dữ liệu từ form
            var fullname = $('#fullname_signup').val();
            var username = $('#user_name_signup').val();
            var password = $('#password_signup').val();
            var email = $('#email_signup').val();
            var phone_number = $('#phone_number_signup').val();
            var address = $('#address_signup').val();

            // Gửi AJAX request
            $.ajax({
                type: 'POST',
                url: 'Controller/trangchu/check_username.php',
                data: {
                    fullname: fullname,
                    username: username,
                    password: password,
                    email: email,
                    phone_number: phone_number,
                    address: address,
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
                    } else if (response.trim() === "exists phone") {
                        alert("Số điện thoại đã tồn tại, vui lòng nhập lại!");
                    } else if (response.trim() === "valid") {
                        alert("Đăng kí thành công");
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

    function loginAjax() {
        var formData = $('#formSign_in').serialize(); // Sử dụng .serialize() để thu thập dữ liệu từ form

        $.ajax({
            url: "/WEB2/Controller/trangchu/index.php",
            type: "POST",
            data: formData,
            success: function(response) {
                if (xhr.status === 401) {
                    // Hiển thị thông báo lỗi nếu thông tin đăng nhập không chính xác
                    alert("Tên đăng nhập hoặc mật khẩu không đúng!");
                } else {
                    // Xử lý phản hồi từ server
                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Xử lý lỗi nếu có
            }
        });
    }
</script>

<!-- <link rel="stylesheet" href="Controller/trangchu/check_username.php"> -->
<?php
if (isset($_SESSION['error_message'])) {
    echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';
    unset($_SESSION['error_message']); // Xóa thông báo lỗi sau khi đã hiển thị
}

if (isset($_SESSION['error_username_password'])) {
    echo '<script>alert("' . $_SESSION['error_username_password'] . '");</script>';
    unset($_SESSION['error_username_password']); // Xóa thông báo lỗi sau khi đã hiển thị
}
?>
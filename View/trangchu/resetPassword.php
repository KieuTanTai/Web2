<?php
include "../../Model/DBConfig.php";
if (isset($_COOKIE['userIDForReset'])) {
    $idUserForReset = $_COOKIE["userIDForReset"];

    // Kiểm tra xem người dùng đã gửi mật khẩu mới hay chưa
    if (isset($_POST['password-forgot'])) {
        $password = $_POST['password-forgot'];
        // if(strlen($password) < 6 || !preg_match('/[^a-zA-Z0-9]/', $password)){ // hoac password không chứ kí tự đặc biệt
        //     exit();
        // }
        $db = new Database();
        $db->connect();
        $db->updatePasswordById($idUserForReset, $password);

        // Hủy cookie sau khi cập nhật mật khẩu thành công
        setcookie("userIDForReset", "", time() - 3600, "/");
        echo '<div class="susscess-sent-email" style="background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 10px 0 rgba(0,0,0,.14);
            margin: 0 22% 0 auto;
            min-height: 280px;
            padding: 20px 50px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 440px;
            text-align: center">
            <svg width="64" height="64" viewBox="0 0 48 48" fill="none">
                <circle cx="24" cy="24" r="21" fill="transparent" stroke="#08B371" stroke-width="3.6"></circle>
                <path d="M15 24L21.364 30.364L32.6777 19.0503" stroke="#08B371" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <h2 style="padding-top: 20px">Đã đặt lại mật khẩu</h2>
            <p style="
        font-size: 16px;
        padding-top: 15px;
        font-weight: 400;
        line-height: 1.5;
        color: #212121" id="countdown" class="countdown">Bạn sẽ được đưa về trang trước trong 3 giây</p>
            <a href="http://localhost/WEB2/">
                <button type="button" style="border-radius: 12px;
                background-color: #ff5b00;
                border: 1px solid #ff5b00;
                color: #fff;
                font-size: 16px;
                font-stretch: normal;
                font-style: normal;
                font-weight: 600;
                line-height: 22px;
                margin-top: 30px;
                min-width: 86px;
                outline: none;
                overflow: hidden;
                padding: 10px 16px;
                text-align: center;
                text-decoration: none;
                text-transform: none;
                width: 100%;
                cursor: pointer;">OK</button>
            </a>
        </div>
        <script>
  // Đoạn mã JavaScript
  document.addEventListener("DOMContentLoaded", function() {
    var countdownElement = document.getElementById("countdown");
    var count = 3;

    var countdownInterval = setInterval(function() {
      count--;
      if (count > 0) {
        countdownElement.textContent = "Bạn sẽ được đưa về trang trước trong " + count + " giây";
      } else {
        clearInterval(countdownInterval);
        countdownElement.textContent = "Bạn đã được đưa về trang trước";
        window.location.href = "http://localhost/WEB2/index.php?controller=trang-chu&action=login";
        countdownElement.classList.add("countdown-finished"); // Thêm class cho thẻ p khi countdown kết thúc
      }
    }, 1000);
  });
</script>
    
        ';


    }
} else {
    echo '<div class="susscess-sent-email" style="background: #fff;
		border-radius: 20px;
		box-shadow: 0 4px 10px 0 rgba(0,0,0,.14);
		margin: 0 22% 0 auto;
		min-height: 280px;
		padding: 20px 50px;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 9999;
		width: 440px;
		text-align: center">
		
		<svg width="64" height="64" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="21" fill="transparent" stroke="#F09B0A" stroke-width="3.6"></circle><path d="M24 25V14" stroke="#F09B0A" stroke-width="3.6" stroke-linecap="round"></path><circle cx="24" cy="33" r="2.5" fill="#F09B0A"></circle></svg>
		<h2 style="padding-top: 20px">Email đã hết hạn</h2>
        <p style="
    font-size: 16px;
    padding-top: 15px;
    font-weight: 400;
    line-height: 1.5;
    color: #212121">Xin lỗi bạn, email đã hết hạn. Vui lòng gửi lại email để đặt lại mật khẩu.</p>
        <a href="http://localhost/WEB2/">
            <button type="button" style="border-radius: 12px;
            background-color: #ff5b00;
            border: 1px solid #ff5b00;
            color: #fff;
            font-size: 16px;
            font-stretch: normal;
            font-style: normal;
            font-weight: 600;
            line-height: 22px;
            margin-top: 30px;
            min-width: 86px;
            outline: none;
            overflow: hidden;
            padding: 10px 16px;
            text-align: center;
            text-decoration: none;
            text-transform: none;
            width: 100%;
            cursor: pointer;">OK</button>
        </a>
	</div>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0dfb1263b2.js" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #f5f5f5;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .header {
            height: 60px;
            background-color: #fff;
        }

        .container {
            width: 1160px;
            margin: 0 auto;
        }

        .form-forgotpassword {
            background-color: #fff;
            width: 420px;
            border-radius: 20px;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .08);
            outline: none;
            padding: 24px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            line-height: 1.32;
        }

        input {
            align-items: center;
            background-color: #fff;
            outline: none;
            border: 1px solid #e6e6e6;
            border-radius: 12px;
            color: #212121;
            display: inline-flex;
            font-size: 16px;
            min-height: 44px;
            position: relative;
            transition: border .24s cubic-bezier(.22, 0, .08, 1);
            width: 100%;
            padding: 5px 43px 5px 47px;
        }

        input:hover {
            align-items: center;
            background-color: #fff;
            border: 1px solid #212121;
            outline: none;
            border-radius: 12px;
            color: #212121;
            display: inline-flex;
            font-size: 16px;
            min-height: 44px;
            position: relative;
            transition: border .24s cubic-bezier(.22, 0, .08, 1);
            width: 100%;
        }

        input:focus {
            border: 1px solid #212121;
            outline: none;
        }

        .input:hover .fa-regular {
            color: #212121;
        }

        input:focus~.icon .fa-regular {
            color: #212121;
        }

        button {
            border-radius: 12px;
            background-color: #ff5b00;
            border: 1px solid #ff5b00;
            color: #fff;
            font-size: 16px;
            font-stretch: normal;
            font-style: normal;
            font-weight: 600;
            line-height: 22px;
            margin-top: 30px;
            min-width: 86px;
            outline: none;
            overflow: hidden;
            padding: 10px 16px;
            text-align: center;
            text-decoration: none;
            text-transform: none;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #e85d0f;
        }

        .icon {
            position: fixed;
            top: 41%;
            left: 12%;
            transform: translate(-50%, -50%);
        }

        .icon-kill {
            position: fixed;
            top: 41%;
            left: 88%;
            transform: translate(-50%, -50%);
            padding: 6px;
            cursor: pointer;
        }

        .icon .fa-regular {
            font-size: 21px;
            font-weight: 300;
            color: #e6e6e6;
        }

        .nav-top--logo {
            width: 115px;
            height: 60px;
        }

        .footer {
            position: fixed;
            bottom: 0px;
            margin-bottom: 10px;
            background-color: #fff;
            width: 100%;
        }

        .footer .container {
            /* padding-left: 138px; */
            width: 1160px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #757575;
            font-weight: 400;
            font-size: 15px;
            padding-top: 20px;
        }

        .footer .icon-logo-SGU {
            width: 32px;
            height: 32px;
            object-fit: cover;
        }

        .css-top {
            width: 200px;
            height: 200px;
            position: fixed;
            z-index: -1;
            top: 34px;
            left: -37px;
            border: 121px solid #ff5b00;
            border-radius: 92px 189px 11px 200px;
            -webkit-border-radius: 92px 189px 11px 200px;
            -moz-border-radius: 92px 189px 11px 200px;
            color: #ff5b00;
        }

        .css-bottom {
            width: 200px;
            height: 200px;
            position: fixed;
            z-index: -1;
            bottom: 34px;
            right: -37px;
            border: 121px solid #158cba;
            border-radius: 21px 200px 27px 136px;
            -webkit-border-radius: 21px 200px 27px 136px;
            -moz-border-radius: 21px 200px 27px 136px;
        }

        .notifi {
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 9px;
            color: #757575;
            font-size: 14px;
            font-weight: 400;
            gap: 5px;
        }

        .none {
            display: none;
            /* opacity: 0;
            visibility: hidden; */
        }
        .reject {
            cursor: not-allowed;
            opacity: 0.8;
        }
    </style>
    <header class="header">
        <div class="container">
            <a href="index.php?controller=trang-chu">
                <img src="/WEB2/css/icons/8939fe11b96fc40d9c65ca88a0ad1fd1.png" alt="" class="nav-top--logo">
            </a>
        </div>
    </header>

    <div class="form-forgotpassword">
        <form method="post">
            <h1>Đặt lại mật khẩu</h1><br>
            <div class="input">
                <input type="password" placeholder="mật khẩu" name="password-forgot" id="password-forgot"><br>
                <div class="icon"><svg width="20" height="20" viewBox="0 0 48 48" fill="none">
                        <rect x="5" y="18" width="38" height="27" rx="8" fill="transparent" stroke="#212121"
                            stroke-width="3.6"></rect>
                        <path d="M15 12C15 7.58172 18.5817 4 23 4H25C29.4183 4 33 7.58172 33 12V18H15V12Z"
                            stroke="#212121" stroke-width="3.6"></path>
                        <line x1="23.8" y1="26.8" x2="23.8" y2="35.2" stroke="#212121" stroke-width="3.6"
                            stroke-linecap="round"></line>
                    </svg></div>
                <div class="icon-kill">
                    <i class="fa-regular fa-eye eye-open none"></i>
                    <i class="fa-regular fa-eye-slash eye-close"></i>
                </div>
                <div class="error notifi length">
                    <!-- <i class="fa-solid fa-xmark fa-sm" style="color: #fff;"></i> -->
                    <svg width="16" height="16" viewBox="0 0 48 48" fill="none" class="check-length-false">
                        <circle cx="24" cy="24" r="21" fill="#F44622" stroke="#F44622" stroke-width="3.6"></circle>
                        <path d="M17.636 17.636L30.3639 30.3639" stroke="#FFF" stroke-width="3.6"
                            stroke-linecap="round"></path>
                        <path d="M17.636 30.364L30.3639 17.6361" stroke="#FFF" stroke-width="3.6"
                            stroke-linecap="round"></path>
                    </svg>
                    <svg width="16" height="16" viewBox="0 0 48 48" fill="none" class=" none check-length-success">
                        <circle cx="24" cy="24" r="21" fill="#08B371" stroke="#08B371" stroke-width="3.6"></circle>
                        <path d="M15 24L21.364 30.364L32.6777 19.0503" stroke="#FFF" stroke-width="3.6"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <p style="padding-left: 5px;">
                        Dài ít nhất 6 kí tự
                    </p>
                </div>
            </div>
            <button value="submit" class="submit reject">Đặt lại và đăng nhập</button>
        </form>
    </div>

    <div class="css-top">
        <div class="css-bottom"></div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>© 2014-2024 Klook. All Rights Reserved.</p>
            <img src="/WEB2/View/icon/logoSGU.jpeg" alt="" class="icon-logo-SGU" />
        </div>
    </footer>
    <script>
        var input = document.querySelector("#password-forgot");
        var checkLengthSuccess = document.querySelector(".check-length-success");
        var checkLengthFalse = document.querySelector(".check-length-false");
        var submitBtn = document.querySelector(".submit");

        submitBtn.addEventListener("click", function (event) {

            if (input.value.length < 6) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của sự kiện click
            }
        });


        console.log(checkLengthFalse);
        console.log(checkLengthSuccess);

        input.addEventListener("input", function () {
            if (input.value.trim().length < 6) {
                checkLengthSuccess.classList.add('none');
                checkLengthFalse.classList.remove('none');
                submitBtn.classList.add("reject");
            } else {
                checkLengthSuccess.classList.remove('none');
                checkLengthFalse.classList.add('none');
                submitBtn.classList.remove("reject");
            }
            
        })

        var icon_eye_password = document.querySelector(".icon-kill");
        var icon_eye_open = document.querySelector(".eye-open");
        var icon_eye_close = document.querySelector(".eye-close");

        icon_eye_password.addEventListener("click", function () {
            if (input.type == "password") {
                icon_eye_close.classList.add("none");
                icon_eye_open.classList.remove("none");
                input.type = "text";
            } else {
                icon_eye_close.classList.remove("none");
                icon_eye_open.classList.add("none");
                input.type = "password";
            }
        })
    </script>
</body>

</html>
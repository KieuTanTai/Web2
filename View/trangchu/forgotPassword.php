<?php
include "../../Model/DBConfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0dfb1263b2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="loading_min.css"/>
    <link rel="stylesheet" type="text/css" href="loading.css"/>
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
            padding: 5px 12px 5px 47px;
            position: relative;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
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
            position: absolute;
            top: 49%;
            left: 10%;
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

        .icon-left {
            padding-bottom: 10px;
        }

        .icon-left svg {
            font-size: 28px;
            font-weight: 700;
        }

        .show-error {
            display: block;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 400;
            color: #f44622;
            transition: opacity 0.3s ease-in-out;
        }

        .show-error.none {
            display: none;
            /* opacity: 0; */
            /* visibility: hidden; */
        }
        .submit.loading {
        opacity: 0.7;
        cursor: not-allowed;
        }
        .animate_load.hide {
            display: none;
            opacity: 0;
            visibility: hidden;
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
        <a href="http://localhost/WEB2/index.php?controller=trang-chu&action=login">
            <div class="icon-left">
                <svg width="15" height="23" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 1L1 8.5L10 16" stroke="#212121" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
        </a>

        <form method="post" class="form-check-has-email">
            <h1>Đặt lại bằng email</h1><br>
            <div class="input">
                <input type="text" placeholder="enter your email" name="email-forgot" id="email-forgot"><br>
                <div class="icon"><i class="fa-regular fa-envelope"></i></div>
            </div>
            <div class="show-error none">
                <svg width="16" height="16" viewBox="0 0 48 48" fill="none">
                    <circle cx="24" cy="24" r="21" fill="#F44622" stroke="#F44622" stroke-width="3.6"></circle>
                    <path d="M24 25V14" stroke="#FFF" stroke-width="3.6" stroke-linecap="round"></path>
                    <circle cx="24" cy="33" r="2.5" fill="#FFF"></circle>
                </svg>
                Bạn chưa có tài khoản nào với email này. Vui lòng đăng ký bằng email trước.
            </div>
            <button value="submit" class="submit">
                Gửi email
                <div class="ld ld-ring ld-spin animate_load hide"></div>
            </button>
        </form>
    </div>
    <div class="show-messege-sucsess"></div>
    <div class="css-top">
        <div class="css-bottom"></div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>© 2014-2024 Klook. All Rights Reserved.</p>
            <img src="/WEB2/View/icon/logoSGU.jpeg" alt="" class="icon-logo-SGU" />
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('.form-check-has-email').submit(function (e) {
    e.preventDefault(); // Ngăn chặn việc gửi form mặc định
    // Thu thập dữ liệu từ form
    var email_forgot = $('#email-forgot').val();
    var showError = $('.show-error');
    var icon = $('.icon')
    var emailInput = $("#email-forgot");
    var showSucess = $('.show-messege-sucsess');
    var btnSubmit = $('.submit');
    var animateLoad = $('.animate_load');
    btnSubmit.addClass('loading');
    animateLoad.removeClass('hide');


    // Gửi AJAX request
    $.ajax({
        type: 'POST',
        url: '/WEB2/includes/handle_mail.php',
        data: {
            email_forgot: email_forgot,
        },
        success: function (response) {
            if (response === "foundEmailToSentForgot") {
                console.log("Email found. Reset instructions sent.");
                showError.addClass('none');
                icon.css('top', '49%');
                showSucess.html(`
    <div class="susscess-sent-email" style="background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 10px 0 rgba(0,0,0,.14);
        margin: 0 22% 0 auto;
        min-height: 280px;
        padding: 20px 50px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        width: 440px;
        text-align: center">
        <a href="http://localhost/WEB2/index.php?controller=trang-chu&action=login">
            <div class="icon-left" style="text-align: left;">
                <svg width="15" height="23" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 1L1 8.5L10 16" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </a>
        <svg width="64" height="64" viewBox="0 0 48 48" fill="none">
            <circle cx="24" cy="24" r="21" fill="transparent" stroke="#08B371" stroke-width="3.6"></circle>
            <path d="M15 24L21.364 30.364L32.6777 19.0503" stroke="#08B371" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <h2 style="padding-top: 20px">Đã gửi email</h2>
        <p>Chúng tôi đã gửi email cho bạn đến <span style="color: #212121; font-weight: 600">${email_forgot}</span>. Hãy làm theo hướng dẫn trong email để đặt lại mật khẩu của bạn.</p><br>
        <p style="margin-top: 32px; color: #757575;">Không thể tìm thấy email? Hãy đảm bảo bạn đã nhập chính xác địa chỉ email hoặc</p>
`)


            } else if (response === "Email not found in the database") {
                console.log("Email not found in the database");
                showError.removeClass('none');
                icon.css('top', '42%');
                btnSubmit.removeClass('loading');
                animateLoad.addClass('hide');
            } else {
                console.log("Unknown response:", response);
            }
        },
        error: function (xhr, status, error) {
            console.error("XHR status:", xhr.status);
            console.error("XHR statusText:", xhr.statusText);
            console.error("Error:", error);
        }
    });

    // Xử lý sự kiện focus vào trường nhập email
    emailInput.focus(function () {
        // Ẩn thông báo lỗi khi trường nhập email được focus
        showError.addClass('none');
        icon.css('top', '49%');
    });
});



        // Chờ tất cả các phần tử trong DOM được tải xong
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Chọn tất cả các phần tử có class là 'show-error'
        //                 // $('#error-message').text(response);
        //                 var showError = document.querySelector('.show-error');
        //                 // Nếu phần tử tồn tại và có class 'none'
        //                 if (showError && showError.classList.contains('none')) {
        //                     // Chọn phần tử có class là 'icon'
        //                     var icon = document.querySelector('.icon');
        //                     // Thêm style cho class 'icon'
        //                     icon.style.top = '49%';
        //                 } else {
        //                     icon.style.top = '42%';
        //                 }

        //     // Lấy phần tử .check-tim-thay-email
        //     var checkTimThayEmail = document.querySelector(".check-tim-thay-email");
        //     console.log(checkTimThayEmail);

        //     // Kiểm tra nếu thuộc tính 'data' có giá trị là 1
        //     if (checkTimThayEmail.getAttribute("data") === "1") {
        //         // Lấy phần tử .show-error
        //         var showError = document.querySelector(".show-error");
        //         // Loại bỏ class 'none' từ phần tử .show-error
        //         showError.classList.add("none");
        //     } else {
        //         showError.classList.remove("none");
        //         icon.style.top = '42%';
        //     }
        //     // Lấy phần tử có id là "email-forgot"

        //     // Thêm sự kiện focus và xử lý khi phần tử được tập trung vào
            
        // });
    </script>
</body>

</html>
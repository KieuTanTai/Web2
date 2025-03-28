<!-- Trong mỗi trang HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
    <link rel="stylesheet" href="css/cssadmin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>


<body>
    <header class="header-admin">
        <div class="header-left">
            <img src="css/icons/hamberger-admin.svg" alt="" class="header-left--icon">
            <div class="header-left--find">
                <img src="css/icons/search-admin.svg" alt="" class="header-left--find-icon">
                <input type="text" class="header-left--find--input">
            </div>
        </div>
        <div class="header-right">
            <div class="header-right--nofi">
                <img src="css/icons/nofi-admin.svg" alt="" class="header-right--nofi--icon">
                <div class="header-right--nofi--text"></div>
            </div>
            <div class="header-right--profile">
                <div class="header-right--profile-info">
                    <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        ob_start();
                        session_start();
                    }
                    if (isset($_SESSION['objuser']) && isset($_SESSION['idUserLogin'])) {
                        echo '<div class ="tennguoidung nav-top--right__panner "> ' . $db->getTenNguoiDung() . '</div>';
                        echo '
							<div class = "header-avatar">
								<img src="/WEB2/images/avatar.png" width = "34" />
								<div class = "drop-user-side-bar">
									<a class = "dangxuat item" href="includes/session/del_session.php" >
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
											<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
										</svg>
										<p class="text">Đăng xuất</p>
									</a>
								</div>
							</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </header>

    <div class="navigation-admin">
        <a href="index.php?controller=trang-admin&action=trangChuAdmin" id="nav-item--logo" class="">
            <img src="css/icons/Logo-admin.png" alt="" class="nav-item--logo">
        </a>
        <div class="nav-admin-list">
            <!-- <a href="index.php?controller=trang-admin&action=role" id="page2" class="nav-admin-item-a nav-admin-item">
                <img src="css/icons/user-role-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                <p class="nav-admin-item--title">Phân quyền</p>
            </a> -->
            <!-- <a href="index.php?controller=trang-admin&action=chucnang" id="page0" class="nav-admin-item-a nav-admin-item">
                <img src="css/icons/function-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                <p class="nav-admin-item--title">Chức năng</p>
            </a> -->
            <img src="../../css/icons/userslist-admin-icon.svg" alt="">
            <?php
            $role = $db->checkRoleAdmin($_SESSION['idUserLogin']);
            foreach ($role as $rowRole) {
                if ($rowRole['id_role'] == 99) {
                    echo '<a href="index.php?controller=trang-admin&action=role" id="page2" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/user-role-svgrepo-com.svg" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Phân quyền</p>
                    </a>';
                    echo '<a href="index.php?controller=trang-admin&action=chucnang" id="page0" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/function-svgrepo-com.svg" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Chức năng</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 1 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=indexAdmin" id="page1" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/admin-nguoidung.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Người dùng</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 2 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=tour" id="page3" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/userslist-admin-icon.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Tour</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 3 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=order" id="page7" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/order-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Order</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 4 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=dthongke" id="page6" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/stats-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Thống kê</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 5 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=dsbl" id="page4" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/comment-alt-lines-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Bình luận</p>
                    </a>';
                } elseif ($rowRole['id_chucNang'] == 6 && $rowRole['HD'] == 'View') {
                    echo '<a href="index.php?controller=trang-admin&action=dsvoucher" id="page5" class="nav-admin-item-a nav-admin-item">
                        <img src="css/icons/price-voucher-discount-offer-ticket-svgrepo-com.svg" alt="" class="nav-admin-item--icon">
                        <p class="nav-admin-item--title">Voucher</p>
                    </a>';
                }
            }
            for ($i = 0; $i < 20; $i++) {
                echo '<a href="index.php?controller=trang-admin" w>
                        <p class="nav-admin-item--title"></p>
                    </a>';
            }
            ?>

        </div>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() { // Khi trang đã tải xong
        checkUrl(); // Kiểm tra và thêm class active cho phần tử thanh điều hướng

        $('.nav-admin-item-a').click(function(e) { // Khi một phần tử .nav-admin-item được nhấp vào
            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

            var url = $(this).attr('href'); // Lấy đường dẫn từ thuộc tính href của thẻ a

            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) { // Nếu yêu cầu Ajax thành công
                    // Cập nhật nội dung của trang
                    $('body').html(data);

                    // Thay đổi URL của trình duyệt mà không làm tải lại trang
                    history.pushState(null, null, url);

                    // Kiểm tra và thêm class active cho phần tử thanh điều hướng
                    checkUrl();
                },
                error: function(xhr, status, error) { // Nếu có lỗi xảy ra
                    // Xử lý lỗi nếu có
                    console.error(error);
                }
            });
        });

        // Lắng nghe sự kiện khi người dùng bấm nút Back/Forward trên trình duyệt
        window.onpopstate = function(event) {
            // Thực hiện lại yêu cầu Ajax khi người dùng quay lại trang trước đó
            $.ajax({
                url: location.href, // Sử dụng đường dẫn hiện tại
                type: 'GET',
                success: function(data) { // Nếu yêu cầu Ajax thành công
                    // Cập nhật nội dung của trang
                    $('body').html(data);
                    // Thay đổi URL của trình duyệt mà không làm tải lại trang
                    // Kiểm tra và thêm class active cho phần tử thanh điều hướng
                    checkUrl();
                },
                error: function(xhr, status, error) { // Nếu có lỗi xảy ra
                    // Xử lý lỗi nếu có
                    console.error(error);
                }
            });
        };

        // Hàm kiểm tra và thêm class active cho phần tử thanh điều hướng
        function checkUrl() {
            // Lấy action từ URL
            const urlParams = new URLSearchParams(window.location.search);
            const action = urlParams.get('action');
            // Kiểm tra action và thêm class active cho phần tử thanh điều hướng tương ứng
            if (action === 'indexAdmin' || action === 'edit' || action === 'editrole' || action === 'add') {
                $('#page1').addClass('header-admin-active');
            } else if (action === 'role' || action === 'editRole' || action === 'addRole') {
                $('#page2').addClass('header-admin-active');
            } else if (action === 'tour' || action === 'editTour' || action === 'addTour' || action === 'ticket' || action === 'addTicket' || action === 'editTicket') {
                $('#page3').addClass('header-admin-active');
            } else if (action === 'dsbl') {
                $('#page4').addClass('header-admin-active');
            } else if (action === 'dsvoucher' || action === 'suavoucher') {
                $('#page5').addClass('header-admin-active');
            } else if (action === 'dthongke') {
                $('#page6').addClass('header-admin-active');
            } else if (action === 'order' || action === 'detailOrder') {
                $('#page7').addClass('header-admin-active');
            } else if (action === 'chucnang') {
                $('#page0').addClass('header-admin-active');
            }
        }
    });
</script>
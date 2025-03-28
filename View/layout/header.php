<style>
    a {
        color: black;
    }

    .header-avatar img {
        cursor: pointer;
        border-radius: 25px;
    }

    .header-avatar .item {
        height: 40px;
        width: 83%;
        text-align: center;
        display: flex;
        align-items: center;
        column-gap: 3px;
        padding: 0px 10px;
        font-size: 16px;
    }

    .item svg {
        width: 20px;
        height: 20px;
    }

    .header-avatar .item:hover {
        background: #f5f5f5;
    }

    .drop-user-side-bar {
        border-radius: 10px;
        box-shadow: -1px 5px 15px 0px rgb(171, 171, 171);
        width: 180px;
        height: 100px;
        position: absolute;
        transform: translateX(-80%) translateY(10%);
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: white;
        cursor: pointer;
        display: none;
    }

    .drop-user-side-bar::before {
        position: absolute;
        right: 0;
        top: -10px;
        content: "";
        display: block;
        width: 100px;
        height: 20px;
    }

    .header-avatar:hover .drop-user-side-bar {
        display: flex;
    }

    #cartIcon {
        position: relative;
        font-size: 13px;
        font-weight: 600;
    }

    #numCart {
        position: absolute;
        right: 6px;
        top: 4px;
        content: "0";
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 25px;
        width: 12px;
        height: 12px;
        background-color: #ff5b00;
        color: #fff;
        font-size: 9px;
    }

    .dangxuat svg {
        margin-left: 3px;
    }
</style>

<body>
    <div class="nav display-none-mobile">
        <div class="nav-top">
            <div class="container">
                <div class="nav-top--inner">
                    <div class="nav-top--left">
                        <a href="index.php?controller=trang-chu">
                            <img src="css/icons/8939fe11b96fc40d9c65ca88a0ad1fd1.png" alt="" class="nav-top--logo">
                        </a>
                        <div class="nav-top--find">
                            <img src="css/icons/find-magnifier-search-zoom-look-svgrepo-com.svg" class="nav-top--find__icon" />
                            <input type="text" class="nav-top--find__input" placeholder="Tìm theo điểm đến, hoạt động">
                        </div>
                    </div>
                    <div class="nav-top--right">
                        <div class="nav-top--right__inner">
                            <a href="#!" class="nav-top--right__panner display-none-mobile">Mở ứng dụng</a>
                            <a href="#!" class="nav-top--right__panner display-none-mobile">Xem gần đây</a>
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            $idUser = 0;
                            if (isset($_SESSION['idUserLogin'])) {
                                $idUser = $_SESSION['idUserLogin'];
                            }
                            if ($db === null) {
                                die("Lỗi kết nối CSDL");
                            }
                            $numCart = $db->execute("SELECT COUNT(*) AS total_rows FROM cart WHERE id_user='$idUser'");
                            $rowNumCart = $numCart->fetch_assoc();
                            $totalRowsNumCart = $rowNumCart["total_rows"];
                            ?>
                            <?php
                            if (isset($_SESSION['isLogin'])) {
                                if ($_SESSION['isLogin'] == 1) {
                                    echo '<a href="/WEB2/index.php?controller=trang-chu&action=cart" id="cartIcon" class="option-header-right nav-top--right__panner toggle-nav--item a-href-ajax">
                                        Giỏ hàng 
          								<div id="numCart">';
                                    echo $totalRowsNumCart;
                                    echo '</div>
      								</a>';
                                }
                            }
                            if (isset($_SESSION['objuser']) && isset($_SESSION['idUserLogin'])) {
                                echo '<div class ="tennguoidung nav-top--right__panner display-none-mobile"> ' . $db->getTenNguoiDung() . '</div>';

                                echo '
							<div class = "header-avatar">
								<img src="/WEB2/images/avatar.png" width = "34" />
								<div class = "drop-user-side-bar">
									<a href="index.php?controller=trang-chu&action=userprofile&pageuser=cs">
										<div class = "trangcanhan item">
										<img src="/WEB2/IMAGEofLam/person.svg" width = "22" />
											<div class = "text">Trang cá nhân</div>
										</div>
									</a>
									<a class = "dangxuat item" href="includes/session/del_session.php">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
											<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
										</svg>
										<p  class="text">Đăng xuất</p>
									</a>
								</div>
							</div>';
                                echo '
							';

                                // Ẩn liên kết "Đăng kí" và "Đăng nhập"
                            } else {
                                //echo '<a href="index.php?controller=trang-chu&action=login" class="nav-top--right__panner">Đăng kí</a>';
                                echo '<a href="index.php?controller=trang-chu&action=login" class="nav-top--right__panner login-btn a-href-ajax">Đăng nhập</a>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-bottom">
            <div class="container">
                <div class="nav-bottom--inner">
                    <div class="nav-bottom--list">
                        <a href="index.php?controller=trang-chu&action=showproduct&category=0" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Tất cả danh mục
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=1" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Tour
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=2" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Du thuyền
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=3" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Hoạt động dưới nước
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=4" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Phiêu lưu & Khám phá thiên nhiên

                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=5" class="toggle-nav--item a-href-ajax">
                            <p class="nav-bottom--item">
                                Trải nghiệm văn hoá

                            </p>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="nav--mobile display-none-pc">
        <div class="nav-top">
            <div class="container">
                <div class="nav-top--inner">
                    <div class="nav-top--left">
                        <img src="css/icons/line-3-svgrepo-com.svg" alt="" id="toggleIcon" class="nav-top--toggle-icon ">
                        <a href="index.php?controller=trang-chu" class="a-href-ajax">
                            <img src="css/icons/8939fe11b96fc40d9c65ca88a0ad1fd1.png" alt="" class="nav-top--logo">
                        </a>
                        <div class="nav-top--find">
                            <img src="css/icons/find-magnifier-search-zoom-look-svgrepo-com.svg" class="nav-top--find__icon" />
                            <input type="text" class="nav-top--find__input" placeholder="Tìm theo điểm đến, hoạt động">
                        </div>
                    </div>
                    <div class="nav-top--right">
                        <div class="nav-top--right__inner">
                            <a href="#!" class="nav-top--right__panner display-none-mobile">Mở ứng dụng</a>
                            <a href="#!" class="nav-top--right__panner display-none-mobile">Xem gần đây</a>
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            $idUser = 0;
                            if (isset($_SESSION['idUserLogin'])) {
                                $idUser = $_SESSION['idUserLogin'];
                            }
                            $numCart = $db->execute("SELECT COUNT(*) AS total_rows FROM cart WHERE id_user='$idUser'");
                            $rowNumCart = $numCart->fetch_assoc();
                            $totalRowsNumCart = $rowNumCart["total_rows"];
                            ?>
                            <?php
                            if (isset($_SESSION['isLogin'])) {
                                if ($_SESSION['isLogin'] == 1) {
                                    echo '<a href="/WEB2/index.php?controller=trang-chu&action=cart" id="cartIcon" class="option-header-right nav-top--right__panner a-href-ajax">
                                        Giỏ hàng 
          								<div id="numCart">';
                                    // Embedding PHP to display $totalRowsNumCart
                                    echo $totalRowsNumCart;
                                    echo '</div>
      								</a>';
                                }
                            }
                            if (isset($_SESSION['objuser']) && isset($_SESSION['idUserLogin'])) {
                                echo '<div class ="tennguoidung nav-top--right__panner display-none-mobile"> ' . $db->getTenNguoiDung() . '</div>';

                                echo '
							<div class = "header-avatar">
								<img src="/WEB2/images/avatar.png" width = "34" />
								<div class = "drop-user-side-bar">
									<a href="index.php?controller=trang-chu&action=userprofile&pageuser=cs">
										<div class = "trangcanhan item">
										<img src="/WEB2/IMAGEofLam/person.svg" width = "22" />
											<div class = "text">Trang cá nhân</div>
										</div>
									</a>
									<a class = "dangxuat item" href="includes/session/del_session.php">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
											<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
										</svg>
										<p  class="text">Đăng xuất</p>
									</a>
								</div>
							</div>';
                                echo '
							';

                                // Ẩn liên kết "Đăng kí" và "Đăng nhập"
                            } else {
                                //echo '<a href="index.php?controller=trang-chu&action=login" class="nav-top--right__panner">Đăng kí</a>';
                                echo '<a href="index.php?controller=trang-chu&action=login" class="nav-top--right__panner login-btn a-href-ajax">Đăng nhập</a>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="toggle-nav display-none-mobile display-none-pc" id="toggleNav">
            <div class="toggle-nav--inner">
                <div class="toggle-nav--list">
                    <a href="index.php?controller=trang-chu&action=showproduct&category=0" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-00.webp" alt="" class="toggle-nav--icon">
                        <p class="toggle-nav-title">
                            Tất cả danh mục
                        </p>
                    </a>

                    <a href="index.php?controller=trang-chu&action=showproduct&category=1" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-01.webp" alt="" class="toggle-nav--item-icon">
                        <p class="toggle-nav--item-title">
                            Tour
                        </p>
                    </a>
                    <a href="index.php?controller=trang-chu&action=showproduct&category=2" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-02.webp" alt="" class="toggle-nav--item-icon">
                        <p class="toggle-nav--item-title">
                            Du thuyền
                        </p>
                    </a>
                    <a href="index.php?controller=trang-chu&action=showproduct&category=3" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-03.webp" alt="" class="toggle-nav--item-icon">
                        <p class="toggle-nav--item-title">
                            Hoạt động dưới nước
                        </p>
                    </a>
                    <a href="index.php?controller=trang-chu&action=showproduct&category=4" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-04.webp" alt="" class="toggle-nav--item-icon">
                        <p class="toggle-nav--item-title">
                            Phiêu lưu & Khám phá thiên nhiên

                        </p>
                    </a>
                    <a href="index.php?controller=trang-chu&action=showproduct&category=5" class="toggle-nav--item a-href-ajax">
                        <img src="css/icons/category-mobile-05.webp" alt="" class="toggle-nav--item-icon">
                        <p class="toggle-nav--item-title">
                            Trải nghiệm văn hoá

                        </p>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="overlay display-none-mobile" id="overlay">
    </div>

    <header class="header-mobile display-none-pc">
        <div class="container">
            <div class="header-mobile--inner">
                <div class="header-mobile-find">
                    <img src="css/icons/find-magnifier-search-zoom-look-svgrepo-com.svg" alt="" class="find-mobile-icon" />
                    <input type="text" class="find-mobile-input" placeholder="Thành phố HCM - Tour" />
                </div>

                <div class="header-mobile--category">
                    <ul class="header-mobile--list">
                        <a href="index.php?controller=trang-chu&action=showproduct&category=0" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-00.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Tất cả danh mục
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=1" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-01.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Tour
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=2" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-02.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Du thuyền
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=3" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-03.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Hoạt động dưới nước
                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=4" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-04.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Phiêu lưu & Khám phá thiên nhiên

                            </p>
                        </a>
                        <a href="index.php?controller=trang-chu&action=showproduct&category=5" class="header-mobile--item a-href-ajax">
                            <img src="css/icons/category-mobile-05.webp" alt="" class="header-mobile--item-icon">
                            <p class="header-mobile--item-title">
                                Trải nghiệm văn hoá

                            </p>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</body>


<script>
    var toggleIcon = document.getElementById("toggleIcon");
    var toggleNav = document.getElementById("toggleNav");
    var overlay = document.getElementById("overlay");

    toggleIcon.addEventListener("click", function() {
        toggleClass(toggleNav, "display-none-mobile");
        toggleClass(toggleNav, "display-block-mobile");
        toggleClass(overlay, "display-none-mobile");
        toggleClass(overlay, "display-block-mobile");
    });

    overlay.addEventListener("click", function() {
        toggleClass(toggleNav, "display-block-mobile");
        toggleClass(toggleNav, "display-none-mobile");
        toggleClass(overlay, "display-block-mobile");
        toggleClass(overlay, "display-none-mobile");
    });

    function toggleClass(element, className) {
        if (element.classList.contains(className)) {
            element.classList.remove(className);
        } else {
            element.classList.add(className);
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bắt sự kiện click trên các liên kết
        $('.a-href-ajax').click(function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

            var url = $(this).attr('href'); // Lấy đường dẫn từ thuộc tính href của liên kết
            // Thực hiện yêu cầu AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Xử lý phản hồi từ máy chủ (nếu cần)
                    // Ví dụ: cập nhật nội dung của một phần của trang với dữ liệu mới
                    // Ví dụ: $('.content').html(response);

                    // Thay đổi URL mà không làm tải lại trang
                    history.pushState(null, null, url);

                    // Cập nhật nội dung của trang
                    document.open();
                    document.write(response);
                    document.close();
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu cần)
                    console.error(error);
                }
            });
        });

        // Bắt sự kiện popstate để xử lý khi người dùng điều hướng qua lịch sử trình duyệt
        $(window).on('popstate', function() {
            // Load lại nội dung hoặc thực hiện các hành động cần thiết khi người dùng quay lại từ lịch sử trình duyệt
            // Ví dụ: load lại nội dung tương ứng với URL hiện tại
        });
    });
</script>
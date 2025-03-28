<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chi tiết</title>
    <link rel="stylesheet" href="../../css/styleKiet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php

    ?>
    <div class="nen-den"></div>
    <div class="container">
        <?php include "../../View/layout/header-showproduct.php" ?>
        <div class="container-body">
            <a class="back" href="/WEB2/index.php?controller=trang-chu&action=showproduct&category=<?php echo (isset($_REQUEST['category'])) ? $_REQUEST['category'] : 1 ?>">
                Quay lại
            </a>
            <h1 class="title-tour">
                <?php echo $rowTour['title'] ?>
            </h1>
            <div class="review-box">
                <div class="rate-box">
                    <div class="star-tour">
                        <?php echo $rowTour['star_feedback'] ?> <img src="../../images/star.webp" width="14" alt="">
                    </div>
                    <div class="count-cmt">
                        (1k+ đánh giá)
                    </div>
                    <div class="count-book">
                        <?php echo $rowTour['num_bought'] ?> đã được đặt
                    </div>
                </div>
                <div class="love-btn">
                    <img src="../../images/heart.png" width="16" alt="">
                    Yêu thích
                </div>
            </div>
            <?php $result = $db->GetImgProduct($idTour);
            $numImg = mysqli_num_rows($result);
            $srcArray = array();

            // Lặp qua từng dòng dữ liệu và lưu trữ src vào mảng
            for ($i = 0; $i < $numImg; $i++) {
                $row = mysqli_fetch_array($result);
                $imageData = $row['image']; // Giả sử cột chứa dữ liệu hình ảnh là 'image'
                $srcArray[$i] = 'data:image/jpeg;base64,' . base64_encode($imageData);
            }
            for ($i = 2; $i > $numImg - 1; $i--) {
                $srcArray[$i] = "../../images/no_image.gif";
            }
            ?>
            <div class="container-img">
                <div class="big-image">
                    <img src='<?php echo $srcArray[0] ?>' alt="Big Image">
                </div>
                <div class="small-images">
                    <div class="small-image">
                        <img src='<?php echo $srcArray[1] ?>' height="234" alt="Small Image 1">
                    </div>
                    <div class="small-image">
                        <img src='<?php echo $srcArray[2] ?>' height="234" alt="Small Image 2">
                    </div>
                </div>
            </div>
            <div class="tags">
                <div class="tag">Klook chọn lọc</div>
                <div class="tag">Giảm 10%</div>
                <div class="tag">Chính sách đảm bảo về giá</div>
            </div>
            <div class="box-short-content">
                <ul>
                    <li>Chuyến phiêu lưu trong ngày đến di tích lịch sử Địa Đạo Củ Chi và đồng bằng sông Cửu Long từ thành phố Hồ Chí Minh</li>
                    <li>Khám phá thế giới ngầm dưới lòng đất với mạng lưới đường hầm phức tạp của Việt Nam tại huyện Củ Chi</li>
                </ul>
                <!-- <a href="" class="xem-them">Xem thêm</a> -->
                <div class="tam-tinh">
                    <div class="money-tamtinh" id="<?php echo $rowTour['price']; ?>">
                        <?php
                        // if (mysqli_num_rows($listTicket0) > 0) {
                        //     $maxPrice = 0;
                        //     // Duyệt qua từng dòng dữ liệu
                        //     while ($row = mysqli_fetch_assoc($listTicket0)) {
                        //         if ($maxPrice < $row['price']) $maxPrice = $row['price'];
                        //     }
                        // }
                        // // $price = $rowTour['price'];
                        // $formatted_price = number_format($maxPrice, 0, '.', ',');
                        echo "Giá từ: " . number_format($rowTour['price'], 0, '.', ',') . " đ";
                        ?>
                    </div>
                    <div class="btn-chosse-dichvu">Chọn các gói dịch vụ</div>
                    <?php
                    $address = $rowTour["address"];

                    // Tạo URL của Google Map
                    $google_map_url = "https://www.google.com/maps/embed/v1/place?q=" . urlencode($address) . "&key=AIzaSyBT0zArw_eDN1rklr3lPrNFObbFOPSWjUk";

                    // Hiển thị iframe Google Map
                    echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d85041.64026301184!2d107.77957549740518!3d20.97131910388879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314b740755b39e17%3A0x2a986b2520bf63dd!2zSOG6o2kgxJDEg25nIEPDtCBUw7Q!5e0!3m2!1svi!2s!4v1714138236422!5m2!1svi!2s" width="260" height="200" style="border:0; margin-top: 30px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    ?>
                </div>
            </div>
            <div class="package-option">
                <div class="section-header">
                    <h2 class="section-title"> Các gói dịch vụ</h2>
                </div>
                <!-- form nè -->
                <div class="box-option">
                    <h3 class="title-box-option">Vui lòng chọn ngày & gói dịch vụ</h3>
                    <div class="option-item">
                        <p class="label-option">Xin chọn ngày đi tour có sẵn</p>
                        <div class="contain_selectDate">
                            <div class="maxTicket" style="display:none;">0</div>
                            <?php
                            $currentDateTimestamp = strtotime(date('Y-m-d'));
                            if (mysqli_num_rows($listTicket) > 0) {
                                // Duyệt qua từng dòng dữ liệu
                                while ($row = mysqli_fetch_assoc($listTicket)) {
                                    $dateStartTimestamp = strtotime($row['dateStart']);
                                    if($row['status']==1 && ($dateStartTimestamp >= $currentDateTimestamp)){
                                        echo "<div class='wrapper'>";
                                        echo "<div data-idTicket=" . $row['id'] . " id=" . $rowTour['price'] . " class='select-date'>" . $row['dateStart'] . "</div>";
                                        echo "<div class='numTicket' id=" . $row['numTicketAvailable'] . "> Còn " . $row['numTicketAvailable'] . " vé</div>";
                                        echo "</div>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <span class="validation">Không được chọn ngày đã qua</span>
                    </div>
                    <div class="option-item">
                        <div class="discount">
                            <div class="percentVou" id="0" style="display: none;">Giảm giá</div>
                            <div class="label-discount">Giảm giá</div>
                            <p class="content-discount">Xem voucher có sẵn</p>
                        </div>
                        <div class="vouchers">

                            <?php
                            $checkHasVou = 0;
                            while ($rowVC = mysqli_fetch_array($resultVoucher)) {
                                $idVoucher = $rowVC['id_discount'];
                                $rowVoucherKq = $db->execute("select * from discount where id = $idVoucher");
                                while ($rowVou = mysqli_fetch_array($rowVoucherKq)) {
                                    $checkHasVou++;
                                    $nameVou = $rowVou['code'];
                                    $detailVou = $rowVou['discount_name'];
                                    $percent = $rowVou['percent'];
                                    $dateStart = new DateTime(); // Chuyển đổi sang đối tượng DateTime
                                    $dateEnd = new DateTime($rowVou['date_end']);
                                    if ($dateStart >= $dateEnd) {
                                        $numDayVou = 0; // Trả về 0 nếu ngày hôm nay lớn hơn hoặc bằng ngày kết thúc
                                    } else {
                                        $interval = $dateStart->diff($dateEnd); // Tính khoảng cách giữa hai ngày
                                        // Lấy số ngày từ kết quả
                                        $numDayVou = $interval->days;
                                    }
                                    echo '<div class="discount-card">';
                                    echo '<div class="infor-card">';
                                    echo '<div class="infor-card-main">';
                                    echo '<div class="title-infor-card">' . $detailVou . '</div>';
                                    echo '<div id="idVoucher" style="display: none;">' . $rowVou['id'] . '</div>';
                                    echo '<div class="detail-infor-card">Giảm ' . $percent . '%</div>';
                                    echo '<div class="hansudung">Hạn sử dụng : ' . $dateEnd->format('Y-m-d') . '</div>';
                                    echo '<div class="hansudung">Còn lại ' . $numDayVou . ' ngày</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="cac-hinh-tron">';
                                    for ($i = 0; $i < 5; $i++) {
                                        echo '<div class="hinhtron"></div>';
                                    }
                                    echo '</div>';
                                    echo '<div class="use-card">';
                                    echo '<div class="title-use-card">Mã ưu đãi</div>';
                                    echo '<div class="code-use-card">' . $nameVou . '</div>';
                                    echo '<div class="percentDIV" style="display: none;" >Giảm ' . $percent . '%</div>';
                                    echo '<button class="btn-use-card" id=' . $numDayVou . '>Sử dụng</button>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            if ($checkHasVou == 0) echo "<div style='display:flex; align-item: center; justify-content: center;'>Bạn không có voucher nào.</div>";
                            ?>
                        </div>
                    </div>
                    <div class="option-item">
                        <p class="label-option">Số lượng</p>
                        <div class="box-numTicket">
                            <div class="btn-numTicket" id="btn-minus">-</div>
                            <div id="numTicket">0</div>
                            <div class="btn-numTicket" id="btn-plus">+</div>
                        </div>
                        <span class="validation">Vui lòng chọn ít nhất 1 vé</span>
                    </div>
                    <div class="option-item">
                        <div class="container-total-money">
                            <div class="lable-totalMoney">Tổng cộng:</div>
                            <div id="totalMoney">
                                0
                            </div>
                        </div>
                        <div class="giamgia">
                            <div class="container-total-money">
                                <div class="lable-giamgia">Giảm:</div>
                                <div id="discountAmount"></div>
                            </div>
                            <div class="container-total-money">
                                <div class="lable-totalMoney">Giá cuối:</div>
                                <div id="newPrice"></div>
                            </div>
                        </div>
                        <div class="container-submit-option">
                            <form action="buyTour.php" name="formAddCart" id="submitAddcart">
                                <input type="hidden" name="controller" value="chi-tiet-tour">
                                <input type="hidden" name="action" value="add-cart">
                                <input type="hidden" name="id" value='<?php echo $idTour; ?>'>
                                <input type="hidden" name="add-cart" value="1">
                                <input type="hidden" name="numTicketphp" value="0">
                                <input type="hidden" name="idTicketCart" value="0">
                                <button type="button" class="add-cart btn-submit-option">Thêm vào giỏ hàng</button>
                            </form>
                            <div id="dot"></div>

                            <input type="submit" class="buy-now btn-submit-option" value="Mua ngay">
                        </div>
                    </div>
                </div>
                <form action="buyTour.php" method="get" id="form-book-tour">
                    <?php
                    $rowUser = $db->getDataId('nguoidung', $idUser);
                    ?>
                    <input type="hidden" name="numTicketphp" value="0">
                    <input type="hidden" name="controller" value="chi-tiet-tour">
                    <input type="hidden" name="action" value="book-tour">
                    <input type="hidden" name="datePhp" value="0">
                    <input type="hidden" name="priceTourNe" value="0">
                    <input type="hidden" name="idVoucher" value="0">
                    <input type="hidden" name="idTicket" value="0">
                    <input type="hidden" name="totalMoneyphp" value="0">
                    <input type="hidden" name="id" value='<?php echo $idTour; ?>'>
                    <h2>Vui lòng điền thông tin</h1>
                        <div class="container-field">
                            <label for="">Họ tên</label> </br>
                            <input type="text" class="inputField-tourForm hoTen" name="hoTen" value='<?php echo $rowUser['fullname'] ?>'>
                            <span class="validation">Họ tên không hợp lệ</span>
                        </div>
                        <div class="container-field">
                            <label for="">Email</label> </br>
                            <input type="text" class="inputField-tourForm email" name="email" value='<?php echo $rowUser['email'] ?>'>
                            <span class="validation">Email không hợp lệ</span>
                        </div>
                        <div class="container-field">
                            <label for="">Số điện thoại</label> </br>
                            <input type="text" class="inputField-tourForm sodienthoai" name="sodienthoai" value='<?php echo $rowUser['phone_number'] ?>'>
                            <span class="validation">Số điện thoại không hợp lệ</span>
                        </div>
                        <div class="container-field">
                            <label for="">Địa chỉ</label> </br>
                            <input type="text" class="inputField-tourForm diachi" name="diachi" value='<?php echo $rowUser['address'] ?>'>
                            <span class="validation">Địa chỉ không được rỗng</span>
                        </div>
                        <div class="container-field">
                            <label for="">Ghi chú</label> </br>
                            <input type="text" class="inputField-tourForm note-book-tour" name="note-book-tour"></br>
                            <input type="submit" name="buy-now" class="buy-now btn-submit-option" value="Mua ngay">
                        </div>
                </form>
            </div>
            <div class="container-content">
                <div class="section-header">
                    <h2 class="section-title"> Về dịch vụ này</h2>
                </div>
                <div class="content-tour">
                    <p class="text-content-tour">
                        <?php echo $rowTour['content'] ?>
                    </p>
                    <div class="container-img-content">
                        <img src='<?php echo $srcArray[0] ?>' width="848" alt="" class="img-tour">
                        <p class="detail-img">Thoát khỏi sự hối hả và nhộn nhịp của đô thị và tham gia một tour lịch sử đến khu di tích Địa Đạo Củ Chi và đồng bằng sông Cửu Long</p>
                    </div>
                    <div class="container-img-content">
                        <img src='<?php echo $srcArray[1] ?>' width="848" alt="" class="img-tour">
                        <p class="detail-img">Thoát khỏi sự hối hả và nhộn nhịp của đô thị và tham gia một tour lịch sử đến khu di tích Địa Đạo Củ Chi và đồng bằng sông Cửu Long</p>
                    </div>
                    <div class="container-img-content">
                        <img src='<?php echo $srcArray[2] ?>' width="848" alt="" class="img-tour">
                        <p class="detail-img">Thoát khỏi sự hối hả và nhộn nhịp của đô thị và tham gia một tour lịch sử đến khu di tích Địa Đạo Củ Chi và đồng bằng sông Cửu Long</p>
                    </div>
                </div>
            </div>
            <div class="container-comment">
                <div class="section-header">
                    <h2 class="section-title"> Đánh giá</h2>
                </div>
                <div class="star-tour-cmt">
                    <div id="rating-stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>
                <form action="buyTour.php" method="get">
                    <input type="hidden" name="controller" value="chi-tiet-tour">
                    <input type="hidden" name="action" value="send-cmt">
                    <input type="hidden" name="id" value='<?php echo $idTour; ?>'>
                    <textarea class="text-cmt" name="text-cmt" rows="4" cols="92" placeholder="Viết bình luận..."></textarea>
                    <input type="hidden" id="rating-value" name="rating" value="0">
                    <input type="submit" name="send-cmt" value="Gửi" class="btn-sendCmt">
                </form>
                <?php
                while ($rowCmt = mysqli_fetch_array($result2)) {
                    // lấy tên người đăng
                    $idUserCMT = $rowCmt['user_id'];
                    $numstar = $rowCmt['num_star'];
                    $result3 = $db->execute("SELECT * FROM nguoidung WHERE id = $idUserCMT");
                    while ($rowUser = mysqli_fetch_array($result3)) $nameUser = $rowUser['fullname'];
                    // lấy ngày
                    $date_create = strtotime($rowCmt['create_at']);
                    $current_time = time();
                    $time_diff = $current_time - $date_create;

                    // Chuyển đổi khoảng thời gian thành "x đơn vị trước"
                    if ($time_diff < 60) {
                        $time_ago = 'vài giây trước';
                    } elseif ($time_diff < 3600) {
                        $time_ago = floor($time_diff / 60) . ' phút trước';
                    } elseif ($time_diff < 86400) {
                        $time_ago = floor($time_diff / 3600) . ' giờ trước';
                    } else {
                        $time_ago = floor($time_diff / 86400) . ' ngày trước';
                    }
                ?>
                    <div class="comment-data">
                        <div class="header-cmt">
                            <img src="../../images/avatar.png" width="43" alt="" class="avatar-cmt">
                            <div class="container-name-date-cmt">
                                <div class="name-cmt"><?php echo $nameUser; ?></div>
                                <div class="box-star-cmt">
                                    <div id="rating-stars">
                                        <?php
                                        for ($i = 0; $i < $numstar; $i++) {
                                            echo "<span class=\"starMini selected\">&#9733;</span>";
                                        }
                                        for ($i = 0; $i < 5 - $numstar; $i++) {
                                            echo "<span class=\"starMini\">&#9733;</span>";
                                        } ?>
                                    </div>
                                    <div class="date-cmt"><?php echo $time_ago; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="content-cmt">
                            <?php echo $rowCmt['note'] ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <script src="../../js/indexKiet.js"></script> -->
    <?php include("../../js/indexKiet.php") ?>
</body>

</html>
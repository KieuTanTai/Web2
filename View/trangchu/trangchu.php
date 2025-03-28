<link rel="stylesheet" href="css/csslamresponsive.css">

<body>
    <?php
    require_once("View/layout/header.php");
    require_once('includes/handle_mail.php');
    ?>


    <header class="header display-none-mobile">
        <div class="header-inner">
            <div class="slider">
                <img src="css/icons/header-01.webp" alt="" class="slide" />
                <img src="css/icons/header-02.webp" alt="" class="slide" />
            </div>
            <div class="header-info">
                <h1 class="header-heading">THẾ GIỚI TRỌN NIỀM VUI</h1>
                <p class="header-desc">
                    Khám phá niềm vui của bạn mọi lúc mọi nơi - từ những
                    chuyến du lịch ngẫu hứng tới những cuộc phiêu lưu khắp
                    thế giới
                </p>
                <div class="header-find">
                    <img src="css/icons/find-magnifier-search-zoom-look-svgrepo-com.svg" alt="" class="find-icon" />
                    <input type="text" class="find-input" placeholder="Thành phố HCM - Tour" />
                    <button class="find-btn">Khám phá</button>
                </div>
            </div>
        </div>
    </header>

    <div class="attractive-offer">
        <div class="container">
            <h3 class="attractive-offer--heading">Ưu đãi hấp dẫn</h3>
            <div class="attractive-offer--inner">
                <ul class="attractive-offer--list">
                    <li class="attractive-offer--item">
                        <img src="css/icons/banner-01.png" alt="">
                        <button class="attractive-offer--btn">Xem thêm</button>
                    </li>
                    <li class="attractive-offer--item">
                        <img src="css/icons/banner-02.png" alt="">
                        <button class="attractive-offer--btn">Xem thêm</button>
                    </li>
                    <li class="attractive-offer--item">
                        <img src="css/icons/banner-03.png" alt="">
                        <button class="attractive-offer--btn">Xem thêm</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="highlighted-activities">
        <div class="container">
            <h3 class="highlighted-activities--heading">Các hoạt động nổi bật</h3>
            <div class="highlighted-activities--inner">
                <div class="highlighted-activities--list">
                    <?php $count = 0; ?>
                    <?php foreach ($dataHotProduct as $product) : ?>
                        <?php if ($count < 4) :
                            $result = $db->GetImgProduct($product['id']);
                            $row = mysqli_fetch_array($result);
                            $numImg = mysqli_num_rows($result);
                            if ($numImg > 0) {
                                $imageData = $row['image'];
                                $url = 'data:image/jpeg;base64,' . base64_encode($imageData);
                            } else $url = "images/no_image.gif"; ?>
                            <div class="highlighted-activities--item">
                                <img src="<?php echo $url ?>" alt="<?php echo $product['title']; ?>" class="highlighted-activities--img">
                                <div class="highlighted-activities--info">
                                    <p class="highlighted-activities--desc"><?php echo $product['content']; ?></p>
                                    <p class="highlighted-activities--title"><?php echo $product['title']; ?></p>
                                    <p class="highlighted-activities--price">Từ <?php echo number_format($product['price'], 0, ',', '.') . "đ"; ?></p>
                                </div>
                            </div>
                            <?php $count++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="product-list--hot">
        <div class="container">
            <h3 class="product-list--hot--heading">Hot nhất tại Klook</h3>
            <div class="product-list--hot__inner">
                <div class="list--hot">
                    <div class="product-hot-item">
                        <h3 class="product-hot-item--heading">Hoạt Động Du Lịch Việt Nam Bán Chạy</h3>
                        <div class="sub-hot-list">
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/dalat.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">vé cáp treo Sun World Bân Hill Đà nẵng</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/bigimg.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">du lịch Cô Tô rất hấp dẫn khách hàng n</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/danang.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">chuyến đi Đà Nẵng đáng nhớ nhất nè b</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-hot-item">
                        <h3 class="product-hot-item--heading">Hoạt Động Du Lịch Việt Nam Bán Chạy</h3>
                        <div class="sub-hot-list">
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/haiduong2.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">chuyến đi Đà Nẵng đáng nhớ nhất nè b.</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/nhatrang2.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">vé cáp treo Sun World BanaHill Đà nẵng</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/dalat.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">hãy đi Quy Nhơn đi nhé mọi người hi hi</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-hot-item">
                        <h3 class="product-hot-item--heading">Hoạt Động Du Lịch Việt Nam Bán Chạy</h3>
                        <div class="sub-hot-list">
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/bigimg.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">hãy đi Quy Nhơn đi nhé mọi người hi hi</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/danang.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">chuyến đi Đà Nẵng đáng nhớ nhất nè b</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                            <div class="sub-hot-item">
                                <img src="/WEB2/images/dalat.webp" alt="" class="sub-hot-item--img">
                                <div class="sub-hot-item--info">
                                    <h4 class="sub-hot-item--heading">vé cáp treo Sun World Bân Hill Đà nẵng</h4>
                                    <p class="sub-hot-item--desc">Đây là hoạt động đặc biệt...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="experience-for-all">
        <div class="container">
            <h3 class="experience-for-all--heading">Trải nghiệm cho mọi người</h3>
            <div class="experience-for-all--inner">
                <div class="experience-for-all--list">
                    <div class="experience-for-all--item">
                        <img src="css/icons/experience-forall-01.webp" alt="" class="experience-for-all--item__img">
                        <div class="experience-for-all--item__info">
                            <h4 class="experience-for-all--item__heading">Chốt Gấp Kèo Sing - Thái</h4>
                            <p class="experience-for-all--item__desc">Deal du lịch HOT nhất Singapore & Thái Lan</p>
                        </div>
                        <button class="experience-for-all--item__btn">Khám phá</button>
                    </div>
                    <div class="experience-for-all--item">
                        <img src="css/icons/experience-forall-02.webp" alt="" class="experience-for-all--item__img">
                        <div class="experience-for-all--item__info">
                            <h4 class="experience-for-all--item__heading">Càng Mua Càng Hời</h4>
                            <p class="experience-for-all--item__desc">Ưu đãi hấp dẫn. Càng mua nhiều - càng thêm lợi.</p>
                        </div>
                        <button class="experience-for-all--item__btn">Khám phá</button>
                    </div>
                    <div class="experience-for-all--item">
                        <img src="css/icons/experience-forall-03.webp" alt="" class="experience-for-all--item__img">
                        <div class="experience-for-all--item__info">
                            <h4 class="experience-for-all--item__heading">Zone Châu Âu - Hoa Kỳ</h4>
                            <p class="experience-for-all--item__desc">Gợi ý du lịch hàng đầu Châu Âu và Hoa Kỳ.</p>
                        </div>
                        <button class="experience-for-all--item__btn">Khám phá</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="go-where">
        <div class="container">
            <h3 class="go-where--heading">Bạn muốn đi đâu chơi?</h3>
            <div class="go-where--inner">
                <div class="go-where--list">
                    <div class="go-where--item">
                        <img src="css/icons/go-where=01.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">TP Hồ Chí Minh</h4>
                    </div>
                    <div class="go-where--item">
                        <img src="css/icons/go-where=02.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">Đà Nẵng</h4>
                    </div>
                    <div class="go-where--item">
                        <img src="css/icons/go-where=03.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">Bangkok</h4>
                    </div>
                    <div class="go-where--item">
                        <img src="css/icons/go-where=04.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">Hà Nội</h4>
                    </div>
                    <div class="go-where--item">
                        <img src="css/icons/go-where=05.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">Hội An</h4>
                    </div>
                    <div class="go-where--item">
                        <img src="css/icons/go-where=06.webp" alt="" class="go-where--item__img">
                        <h4 class="go-where--item__heading">Singapore</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="explorer-collection">
        <div class="container">
            <div class="explorer-collection--inner">
                <h3 class="explorer-collection--heading">Thêm nhiều khám phá thú vị</h3>
                <div class="explorer-collection--block">
                    <img src="css/icons/guimail-01.webp" alt="" class="img-decor-mail img-decor-mail-01 display-none-mobile">
                    <img src="css/icons/guimail-02.webp" alt="" class="img-decor-mail img-decor-mail-02 display-none-mobile">

                    <div class="explorer-collection--info">
                        <h4 class="explorer-collection--info__heading">Giảm 5% cho đơn hàng đầu tiên trên ứng dụng</h4>
                        <p class="explorer-collection--info__desc">Trải nghiệm tiện lợi với ứng dụng Klook. Sử dụng mã "BetterOnApp" để được giảm giá</p>
                        <form id="explorer-collection--send-email" class="explorer-collection--send-email">
                            <label for="email" class="explorer-collection--email-label">Nhận & gửi magic link đến email của bạn</label>
                            <div class="explorer-collection--place-input">
                                <input type="email" placeholder="Email" name="email" id="email" class="explorer-collection--input">
                                <button type="button" id="submitBtn" class="explorer-collection--btn">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page">
        <div class="container">
            <div class="blog-page--inner">
                <div class="blog-page--list">
                    <div class="blog-page--item">
                        <img src="css/icons/blog-page-01.png" alt="" class="blog-page--img">
                        <div class="blog-page--info">
                            <h4 class="blog-page--heading">Xem blog của Klook</h4>
                            <p class="blog-page--desc">Klook gợi ý cho bạn các xu hướng du lịch, lịch trình chi tiết và các mẹo hữu ích</p>
                            <button class="blog-page--btn">Xem ngay</button>
                        </div>
                    </div>
                    <div class="blog-page--item">
                        <img src="css/icons/blog-page-02.png" alt="" class="blog-page--img">
                        <div class="blog-page--info">
                            <h4 class="blog-page--heading">Tặng bạn mã ưu đãi</h4>
                            <p class="blog-page--desc">'BetterOnApp' giảm 5% cho đơn hàng đầu tiên trên ứng dụng</p>
                            <button class="blog-page--btn">Xem ngay</button>
                        </div>
                    </div>
                    <div class="blog-page--item">
                        <img src="css/icons/blog-page-03.png" alt="" class="blog-page--img">
                        <div class="blog-page--info">
                            <h4 class="blog-page--heading">Tiết kiệm hơn với credit</h4>
                            <p class="blog-page--desc">Klook gợi ý cho bạn các xu hướng du lịch</p>
                            <button class="blog-page--btn">Xem ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="why-choose-klook">
        <div class="container">
            <h3 class="why-choose-klook--heading">Vì sao bạn nên chọn Klook
                <div class="why-choose-klook--inner">
            </h3>
            <ul class="why-choose-klook--list">
                <li class="why-choose-klook--item">
                    <img src="css/icons/why-choose-01.webp" alt="" class="why-choose-klook--img">
                    <div class="why-choose-klook--info">
                        <h4 class="why-choose-klook--title">Vô vàn lựa chọn</h4>
                        <p class="why-choose-klook--desc">Tìm kiếm niềm vui với gần nửa triệu điểm tham quan, phòng khách sạn và nhiều trải nghiệm thú vị</p>
                    </div>
                </li>
                <li class="why-choose-klook--item">
                    <img src="css/icons/why-choose-02.webp" alt="" class="why-choose-klook--img">
                    <div class="why-choose-klook--info">
                        <h4 class="why-choose-klook--title">Chơi vui, giá tốt</h4>
                        <p class="why-choose-klook--desc">Trải nghiệm chất lượng với giá tốt. Tích luỹ Klook credit để được thêm ưu đãi</p>
                    </div>
                </li>
                <li class="why-choose-klook--item">
                    <img src="css/icons/why-choose-03.webp" alt="" class="why-choose-klook--img">
                    <div class="why-choose-klook--info">
                        <h4 class="why-choose-klook--title">Dễ dàng và tiện lợi</h4>
                        <p class="why-choose-klook--desc">Đặt vé xác nhận ngay, miễn xếp hàng, miễn phí hủy, tiện lợi cho bạn tha hồ khám phá</p>
                    </div>
                </li>
                <li class="why-choose-klook--item">
                    <img src="css/icons/why-choose-04.webp" alt="" class="why-choose-klook--img">
                    <div class="why-choose-klook--info">
                        <h4 class="why-choose-klook--title">Đáng tin cậy</h4>
                        <p class="why-choose-klook--desc">Tham khảo đánh giá chân thực. Dịch vụ hỗ trợ tận tình, đồng hành cùng bạn mọi lúc, mọi nơi</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php
    require_once("View/layout/footer.php");
    ?>

</body>
<script src="js/animate.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submitBtn').on('click', function() {
            var email = $('#email').val();
            if (email.trim() !== '') {
                // Hiển thị hiệu ứng "đang tải"
                $('.explorer-collection--btn').html('Đang gửi...');
                // Vô hiệu hóa nút gửi
                $('#submitBtn').prop('disabled', true);

                // Gửi yêu cầu AJAX
                $.ajax({
                    type: 'POST',
                    url: 'includes/handle_mail.php',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        // Ẩn hiệu ứng "đang tải"
                        $('.explorer-collection--btn').html('Gửi');
                        // Kích hoạt lại nút gửi
                        $('#submitBtn').prop('disabled', false);
                        alert("Gửi thành công");
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Ẩn hiệu ứng "đang tải"
                        $('.explorer-collection--btn').html('Gửi');
                        // Kích hoạt lại nút gửi
                        $('#submitBtn').prop('disabled', false);
                        alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
                    }
                });
            } else {
                alert('Vui lòng nhập địa chỉ email.');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const prevButton = document.getElementById("prevButton");
        const nextButton = document.getElementById("nextButton");
        const list = document.querySelector(".highlighted-activities--list");
        const items = document.querySelectorAll(".highlighted-activities--item");
        const itemCount = items.length;
        const visibleItems = 4;
        let currentIndex = 0;

        function moveList(direction) {
            const itemWidth = items[0].offsetWidth + 15; // Lấy kích thước của mỗi phần tử
            const listWidth = itemCount * itemWidth; // Tính kích thước tổng của danh sách
            const containerWidth = list.parentElement.offsetWidth; // Lấy kích thước của phần tử chứa danh sách
            const maxIndex = Math.ceil((listWidth - containerWidth) / itemWidth); // Tính chỉ số tối đa có thể di chuyển đến

            if (direction === 'prev') {
                currentIndex = Math.max(currentIndex - visibleItems, 0); // Di chuyển sang trái
            } else {
                currentIndex = Math.min(currentIndex + visibleItems, maxIndex); // Di chuyển sang phải
            }

            list.style.transform = `translateX(-${currentIndex * itemWidth}px)`; // Di chuyển danh sách
        }

        prevButton.addEventListener("click", function() {
            moveList('prev');
        });

        nextButton.addEventListener("click", function() {
            moveList('next');
        });
    });
</script>

</html>
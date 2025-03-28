<main class="main">
    <div class="filter-row" id="filter-row-anchor-for-pagination">
        <div class="container">
            <div class="filter-left hidden_tablet_mobile">
                <div class="all-category category ">
                    <span>Tất cả danh mục</span>
                    <!-- <img src="../View/icon/icon-list-bottom.svg" alt="" class="icon-list-bottom" /> -->
                    <svg class="icon-list-bottom" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.3 0L0 1.36364L6.5 9L13 1.36364L11.7 0L6.5 6L1.3 0Z" fill="#212121" />
                    </svg>

                </div>
                <div class="list-category">
                    <?php foreach ($listCategory as $item) : ?>
                        <div class="category category-<?= $item['id'] ?> category-out-form checked" data-value="<?= $item['id'] ?>">
                            <a href="#">
                                <?= $item['name_category'] ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="display-selected">
                    <?php
                    if (isset($_GET['category'])) {
                        $category = $_GET['category'];
                        foreach ($listCategory as $item) :
                            if ($item['id'] == $category) : ?>
                                <div class="category category-<?= $item['id'] ?> category-out-form checked" data-value="<?= $item['id'] ?>">
                                    <a href="#">
                                        <?= $item['name_category'] ?>
                                    </a>
                                </div>
                    <?php
                                break; // Dừng vòng lặp sau khi đã tìm thấy danh mục
                            endif;
                        endforeach;
                    }
                    ?>

                </div>
                <div class="optionCategory-get-from-url" data-value-from-url="<?= $_GET['category'] ?>"></div>

            </div>
            <div class="separete-center hidden_tablet_mobile"></div>
            <div class="filter-right">
                <div class="filter-date-price-group hidden_tablet_mobile">

                    <div class="all-category category filter-price">
                        <span>Lọc theo giá</span>
                        <svg class="icon-list-bottom" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.3 0L0 1.36364L6.5 9L13 1.36364L11.7 0L6.5 6L1.3 0Z" fill="#212121" />
                        </svg>

                    </div>
                    <div class="wrapper">
                        <div class="price-input">
                            <div class="field">
                                <span>Min</span>
                                <input type="number price-min-out-form" class="input-min" value="0" id="price-min-out-form">
                            </div>
                            <div class="separator">-</div>
                            <div class="field">
                                <span>Max</span>
                                <input type="number price-max-out-form" class="input-max" value="5000000" id="price-max-out-form">
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <form class="range-input" method="get" action="">
                            <input type="range" class="range-min" min="0" max="5000000" value="0" step="100000" name="price-min">
                            <input type="range" class="range-max" min="0" max="5000000" value="5000000" step="100000" name="price-max">
                            <!-- <input type="submit" hidden> -->
                            <div class="row">
                                <span class="btn-clear" onclick="deleteFormValuesOutForm()">Xoá</span>
                                <button class="btn-show-result btn-show-result-out-form" type="button">Xem kết
                                    quả</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="filter-all">
                    <img src="View/icon/Filter.svg" alt="" class="icon-filter" />
                    <span>Lọc</span>
                </div>
                <form class="filter-advance" method="get">
                    <div class="icon-kill">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none">
                            <path d="M10 10L38 38" stroke="#ffffff" stroke-width="3.6" stroke-linecap="round"></path>
                            <path d="M38 10L10 38" stroke="#ffffff" stroke-width="3.6" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <div class="filter-header">
                        <div class="title">Lọc</div>
                    </div>
                    <div class="filter-body">
                        <div class="filter-content">
                            <div class="filter-content-wrapper">
                                <div class="filter-content-item">
                                    <h3 class="title">Tên sản phẩm</h3>
                                    <div class="item item-position-relative">
                                        <!-- <div class="quick-item">
                                            <div class="category">Hôm nay</div>
                                            <div class="category">Ngày mai</div>
                                            <div class="category">Ngày khác</div>
                                        </div>
                                        <div class="select-date"></div> -->
                                        <div class="icon">
                                            <img src="View/icon/search-icon.svg" alt="" srcset="" />
                                        </div>
                                        <input type="text" placeholder="Nhập tên tour" class="search-input" name="keyword" id="keyword-inform" />
                                    </div>
                                </div>
                                <div class="filter-content-item">
                                    <h3 class="title">Lọc theo giá</h3>
                                    <div class="wrapper-filter-all">
                                        <div class="price-input-all">
                                            <div class="field-all">
                                                <span>Min</span>
                                                <input type="number" class="input-min-all" value="0" id="price-min">
                                            </div>
                                            <div class="separator-all hidden_tablet_mobile">-</div>
                                            <div class="field-all">
                                                <span>Max</span>
                                                <input type="number" class="input-max-all" value="5000000" id="price-max">
                                            </div>
                                        </div>
                                        <div class="slider-all">
                                            <div class="progress-all"></div>
                                        </div>
                                        <div class="range-input-all">
                                            <input type="range" class="range-min-all" min="0" max="5000000" value="0" step="100000" name="price-min">
                                            <input type="range" class="range-max-all" min="0" max="5000000" value="5000000" step="100000" name="price-max">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-content-item">
                                    <h3 class="title">Danh mục</h3>
                                    <div class="item">
                                        <div class="quick-item content-wrap">
                                            <?php foreach ($listCategory as $item) : ?>
                                                <div class="category category-<?= $item['id'] ?> category-advance" data-value="<?= $item['id'] ?>">
                                                    <a href="#">
                                                        <?= $item['name_category'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="filter-content-item">
                                    <h3 class="title">Thời lượng</h3>
                                    <div class="item">
                                        <div class="quick-item">
                                            <div class="category">0-3 tiếng</div>
                                            <div class="category">3-5 tiếng</div>
                                            <div class="category">5-7 tiếng</div>
                                            <div class="category">1 ngày</div>
                                            <div class="category">2 ngày trở lên</div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="filter-content-item">
                                    <h3 class="title">Giờ khởi hành</h3>
                                    <div class="item">
                                        <div class="quick-item content-wrap">
                                            <div class="category">Sáng sớm (05:00 - 09:00)</div>
                                            <div class="category">Sáng (09:00 - 12:00)</div>
                                            <div class="category">Chiều (12:00 - 16:00)</div>
                                            <div class="category">Đêm (20:00 - 00:00)</div>
                                            <div class="category">Đêm muộn & rạng sáng (00:00 - 05:00)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-content-item">
                                    <h3 class="title">Ngôn ngữ hướng dẫn</h3>
                                    <div class="item">
                                        <div class="quick-item">
                                            <div class="category">Tiếng Việt</div>
                                            <div class="category">Tiếng Anh</div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="filter-footer">
                        <span class="btn-clear" onclick="deleteFormValues()">Xoá</span>
                        <button class="btn-show-result" type="submit">Xem kết quả</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="quantity-sort">
        <div class="container">
            <div class="quantity">

            </div>
            <div class="sort">
                <span class="hidden_tablet_mobile">Sắp xếp theo</span>
                <!-- <div class="list-item">
                        <span>KLook giới thiệu</span>
                        <img src="../View/icon/icon-list-bottom.svg" alt="" />
                    </div> -->
                <img src="View/icon/icon-list-bottom.svg" alt="" />
                <div class="hide-arrow-default"></div>
                <form id="sortForm" class="form" method="get">
                    <select class="list-item" name="sort" id="sortOption">
                        <option value="1" <?= (isset($sortOption) && $sortOption == 1) ? 'selected' : '' ?>>Klook giới
                            thiệu</option>
                        <option value="2" <?= (isset($sortOption) && $sortOption == 2) ? 'selected' : '' ?>>Bán chạy
                        </option>
                        <option value="3" <?= (isset($sortOption) && $sortOption == 3) ? 'selected' : '' ?>>Đánh giá
                            cao
                            nhất</option>
                        <option value="4" <?= (isset($sortOption) && $sortOption == 4) ? 'selected' : '' ?>>Giá (từ
                            thấp
                            đến cao)</option>
                        <option value="5" <?= (isset($sortOption) && $sortOption == 5) ? 'selected' : '' ?>>Giá (từ cao
                            đến thấp)</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="list-product">
        <div class="container">
            <?php foreach ($result as $item) : ?>
                <!-- <a class="card" href="index.php?controller=chi-tiet-tour&action=xem-tour">
                    <img src="View/image/tourCheoThuyen.webp" alt="" class="img-product" />
                    <h2 class="name-product">
                        <?= $item['title'] ?>
                    </h2>
                    <div class="row-star">
                        <img src="View/icon/Star.svg" alt="" class="icon-star" />
                        <span>(
                            <?= $item['star_feedback'] ?>)
                        </span>
                        <div class="dot"></div>
                        <span>
                            <?= $item['num_bought'] ?> đã được đặt
                        </span>
                    </div>
                    <div class="row-toggle">
                        <div class="toggle">
                            <span>Bán chạy</span>
                        </div>
                        <div class="toggle">
                            <span>Xác nhận tức thời</span>
                        </div>
                    </div>
                    <div class="row-price">
                        <span class="price">
                            <?= number_format($item['price'], 0, ',', '.') ?>đ
                        </span>
                        <span class="discount">giảm 42.000đ</span>
                    </div>
                    <div class="row-toggle">
                        <div class="toggle">
                            <span>Chính sách đảm bảo về giá</span>
                        </div>
                    </div>
                </a> -->
            <?php endforeach ?>
            <div id="total-pages" data-total="<?= $totalPages != 0 ? $totalPages : 0 ?>"></div>
            <div id="total-products" data-total="<?php echo $countProduct; ?>"></div>
        </div>

    </div>
    <div class="page-navigation">
        <ul class="pagination">
            <a href="#filter-row-anchor-for-pagination">

                <li id="prevPage">
                    <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 1L1 8.5L10 16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
            </a>

            <a href="#filter-row-anchor-for-pagination">

                <li id="nextPage">
                    <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L10 8.5L1 16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
            </a>


        </ul>

    </div>
    <div class="info-path">
        <div class="container">
            <p><a href="http://localhost/WEB2/" style="color: #333; text-decoration: none;">Trang chủ ></a> <span class="support-info"> Tour trải nghiệm</span></p>
        </div>
    </div>
    <div class="question">
        <div class="container">
            <h2>Câu hỏi thường gặp về địa điểm phổ biến</h2>
            <div class="list-question">
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">Klook có bao nhiêu Tour & Trải nghiệm?</h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Klook có 13095 Tour & Trải nghiệm tại các địa điểm nổi tiếng
                        </div>
                    </div>
                </div>
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">Klook có bao nhiêu Tour & Trải nghiệm?</h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Top Tour & Trải nghiệm tại các địa điểm nổi tiếng là:
                            1.
                            2.
                            3.
                        </div>
                    </div>
                </div>
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">
                                Những Tour & Trải nghiệm phổ biến nhất là gì?
                            </h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Tour & Trải nghiệm được đánh giá cao tại các địa điểm nổi tiếng là:<br>
                            1.<br>
                            2.<br>
                            3.<br>
                        </div>
                    </div>
                </div>
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">
                                Những Tour & Trải nghiệm được đánh giá cao là gì?
                            </h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Tour & Trải nghiệm có giá hợp lý tại các địa điểm nổi tiếng là:<br>
                            1.<br>
                            2.<br>
                            3.<br>
                        </div>
                    </div>
                </div>
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">
                                Những Tour & Trải nghiệm được đánh giá cao là gì?
                            </h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Tour & Trải nghiệm được đánh giá cao tại các địa điểm nổi tiếng là:<br>
                            1.<br>
                            2.<br>
                            3.<br>
                        </div>
                    </div>
                </div>
                <div class="one-question">
                    <div class="container-one-question">
                        <div class="top">
                            <h3 class="title">Có Tour & Trải nghiệm nào mới nhất?</h3>
                            <img src="View/icon/icon-list-bottom.svg" alt="" class="icon-dynamic" />
                        </div>
                        <div class="content">
                            Tour & Trải nghiệm mới nhất tại các địa điểm nổi tiếng là:<br>
                            1.<br>
                            2.<br>
                            3.<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
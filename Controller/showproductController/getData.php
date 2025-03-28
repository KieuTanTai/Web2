<?php
include "../../Model/DBConfig.php";
$db = new Database;
$db->connect();
if (isset($_POST['action'])) {
    if ($_POST['action'] == "getData") {
        $page = 1;
        $showProductPerPage = 12;
        $totalPages = 0;
        $sql = "SELECT * FROM product WHERE status = 1"; // Bắt đầu câu truy vấn với điều kiện luôn đúng
        if (isset($_POST['categories']) && !empty($_POST['categories'])) {
            // Chuyển mảng categories thành chuỗi ngăn cách bằng dấu ','
            $categories = implode(",", $_POST['categories']);
            // Thêm điều kiện vào câu truy vấn
            $sql .= " AND id_category IN ($categories)";
        }
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $sql .= " AND title LIKE '%$keyword%'";
        }
        if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
            $minPrice = $_POST['minPrice'];
            $maxPrice = $_POST['maxPrice'];

            // Thêm điều kiện vào câu truy vấn
            $sql .= " AND price >= $minPrice and price <= $maxPrice";
            $result = $db->getAllDataBySql($sql);
            $countProduct = $db->num_row();
            $totalPages = ceil($countProduct / 12);
        }
        if (isset($_POST['sort'])) {
            $sort = $_POST['sort'];
            switch ($sort) {
                case 1:
                    break;
                case 2:
                    $sql .= " order by num_bought desc";
                    break;
                case 3:
                    $sql .= " order by star_feedback desc";
                    break;
                case 4:
                    $sql .= " order by price asc";
                    break;
                case 5:
                    $sql .= " order by price desc";
                    break;
            }
        } else {
            echo 'khong nhan duoc bien sort';
        }
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
            $from = ($page - 1) * $showProductPerPage;
            $sql .= " limit $from, $showProductPerPage";
        } else {
            echo 'khong nhan duoc price';
        }

        $result = $db->getAllDataBySql($sql);
    } else if ($_POST['action'] == "categoryFilter") {
        $page = 1;
        $showProductPerPage = 12;
        $totalPages = 0;
        $sql = "SELECT * FROM product WHERE status = 1";
        if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
            $minPrice = $_POST['minPrice'];
            $maxPrice = $_POST['maxPrice'];

            // Thêm điều kiện vào câu truy vấn
            $sql .= " AND price >= $minPrice and price <= $maxPrice";
        }
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $sql .= " AND title LIKE '%$keyword%'";
        }
        if (isset($_POST['categories']) && !empty($_POST['categories'])) {
            $categories = implode(",", $_POST['categories']);
            $sql .= " AND id_category IN ($categories)";
            $result = $db->getAllDataBySql($sql);
            $countProduct = $db->num_row();
            $totalPages = ceil($countProduct / 12);
        }
        if (isset($_POST['sort'])) {
            $sort = $_POST['sort'];
            switch ($sort) {
                case 1:
                    break;
                case 2:
                    $sql .= " order by num_bought desc";
                    break;
                case 3:
                    $sql .= " order by star_feedback desc";
                    break;
                case 4:
                    $sql .= " order by price asc";
                    break;
                case 5:
                    $sql .= " order by price desc";
                    break;
            }
        } else {
            echo 'khong nhan duoc bien sort';
        }
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
            $from = ($page - 1) * $showProductPerPage;
            $sql .= " limit $from, $showProductPerPage";
        }
        $result = $db->getAllDataBySql($sql);
    }
}
?>

<?php $idCate = (isset($_REQUEST['category']))?$_REQUEST['category']:2; if ($countProduct > 0) { ?>
    <div class="container">
        <?php foreach ($result as $item) : 
            $result = $db->GetImgProduct($item['id']);
            $row = mysqli_fetch_array($result);
            $numImg = mysqli_num_rows($result);
            if($numImg>0) {
                $imageData = $row['image'];
                $url = 'data:image/jpeg;base64,' . base64_encode($imageData);
            }
            else $url = "images/no_image.gif";
            
        ?>
            <a href="Controller/chitietTour/buyTour.php?id=<?php echo $item['id'] ?>&category=<?php echo $idCate; ?>" class="card" id=''>
                <img src="<?php echo $url?>" alt="" class="img-product" />
                <h2 class="name-product" style="color: black;">
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
            </a>
        <?php endforeach ?>
        <script>
            // let tours = document.getElementsByClassName('card');
            // for (let i = 0; i < tours.length; i++) {
            //     console.log(tours[i])
            //     tours[i].addEventListener('click', function() {
            //         let id = tours[i].id;
            //         window.location.href = "Controller/chitietTour/buyTour.php?id="+id;
            //     });
            // }
        </script>
        <div id="total-pages" data-total="<?php echo $totalPages; ?>"></div>
        <div id="total-products" data-total="<?php echo $countProduct; ?>"></div>
        <div id="option-sort" data-total="<?php echo $sort; ?>"></div>
        <?php if ($_POST['action'] == "categoryFilter") : ?>
            <div id="idCategory" data-total="<?php echo $idCategory; ?>"></div>
        <?php endif; ?>



    </div>
<?php } else { ?>
    <div class="container">
        <h3 class="not-found-product">Không tìm thấy sản phẩm</h3>
        <div id="total-pages" data-total="<?php echo $totalPages; ?>"></div>
        <div id="total-products" data-total="<?php echo $countProduct; ?>"></div>
        <div id="option-sort" data-total="<?php echo $sort; ?>"></div>
        <?php if ($_POST['action'] == "categoryFilter") : ?>
            <div id="idCategory" data-total="<?php echo $idCategory; ?>"></div>
        <?php endif; ?>
    </div>
    <style>
        .not-found-product {
            font-size: 16px;
            color: #212121;
            font-weight: 400;
        }
    </style>
<?php } ?>
<?php
// // Kiểm tra xem form đã được submit chưa
// if(isset($_POST['status'])) {
//     // Xử lý dữ liệu khi form đã được submit
//     $selectedStatus = $_POST['status'];
//     echo "Đã chọn trạng thái mới làĐã chọn trạng thái mới làĐã chọn trạng thái mới là: $selectedStatus";
// } else {
//     echo "Chưa có trạng thái nào được chọnChưa có trạng thái nào được chọn";
// }
//  ?>
<link rel="stylesheet" href="css/cssadmin.css">

<style>
    .body-order-detail {
        margin-left: 220px;
        margin-right: 30px;
        margin-top: 60px;
    }

    .infor {
        margin-top: 20px;
        align-items: center;

    }

    .infor-order {
        margin-top: 20px;
    }

    .infor-person {
        display: flex;
        justify-content: space-around;
        gap: 20px;
    }

    .infor-order-person,
    .infor-reciver,
    .infor-order {
        width: 100%;
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        border-radius: 16px;
    }

    .infor-order {
        width: 97%;
    }

    .title {
        font-size: 30px;
        font-weight: 600;
    }

    h1 {
        font-weight: 600;
        font-size: 35px;
        padding: 20px;
    }

    .id-css {
        color: red;
        font-weight: 700;
    }

    .info-content {
        margin-top: 10px;
        font-size: 18px;
    }

    .info-content .label {
        font-weight: 600;
    }

    .status-label {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
    }

    .wait {
        background-color: #ffc107;
        /* yellow */
        color: #fff;
    }

    .confirmed {
        background-color: #28a745;
        /* green */
        color: #fff;
    }

    .in-progress {
        background-color: #007bff;
        /* blue */
        color: #fff;
    }

    .completed {
        background-color: purple;
        /* gray */
        color: #fff;
    }

    .canceled {
        background-color: #dc3545;
        /* red */
        color: #fff;
    }

    .wait-txt {
        color: #ffc107;
    }

    .confirmed-txt {
        color: #28a745;
    }

    .in-progress-txt {
        color: #007bff;
    }

    .completed-txt {
        color: purple;
    }

    .canceled-txt {
        color: #dc3545;
    }
   

    h3 {
        font-size: 20px;
        padding-bottom: 20px;
        padding: 10px 0;
    }

    input[type='radio']:hover {
        cursor: pointer;
    }

    label:hover {
        cursor: pointer;
        transition: all 0.1s;
    }
    .lb_wait:hover {
        color: #ffc107;
    }
    .lb_confirmed:hover {
        color: #28a745;
    }
    .lb_in-progress:hover {
        color: #007bff;
    }
    .lb_completed:hover {
        color: purple;
    }
    .lb_canceled:hover {
        color: #dc3545;
    } 
    .btn-update {
        margin-left: 10px;
        font-size: 19px;
        font-weight: 600;
        padding: 5px 8px;
        border-radius: 6px;
        background-color: orangered;
        color: #fff;
        outline: none;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-update:hover {
        background-color: #dc3545;
    }
    .img-product-detail {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }
    .red {
        color: red;
        font-weight: 600;

    }
    .blue {
        color: #0550fa;
        font-weight: 600;
        background-color: #fff;
    }
    .yellow {
        color: #ffc107;
        font-weight: 600;
        background-color: #fff;

    }
</style>
<div class="body-order-detail">
    <h1>Chi tiết đơn hàng
        <span class="id-css ">
            <?php
            switch ($status) {
                case 1:
                    echo '<span class="wait-txt"># ' . $orderId . '</span>';
                    break;
                case 2:
                    echo '<span class="confirmed-txt"># ' . $orderId . '</span>';
                    break;
                case 3:
                    echo '<span class="in-progress-txt"># ' . $orderId . '</span>';
                    break;
                case 4:
                    echo '<span class="completed-txt"># ' . $orderId . '</span>';
                    break;
                case 5:
                    echo '<span class="canceled-txt"># ' . $orderId . '</span>';
                    break;
            }
            ?>

        </span>

    </h1>

    <div class="infor">
        <div class="infor-person">
            <div class="infor-order-person">
                <h2 class="title">Thông tin người đặt hàng</h2>
                <p class="info-content">
                    <span class="label">Id: </span>
                    <?= $infoPersonOrder[0]['idUser'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Tên: </span>
                    <?= $infoPersonOrder[0]['nameUser'] ?>
                </p>
                <p class="info-content">
                    <span class="label">SĐT: </span>
                    <?= $infoPersonOrder[0]['phone_number'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Email: </span>
                    <?= $infoPersonOrder[0]['email'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Địa chỉ: </span>
                    <?= $infoPersonOrder[0]['address'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Số đơn đã đặt:  </span>
                    <?= $totalOrderByUser ?>
                </p>
                <p class="info-content">
                    <span class="label">Số đơn huỷ:  </span>
                    <?= $totalRejectOrderByUser ?>
                </p>
                <div class="info-content">
                    <div class="label">Tỉ lệ giao đơn giao thành công: <span class="check-red-or-blue red" style="font-weight: 400;"><?= $successPercentage ?> %</span></div>
                </div>
               

            </div>
            <div class="infor-reciver">
                <h2 class="title">Thông tin người nhận hàng</h2>
                <p class="info-content">
                    <span class="label">Tên: </span>
                    <?= $listOrderDetail[0]['fullname'] ?>
                </p>
                <p class="info-content">
                    <span class="label">SĐT: </span>
                    <?= $listOrderDetail[0]['phone_number'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Email: </span>
                    <?= $listOrderDetail[0]['email'] ?>
                </p>
                <p class="info-content">
                    <span class="label">Địa chỉ: </span>
                    <?= $listOrderDetail[0]['address'] ?>
                </p>
            </div>
        </div>
        <div class="infor-order">
            <h2>Thông tin đơn hàng</h2>
            <p class="info-content">
                <span class="label">Ngày đặt hàng: </span>
                <?= $listOrderDetail[0]['date_order'] ?>
            </p>
            <p class="info-content">
                <span class="label">Ghi chú: </span>
                <?= $listOrderDetail[0]['note'] ?>
            </p>
            <p class="info-content">
                <span class="label">Tổng tiền: </span>
                <?php echo number_format($totalAllMoney, 0, ',', '.') . ' vnđ'?>
            </p>
            <p class="info-content">
                <span class="label">Trạng thái: </span>
                <?php
                switch ($status) {
                    case 1:
                        echo '<span class="status-label wait">chờ xác nhận</span>';
                        break;
                    case 2:
                        echo '<span class="status-label confirmed">đã xác nhận</span>';
                        break;
                    case 3:
                        echo '<span class="status-label in-progress">đang thực hiện tour</span>';
                        break;
                    case 4:
                        echo '<span class="status-label completed">đã hoàn thành</span>';
                        break;
                    case 5:
                        echo '<span class="status-label canceled">đã huỷ bỏ</span>';
                        break;
                    default:
                        echo '<span class="status-label unknown">Unknown status</span>';
                        break;
                }
                ?>
            </p>
            <div class="form-update-status">
                <h3>Cập nhật trạng thái đơn hàng</h3>
                <form action="http://localhost/WEB2/includes/handle_mail.php" method="post">
                    <input type="text" name="orderId" id="" value="<?= $orderId ?>" hidden>
                    <input type="text" name="old_status" id="" value="<?= $status ?>" hidden>
                    <input type="text" name="total_all_money" id="" value="<?= $totalAllMoney ?>" hidden>


                    <input type="radio" name="status" id="wait" value="1" <?= $status == 1 ? 'checked' : '' ?>>
                    <label for="wait" class = "lb_wait">chờ xác nhận</label>

                    <input type="radio" name="status" id="confirmed" value="2" <?= $status == 2 ? 'checked' : '' ?>>
                    <label for="confirmed" class = "lb_confirmed">đã xác nhận</label>

                    <input type="radio" name="status" id="in-progress" value="3" <?= $status == 3 ? 'checked' : '' ?>>
                    <label for="in-progress" class = "lb_in-progress">đang thực hiện tour</label>

                    <input type="radio" name="status" id="completed" value="4" <?= $status == 4 ? 'checked' : '' ?>>
                    <label for="completed" class="lb_completed">đã hoàn thành</label>

                    <input type="radio" name="status" id="canceled" value="5" <?= $status == 5 ? 'checked' : '' ?>>
                    <label for="canceled" class="lb_canceled">đã huỷ bỏ</label>
                    <button class="btn-update" style="background-color: #4880ff;">Cập nhật</button>
                </form>


            </div>


            <table id="tableData" class="custom-table">
                <thead class="table-head">
                    <tr class="table--head">
                        <th class="table-header">STT</th>
                        <th class="table-header">Hình sản phẩm</th>
                        <th class="table-header">Tên sản phẩm</th>
                        <th class="table-header">Giá sản phẩm</th>
                        <th class="table-header">Số lượng</th>
                        <th class="table-header">Tổng tiền</th>
                        <th class="table-header">Tên vocher</th>
                        <th class="table-header">Ngày đi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach ($listOrderDetail as $value) {
                        ?>
                        <tr class="table-row">
                            <td class="table-cell id">
                                <?php echo $stt++; ?>
                            </td>
                            <td class="table-cell id">
                                <?php 
                                    // include "../../Model/DBConfig.php";
                                    // $dbbb = new Database();
                                    // $dbbb->connect();
                                    $result = $db->GetImgProduct($value['id_product']);
                                    $row = mysqli_fetch_array($result);
                                    $numImg = mysqli_num_rows($result);
                                    if($numImg>0) {
                                        $imageData = $row['image'];
                                        $url = 'data:image/jpeg;base64,' . base64_encode($imageData);
                                    }
                                    else {
                                        $url = "images/no_image.gif";
                                    }
                                ?>
                            <img src="<?php echo $url?>" alt="" class="img-product-detail" />
                            </td>
                            <td class="table-cell id">
                                <?= $value['title'] ?>
                            </td>
                            <td class="table-cell id">
                                <?php echo number_format($value['price'], 0, ',', '.')?>
                            </td>
                            <td class="table-cell id">
                                <?= $value['amount'] ?>

                            </td>
                            <td class="table-cell id">
                                <?php echo number_format($value['total_money'], 0, ',', '.') ?>
                            </td>
                            <td class="table-cell id">
                                <?= $value['discount_name'] ?>
                            </td>
                            <td class="table-cell id">
                                <?= $value['date_go'] ?>
                            </td>
                            <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>



    </div>



</div>
<script>
    let checkRedOrBlue = document.querySelector(".check-red-or-blue");
    console.log(checkRedOrBlue.textContent);
    if (parseInt(checkRedOrBlue.textContent) < 50) {
        checkRedOrBlue.classList.add("red");
        checkRedOrBlue.classList.remove("blue");
        checkRedOrBlue.classList.remove("yellow");
    } else if (parseInt(checkRedOrBlue.textContent) >= 50 && parseInt(checkRedOrBlue.textContent) <= 79){
        checkRedOrBlue.classList.add("yellow");
        checkRedOrBlue.classList.remove("blue");
        checkRedOrBlue.classList.remove("red");
    } else {
        checkRedOrBlue.classList.add("blue");
        checkRedOrBlue.classList.remove("red");
        checkRedOrBlue.classList.remove("yellow");
    }
</script>

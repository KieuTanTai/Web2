<style>
body {
    font-family: Arial, sans-serif;
}



h3 {
    text-align: center;
    margin-bottom: 15px;
    color: #4a81fc;
    margin-top: 85px;
}

.valiFormTour {
    display: none;
    color: red;
    font-size: 12px;
    margin-bottom: 3px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.form-col {
    display: flex;
    gap: 20px
}

.form-group {
    width: 100%;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    margin-top: 20px;
}

input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

label[for="status"] {
    text-align: center;
}

input[name="status"] {
    margin-left: 138px;
    width: 30%;
    text-align: center;
}

input[type="submit"],
input[type="button"] {
    background-color: #4a81fc;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

input[type="submit"]:hover {
    background-color: #2669ff;
}
</style>

<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    // Get the voucher ID from the URL
    $voucherId = $_GET['id'];

    // Fetch voucher details from the database based on the ID
    // Assuming you have a method to fetch voucher details by ID in your DBConfig class
    $voucherDetails = $db->getVoucherDetailsById($voucherId);

    // Check if voucher details are retrieved successfully
    if($voucherDetails) {
        // Extract voucher details into variables
        extract($voucherDetails);
    }
}
?>

<body>
    <h3>Sửa Voucher</h3>
    <form action="index.php?controller=trang-admin&action=capnhatvoucher" method="POST">
        <div class="form-col">
            <div class="form-group">

                <label for="ten-voucher">Tên Voucher</label>
                <input type="text" id="ten-voucher" name="ten_voucher"
                    value="<?= isset($discount_name) ? $discount_name : '' ?>">
                <span class="valiFormTour" id="tenVoucherValidation">Tên voucher không được để trống</span>

                <label for="ma-voucher">Mã Voucher</label>
                <input type="text" id="ma-voucher" name="ma_voucher" value="<?= isset($code) ? $code : '' ?>">
                <span class="valiFormTour" id="maVoucherValidation">Mã voucher không được để trống</span>

                <label for="mo-ta">Mô tả</label>
                <input type="text" id="mo-ta" name="mo_ta" value="<?= isset($description) ? $description : '' ?>">
                <span class="valiFormTour" id="moTaValidation">Mô tả không được để trống</span>

            </div>
            <div class="form-group">

                <label for="gia-tri">Giá trị</label>
                <input type="text" id="gia-tri" name="gia_tri" value="<?= isset($percent) ? $percent : '' ?>">
                <span class="valiFormTour" id="giatriValidation">Giá trị không hợp lệ</span>

                <label for="ngay-bat-dau">Ngày bắt đầu</label>
                <input type="date" id="ngay-bat-dau" name="ngay_bat_dau"
                    value="<?= isset($date_start) ? $date_start : '' ?>">
                <span class="valiFormTour" id="ngaybatdauValidation">Ngày bắt đầu không được để trống</span>

                <label for="ngay-ket-thuc">Ngày kết thúc</label>
                <input type="date" id="ngay-ket-thuc" name="ngay_ket_thuc"
                    value="<?= isset($date_end) ? $date_end : '' ?>">
                <span class="valiFormTour" id="ngayketthucValidation">Ngày kết thúc không được để trống</span>

            </div>
        </div>


        <label for="status">Status</label>
        <input type="text" id="status" name="status" value="<?= isset($status) ? $status : '' ?>">
        <br>
        <span class="valiFormTour" id="statusValidation" style="margin-left: 141px;">Status phải là 0 hoặc 1</span>


        <input type="hidden" name="id" value="<?php if(isset($id) && ($id) > 0) echo $id ?>">
        <input type="submit" name="btnedit" id="btnedit" style="margin-top: 10px;" value="Cập Nhật">
        <?php
    if (isset($alert) && $alert == 'edit_success') {
        echo "<p style='color: green;  margin-left: 360px; margin-top: 10px;'>Cập nhật thành công</p>";
    }
    ?>
    </form>

</body>

<script>
document.getElementById('btnedit').addEventListener('click', function(e) {
    var tenVoucher = document.getElementById('ten-voucher');
    var maVoucher = document.getElementById('ma-voucher');
    var moTa = document.getElementById('mo-ta');
    var giaTri = document.getElementById('gia-tri');
    var ngayBatDau = document.getElementById('ngay-bat-dau');
    var ngayKetThuc = document.getElementById('ngay-ket-thuc');
    var status = document.getElementById('status');

    var tenVoucherValidation = document.getElementById('tenVoucherValidation');
    var maVoucherValidation = document.getElementById('maVoucherValidation');
    var moTaValidation = document.getElementById('moTaValidation');
    var giaTriValidation = document.getElementById('giatriValidation');
    var ngayBatDauValidation = document.getElementById('ngaybatdauValidation');
    var ngayKetThucValidation = document.getElementById('ngayketthucValidation');
    var statusValidation = document.getElementById('statusValidation');

    var isValid = true;

    if (tenVoucher.value.trim() === '') {
        e.preventDefault();
        tenVoucherValidation.style.display = 'block';
        isValid = false;
    } else {
        tenVoucherValidation.style.display = 'none';
    }

    if (maVoucher.value.trim() === '') {
        e.preventDefault();
        maVoucherValidation.style.display = 'block';
        isValid = false;
    } else {
        maVoucherValidation.style.display = 'none';
    }

    if (moTa.value.trim() === '') {
        e.preventDefault();
        moTaValidation.style.display = 'block';
        isValid = false;
    } else {
        moTaValidation.style.display = 'none';
    }

    if (giaTri.value.trim() === '' || !Number.isInteger(parseInt(giaTri.value)) || parseInt(giaTri.value) <=
        0) {
        e.preventDefault();
        giaTriValidation.style.display = 'block';
        isValid = false;
    } else {
        giaTriValidation.style.display = 'none';
    }


    var currentDate = new Date();


    var startDate = new Date(ngayBatDau.value);
    var endDate = new Date(ngayKetThuc.value);

    // Kiểm tra nếu ngày bắt đầu hoặc ngày kết thúc trống
    if (ngayBatDau.value.trim() === '') {
        e.preventDefault();
        ngayBatDauValidation.style.display = 'block';
        isValid = false;
    } else {
        ngayBatDauValidation.style.display = 'none';
    }

    if (ngayKetThuc.value.trim() === '') {
        e.preventDefault();
        ngayKetThucValidation.style.display = 'block';
        isValid = false;
    } else {
        ngayKetThucValidation.style.display = 'none';
    }

    // Kiểm tra nếu ngày kết thúc không được chọn sau ngày bắt đầu
    if (endDate <= startDate) {
        e.preventDefault();
        ngayKetThucValidation.style.display = 'block';
        ngayKetThucValidation.textContent = 'Ngày kết thúc phải sau ngày bắt đầu';
        isValid = false;
    } else {
        ngayKetThucValidation.style.display = 'none';
    }

    if (status.value.trim() !== '0' && status.value.trim() !== '1') {
        e.preventDefault();
        statusValidation.style.display = 'block';
        isValid = false;
    } else {
        statusValidation.style.display = 'none';
    }
});
</script>
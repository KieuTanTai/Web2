<style>
body {
    font-family: Arial, sans-serif;
}

.valiFormTour {
    display: none;
    color: red;
    font-size: 12px;
    margin-bottom: 3px;
}

h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #4a81fc;
    margin-top: 85px;
}

form {
    max-width: 40%;
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


<body>
    <h3>Thêm voucher</h3>
    <form action="index.php?controller=trang-admin&action=themvoucher" method="POST">

        <div class="form-col">
            <div class="form-group">

                <label for="ten-voucher">Tên Voucher</label>
                <input type="text" id="ten-voucher" name="ten_voucher">
                <span class="valiFormTour" id="tenVoucherValidation">Tên voucher không được để trống</span>

                <label for="ma-voucher">Mã Voucher</label>
                <input type="text" id="ma-voucher" name="ma_voucher">
                <span class="valiFormTour" id="maVoucherValidation">Mã voucher không được để trống</span>

                <label for="mo-ta">Mô tả</label>
                <input type="text" id="mo-ta" name="mo_ta">
                <span class="valiFormTour" id="moTaValidation">Mô tả không được để trống</span>

            </div>
            <div class="form-group">

                <label for="gia-tri">Giá trị</label>
                <input type="text" id="gia-tri" name="gia_tri">
                <span class="valiFormTour" id="giatriValidation">Giá trị không hợp lệ</span>

                <label for="ngay-bat-dau">Ngày bắt đầu</label>
                <input type="date" id="ngay-bat-dau" name="ngay_bat_dau">
                <span class="valiFormTour" id="ngaybatdauValidation">Ngày bắt đầu không được để trống</span>

                <label for="ngay-ket-thuc">Ngày kết thúc</label>
                <input type="date" id="ngay-ket-thuc" name="ngay_ket_thuc">
                <span class="valiFormTour" id="ngayketthucValidation">Ngày kết thúc không được để trống</span>

            </div>
        </div>

        <input type="submit" name="btnadd" id="btnadd" style="margin-top: 15px;" value="Thêm">

    </form>
    <?php
			if (isset($alert) && $alert == 'add_success') {
				echo '<script>alert("Thêm voucher thành công")</script>';
            } else if (isset($alert) && $alert == 'add_fail') {
                echo '<script>alert("Thêm voucher thất bại")</script>';
			} else return;
	?>
</body>
<script>
document.getElementById('btnadd').addEventListener('click', function(e) {
    var tenVoucher = document.getElementById('ten-voucher');
    var maVoucher = document.getElementById('ma-voucher');
    var moTa = document.getElementById('mo-ta');
    var giaTri = document.getElementById('gia-tri');
    var ngayBatDau = document.getElementById('ngay-bat-dau');
    var ngayKetThuc = document.getElementById('ngay-ket-thuc');


    var tenVoucherValidation = document.getElementById('tenVoucherValidation');
    var maVoucherValidation = document.getElementById('maVoucherValidation');
    var moTaValidation = document.getElementById('moTaValidation');
    var giaTriValidation = document.getElementById('giatriValidation');
    var ngayBatDauValidation = document.getElementById('ngaybatdauValidation');
    var ngayKetThucValidation = document.getElementById('ngayketthucValidation');


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


});
</script>
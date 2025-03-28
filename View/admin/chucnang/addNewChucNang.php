<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .themuser {
        width: 400px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .themuser h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .themuser form label {
        display: block;
        margin-bottom: 5px;
    }

    .themuser form input[type="text"],
    .themuser form input[type="email"],
    .themuser form input[type="password"],
    .themuser form input[type="date"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .themuser form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .themuser form input[type="submit"]:hover {
        background-color: #45a049;
    }

    .alert {
        color: green;
        text-align: center;
    }

    .form--inner {
        display: flex;
        gap: 30px;
    }

    .spanNameCN {
        display: none;
        color: red;
        font-size: 12px;
        padding-bottom: 5px !important;
    }
</style>

<body>
    <div class="container">
        <div class="themuser">
            <h3>Thêm chức năng</h3>
            <form id="addForm" action="Controller/trangadmin/ChucNang/C_addNewChucNang.php" method="POST" class="form">
                <label for="nameCN">Tên Chức năng</label><br>
                <input type="text" id="nameCN" name="nameCN"><br>
                <span class="spanNameCN">Vui lòng điền vào trường này</span>
                <input type="submit" name="edit_CN" value="Thêm">
            </form>
            <div id="alertMessage"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let isNameValid = true; // Biến để kiểm tra trạng thái của trường nhập liệu
            let nameCNValue = $('#nameCN').val().trim();
            let span = $('.spanNameCN');
            $('#nameCN').on('input', function() {
                if ($(this).val().trim() == "") {
                    span.css('display', 'block').css('margin-bottom', '5px');
                    span.show(); // Hiển thị thông báo lỗi nếu trường nhập liệu trống
                    isNameValid = false;
                } else {
                    span.hide(); // Ẩn thông báo lỗi nếu trường nhập liệu có dữ liệu hợp lệ
                    isNameValid = true;
                }
            });

            $('#addForm').submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                if(document.getElementById('nameCN').value == ""){
                    span.css('display', 'block').css('margin-bottom', '5px');
                    span.show();
                    isNameValid = false;
                }
                if (!isNameValid) {
                    return; // Không gửi dữ liệu nếu trường nhập liệu không hợp lệ
                }

                let alertMessage = $('#alertMessage');

                // Send form data via Ajax
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle the successful response here
                        alert('Thêm chức năng thành công!')
                        // Redirect to the specified URL
                        window.location.href = 'index.php?controller=trang-admin&action=chucnang';
                    },
                    error: function() {
                        // Handle errors
                        alert('Request failed. Please try again later.');
                    }
                });
            });
        });
    </script>
</body>

</html>
<link rel="stylesheet" href="css/cssadmin.css">

<body>
    <style>
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
            color: #fff;
        }

        .canceled {
            background-color: #dc3545;
            /* red */
            color: #fff;
        }

        .unknown {
            background-color: #f8f9fa;
            /* light gray */
            color: #333;
        }

        .form-group-filter-date {
            margin-left: 200px;
        }

        .form-group-filter-date .container-form {
            display: flex;
            gap: 10px;
        }

        .form-group-filter-date input {
            padding: 5px 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .btn-reset-date {
            text-decoration: underline;
            margin-right: 5px;
            cursor: pointer;
            color: #777;
        }

        .btn-reset-date:hover {
            color: #333;
        }

        #btn-filter-date {
            margin-top: 5px;
            padding: 5px 8px;
            background-color: #4880ff;
            font-weight: 500;
            outline: none;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
        }

        #btn-filter-date:hover {
            background-color: #2f5dc5;
        }

        .form-group-filter-status .container-form {
            display: flex;
            align-items: start;
            flex-direction: column;
            margin-left: 16px;
        }
        .form-group-filter-status .container-form select {
            padding: 5px 8px;
            width: 150px;
        }
    </style>
    <div class="user--table">
        <?php
        $isAdd = 0;
        $isEdit = 0;
        $isDelete = 0;
        foreach ($role as $rowRole) {
            if ($rowRole['id_chucNang'] == 3) {
                switch ($rowRole['HD']) {
                    case 'Add':
                        $isAdd = 1;
                        break;
                    case 'Edit':
                        $isEdit = 1;
                        break;
                    case 'Delete':
                        $isDelete = 1;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        ?>
        <h2 class="table--heading">Danh sách đơn hàng</h2>
        <div class="list-feature">
            <div class="filter-container">
                <!-- <select id="filterBy">
                    <option value="all">Tất cả</option>
                    <option value="name">Tên</option>
                    <option value="year">Năm sinh</option>
                </select> -->
                <input type="text" id="filterInput" placeholder="Nhập giá trị cần tìm kiếm...">
                <!-- <button>Lọc</button> -->
                <label for="selectNumRow">Số dòng hiển thị</label>
                <select name="" id="selectNumRow"
                    style="width: 100px;height: 37.6px;margin-left: 5px;border-radius: 5px;">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="99999">Tất cả đơn hàng</option>
                </select>
            </div>
            <div class="form-group-filter-status">
                <div class="container-form">
                    <label for="status-filter">Trạng thái</label><br>
                    <select name="status-filter" id="status-filter">
                        <option value="all">Tất cả</option>
                        <option value="chờ xác nhận">Chờ xác nhận</option>
                        <option value="đã xác nhận">Đã xác nhận</option>
                        <option value="đang thực hiện tour">Đang thực hiện tour</option>
                        <option value="đã hoàn thành">Đã hoàn thành</option>
                        <option value="đã huỷ bỏ">Đã huỷ bỏ</option>
                    </select>
                </div>
            </div>
            <div class="form-group-filter-date">
                <div class="container-form">
                    <div class="div">
                        <label for="dateStart">Ngày bắt đầu</label><br>
                        <input type="date" name="dateStart" id="dateStart"><br>
                    </div>
                    <div class="div">
                        <label for="dateEnd">Ngày kết thúc</label><br>
                        <input type="date" name="dateEnd" id="dateEnd">
                    </div>
                </div>
                <span class="btn-reset-date" onclick="resetDate()">Xoá</span>
                <button type="button" id="btn-filter-date" onclick="filterDate()">Lọc theo ngày</button>
            </div>

            <!-- <a href="index.php?controller=trang-admin&action=addTour" class="list-feature-item add-user-btn">
                <img src="css/icons/favorites-admin-icon.svg" alt="" class="list-feature-item--icon">
                <p class="nav-admin-item--title">Thêm mới</p>
            </a> -->
        </div>
        <table id="tableData" class="custom-table">
            <thead class="table-head">
                <tr class="table--head">
                    <th onclick="sortTable(0)">STT
                        <img id="sortIcon0" src="images/arrow-point-to-down.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(1)">Mã đơn hàng
                        <img id="sortIcon1" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(2)">Tên người đặt
                        <img id="sortIcon2" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(3)">Thời gian đặt
                        <img id="sortIcon3" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(4)">Tổng giá trị
                        <img id="sortIcon4" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header">Trạng thái</th>
                    <th class="table-header">Hành động</th>
                </tr>
            </thead>

            <tbody class="table-body">

            </tbody>
        </table>
        <div class="paging" style="display: flex; align-item:center; justify-content: center; margin-top: 20px;">
        </div>
    </div>
    <?php require_once ('js/phantrang.php') ?>
    <script>
        // Lấy ô input và bảng dữ liệu
        var input = document.getElementById("filterInput");
        var table = document.getElementById("tableData");
        var btnFilterDate = document.getElementById("btn-filter-date");
        var dateStartEle = document.getElementById("dateStart")
        var dateEndEle = document.getElementById("dateEnd")
        var btnResetDatet = document.querySelector(".btn-reset-date");

        function resetDate() {
            console.log("Đã vào reset Date");
            dateStartEle.value = " "; // Đặt lại giá trị của ô nhập liệu ngày bắt đầu thành rỗng
            dateEndEle.value = " "; // Đặt lại giá trị của ô nhập liệu ngày kết thúc thành rỗng
        }

        function filterDate() {
            resetStatus();
            let dateStart = dateStartEle.value;
            let dateEnd = dateEndEle.value;
            let startDate = new Date(dateStart);
            let endDate = new Date(dateEnd);

            console.log(dateStart);
            console.log(dateEnd);
            let rows = table.getElementsByClassName("table-roww");
            for (let i = 0; i < rows.length; i++) {
                rows[i].parentElement.style.display = "";
            }
            if (dateStart == "" && dateEnd == "") {
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = ""; // Hiển thị hàng
                }
                return;
            }
            if (dateStart == "" || dateEnd == "") {
                alert("Vui lòng chọn cả 2 ngày bắt đầu và kết thúc");
                return;
            }
            if (startDate > endDate) {
                alert("Ngày bắt đầu không thể lớn hơn ngày kết thúc");
                return;
            }
            for (let i = 0; i < rows.length; i++) {
                console.log(rows[i]);
                let dateString = rows[i].textContent;
                console.log(dateString);
                let rowVisible = false;

                let rowDate = new Date(dateString);


                // Kiểm tra xem ngày trong khoảng thời gian được chọn không
                if (rowDate >= startDate && rowDate <= endDate) {
                    rowVisible = true;
                }

                // Hiển thị hoặc ẩn hàng dựa trên kết quả kiểm tra ngày
                if (rowVisible) {
                    rows[i].style.display = ""; // Hiển thị hàng
                } else {
                    rows[i].parentElement.style.display = "none"; // Ẩn hàng
                }

            }
        }
        function resetStatus() {
            document.querySelector("#status-filter").value = "all";
            let rows = table.getElementsByClassName("table-roww");
            for (let i = 0; i < rows.length; i++) {
                rows[i].parentElement.style.display = ""; // Reset display for all rows
            }
        }
        function filterStatus() {
            resetDate();

    let rows = table.getElementsByClassName("table-roww");
    for (let i = 0; i < rows.length; i++) {
        rows[i].parentElement.style.display = ""; // Reset display for all rows
    }
    let status = document.querySelector("#status-filter").value.toLowerCase().trim(); // Get selected status

    document.querySelectorAll(".status-label").forEach(function (statusLabel) {
        let row = statusLabel.parentElement.parentElement;
        let rowStatus = statusLabel.textContent.toLowerCase().trim();
        if (rowStatus === status || status === "all") {
            row.classList.remove("hidden"); // Show row
        } else {
            row.classList.add("hidden"); // Hide row
        }
    });
}

document.querySelector("#status-filter").addEventListener("change", filterStatus);



        // Lắng nghe sự kiện input trên ô tìm kiếm
        input.addEventListener("input", function () {
            let filter = input.value.toLowerCase(); // Chuyển đổi giá trị nhập vào thành chữ thường để so sánh

            // Lặp qua từng hàng trong tbody
            let rows = table.getElementsByClassName("table-row");
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByClassName("table-cell"); // Lấy tất cả các ô trong hàng

                var rowVisible = false; // Biến để kiểm tra xem hàng có nên hiển thị hay không

                // Lặp qua tất cả các ô trong hàng
                for (var j = 0; j < cells.length; j++) {
                    var textValue = cells[j].textContent.toLowerCase();
                    console.log(textValue); // Nội dung của ô chuyển thành chữ thường

                    // Nếu nội dung của ô chứa giá trị tìm kiếm, hiển thị hàng và thoát khỏi vòng lặp
                    if (textValue.indexOf(filter) > -1) {
                        rowVisible = true;
                        break;
                    }
                }

                // Hiển thị hoặc ẩn hàng dựa trên kết quả kiểm tra các ô trong hàng
                if (rowVisible) {
                    rows[i].style.display = ""; // Hiển thị hàng
                } else {
                    rows[i].style.display = "none"; // Ẩn hàng
                }
            }
        });
        // tao fixed rồi nha
        //     function handleDeleteClick(deleteBtn) {
        // console.log("da nhan vo nuts xoa don hang");
        // var deleteUrl = deleteBtn.getAttribute('data-delete-url');
        // var rowToDelete = deleteBtn.closest('.table-row');
        // console.log(rowToDelete);
        // var confirmDelete = confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');
        // console.log(deleteUrl);
        // if (confirmDelete) {
        //     $.ajax({
        //         url: deleteUrl,
        //         type: 'GET',
        //         success: function(response) {
        //             // Xử lý phản hồi thành công (nếu cần)
        //             if (rowToDelete) { // Kiểm tra nếu rowToDelete tồn tại
        //                 rowToDelete.classList.add("hidden")// Ẩn dòng bằng jQuery hide()
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             // Xử lý lỗi (nếu cần)
        //         }
        //     });
        // } else {
        //     // Nếu người dùng không đồng ý, không làm gì cả
        // }
        // }
    </script>
    <script src="js/sapxep.js"></script>
</body>
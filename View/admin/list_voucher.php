<link rel="stylesheet" href="css/cssadmin.css">

<body>

    <div class="user--table">
        <h2 class="table--heading">Danh Sách Voucher</h2>
        <div class="list-feature">
            <div class="filter-container">

                <input type="text" id="filterInput" placeholder="Nhập giá trị cần tìm kiếm...">
                <label for="selectNumRow">Số dòng hiển thị</label>
				<select name="" id="selectNumRow" style="width: 100px;height: 37.6px;margin-left: 5px;border-radius: 5px;">
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
            </div>
            <?php
			$isAdd = 0;
			$isEdit = 0;
			$isDelete = 0;
			foreach ($role as $rowRole) {
				if ($rowRole['id_chucNang'] == 1) {
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
			if ($isAdd == 1) {
				echo "<a href='index.php?controller=trang-admin&action=themvoucher' class='list-feature-item add-user-btn'>
					<img src='css/icons/favorites-admin-icon.svg' alt='' class='list-feature-item--icon'>
					<p class='nav-admin-item--title'>Thêm mới</p>
				</a>";
			}
			?>

        </div>
        <table id="tableData" class="custom-table">
            <thead class="table-head">
                <tr class="table--head">
                    <th class="table-header" onclick="sortTable(0)">ID
                        <img id="sortIcon0" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(1)">Tên Voucher
                        <img id="sortIcon1" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(2)">Mã
                        <img id="sortIcon2" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(3)">Giá trị
                        <img id="sortIcon3" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(4)">Ngày bắt đầu
                        <img id="sortIcon4" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header" onclick="sortTable(5)">Ngày kết thúc
                        <img id="sortIcon5" src="images/arrow-point-to-up.png" width="14px">
                    </th>
                    <th class="table-header">Hành Động</th>


                </tr>
            </thead>

            <tbody class="table-body">
                

            </tbody>
        </table>
        <div class="paging" style="display: flex; align-item:center; justify-content: center; margin-top: 20px;">
		</div>
    </div>
</body>
<?php require_once('js/phantrang.php')?>
<script>
    // Lấy ô input và bảng dữ liệu
    var input = document.getElementById("filterInput");
    var table = document.getElementById("tableData");

    // Lắng nghe sự kiện input trên ô tìm kiếm
    input.addEventListener("input", function() {
        var filter = input.value.toLowerCase(); // Chuyển đổi giá trị nhập vào thành chữ thường để so sánh

        // Lặp qua từng hàng trong tbody
        var rows = table.getElementsByClassName("table-row");
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByClassName("table-cell"); // Lấy tất cả các ô trong hàng

            var rowVisible = false; // Biến để kiểm tra xem hàng có nên hiển thị hay không

            // Lặp qua tất cả các ô trong hàng
            for (var j = 0; j < cells.length; j++) {
                var textValue = cells[j].textContent.toLowerCase(); // Nội dung của ô chuyển thành chữ thường

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

    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('data-delete-url');
            var rowToDelete = $(this).closest('.table-row');
            var confirmDelete = confirm('Bạn có chắc chắn muốn xóa tour này không?');
            if (confirmDelete) {
                $.ajax({
                    url: deleteUrl,
                    success: function(response) {
                        // Xử lý phản hồi thành công (nếu cần)
                        if (rowToDelete.length > 0) { // Kiểm tra nếu rowToDelete tồn tại
                            rowToDelete.hide(); // Ẩn dòng bằng jQuery hide()
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu cần)
                    }
                });
            } else {
                // Nếu người dùng không đồng ý, không làm gì cả
            }
        });
    });
</script>
<script src="js/sapxep.js"></script>
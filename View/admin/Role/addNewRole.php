<style>
    .nameRoleValidation,
    .validationTableRole {
        display: none;
        color: red;
    }

    #formAddRole {
        margin-left: 220px !important;
        margin-top: 80px !important;
    }

    #formAddRole {
        width: 80%;
        margin: 0 auto;
    }

    .Box_name_role {
        margin-bottom: 20px;
    }

    .Box_name_role label {
        display: block;
        margin-bottom: 5px;
    }

    .Box_name_role input[type="text"] {
        width: 44%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .Box_name_role .nameRoleValidation {
        display: none;
        color: red;
        margin-top: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th,
    table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    table th {
        background-color: #f2f2f2;
    }

    .validationTableRole {
        display: none;
        color: red;
        margin-top: 5px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        position: absolute;
        right: 650px;
        top: 100px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

<body>
    <form id="formAddRole">
        <div class="Box_name_role">
            <label for="">Tên quyền:</label>
            <input type="text" id="name_role" name="name_role">
            <span class="nameRoleValidation">Dữ liệu không hợp lệ</span>
            <button type="button" name="addRole" id="addRole" value="Thêm" onclick="ajaxAddRole()">Thêm</button>
        </div>

        <!-- <input type="hidden" name="id_chucNang" value="<?php // echo $rowCN['id']; 
                                                            ?>"> -->
        <table border="1">
            <tr>
                <th>Bộ phận quản lý</th>
                <th>Xem</th>
                <th>Thêm</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>

            <?php
            $rowsCN = $db->getAllData('ChucNang');
            // Duyệt qua mỗi bộ phận và tạo hàng trong bảng
            foreach ($rowsCN as $rowCN) {
                $name = $rowCN['decription'];
                $idCN = $rowCN['id'];
                echo "<tr>";
                echo "<input type=\"hidden\" name=\"id_chucNang\" value=\"" . $rowCN['id'] . "\">";
                echo "<td>$name</td>";
                echo "<td><input type='checkbox' name='view[$idCN]'></td>";
                echo "<td><input type='checkbox' name='add[$idCN]'></td>";
                echo "<td><input type='checkbox' name='delete[$idCN]'></td>";
                echo "<td><input type='checkbox' name='edit[$idCN]'></td>";
                echo "</tr>";
            }
            ?>

        </table>
        <span class="validationTableRole">Vui lòng chọn ít nhất một ô</span>
    </form>
    <script>
        function validateFormAddRole() {
            let nameRole = document.getElementById('name_role').value;
            let nameRoleValidation = document.getElementsByClassName('nameRoleValidation')[0];
            let isTrue = true;
            if (nameRole.trim() === '') {
                nameRoleValidation.style.display = 'block';
                isTrue = false;
            } else nameRoleValidation.style.display = 'none';

            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedCount = 0;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCount++;
                }
            }
            let spanTable = document.getElementsByClassName('validationTableRole')[0];
            if (checkedCount === 0) {
                spanTable.style.display = 'block';
                isTrue = false;
            } else spanTable.style.display = 'none';
            return isTrue;
        }

        function ajaxAddRole() {
            if (validateFormAddRole()) {
                var xhr = new XMLHttpRequest();
                var url = "Controller/trangadmin/Role/C_addNewRole.php";
                var formData = new FormData(document.getElementById("formAddRole"));

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert('Thêm thành công')
                            // Xử lý kết quả thành công ở đây nếu cần thiết
                            console.log(xhr.responseText);
                        } else {
                            alert('Thêm thất bại')
                            // Xử lý lỗi nếu cần thiết
                            alert('Error: ' + xhr.status);
                        }
                    }
                }
                console.log(formData);
                // Sử dụng phương thức POST để gửi dữ liệu form
                xhr.open("POST", url + "?addRole='1'&action=addRole", true);
                xhr.send(formData);
                window.location.href = '/WEB2/index.php?controller=trang-admin&action=role';
            }
        }
    </script>
</body>
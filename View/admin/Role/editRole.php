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
            <?php
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
            }
            $role = $db->getDataId('role', $id);
            ?>
            <label for="">Tên quyền:</label>
            <input type="text" id="name_role" name="name_role" value='<?php echo $role['decription'] ?>'>
            <span class="nameRoleValidation">Dữ liệu không hợp lệ</span>
            <input type="hidden" name="idRole" value='<?php echo $id ?>'>
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

            $rowsPQLD = $db->FindRole($id);
            foreach ($rowsCN as $rowCN) {
                $name = $rowCN['decription'];
                $idCN = $rowCN['id'];
                $viewChecked = '';
                $addChecked = '';
                $deleteChecked = '';
                $editChecked = '';
                foreach ($rowsPQLD as $pqld) {
                    if ($pqld['id_chucNang'] === $idCN) {
                        if ($pqld['HD'] === "View") {
                            $viewChecked = 'checked';
                        } elseif ($pqld['HD'] === "Add") {
                            $addChecked = 'checked';
                        } elseif ($pqld['HD'] === "Delete") {
                            $deleteChecked = 'checked';
                        } elseif ($pqld['HD'] === "Edit") {
                            $editChecked = 'checked';
                        }
                    }
                }


                echo "<tr>";
                echo "<td>$name</td>";
                echo "<td><input type='checkbox' name='view[$idCN]' $viewChecked></td>";
                echo "<td><input type='checkbox' name='add[$idCN]' $addChecked></td>";
                echo "<td><input type='checkbox' name='delete[$idCN]' $deleteChecked></td>";
                echo "<td><input type='checkbox' name='edit[$idCN]' $editChecked></td>";
                echo "</tr>";
            }
            ?>

        </table>
        <span class="validationTableRole">Vui lòng chọn ít nhất một ô</span>
        <button type="button" name="addRole" id="addRole" value="Thêm" onclick="ajaxAddRole()">Thêm</button>
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
                var url = "Controller/trangadmin/Role/C_editRole.php";
                var formData = new FormData(document.getElementById("formAddRole"));

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Hiển thị thông báo từ phía server
                            alert(xhr.responseText);
                            // Làm mới trang sau khi thông báo đã được hiển thị
                            window.location.href = '/WEB2/index.php?controller=trang-admin&action=role';
                        } else {
                            alert('Cập nhật thất bại');
                            alert('Error: ' + xhr.status);
                        }
                    }
                }

                // Sử dụng phương thức POST để gửi dữ liệu form
                xhr.open("POST", url + "?addRole='1'&action=addRole", true);
                xhr.send(formData);
            }

        }
    </script>
</body>
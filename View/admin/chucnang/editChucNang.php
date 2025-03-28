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
</style>

<body>
<?php
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    } else $id = 1;
    $data = $db->getDataId('chucnang', $id);
    ?>
    <div class="container">
        <div class="themuser">
            <h3>Sửa chức năng</h3>
            <form action="Controller/trangadmin/ChucNang/C_editChucNang.php" method="POST" class="form">
                <input type="hidden" name="id" value=<?php echo $id?>>
                <label for="">Tên Chức năng</label> </br>
                <input type="text" id="nameCN" name="nameCN" value="<?php echo $data['decription']?>"><br>
                <input type="submit" name="edit_CN" value="Cập nhật">
            </form>
            <?php
            if (isset($alert) && $alert == 'add_success') {
                echo "<p style='color: green; align-item: center;'>Sửa thành công</p>";
            } else return;
            ?>

        </div>


    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .valiFormAddTour {
        display: none;
        color: red;
    }

    #ImgValidation1,
    #ImgValidation2,
    #ImgValidation3 {
        font-size: 12px;
        display: none;
        color: red;
    }





    #formAddTour {
        /* margin-left: 220px;
        margin-top: 80px; */
    }

    .box-up-img {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-left: 22px;
    }

    .valiFormAddTour{
        font-size: 12px;
        margin-bottom: 3px;
    }

    #btnAddTour {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #4880ff;
        color: white;
        cursor: pointer;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .themuser {
        width: 600px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        margin-top: 50px;
    }

    .themuser h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .themuser form label {
        display: block;
        margin-bottom: 8px;
    }

    .themuser form input[type="text"],
    .themuser form input[type="number"] {
        width: 275px;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #f5f6fa;
    }

    .themuser form select {
        background-color: #f5f6fa;
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .themuser form textarea {
        background-color: #f5f6fa;
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .alert {
        color: green;
        text-align: center;
    }

    .form--inner {
        display: flex;
        gap: 50px;
    }


    .inputfile {
        display: none;
    }

    .file-upload {
        width: 150px;
        /* Kích thước của khối hình vuông */
        height: 100px;
        /* Kích thước của khối hình vuông */
        position: relative;
        overflow: hidden;
        border: 2px dashed #ccc;
        /* Đường viền đứt */
    }

    .file-upload span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        /* Kích thước của dấu cộng */
        color: #999;
        /* Màu của dấu cộng */
    }

    .uploaded-image {
        display: none;
        width: 100%;
        /* Kích thước của hình ảnh */
        height: 100%;
        /* Kích thước của hình ảnh */
        object-fit: cover;
        /* Hiển thị hình ảnh mà không bị chiếm đối tượng */
    }

    /* Hiển thị hình ảnh khi người dùng chọn hình */
    .inputfile:focus+.file-upload #uploaded-image1 {
        display: block;
    }
    .inputfile:focus+.file-upload #uploaded-image2 {
        display: block;
    }
    .inputfile:focus+.file-upload #uploaded-image3 {
        display: block;
    }
</style>

<body>
    <div class="container">
        <div class="themuser">
            <h3>Thêm Tour</h3>
            <form id="formAddTour" action="Controller/trangadmin/Tour/C_addNewTour.php" method="post" enctype="multipart/form-data">
                <div class="form--inner">
                    <div class="flex">
                        <input type="hidden" name="action" value="addTour">
                        <div class="containFieldAddTour">
                            <label for="title">Tiêu đề</label> 
                            <input id="title" name="title" type="text">
                            <span class="valiFormAddTour" id="titleValidation">Tiêu đề không hợp lệ</span>
                        </div>
                        <div class="containFieldAddTour">
                            <label for="selectCate">Loại</label> 
                            <select name="category" id="selectCate">
                                <?php
                                $rowsCate = $db->getAllData('category');
                                foreach ($rowsCate as $rowCate) {
                                    echo "<option name='selectCate' value='" . $rowCate['id'] . "'>" . $rowCate['name_category'] . "</option>";
                                }
                                ?> 
                            </select>
                            <span class="valiFormAddTour" id="categoryValidation">Vui lòng chọn trường này</span>
                        </div>
                        <div class="containFieldAddTour">
                            <label for="selectProvin">Tỉnh thành</label> 
                            <select name="provincial" id="selectProvin">
                                <?php
                                $rowsProvin = $db->getAllData('provincial');
                                foreach ($rowsProvin as $rowProvin) {
                                    echo "<option name='selectRole' value='" . $rowProvin['id'] . "'>" . $rowProvin['name_procince'] . "</option>";
                                }
                                ?>
                            </select>
                            <span class="valiFormAddTour" id="provincialValidation">Vui lòng chọn trường này</span>
                        </div>

                    </div>
                    <div class="flex">
                        <div class="containFieldAddTour">
                            <label for="price">Giá gốc</label> 
                            <input name="price" type="number">
                            <span class="valiFormAddTour" id="priceValidation">Dữ liệu không hợp lệ</span>
                        </div>
                        <div style="display: none;" class="containFieldAddTour">
                            <label for="acount">Số lượng</label> 
                            <input name="acount" type="number">
                            <span class="valiFormAddTour" id="acountValidation">Dữ liệu không hợp lệ</span>
                        </div>
                        <div class="containFieldAddTour">
                            <label for="address">Địa chỉ</label> 
                            <input name="address" type="text">
                            <span class="valiFormAddTour" id="addressValidation">Dữ liệu không hợp lệ</span>
                        </div>
                    </div>

                </div>
                <div class="containFieldAddTour">
                    <label for="">Chọn ảnh</label> <br>
                    <div class="box-up-img">
                        <input type="file" name="img1" id="img1" class="inputfile" accept="image/*">
                        <label for="img1" class="file-upload">
                            <span class="spanplus">+</span>
                            <img class="uploaded-image" id="uploaded-image1" src="#" alt="Uploaded Image">
                        </label> <br>
                        <span id="ImgValidation1">Dữ liệu không hợp lệ</span><br>

                        <input type="file" name="img2" id="img2" class="inputfile" accept="image/*">
                        <label for="img2" class="file-upload">
                            <span class="spanplus">+</span>
                            <img class="uploaded-image" id="uploaded-image2" src="#" alt="Uploaded Image">
                        </label><br>
                        <span id="ImgValidation2">Dữ liệu không hợp lệ</span><br>

                        <input type="file" name="img3" id="img3" class="inputfile" accept="image/*">
                        <label for="img3" class="file-upload">
                            <span class="spanplus">+</span>
                            <img class="uploaded-image" id="uploaded-image3" src="#" alt="Uploaded Image">
                        </label><br>
                        <span id="ImgValidation3">Dữ liệu không hợp lệ</span><br>
                    </div>
                </div>


                <div class="containFieldAddTour">
                    <label for="content">Nội dung</label> <br>
                    <textarea name="content" rows="4" cols="50"></textarea>
                    <span class="valiFormAddTour" id="contentValidation">Dữ liệu không hợp lệ</span>
                </div>
                <button type="submit" name="btnAddTour" id="btnAddTour" value="Thêm">Thêm</button>
            </form>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('.inputfile').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                var $uploadedImage = $(this).next().find('.uploaded-image');
                var $plus = $(this).next().find('.spanplus');
                reader.onload = function(e) {
                    $uploadedImage.attr('src', e.target.result);
                    $uploadedImage.css('display', 'block');
                    $plus.css('display', 'none');
                }
                reader.readAsDataURL(file);
            });
        });
        var formAddTour = document.getElementById('formAddTour');
        var title = document.getElementById('title');
        var selectCate = document.getElementById('selectCate');
        var selectProvin = document.getElementById('selectProvin');
        var price = document.getElementsByName('price')[0];
        var acount = document.getElementsByName('acount')[0];
        var content = document.getElementsByName('content')[0];
        var address = document.getElementsByName('address')[0];
        var img1 = document.getElementsByName('img1')[0];
        var img2 = document.getElementsByName('img2')[0];
        var img3 = document.getElementsByName('img3')[0];

        document.getElementById('btnAddTour').addEventListener('click', function(e) {


            // Validation
            var isValid = true;
            

            if (title.value.trim() === '') {
                e.preventDefault();
                document.getElementById('titleValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('titleValidation').style.display = 'none';
            }

            if (selectCate.value.trim() === '') {
                e.preventDefault();
                document.getElementById('categoryValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('categoryValidation').style.display = 'none';
            }

            if (selectProvin.value.trim() === '') {
                e.preventDefault();
                document.getElementById('provincialValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('provincialValidation').style.display = 'none';
            }

            if (price.value.trim() === '' || price.value<0) {
                e.preventDefault();
                document.getElementById('priceValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('priceValidation').style.display = 'none';
            }

            if (content.value.trim() === '') {
                e.preventDefault();
                document.getElementById('contentValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('contentValidation').style.display = 'none';
            }

            if (address.value.trim() === '') {
                e.preventDefault();
                document.getElementById('addressValidation').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('addressValidation').style.display = 'none';
            }

            // console.log(isValid)
            //img1
            var fileInput = document.getElementById('img1');
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var imageType = /image.*/;
                    if (file.type.match(imageType)) {
                        document.getElementById('ImgValidation1').style.display = 'none';
                    } else {
                        e.preventDefault();
                        document.getElementById('ImgValidation1').style.display = 'block';
                        fileInput.value = '';
                    }
                };
                reader.readAsDataURL(file);
            }
            //img2
            var fileInput = document.getElementById('img2');
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var imageType = /image.*/;
                    if (file.type.match(imageType)) {
                        document.getElementById('ImgValidation2').style.display = 'none';
                    } else {
                        e.preventDefault();
                        document.getElementById('ImgValidation2').style.display = 'block';
                        fileInput.value = '';
                    }
                };
                reader.readAsDataURL(file);
            }
            //img3
            var fileInput = document.getElementById('img3');
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var imageType = /image.*/;
                    if (file.type.match(imageType)) {
                        document.getElementById('ImgValidation3').style.display = 'none';
                    } else {
                        e.preventDefault();
                        document.getElementById('ImgValidation3').style.display = 'block';
                        fileInput.value = '';
                    }
                };
                reader.readAsDataURL(file);
                if(isValid) formAddTour.submit();
            }
        });
    </script>
</body>

</html>
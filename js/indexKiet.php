<body>
    <script>
        // chọn loại tour
        let chosseTour = document.getElementsByClassName('type-tour');
        for (var i = 0; i < chosseTour.length; i++) {
            chosseTour[i].addEventListener('click', function(e) {
                for (var j = 0; j < chosseTour.length; j++) chosseTour[j].classList.remove('chose-tour');
                this.classList.add('chose-tour')
            });
        }

        // chọn số lượng vé
        let numTicketphp = document.getElementsByName('numTicketphp')[0];
        let numTicketphp2 = document.getElementsByName('numTicketphp')[1];
        let totalMoneyphp = document.getElementsByName('totalMoneyphp')[0]; // cập nhật tiền để dùng php
        let btnPlus = document.getElementById('btn-plus');
        let btnMinus = document.getElementById('btn-minus');
        let numTicket = document.getElementById('numTicket');
        let num = numTicket.textContent;
        let percentVou = document.getElementsByClassName('percentVou')[0];
        btnPlus.addEventListener('click', function(e) {
            if (btnChonNgay.value == "0") {
                e.preventDefault();
                spanValidationDate.textContent = "Vui lòng chọn ngày đi";
                spanValidationDate.style.display = 'block';
                return;
            }
            var numMaxTicket = document.getElementsByClassName('maxTicket')[0].textContent
            if(numMaxTicket<=(num)){
                e.preventDefault();
                alert('Số vé còn lại không đủ');
                return;
            }
            num++;
            numTicket.textContent = num;
            numTicketphp.value = num;
            numTicketphp2.value = num;
            capnhatTongTien();
            capnhatGiamGia(percentVou.id)
        });
        btnMinus.addEventListener('click', function(e) {
            if (num > 0) {
                if (btnChonNgay.value == "0") {
                    e.preventDefault();
                    spanValidationDate.textContent = "Vui lòng chọn ngày đi";
                    spanValidationDate.style.display = 'block';
                    return;
                }
                num--;
                numTicket.textContent = num;
                numTicketphp2.value = num;
                numTicketphp.value = num;
                capnhatTongTien();
                capnhatGiamGia(percentVou.id)
            }
        });

        function capnhatTongTien() {
            let per = percentVou.id / 100 * 1.0;
            //bỏ validation
            if (num > 0) {
                spanValidationNumticket.style.display = 'none';
            }
            let gia1ve = document.getElementsByClassName('money-tamtinh')[0].id;
            let tongtienView = document.getElementById('totalMoney');
            let x = gia1ve * num;
            totalMoneyphp.value = x - x * per * 1.0;
            x = x.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            tongtienView.textContent = x;
        }

        // chọn ngày, validation phải sau ngày hiện tại
        let datePhp = document.getElementsByName('datePhp')[0]; // cập nhật ngày để dùng php
        let btnChonNgay = document.getElementsByName('datePhp')[0];
        let btnChonNgayCoSan = document.getElementsByClassName('select-date');
        let spanValidationDate = document.getElementsByClassName('validation')[0];
        for (var i = 0; i < btnChonNgayCoSan.length; i++) {
            btnChonNgayCoSan[i].addEventListener('click', function() {
                for (var i = 0; i < btnChonNgayCoSan.length; i++) {
                    btnChonNgayCoSan[i].style.backgroundColor = "#fff";
                    btnChonNgayCoSan[i].style.color = "#000";
                }
                this.style.backgroundColor = "#ff5b00";
                this.style.color = "#fff";
                datePhp.value = this.textContent;
                spanValidationDate.style.display = 'none';
                var priceNe = this.id;
                document.getElementsByName('priceTourNe')[0].value = priceNe;
                priceNe = formatCurrencyVND(priceNe);
                document.getElementsByClassName('money-tamtinh')[0].textContent = "Giá từ: " + priceNe;
                document.getElementsByClassName('money-tamtinh')[0].id = this.id; //idTicket idTicketCart
                document.getElementsByName('idTicketCart')[0].value = this.getAttribute('data-idTicket');
                document.getElementsByName('idTicket')[0].value = this.getAttribute('data-idTicket');
                var numTicket = this.nextElementSibling;
                // Lấy id của '.numTicket'priceTour
                document.getElementsByClassName('maxTicket')[0].textContent = numTicket.id;

                // Lấy ngày hiện tại
                // var today = new Date();

                // // Lấy giá trị ngày được chọn từ input
                // var selectedDate = new Date(document.getElementById("select-date").value);

                // // Kiểm tra xem ngày được chọn có sau ngày hôm nay không
                // if (selectedDate <= today) {
                //     spanValidationDate.textContent = "Không được chọn ngày đã qua";
                //     spanValidationDate.style.display = 'block';
                //     // Đặt giá trị của input ngày thành rỗng để yêu cầu người dùng nhập lại
                //     document.getElementById("select-date").value = "";
                // } else {
                //     spanValidationDate.style.display = 'none';
                //     var formattedDate = selectedDate.getFullYear() + '-' + ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' + ('0' + selectedDate.getDate()).slice(-2);
                //     datePhp.value = formattedDate;
                // }
                capnhatTongTien();
            })
        }

        function formatCurrencyVND(amount) {
            if (amount == null) return 0;
            // Chuyển số thành chuỗi
            var amountString = amount.toString();

            // Tạo một mảng để lưu trữ từng phần của số
            var parts = [];

            // Tạo một biến đếm để theo dõi vị trí của dấu chấm (phân tách hàng nghìn)
            var count = 0;

            // Duyệt qua từng ký tự của chuỗi số, bắt đầu từ cuối
            for (var i = amountString.length - 1; i >= 0; i--) {
                // Thêm ký tự vào phần tử đầu tiên của mảng parts
                parts.unshift(amountString[i]);
                // Tăng biến đếm lên 1
                count++;
                // Nếu biến đếm là 3 và chưa ở cuối chuỗi số
                if (count % 3 === 0 && i !== 0) {
                    // Thêm dấu chấm vào trước số vừa thêm vào mảng parts
                    parts.unshift(',');
                }
            }

            // Ghép các phần của số và thêm dấu '₫'
            return parts.join('') + ' đ ';
        }

        // Sử dụng hàm để định dạng số tiền và gán vào phần tử HTML
        // document.getElementsByClassName('money-tamtinh')[0].textContent = formatCurrencyVND(this.id);

        // scroll đến gói dịch vụ
        let btnScrollDichVu = document.getElementsByClassName('btn-chosse-dichvu')[0];
        btnScrollDichVu.addEventListener('click', function() {
            var targetDiv = document.getElementsByClassName("package-option")[0];
            var offsetTop = targetDiv.offsetTop - 74; // 100px độ lệch từ đỉnh của div
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        })

        // validation các trường dịch vụ
        let btnBuyNow = document.getElementsByClassName('buy-now')[0];
        let btnAddCart = document.getElementsByClassName('add-cart')[0];
        let btnBuyNow2 = document.getElementsByClassName('buy-now')[1];
        let flag2 = 0;
        let spanValidationNumticket = document.getElementsByClassName('validation')[1];
        btnBuyNow.addEventListener('click', function(e) {
            <?php
            //session_start();

            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {
                // Nếu người dùng đã đăng nhập
            ?>
                flag2 = 0;
                if (btnChonNgay.value == "0") {
                    e.preventDefault();
                    spanValidationDate.textContent = "Vui lòng chọn ngày đi";
                    spanValidationDate.style.display = 'block';
                    flag2++;
                }
                if (num == 0) {
                    e.preventDefault();
                    spanValidationNumticket.style.display = 'block';
                    flag2++;
                }
                if (flag2 == 0) {
                    formBookTour.style.display = 'block';
                    nenDen.style.display = 'block';
                    setTimeout(function() {
                        formBookTour.style.transform = 'translate(0%, 0%) scale(1)';
                    }, 50);
                }
            <?php
            } else {

            ?>
                alert("Vui lòng đăng nhập trước khi mua hàng")
                e.preventDefault();
            <?php } ?>
        })
        btnAddCart.addEventListener('click', function(e) {
            <?php
            //session_start();

            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {
                // Nếu người dùng đã đăng nhập
            ?>
                let flag3 = 0;
                if (btnChonNgay.value == "0") {
                    e.preventDefault();
                    spanValidationDate.textContent = "Vui lòng chọn ngày đi";
                    spanValidationDate.style.display = 'block';
                    flag3++;
                }
                if (num == 0) {
                    e.preventDefault();
                    spanValidationNumticket.style.display = 'block';
                    flag3++;
                }
                if (flag3 == 0) {
                    //e.preventDefault();
                    // alert('e')
                    animationAddCart(this);
                    addToCart();
                    // setTimeout(function() {
                    //     document.getElementById('submitAddcart').submit();
                    // }, 1000);
                }
            <?php
            } else {

            ?>
                alert("Vui lòng đăng nhập trước khi thêm vào giỏ hàng")
                e.preventDefault();
            <?php } ?>
        })
        let formBookTour = document.getElementById('form-book-tour');
        let hoTen = document.getElementsByClassName('hoTen')[0];
        let email = document.getElementsByClassName('email')[0];
        let sodienthoai = document.getElementsByClassName('sodienthoai')[0];
        let diachi = document.getElementsByClassName('diachi')[0];
        let spanValidation2 = document.getElementsByClassName('validation')[2];
        let spanValidation3 = document.getElementsByClassName('validation')[3];
        let spanValidation4 = document.getElementsByClassName('validation')[4];
        let spanValidation5 = document.getElementsByClassName('validation')[5];
        let spanValidation6 = document.getElementsByClassName('validation')[6];
        let flag = 0;

        function valiHoten() {
            let regexChuoiKhongRong = /^(?!\s*$).+/;
            if (!regexChuoiKhongRong.test(hoTen.value) || hoTen.value == "") {
                spanValidation2.style.display = 'block';
                flag++;
            } else {
                spanValidation2.style.display = 'none';
            }
        }

        hoTen.addEventListener('blur', function() {
            valiHoten();
        })

        function valiEmail() {
            let regexEmail = /^\S+@\S+\.\S+$/;
            if (!regexEmail.test(email.value)) {
                spanValidation3.style.display = 'block';
                flag++;
            } else {
                spanValidation3.style.display = 'none';
            }
        }
        email.addEventListener('blur', function() {
            valiEmail();
        })

        function valiSodienthoai() {
            let regexSDT = /^0\d{9}$/;
            if (!regexSDT.test(sodienthoai.value)) {
                spanValidation4.style.display = 'block';
                flag++;
            } else {
                spanValidation4.style.display = 'none';
            }

        }
        sodienthoai.addEventListener('blur', function() {
            valiSodienthoai();
        })

        function valiDiachi() {
            let regexChuoiKhongRong = /^(?!\s*$).+/;
            if (!regexChuoiKhongRong.test(diachi.value) || diachi.value == "") {
                spanValidation5.style.display = 'block';
                flag++;
            } else {
                spanValidation5.style.display = 'none';
            }

        }
        diachi.addEventListener('blur', function() {
            valiDiachi();
        })
        btnBuyNow2.addEventListener('click', function(e) {
            flag = 0;
            valiHoten();
            valiEmail();
            valiSodienthoai();
            valiDiachi();
            if (flag != 0) {
                e.preventDefault();
            }
        })

        // click vào nền đen thì ẩn đi form
        let nenDen = document.getElementsByClassName('nen-den')[0];
        nenDen.addEventListener('click', function() {
            nenDen.style.display = 'none';
            formBookTour.style.display = 'none';
            vouchers.style.display = 'none';
            formBookTour.style.transform = 'translate(0%, 0%) scale(0)';
            vouchers.style.transform = 'translate(0%, 0%) scale(0)';
        })



        // css khi nhấn vào ô input thì hiện border ra từ từ
        let inputFieldForm = document.getElementsByClassName('inputField-tourForm');
        for (var i = 0; i < inputFieldForm.length; i++) {

            inputFieldForm[i].addEventListener('focus', function() {
                this.classList.add('input-focus'); // Thêm class 'input-focus' khi focus
            });

            // Thêm sự kiện blur
            inputFieldForm[i].addEventListener('blur', function() {
                this.classList.remove('input-focus'); // Loại bỏ class 'input-focus' khi blur
            });
        }

        // fixed nút tạm tính bên phải
        window.addEventListener('scroll', function() {
            var myDiv = document.getElementsByClassName('tam-tinh')[0];
            var scrollTop = window.scrollY;
            if (scrollTop >= 630) {
                myDiv.style.position = 'fixed';
                myDiv.style.left = 'calc(70%)';
                myDiv.style.top = '138px';
            } else {
                myDiv.style.position = 'absolute';
                myDiv.style.left = '880px';
                myDiv.style.top = '0';
            }
        });


        // test hiệu ứng
        function animationAddCart(e) {
            var btn = e;
            var cartIcon = document.getElementById('cartIcon');
            var cartCount = document.getElementById('numCart');
            //console.log(cartIcon)
            // Tính toán vị trí của biểu tượng giỏ hàng
            var cartIconRect = cartIcon.getBoundingClientRect();
            var cartIconX = cartIconRect.left + (cartIconRect.width / 2) + window.pageXOffset;
            var cartIconY = cartIconRect.top + (cartIconRect.height / 2) + window.scrollY;
            console.log(cartIconX + " " + cartIconY)
            // Tạo khối di chuyển
            var movingBlock = document.createElement('div');
            movingBlock.id = 'moving-block';
            document.body.appendChild(movingBlock);

            // Lấy kích thước của nút "Thêm vào giỏ hàng"
            var btnRect = btn.getBoundingClientRect();
            var btnX = btnRect.left + (btnRect.width / 2) + window.pageXOffset;
            var btnY = btnRect.top + (btnRect.height / 2) + window.scrollY;
            //console.log(btnX + " " + btnY)

            // Thiết lập vị trí ban đầu cho khối di chuyển
            movingBlock.style.left = btnX + 'px';
            movingBlock.style.top = btnY + 'px';
            movingBlock.style.display = 'block';
            //console.log(movingBlock)
            // Di chuyển khối đến vị trí của biểu tượng giỏ hàng
            setTimeout(function() {
                movingBlock.style.transition = 'left 1s, top 1s';
                movingBlock.style.left = cartIconX + 'px';
                movingBlock.style.top = cartIconY + 'px';
            }, 50);

            // Xóa khối di chuyển sau khi hoàn thành
            setTimeout(function() {
                movingBlock.parentNode.removeChild(movingBlock);
                var count = cartCount.textContent;
                count++;
                cartCount.textContent = count;
                cartIcon.classList.add('shake');
                setTimeout(function() {
                    cartIcon.classList.remove('shake');
                }, 500);
            }, 900);
        };
        // nếu nhập cmt thì mới hiện nút gửi
        let btnSendCmt = document.getElementsByName('send-cmt')[0];
        let txtareaCmt = document.getElementsByClassName('text-cmt')[0];
        btnSendCmt.addEventListener('click', function(e) {
            <?php
            //session_start();

            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {
                // Nếu người dùng đã đăng nhập
            ?>
                if (txtareaCmt.value.length == 0) {
                    e.preventDefault();
                }
            <?php
            } else {

            ?>
                alert("Vui lòng đăng nhập trước khi bình luận")
                e.preventDefault();
            <?php } ?>
        })

        // js cho chọn số sao bình luận
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingValue.value = value;
                console.log(ratingValue.value)
                highlightStars(value);
            });
        });

        function highlightStars(value) {
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }

        // chọn voucher
        let btnVoucher = document.getElementsByClassName('discount')[0];
        let vouchers = document.getElementsByClassName('vouchers')[0];
        btnVoucher.addEventListener('click', function() {
            vouchers.style.display = 'block';
            nenDen.style.display = 'block';
            setTimeout(function() {
                vouchers.style.transform = 'translate(0%, 0%) scale(1)';
            }, 50);
        })


        // AJAX add cart
        function addToCart() {
            var formData = new FormData(document.getElementById('submitAddcart'));
            var queryString = "";
            for (var pair of formData.entries()) {
                queryString += encodeURIComponent(pair[0]) + '=' + encodeURIComponent(pair[1]) + '&';
            }
            queryString = queryString.slice(0, -1); // Loại bỏ ký tự '&' cuối cùng

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Xử lý phản hồi từ server
                    console.log(queryString);
                    // Cập nhật giao diện nếu cần
                }
            };
            xhr.open("GET", "/WEB2/Controller/chitietTour/buyTour.php?" + queryString, true);
            xhr.send();
        }
        var buttons = document.querySelectorAll('.btn-use-card');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (num == 0) {
                    alert("Vui lòng chọn số vé trước khi chọn mã");
                    return;
                }
                if (this.id == 0) {
                    alert("Voucher này đã hết hạn sử dụng");
                    return;
                }
                buttons.forEach(function(btn) {
                    btn.textContent = "Sử dụng";
                    btn.style.backgroundColor = "#f08044"; // Đặt lại màu ban đầu
                });
                document.getElementsByClassName('giamgia')[0].style.display = 'block';
                var parentCard = this.closest('.use-card');
                var percent = parseInt(parentCard.querySelector('.percentDIV').textContent.match(/\d+/)[0]);
                capnhatGiamGia(percent);
                document.getElementById('totalMoney').style = "text-decoration: line-through;";
                this.textContent = "Đã chọn"
                this.style = "background-color: green;"
            });
        });

        function capnhatGiamGia(e) {
            if (document.getElementById('idVoucher') != null)
                document.getElementsByName('idVoucher')[0].value = document.getElementById('idVoucher').textContent;
            // Lấy phần trăm giảm

            percentVou.id = e;
            capnhatTongTien();

            // Lấy tổng số tiền hiện tại
            var totalMoneyText = document.getElementById('totalMoney').textContent;
            var totalMoney = parseInt(totalMoneyText.replace(/\D/g, ''));

            // Tính toán và cập nhật tổng số tiền mới
            var newTotal = totalMoney - (totalMoney * e / 100);
            var finalTotal = newTotal.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            //document.getElementById('totalMoney').textContent = finalTotal;
            document.getElementById('newPrice').innerHTML = newTotal.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }); // Giá mới sau khi giảm giá
            document.getElementById('discountAmount').innerHTML = "-" + (totalMoney * e / 100).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }); // Số tiền đã trừ
        }
    </script>
</body>
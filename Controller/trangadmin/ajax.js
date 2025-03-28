<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>;

$(document).ready(function () {
    // Khi trang đã tải xong
    checkUrl(); // Kiểm tra và thêm class active cho phần tử thanh điều hướng

    $(".nav-admin-item-a").click(function (e) {
        // Khi một phần tử .nav-admin-item được nhấp vào
        e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

        var url = $(this).attr("href"); // Lấy đường dẫn từ thuộc tính href của thẻ a

        // Gửi yêu cầu Ajax
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                // Nếu yêu cầu Ajax thành công
                // Cập nhật nội dung của trang
                $("body").html(data);

                // Thay đổi URL của trình duyệt mà không làm tải lại trang
                history.pushState(null, null, url);

                // Kiểm tra và thêm class active cho phần tử thanh điều hướng
                checkUrl();
            },
            error: function (xhr, status, error) {
                // Nếu có lỗi xảy ra
                // Xử lý lỗi nếu có
                console.error(error);
            },
        });
    });

    // Lắng nghe sự kiện khi người dùng bấm nút Back/Forward trên trình duyệt
    window.onpopstate = function (event) {
        // Thực hiện lại yêu cầu Ajax khi người dùng quay lại trang trước đó
        $.ajax({
            url: location.href, // Sử dụng đường dẫn hiện tại
            type: "GET",
            success: function (data) {
                // Nếu yêu cầu Ajax thành công
                // Cập nhật nội dung của trang
                $("body").html(data);
                // Thay đổi URL của trình duyệt mà không làm tải lại trang
                // Kiểm tra và thêm class active cho phần tử thanh điều hướng
                checkUrl();
            },
            error: function (xhr, status, error) {
                // Nếu có lỗi xảy ra
                // Xử lý lỗi nếu có
                console.error(error);
            },
        });
    };

    // Hàm kiểm tra và thêm class active cho phần tử thanh điều hướng
    function checkUrl() {
        // Lấy action từ URL
        const urlParams = new URLSearchParams(window.location.search);
        const action = urlParams.get("action");
        // Kiểm tra action và thêm class active cho phần tử thanh điều hướng tương ứng
        if (
            action === "indexAdmin" ||
            action === "edit" ||
            action === "editrole" ||
            action === "add"
        ) {
            $("#page1").addClass("header-admin-active");
        } else if (
            action === "role" ||
            action === "editRole" ||
            action === "addRole"
        ) {
            $("#page2").addClass("header-admin-active");
        } else if (
            action === "tour" ||
            action === "editTour" ||
            action === "addTour" ||
            action === "ticket" ||
            action === "addTicket" ||
            action === "editTicket"
        ) {
            $("#page3").addClass("header-admin-active");
        } else if (action === "dsbl") {
            $("#page4").addClass("header-admin-active");
        } else if (action === "dsvoucher" || action === "suavoucher") {
            $("#page5").addClass("header-admin-active");
        } else if (action === "dthongke") {
            $("#page6").addClass("header-admin-active");
        } else if (action === "order" || action === "detailOrder") {
            $("#page7").addClass("header-admin-active");
        } else if (action === "chucnang") {
            $("#page0").addClass("header-admin-active");
        }
    }
});

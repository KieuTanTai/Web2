<script>
    $(document).ready(function() {
        function loadPage(page, table, numRow) {
            $.ajax({
                url: 'Controller/trangadmin/C_PhanTrangTour.php',
                type: 'GET',
                data: {
                    page: page,
                    table: table,
                    isEdit: <?php echo $isEdit ?>,
                    isDelete: <?php echo $isDelete ?>,
                    numRow: numRow
                },
                success: function(response) {
                    // alert(page)
                    var htmlData = JSON.parse(response);
                    $('.' + 'table-body').html(htmlData.table);
                    $('.' + 'paging').html(htmlData.paging);
                    if ($('.paging .pagination').length === 1) {
                        $('.paging').hide(); // Ẩn phần tử .paging
                    } else $('.paging').show();
                    $('.pagination').css('background-color', '#fff'); // Đặt lại màu nền cho tất cả các nút phân trang
                    $('[data-page="' + page + '"].pagination').css('background-color', '#4880ff');
                    // displayPrevNext(page, $('.pagination').length);
                    var prevPage = $('.prevPage');
                    var nextPage = $('.nextPage');
                    if (page == 1) prevPage.hide();
                    else prevPage.show();
                    if (page == $('.pagination').length) nextPage.hide();
                    else nextPage.show();
                    prevPage.attr('data-page', parseInt(page) - 1); // Cập nhật data-page cho nút "Prev"
                    nextPage.attr('data-page', parseInt(page) + 1);
                },
                complete: function() {
                    // Kích hoạt lại select sau khi Ajax hoàn thành, ngay cả khi có lỗi xảy ra
                    $('#selectNumRow').prop('disabled', false);
                }
            });
        }

        $(document).on('click', '.pagination', function() {
            var page = $(this).attr('data-page');
            var table = $(this).attr('data-table');
            var selectedValue = $('#selectNumRow').val();
            loadPage(page, table, selectedValue);
        });

        $(document).on('click', '.prevPage, .nextPage', function() {
            var page = $(this).attr('data-page');
            // alert(page)
            var table = $(this).attr('data-table');
            var selectedValue = $('#selectNumRow').val();
            loadPage(page, table, selectedValue);
        });
        $('#selectNumRow').change(function() {
            var selectedValue = $(this).val();
            var table = $('.prevPage').attr('data-table');
            loadPage(1, table, selectedValue);
        });
        loadPage(1, '<?php echo $table ?>');
        // loadPage(1, 'table2');
    });
</script>
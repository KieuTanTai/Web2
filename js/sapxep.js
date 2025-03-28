var columnSortDirection = {}; // Đối tượng lưu trữ hướng sắp xếp của mỗi cột
var table = document.getElementById('tableData');
var headerRow = table.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0];
var columns = headerRow.getElementsByTagName('th').length;
function sortTable(columnIndex) {
    var rows = table.getElementsByTagName('tr');
    var switching = true;
    var shouldSwitch = false;

    // Xác định hướng sắp xếp của cột
    var direction = columnSortDirection[columnIndex] || 'asc';

    while (switching) {
        switching = false;
        for (var i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            var x = rows[i].getElementsByTagName('td')[columnIndex];
            var y = rows[i + 1].getElementsByTagName('td')[columnIndex];
            var xContent = removeDots(x.innerHTML.trim());
            var yContent = removeDots(y.innerHTML.trim());

            // Kiểm tra nếu dữ liệu là số
            var isNumeric = !isNaN(parseFloat(xContent)) && isFinite(xContent);

            if (direction === 'asc') {
                if (isNumeric) {
                    if (parseFloat(xContent) > parseFloat(yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (xContent.toLowerCase() > yContent.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else {
                if (isNumeric) {
                    if (parseFloat(xContent) < parseFloat(yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (xContent.toLowerCase() < yContent.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        } else {
            if (direction === 'asc') {
                direction = 'desc';
                resetImg()
                document.getElementById('sortIcon' + columnIndex).src = "images/arrow-point-to-down.png";
            } else {
                direction = 'asc';
                resetImg()
                document.getElementById('sortIcon' + columnIndex).src = "images/arrow-point-to-up.png";
            }
        }
    }

    // Lưu trữ hướng sắp xếp mới của cột
    columnSortDirection[columnIndex] = direction;
}


function resetImg() {
    for (let i = 0; i < columns; i++) {
        var iconSort = document.getElementById('sortIcon' + i);
        if(iconSort != null)
        iconSort.src = "images/arrow-point-to-up.png";
    }
}
function removeDots(str) {
    // Sử dụng phương thức replace với biểu thức chính quy
    return str.replace(/\./g, '');
}
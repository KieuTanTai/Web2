<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng HTML</title>
  <link rel="stylesheet" href="css/cssadmin.css">
</head>


<style>
  body{
    margin-top : 70px;
  }
  .abc{
    color : red;
  }
  .header{
    width: 100%;
    height: 80px;
    background-color:red;
  }
  .main{
    display: flex;
    column-gap: 55px;
  }

  .side-bar{
    width : 190px;
    height : 465px;
  }


  svg path {
    cursor: pointer;
  }


  .filter{
    /* display: flex; */
    margin-top:  10px;
    margin-bottom: 10px;
  }

  fieldset{
  display : flex;
  border : 1px solid black;
  padding: 10px;
  width : 800px;
}


  .date-start{
    margin-left : 20px;
  }

  .date-end{
    margin-left : 20px;
  }

  .input-date-start{
    margin-top: 3px;
  }

  .input-date-end{
    margin-top: 3px;
  }

  .submit{
    margin-left : 50px;
    width : 80px;
    height : 20.53px;
    border: 1px solid black;
    text-align: center;
    cursor: pointer;
  }

  .submit:active{
    background-color: black ;
    color : white;

  }

  .typeData{
    display : flex;
    column-gap : 15px;
    margin :10px 0px;
  }

  .btnData{
    width : 120px;
    height : 20.53px;
    border: 1px solid black;
    text-align: center;
    cursor: pointer;
  }

  .btnData:active{
    background-color: black ;
    color : white;
  }

  .hide{
    display: none;
  }

  .chartData{
    width : 1000px;
  }

  .so-dong-hien-thi{
    width: 50px;
  }

  .san-pham-ban-chay-nhat{
    border: 1px solid black;
    padding :2px;
    cursor: pointer;
    border-radius : 10px;
  }

  .san-pham-ban-chay-nhat:active{
    background-color: blue;
    color : white;
  }

  .btn-tuan{
    width: 120px;

  }

  .btn-thang{
    width: 140px;
    margin-left : 20px;

  }

  .btn{
    display :flex ;
    align-items : center;
    justify-content : center;
    border: 1px solid black;
    height: 39px;
    cursor: pointer;
    border-radius : 10px;
  }

  .btn:active{
    background-color: blue;
    color : white;
  }

</style>

<body>
<div class="main">
  <div class="side-bar"></div>
  <div class="content">
  <div class="filter">
  <fieldset>
    <legend>Lọc</legend>
    <select name="all" id="category" class = "category" onclick = "filterThongKe(event)">
      <option value="0">Tất cả</option>
      <option value="1">Tour</option>
      <option value="2">Du thuyền</option>
      <option value="3">Hoạt động dưới nước</option>
      <option value="4">Phiêu lưu và khám phá thiên nhiên</option>
      <option value="5">Trải nghiệm văn hóa</option>
    </select>
    <div class="date-start" onchange = "filterThongKe(event)">
      <label for="input-date-start">Ngày bắt đầu : </label>
      <input type="date" name="input-date-start" id="input-date-start" class="input-date-start" onchange = "selectDateStart(event)">
    </div>
    <div class="date-end" onchange = "filterThongKe(event)">
      <label for="input-date-end">Ngày kết thúc : </label>
      <input type="date" name="input-date-end" id="input-date-end" class="input-date-end" onchange = "selectDateEnd(event)">
    </div>
    <div class="btn-tuan btn" onclick = "filterTheoTuan(event)">Theo tuần</div>
    <div class="btn-thang btn" onclick = "filterTheoThang(event)">Theo tháng</div>
  </fieldset>
  </div>
  <div class="typeData">
    <select name="sapxep" id="sapxep" class="sapxep hide" onclick = "filterThongKe(event)">
      <option value="-1">Chọn kiểu sắp xếp</option>
      <option value="0">Sắp xếp tăng dần</option>
      <option value="1">Sắp xếp giảm dần</option>
    </select>
    <select name="kieudulieu" id="kieudulieu" class="kieudulieu hide" onchange = "filterThongKe(event)">
      <option value="0">Bảng</option>
      <option value="1">Biểu đồ</option>
    </select>
    <div class="input-so-dong-hien-thi hide" onchange = "filterThongKe(event)">
      <label for="">Số dòng : </label>
      <input type="number" class ="so-dong-hien-thi" value ="5">
    </div>
    <div class="san-pham-ban-chay-nhat 0 hide" onclick = "sanPhamBanChay(event)">Sản phẩm bán chạy nhất</div>
  </div>
  <table border="1" class = "tableData custom-table">
    <thead class = "titleTable hide table-head">
      <tr class = "table--head">
        <th class="table-header">Stt
          <svg  width="16" height="16" fill="currentColor" class="coll id asc hide" viewBox="0 0 16 16">
            <path onclick = "filterThongKe(event)"  class="coll" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          </svg>

          <svg  width="16" height="16" fill="currentColor" class="coll id desc " viewBox="0 0 16 16" >
            <path onclick = "filterThongKe(event)" class="coll" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
          </svg>
        </th>
        <th class="table-header">Tên
        <svg  width="16" height="16" fill="currentColor" class="coll title asc" viewBox="0 0 16 16">
            <path onclick = "filterThongKe(event)"  class="coll" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          </svg>

          <svg  width="16" height="16" fill="currentColor" class="coll title desc hide" viewBox="0 0 16 16">
            <path onclick = "filterThongKe(event)"  class="coll" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
          </svg>
        </th>
        <th class="table-header">Số lượng đã bán
        <svg  width="16" height="16" fill="currentColor" class="coll amount asc" viewBox="0 0 16 16" >
            <path onclick = "filterThongKe(event)"  class="coll" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          </svg>

          <svg  width="16" height="16" fill="currentColor" class="coll amount desc hide" viewBox="0 0 16 16" >
            <path onclick = "filterThongKe(event)"  class="coll" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
          </svg>
        </th>
        <th class="table-header">Tổng tiền
        <svg  width="16" height="16" fill="currentColor" class="coll  total_money asc" viewBox="0 0 16 16">
            <path onclick = "filterThongKe(event)"  class="coll" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          </svg>

          <svg  width="16" height="16" fill="currentColor" class="coll  total_money desc hide" viewBox="0 0 16 16" >
            <path onclick = "filterThongKe(event)" class="coll" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
          </svg>
        </th>
      </tr>
    </thead>  
    <tbody class = "bodyTable">
    </tbody>
  </table>
  <div class = "chartData  hide" style = "width: 100%;">
    <canvas width="400px" height="200px" id="myChartSoLuong">
    </canvas>
    <canvas width="400px" height="200px" id="myChartDoanhThu">
    </canvas>
  </div>
  </div>
</div>
  <script src="./js/User/Jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="./js/ThongKe/thongke.js"></script>
</body>

</html>
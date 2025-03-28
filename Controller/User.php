<?php
//gia su da dang nhap thanh cong vo user 1
// function searchDiscounts---------------------
$idOrder;

function searchDiscount($idUser)
{
  $db = new Database();
  $db->connect();
  $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';
  $result = $db->resultSearchDiscount($searchTerm, $idUser);
  if (mysqli_num_rows($result) == 0) {
    echo '
          <div class="no-find-discount">
            <div class="title-no-find1">
              Mã mời khuyến mãi mới
            </div>
            <div class="title-no-find2">
              Bạn có mã ưu đãi? Nhập vào để lưu ở bên trên.Hoặc bạn có thể mời bạn bè sử dụng Klook và kiếm điểm thưởng.
            </div>
          </div>
          ';
    return;
  }
  while ($row = mysqli_fetch_array($result)) {
    $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
    // Tạo đối tượng DateTime cho hai mốc thời gian
    $now = new DateTime('now', $timezone); // Thời điểm hiện tại
    $futureDate = new DateTime($row['date_end'] . ' 23:59:59'); // Mốc thời gian trong tương lai
    if ($futureDate < $now) {
      continue;
    }
    // Tính khoảng thời gian giữa hai mốc
    $interval = $now->diff($futureDate);

    // Lấy số ngày còn lại từ DateInterval
    $daysRemaining = $interval->days;
    $hoursRemaining = $interval->h;
    echo '
                <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    ' . $row['discount_name'] . '
                  </div>
                  <div class="detail-infor-card">
                  ' . $row['description'] . '
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại ' . ($daysRemaining > 0 ? $daysRemaining : $hoursRemaining / 3) . ($daysRemaining > 0 ? ' ngày' : ' giờ') . '
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                ' . $row['code'] . '
                </div>
                <button class="btn-use-card" onclick ="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
              ';
  }
  $db->disconnect();
}

// function nameUser---------------------

function nameUser($idUser)
{
  $db = new Database();
  $db->connect();
  $nameChange = isset($_POST['nameChange']) ? $_POST['nameChange'] : '';
  $db->resultNameUser($idUser, $nameChange);
  $db->disconnect();
}

function emailUser($idUser)
{
  $db = new Database();
  $db->connect();
  $emailChange = isset($_POST['emailChange']) ? $_POST['emailChange'] : '';
  $db->resultEmailUser($idUser, $emailChange);
  $db->disconnect();
}

function addressUser($idUser)
{
  $db = new Database();
  $db->connect();
  $addressChange = isset($_POST['addressChange']) ? $_POST['addressChange'] : '';
  $db->resultAddressUser($idUser, $addressChange);
  $db->disconnect();
}

function sdtUser($idUser)
{
  $db = new Database();
  $db->connect();
  $sdtChange = isset($_POST['sdtChange']) ? $_POST['sdtChange'] : '';
  $db->resultsdtUser($idUser, $sdtChange);
  $db->disconnect();
}

function loadDataDonHang()
{
  include_once "../Model/DBConfig.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $db = new Database();
  $db->connect();
  $result = $db->getDataDonHang($_SESSION['idUserLogin']);
  $db->disconnect();
  return $result;
}

$tongTien = 0;
function getDataDetailDH($idOrder)
{
  include_once "../Model/DBConfig.php";
  $db = new Database();
  $db->connect();
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $result = $db->getDataChiTietDonHang($idOrder, $_SESSION['idUserLogin']);
  $db->disconnect();
  return $result;
}



// excute function
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'nameUser') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    nameUser($_SESSION['idUserLogin']);
  }
  if ($_POST['action'] == 'searchDiscount') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    searchDiscount($_SESSION['idUserLogin']);
  }
  if ($_POST['action'] == 'emailUser') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    emailUser($_SESSION['idUserLogin']);
  }
  if ($_POST['action'] == 'addressUser') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    addressUser($_SESSION['idUserLogin']);
  }
  if ($_POST['action'] == 'sdtUser') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    sdtUser($_SESSION['idUserLogin']);
  }

  if ($_POST['action'] == 'orderDetail') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $idOrder = isset($_POST['idOrder']) ? $_POST['idOrder'] : '';
    $result = getDataDetailDH($idOrder);
    $tongTien = 0;
    $detail = '';
    $percent = 0;
    $n = 0;
    if (mysqli_num_rows($result) <= 0)
      echo "khong co ket qua";
    else {
      while ($row = mysqli_fetch_array($result)) {
        $urlIMG = '../../images/heart.png';
        $imageData = $row['image'];
        $urlIMG = 'data:image/jpeg;base64,' . base64_encode($imageData) . '';
        echo '
          <a class="detail-dh" href = "./Controller/chitietTour/buyTour.php?id=' . $row['id'] . '&category=' . $row['id_category'] . '">
            <img loading="lazy" src=" ' . $urlIMG . '" alt="" class = "col-1 img">
            <div class="col-2">
              <div class="name">' . $row['title'] . '</div>
              <div class="date-go"> Ngày đi : ' . $row['date_go'] . '</div>
              <div class="amount">Số lượng : ' . $row['amount'] . '</div>
              <div class="col-3 price"> Tổng tiền : ' . number_format($row['price'] * $row['amount']) . ' VNĐ</div>
            </div>
          </a>
          ';
        $tongTien = $tongTien + $row['price'] * $row['amount'];
        $percent = $percent + $row['percent'];
        $n++;
      }
    }
    echo '(' . $tongTien . ')(' . $percent / $n . ')';
  }

  if ($_POST['action'] == 'destroyOrder') {
    require_once ('../Model/DBConfig.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $idOrder = isset($_POST['idOrder']) ? $_POST['idOrder'] : '';
    $db = new Database();
    $db->destroyOrder($idOrder);
    $i = 1;
    $result = loadDataDonHang();
    while ($row = mysqli_fetch_array($result)) {
      $trangThai = "";
      switch ($row['status']) {
        case 1:
          $trangThai = "chờ xác nhận";
          break;
        case 2:
          $trangThai = "đã xác nhận";
          break;
        case 3:
          $trangThai = "đang thực hiện tour";
          break;
        case 4:
          $trangThai = "đã hoàn thành";
          break;
        case 5:
          $trangThai = "đã hủy bỏ";
          break;
        default:
          $trangThai = "";
          break;
      }
      if ($row['status'] != 5) {
        echo '
      <div class="item-dh ' . $row['id'] . '">
      <div class="txt-dh">Don hang ' . $i++ . '</div>
      <div class="txt-date">Đặt ngày : ' . $row['date_order'] . '</div>
      <div class="txt-status">Trạng thái : ' . $trangThai . '</div>
      <div class="btn-item-dh">
        <div class="btn-xemchitiet btn" onclick = "displayDetailDH(event)">Xem chi tiet</div>
        ' . ($row['status'] != 4 ? '<div class="btn-huy btn" onclick = "destroyDetailDH(event)">Hủy</div>' : '') . '
      </div>
      </div>
      ';
      }
    }
  }
}


// display Detail
if (isset($_POST['pageuser'])) {
  switch ($_POST['pageuser']) {
    case 'mud':
      include ("../View/User/MucUuDai.php");
      echo "<script>
      console.log(screen.width);
      </script>";
      break;
    case 'dh':
      include ("../View/User/DonHang.php");
      echo "<script>
      console.log(screen.width);
      </script>";
      break;
    case 'dg':
      include ("../View/User/DanhGia.php");
      echo "<script>
      console.log(screen.width);
      </script>";
      break;
    case 'cs':
      include ("../View/User/ChinhSua.php");
      break;
  }
}

?>

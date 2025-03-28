<?php
class Database
{
  private $hostname = 'localhost';
  private $username = 'root';
  private $pass = '';
  private $dbname = 'web2';

  private $conn = NULL;
  private $result = NULL;

  public function connect()
  {
    $this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->dbname);
    if ($this->conn->connect_error) {
      echo "Kết nối cơ sở dữ liệu thất bại: " . $this->conn->connect_error;
      exit();
    } else {
      mysqli_set_charset($this->conn, 'utf8');
    }
    return $this->conn;
  }

  public function disconnect()
  {
    $this->conn->close();
  }


  //thực thi câu truy vấn
  public function execute($sql)
  {
    $this->result = $this->conn->query($sql);
    return $this->result;
  }

  public function getTenNguoiDung()
  {
    $idUser = $_SESSION['idUserLogin'];
    $sql = 'select * from nguoidung where id_acount = ' . $idUser;
    $this->result = $this->conn->query($sql);
    $name = $this->getData();
    return $name['fullname'];
  }

  public function foreignKey($tableChil, $columnChil, $tableParent, $columnParent)
  {
    $sql = 'alter table ' . $tableChil .
      ' add constraint fk_' . $columnChil . '_' . $columnParent .
      ' foreign key (' . $columnChil . ') ' .
      ' references ' . $tableParent . '(' . $columnParent . ')';
    $result = $this->execute($sql);
    if ($result)
      echo 'thanh cong';
  }

  //lấy dữ liệu
  public function getData()
  {
    if ($this->result) {
      $data = mysqli_fetch_array($this->result);
    } else {
      $data = 0;
    }
    return $data;
  }

  //lấy dữ liệu
  public function getDataId($table, $id)
  {
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $this->execute($sql);
    if ($this->num_rows() != 0) {
      $data = mysqli_fetch_array($this->result);
    } else {
      $data = 0;
    }
    return $data;
  }


  //đếm bản ghi
  public function num_rows()
  {
    if ($this->result) {
      $num = mysqli_num_rows($this->result);
    } else {
      $num = 0;
    }
    return $num;
  }

  //lấy toàn bộ dữ liệu
  public function getAllData($table)
  {
    $sql = "SELECT * FROM $table";
    $this->execute($sql);
    if ($this->num_rows() == 0) {
      $data = 0;
    } else {
      while ($datas = $this->getData()) {
        $data[] = $datas;
      }
    }
    return $data;
  }

  // thêm user
  public function insertUserData($fullname, $email, $phone_number, $create_at, $status, $address, $id_acount)
  {
    $sql = "INSERT INTO nguoidung (fullname, email, phone_number, create_at, status, address, id_acount) 
        VALUES ('$fullname', '$email', '$phone_number', '$create_at', '$status', '$address', '$id_acount')";
    return $this->execute($sql);
  }

  public function checkUpdate()
  {
    if ($this->result !== false && $this->conn->affected_rows > 0) {
      return true; // Cập nhật thành công
    } else {
      return false; // Không có bản ghi nào được cập nhật
    }
  }

  public function updateEditData($id, $fullname, $email, $phone_number, $create_at, $address)
  {
    $sql = "UPDATE nguoidung SET fullname='$fullname', email='$email', phone_number='$phone_number', create_at='$create_at', address='$address' WHERE id='$id'";
    $this->execute($sql);
    return $this->checkUpdate(); // Kiểm tra kết quả của câu lệnh UPDATE
  }

  public function updateEditDataEdit($id, $fullname, $email, $phone_number, $create_at, $address, $id_acount)
  {
    $sql = "UPDATE nguoidung SET fullname='$fullname', email='$email', phone_number='$phone_number', create_at='$create_at', address='$address', id_acount='$id_acount' WHERE id='$id'";
    $this->execute($sql);
    return $this->checkUpdate(); // Kiểm tra kết quả của câu lệnh UPDATE
  }


  public function updateEditDataAcount($id, $id_acount)
  {
    $sql = "UPDATE nguoidung SET id_acount='$id_acount' WHERE id='$id'";
    $this->execute($sql);
    return $this->checkUpdate(); // Kiểm tra kết quả của câu lệnh UPDATE
  }

  public function roleAccount($id, $role)
  {
    $sql = "UPDATE acount SET id_role = '$role' WHERE id = '$id'";
    $this->execute($sql);
    return $this->checkUpdate();
  }

  public function idAccount($id, $id_acount)
  {
    $sql = "UPDATE nguoidung SET id_acount = '$id_acount' WHERE id = '$id'";
    $this->execute($sql);
    return $this->checkUpdate();
  }




  public function acountAccount($id, $acount, $password)
  {
    $sql = "UPDATE acount SET acount = '$acount',password = '$password' WHERE id = '$id'";
    $this->execute($sql);
    return $this->checkUpdate();
  }


  // delete user
  public function deleteUser($table, $id)
  {
    $sql = "DELETE FROM $table Where id = '$id'";
    return $this->execute($sql);
  }

  // block user
  function blockUser($id)
  {
    $sql = "UPDATE nguoidung SET status = 0 WHERE id = '$id'";
    $this->execute($sql);
  }

  //unblock user
  function unblockUser($id)
  {
    $sql = "UPDATE nguoidung SET status = 1 WHERE id = '$id'";
    $this->execute($sql);
  }

  public function getDataWithLimit($tableName, $startFrom, $limit)
  {

    $query = "SELECT * FROM $tableName LIMIT $startFrom, $limit";
    $result = $this->conn->query($query);
    $data = array();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }

    return $data;
  }


  public function getNguoiDungByIDAcount($idAccount)
  {
    $sql = "SELECT * FROM nguoidung WHERE id_acount = '$idAccount' ";
    return $this->execute($sql);
  }


  public function checkLogin($username, $password)
  {
    $sql = "SELECT * FROM acount WHERE user_name = '$username' AND password = '$password'";
    return $this->execute($sql);
  }

  public function getUserByIdAcount($username)
  {
    $sql = "SELECT * FROM nguoidung WHERE id_acount = '$username' ";
    return $this->execute($sql);
  }


  public function getRole()
  {
    $sql = "SELECT * FROM role";
    $this->execute($sql);

    $roles = array();

    while ($row = $this->getData()) {
      $roles[] = $row;
    }

    return $roles;
  }

  public function getAllAccounts()
  {
    $sql = "SELECT * FROM acount";
    $this->execute($sql);

    $accounts = array();

    while ($row = $this->getData()) {
      $accounts[] = $row;
    }

    return $accounts;
  }

  public function getAllNguoiDung()
  {
    $sql = "SELECT * FROM nguoidung";
    $this->execute($sql);

    $accounts = array();

    while ($row = $this->getData()) {
      $accounts[] = $row;
    }

    return $accounts;
  }


  public function registerAcountOnly($username, $password)
  {
    $sql = "INSERT INTO acount (user_name, password) VALUES ('$username', '$password')";
    return $this->execute($sql);
  }

  public function registerAcount($username, $password, $id_role, $status)
  {
    $sql = "INSERT INTO acount (user_name, password, id_role, status) VALUES ('$username', '$password', '$id_role', '$status')";
    return $this->execute($sql);
  }

  public function registerAcountWithGoogle($username, $password, $id_role, $status, $id_google)
  {
    $sql = "INSERT INTO acount (user_name, password, id_role, status, idGoogle) VALUES ('$username', '$password', '$id_role', '$status', '$id_google')";
    return $this->execute($sql);
  }

  public function registerNguoiDung($fullname, $email, $phone_number, $create_at, $status, $address, $id_acount)
  {
    $sql = "INSERT INTO nguoidung (fullname, email, phone_number, create_at, status, address, id_acount) VALUES ('$fullname', '$email', '$phone_number', '$create_at', '$status', '$address', '$id_acount')";
    return $this->execute($sql);
  }

  public function num_row()
  { // co them s-> thieus 
    if ($this->result) {

      $num = mysqli_num_rows($this->result);
    } else {
      $num = 0;
    }
    return $num;
  }
  public function getAllDataBySql($sql)
  {
    $this->execute($sql);
    if ($this->num_rows() == 0) {
      $data = 0;
    } else {
      while ($datas = $this->getData()) {
        $data[] = $datas;
      }
    }
    return $data;
  }
  // thêm giỏ hàng
  public function InsertOrUpdateCart($id_user, $id_product, $amount, $idTicket, $status)
  {
    // Kiểm tra xem có bản ghi nào trong bảng cart có id_user và idTicket đã cho hay không
    $sql_check = "SELECT * FROM cart WHERE id_user = '$id_user' AND idTicket = '$idTicket'";
    $result = $this->execute($sql_check);

    if ($result->num_rows > 0) {
      // Nếu tìm thấy bản ghi, cập nhật số lượng bằng cách cộng thêm giá trị mới
      $sql_update = "UPDATE cart SET amount = amount + $amount WHERE id_user = '$id_user' AND idTicket = '$idTicket'";
      return $this->execute($sql_update);
    } else {
      // Nếu không tìm thấy bản ghi, thêm bản ghi mới vào bảng cart
      $sql_insert = "INSERT INTO cart (id_user, id_product, amount, status, idTicket) VALUES ('$id_user', '$id_product', '$amount', '$status', '$idTicket')";
      return $this->execute($sql_insert);
    }
  }


  // public function checkAvailableTour($idTour){
  //   $sql="SELECT * FROM product WHERE id = $idTour and soLuongConLai>0;";
  //   $rs = $this->execute($sql);
  //   $numRows = mysqli_num_rows($rs);
  //   if($numRows>0) return true;
  //   else return false;
  // }
  // thêm orrder
  public function InsertOrder($id, $id_user, $hoten, $email, $sdt, $diachi, $note, $date, $totalPrice, $id_discount)
  {
    if ($id_discount != 0) $sql = "INSERT INTO orders (id, id_user, fullname, email, phone_number, address, note, date_order, total_money, status, id_discount)
    VALUES ('$id', '$id_user', '$hoten', '$email', '$sdt', '$diachi', '$note', '$date', '$totalPrice','1', '$id_discount')";
    else $sql = "INSERT INTO orders (id, id_user, fullname, email, phone_number, address, note, date_order, total_money, status)
    VALUES ('$id', '$id_user', '$hoten', '$email', '$sdt', '$diachi', '$note', '$date', '$totalPrice','1')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }

  // xóa voucher
  public function XoaVoucherKhiAddMa($idVou, $idUser)
  {
    $sql = "delete from discountuser where id_user = $idUser and id_discount = $idVou";
    return $this->execute($sql);
  }

  // thêm detailOrder
  public function InsertDetailOrder($id_order, $id_pro, $price, $amount, $totalmoney, $dateGo)
  {
    $sqlTangSoLuongMua = "UPDATE product SET num_bought = num_bought + $amount WHERE id = $id_pro";
    $this->execute($sqlTangSoLuongMua);
    $sql = "INSERT INTO order_detail (id_order, id_product, price, amount, total_money, date_go)
    VALUES ( '$id_order', '$id_pro', '$price', '$amount', '$totalmoney', '$dateGo')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }
  // lấy ảnh sản phẩm
  public function GetImgProduct($product_id)
  {
    $sql = "SELECT * FROM image_product WHERE id_product = $product_id";
    return $this->execute($sql);
  }
  // thêm bình luận
  public function InsertCmt($user_id, $product_id, $cmt, $create_at, $num_star)
  {
    $sql = "INSERT INTO feedback (user_id, product_id, note, create_at, num_star)
    VALUES ('$user_id', '$product_id', '$cmt', '$create_at', '$num_star')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }

  // cập nhật số sao của sản phẩm
  public function updateStarOfTour($product_id)
  {
    $sql = "SELECT ROUND(AVG(num_star), 1) AS avgStar FROM feedback WHERE product_id = '$product_id'";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    $avgStar = $row["avgStar"];
    $update_sql = "UPDATE product SET star_feedback = '$avgStar' WHERE id = '$product_id'";
    return $this->execute($update_sql);
  }
  // phần của admin
  public function updateNumBoughtTour($id, $sove)
  {
    $sql = "UPDATE product SET num_bought = num_bought + $sove where id = $id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function addTicket($idTour, $name, $dateStart, $dateEnd, $sove)
  {
    $sql = "insert into tickettour (idTour, dateStart, dateEnd, numTicketAvailable, name, num_bought, status) values ('$idTour', '$dateStart', '$dateEnd', '$sove', '$name', 0, 1);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function buyTicket($id, $sove)
  {
    $sql = "UPDATE tickettour SET numTicketAvailable = numTicketAvailable - '$sove', num_bought = num_bought + $sove where id = $id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function updateTicket($id, $name, $dateStart, $dateEnd, $sove, $status)
  {
    $sql = "UPDATE tickettour SET dateStart = '$dateStart', dateEnd = '$dateEnd', numTicketAvailable = '$sove', name = '$name', status = '$status' WHERE id = '$id';";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteTicket($id)
  {
    $sql = "delete from tickettour where id = $id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function getListTicketByidTour($idTour)
  {
    $sql = "select * from tickettour where idTour = $idTour";
    return $this->execute($sql);
  }
  // thêm tour mới
  public function InsertTour($id, $id_cate, $id_user, $id_provin, $title, $price, $content, $address, $datecreate, $acount)
  {
    $sql = "INSERT INTO product (id, id_category, id_user, id_provincial, title, price, content, create_at, num_bought, status, address, star_feedback)
    VALUES ('$id','$id_cate', '$id_user', '$id_provin', '$title', '$price', '$content', '$datecreate', '0', '1', '$address', '0')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }
  // lấy id cuối cùng của tour
  public function getLastID($table)
  {
    $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
    return $this->execute($sql);
  }
  //edit Tour
  public function UpdateTour($id, $id_cate, $id_user, $id_provin, $title, $price, $content, $dateUpdate, $address)
  {
    $sql = "UPDATE product SET 
            id_category = '$id_cate', 
            id_user = '$id_user', 
            id_provincial = '$id_provin', 
            title = '$title', 
            price = '$price', 
            content = '$content',
            update_at = '$dateUpdate',  
            address = '$address'
            WHERE id = '$id'";
    // $this->execute($sql);
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }

  //xóa tour
  public function DeleteTour($id)
  {
    $sql = "DELETE FROM product WHERE id = $id";
    return $this->execute($sql);
  }
  // thêm ảnh
  public function InsertImg($id_product, $id_user, $img)
  {
    $sql = "INSERT INTO image_product (id_product, id_user, image) VALUES ('$id_product', '$id_user', '$img')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }
  public function UpdateImg($id, $img)
  {
    $sql = 'Update image_product SET image = "' . $img . '"  WHERE id = ' . $id;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function DeleteImg($id)
  {
    $sql = 'delete from image_product where  id = ' . $id;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }

  // thêm chức năng
  public function InsertChucNang($name)
  {
    $sql = "INSERT INTO chucnang (decription) VALUES ('$name')";
    return $this->execute($sql);
  }
  // sửa chức năng
  public function UpdateNameChucNang($id, $name)
  {
    $sql = "UPDATE chucnang SET decription = '$name' WHERE id = $id";
    return $this->execute($sql);
  }
  //xóa chức năng
  public function DeleteChucNang($id)
  {
    $sql = "DELETE FROM chucnang WHERE id = $id";
    return $this->execute($sql);
  }

  // thêm quyền
  public function InsertRole($name)
  {
    $sql = "INSERT INTO role (decription) VALUES ('$name')";
    $rs = $this->execute($sql);
    if ($rs) {
      return true;
    } else
      return false;
  }
  // update role
  public function UpdateNameRole($id, $name)
  {
    $sql = "UPDATE role SET decription = '$name' WHERE id = $id";
    // $rs = $this->execute($sql);
    // $affectedRows = mysqli_affected_rows($this->conn);
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  // tìm role theo id
  public function FindRole($idRole)
  {
    $sql = "select * from phanquyenlinhdong where id_role = $idRole";
    return $this->execute($sql);
  }
  //xóa role
  public function DeleteRole($id)
  {
    $sql1 = "DELETE FROM phanquyenlinhdong WHERE id_role = $id";
    $this->execute($sql1);
    $sql = "DELETE FROM role WHERE id = $id";
    return $this->execute($sql);
  }
  public function DeleteRoleLinhDong($id)
  {
    $sql1 = "DELETE FROM phanquyenlinhdong WHERE id_role = $id";
    return $this->execute($sql1);
  }
  public function UpdateRoleLinhDong($idRole, $id_CN, $HD)
  {
    $sql = "INSERT INTO phanquyenlinhdong (id_role, id_chucNang, HD) values ('$idRole', '$id_CN', '$HD')";

    // $rs = $this->execute($sql);
    // $affectedRows = mysqli_affected_rows($this->conn);
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $affectedRows = $stmt->affected_rows;
    // Nếu có ít nhất một dòng được cập nhật, trả về true
    if ($affectedRows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function InsertRoleLinhDong($id_CN, $HD)
  {
    $selectId = "SELECT id FROM role ORDER BY id DESC LIMIT 1";
    $result = $this->execute($selectId);
    $row = $result->fetch_assoc();
    $last_role_id = $row["id"];
    $sql = "INSERT INTO phanquyenlinhdong (id_role, id_chucNang, HD) values ('$last_role_id', '$id_CN', '$HD')";
    return $this->execute($sql);
  }
  // check quyền mới cho nhấn tabAdmin
  public function checkRoleAdmin($idAccount)
  {
    $sql = "SELECT * 
  FROM acount
  JOIN phanquyenlinhdong ON acount.id_role = phanquyenlinhdong.id_role 
  WHERE acount.id = $idAccount;";
    $result = $this->execute($sql);
    $roles = array(); // Mảng chứa các role

    while ($row = mysqli_fetch_array($result)) {
      $roles[] = $row; // Thêm hàng dữ liệu vào mảng roles
    }

    return $roles;
  }

  public function resultThongKe($orderby, $selectCategory, $dateStart, $dateEnd, $namecoll, $soDongHienThi, $sanPhamBanChayNhat)
  {

    if ($selectCategory == 0) {
      $sql = 'select * from category';
      $result = $this->execute($sql);
      $objects = array();
      $id = 0;
      while ($row = mysqli_fetch_array($result)) {
        $key = 'key' . $id;
        $objects[$key][0] = $row['name_category'];
        $sql = 'SELECT SUM(amount) as total
                FROM order_detail AS od , product AS p
                WHERE p.id = od.id_product AND p.id_category = ' . $row['id'];
        $result1 = $this->execute($sql);
        $row1 = mysqli_fetch_array($result1);
        $objects[$key][1] = $row1['total'];

        $sql = 'SELECT SUM(total_money) as total
        FROM order_detail AS od , product AS p
        WHERE p.id = od.id_product AND p.id_category = ' . $row['id'];
        $result1 = $this->execute($sql);
        $row1 = mysqli_fetch_array($result1);
        $objects[$key][2] = $row1['total'];

        if ($objects[$key][1] == null) {
          $objects[$key][2] = 0;
          $objects[$key][1] = 0;
        }
        $objects[$key][3] = $id + 1;
        ++$id;
      }
      $listOrder = [
        'title' => 0,
        'amount' => 1,
        'total_money' => 2,
        'id' => 3,
      ];
      if ($namecoll != '') {
        $column = [];
        foreach ($objects as $keyx => $value) {
          $column[$keyx] = $value[$listOrder[$namecoll]]; // Chỉ lấy giá trị cột 1
        }
        // Sắp xếp mảng dựa trên giá trị của cột
        if ($orderby == 'ASC')
          array_multisort($column, SORT_ASC, $objects);
        else
          if ($orderby == 'DESC')
          array_multisort($column, SORT_DESC, $objects);
      }

      return $objects;
    }

    $sql = ' SELECT  p.title , AVG(od.price) as price , SUM(od.amount) as amount , SUM(od.total_money) as total_money 
              FROM product as p , order_detail as od , orders as o
              where p.id = od.id_product and o.id = od.id_order ';
    ///chon san pham theo ten loai
    if ($selectCategory != 0)
      $sql = $sql . ' and p.id_category = ' . $selectCategory;
    ///loc san pham chon ngay bat dau lo
    if ($dateStart != '') {
      $sql = $sql . ' and o.date_order >= ? ';
    }

    //loc san pham chon ngay ket thuc
    if ($dateEnd != '') {
      $sql = $sql . ' and o.date_order <= ? ';
    }

    $sql = $sql . ' group by p.title  ';
    if ($sanPhamBanChayNhat == 1) {
      $sql = $sql . ' order by amount desc';
    }
    $sql = $sql . ' LIMIT ' . $soDongHienThi;

    $result = null;
    if ($dateStart != '' && $dateEnd == '') {
      // Chuẩn bị câu lệnh SQL và bind tham số
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $dateStart);

      // Thực thi câu lệnh SQL
      $stmt->execute();

      // Lấy kết quả
      $result = $stmt->get_result();
    } elseif ($dateEnd != '') {
      // Chuẩn bị câu lệnh SQL và bind tham số
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ss", $dateStart, $dateEnd);

      // Thực thi câu lệnh SQL
      $stmt->execute();

      // Lấy kết quả
      $result = $stmt->get_result();
    } else
      $result = $this->execute($sql);


    $listOrder = [
      'id' => 0,
      'title' => 1,
      'price' => 2,
      'amount' => 3,
      'total_money' => 4
    ];
    $objects = array();
    $id = 1;
    while ($row = mysqli_fetch_array($result)) {
      $key = 'key' . $id;
      $objects[$key][0] = $id;
      $objects[$key][1] = $row['title'];
      $objects[$key][2] = $row['price'];
      $objects[$key][3] = $row['amount'];
      $objects[$key][4] = $row['total_money'];
      ++$id;
    }

    if ($namecoll != '') {
      $column = [];
      foreach ($objects as $keyx => $value) {
        $column[$keyx] = $value[$listOrder[$namecoll]];
      }
      // Sắp xếp mảng dựa trên giá trị của cột
      if ($orderby == 'ASC')
        array_multisort($column, SORT_ASC, $objects);
      else
        if ($orderby == 'DESC')
        array_multisort($column, SORT_DESC, $objects);
    }

    return $objects;
  }

  public function resultEmailUser($idUser, $emailChange)
  {

    $sql = 'select * from nguoidung where id = ' . $idUser;
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($emailChange != '') {
      $sql1 = 'select * from nguoidung where email =  ?';
      $stmt = $this->conn->prepare($sql1);
      $stmt->bind_param('s', $emailChange);
      $stmt->execute();
      $result = $stmt->get_result();
      if (mysqli_num_rows($result) > 0) {
        echo '
        <script> alert("Tên email đã tồn tại"); </script>
        ' . $row['email'];
        return;
      }
    }

    $fullemailprofile = $row['email'];
    if ($emailChange != '') {
      $fullemailprofile = $_POST['emailChange'];
      $sql = 'Update nguoidung SET email = "' . $fullemailprofile . '"  WHERE id = ' . $idUser;
      mysqli_query($this->conn, $sql);
      echo '
        <script> alert("Thay đổi email thành công"); </script>
        ';
    }
    echo $fullemailprofile;
  }

  public function resultAddressUser($idUser, $addressChange)
  {
    $sql = 'select * from nguoidung where id = ' . $idUser;
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_array($result);

    $fulladdressprofile = $row['address'];
    if ($addressChange != '') {
      $fulladdressprofile = $addressChange;
      $sql = 'Update nguoidung SET address = "' . $fulladdressprofile . '"  WHERE id = ' . $idUser;
      mysqli_query($this->conn, $sql);
    }
    echo $fulladdressprofile;
  }
  public function getIdByEmail($email)
  {
    $sql = "SELECT id FROM nguoiDung WHERE email = '" . $email . "'";
    $result = mysqli_query($this->conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['id'];
    } else {
      return null; // Trả về null nếu không tìm thấy bất kỳ kết quả nào
    }
  }

  public function updatePasswordById($id, $newPassword)
  {
    $sql = "UPDATE acount SET password = '" . $newPassword . "' WHERE id = " . $id;
    $this->execute($sql);
  }






  public function resultNameUser($idUser, $nameChange)
  {
    $sql = 'select * from nguoidung where id = ' . $idUser;
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_array($result);

    $fullnameprofile = $row['fullname'];
    if ($nameChange != '') {
      $fullnameprofile = $_POST['nameChange'];
      $sql = 'Update nguoidung SET fullname = "' . $fullnameprofile . '"  WHERE id = ' . $idUser;
      mysqli_query($this->conn, $sql);
    }

    echo $fullnameprofile;
  }

  public function resultsdtUser($idUser, $sdtChange)
  {
    $sql = 'select * from nguoidung where id = ' . $idUser;
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_array($result);

    $sdtprofile = $row['phone_number'];
    if ($sdtChange != '') {
      $sdtprofile = $_POST['sdtChange'];
      $sql = 'Update nguoidung SET phone_number = ' . $sdtprofile . '  WHERE id = ' . $idUser;
      mysqli_query($this->conn, $sql);
    }

    echo $sdtprofile;
  }

  public function resultSearchDiscount($searchTerm, $idUser)
  {
    $result = mysqli_query($this->conn, "SELECT * FROM discount as d,discountuser as du where id_user = " . $idUser . " and du.id_discount = d.id  ");
    if ($searchTerm != '') {
      $stringFind = $searchTerm;
      $query = "SELECT * FROM discount as d,discountuser as du where code like '%$stringFind%'and date_end > CURRENT_DATE and id_user = " . $idUser . " and du.id_discount = d.id  ";
      $result = mysqli_query($this->conn, $query);
    }
    return $result;
  }
  public function getAll()
  {
    $data = null;
    if (!$this->result) {
      $data = 0;
    } else {
      while ($datas = $this->getData()) {
        $data[] = $datas;
      }
    }
    return $data;
  }
  public function deleteComment($commentId)
  {
    $this->connect();

    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM feedback WHERE id = $commentId";
    $result = $this->execute($sql);

    return $result;
  }
  public function deleteVoucher($VoucherId)
  {
    $this->connect();

    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM discount WHERE id = $VoucherId";
    $result = $this->execute($sql);

    return $result;
  }

  public function updateVoucher($id, $discount_name, $code, $percent, $date_start, $date_end, $description, $status)
  {
    $sql = "UPDATE discount SET discount_name='$discount_name', code='$code', percent='$percent', date_start='$date_start', date_end='$date_end', description='$description',status='$status' WHERE id='$id'";
    return $this->execute($sql);
  }
  public function insertVoucher($discount_name, $code, $percent, $date_start, $date_end, $description)
  {
    $sql = "INSERT INTO discount ( discount_name,code,percent,date_start,date_end,description, status) 
            VALUES ( '$discount_name', '$code', '$percent', '$date_start', '$date_end', '$description','1')";
    return $this->execute($sql);
  }
  // Add this method to your DBConfig class
  public function getVoucherDetailsById($voucherId)
  {
    if ($voucherId > 0) {
      $sql = "SELECT * FROM discount WHERE id = $voucherId";
      $result = $this->execute($sql);

      if ($result && $result->num_rows > 0) {

        $voucherDetails = $result->fetch_assoc();
        return $voucherDetails;
      }
    }
    return false;
  }

  public function getUserById($userID)
  {
    if ($userID > 0) {
      $sql = "SELECT * FROM nguoidung WHERE id = $userID";
      $result = $this->execute($sql);

      if ($result && $result->num_rows > 0) {

        $voucherDetails = $result->fetch_assoc();
        return $voucherDetails;
      }
    }
    return false;
  }
  public function deleteItemCart($ItemId)
  {
    $this->connect();

    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM cart WHERE id = $ItemId";
    $result = $this->execute($sql);

    return $result;
  }
  public function deleteOrder($orderId)
  {
    $this->connect();
    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM orders WHERE id = $orderId";
    $result = $this->execute($sql);
    $sql = "DELETE FROM order_detail WHERE id_order = $orderId";
    $result = $this->execute($sql);
    $this->disconnect();
    return $result;
  }

  public function destroyOrder($orderId)
  {
    $this->connect();
    // Chuẩn bị truy vấn xóa
    $sql = "Update orders Set status = 5 WHERE id = " . $orderId;
    $result = $this->execute($sql);
    $this->disconnect();
  }
  public function getDetailOrderByOrderId($orderId)
  {
    $this->connect();
    $sql = "select * from orders o, order_detail d, product p, discount c where o.id = d.id_order and o.id = $orderId and p.id = d.id_product and c.id = o.id_discount";
    $result = $this->execute($sql);
    return $result;
  }
  public function getStatusOrderByOrderId($orderId)
  {
    $this->connect();
    $sql = "select status from orders where id = $orderId";
    $result = $this->execute($sql);
    return $result->fetch_assoc()['status'];
  }
  public function getNameVocherByOrderId($orderId)
  {
    $this->connect();
    $sql = "select * from discount d, orders o where o.id = $orderId and o.id_discount = d.id";
    $result = $this->execute($sql);
    return $result->fetch_assoc()['discount_name'];
  }
  public function getInfoPersonOrder($orderId)
  {
    $this->connect();
    $sql = "select u.id as idUser, u.phone_number, u.email, u.address, u.fullname as nameUser from orders o, nguoiDung u where o.id = $orderId and u.id = o.id_user";
    $result = $this->execute($sql);
    return $result;
  }
  public function updateOrder($orderId, $status)
  {
    // Sanitize input
    $orderId = intval($orderId); // Convert to integer
    $status = intval($status); // Convert to integer
    $userId = intval($_SESSION['idUserLogin']); // Assuming idUserLogin is an integer, convert to integer

    // Prepare SQL query
    $sql = "UPDATE orders SET status = $status, id_nguoiXacNhanOrder = $userId WHERE id = $orderId";

    // Execute the query
    return $this->execute($sql);
  }
  public function getMailByIdOrder($orderId)
  {
    $this->connect();
    $sql = "select * from orders o, nguoiDung u where o.id = $orderId and o.id_user = u.id";
    $result = $this->execute($sql);
    return $result->fetch_assoc()['email'];
  }
  public function getMailOrderByIdOrder($orderId)
  {
    $this->connect();
    $sql = "select u.email as emailOrder from orders o, nguoiDung u where o.id = $orderId and o.id_user = u.id";
    $result = $this->execute($sql);
    return $result->fetch_assoc()['emailOrder'];
  }

  public function getTotalMoneyByIdOrder($orderId)
  {
    $this->connect();
    $sql = "select * from orders o where o.id = $orderId";
    $result = $this->execute($sql);
    return $result->fetch_assoc()['total_money'];
  }

  public function getDataDonHang($idUser)
  {
    $sql = "select * from orders where id_user = " . $idUser;
    $result = $this->execute($sql);
    return $result;
  }

  public function getDataChiTietDonHang($idOrder, $idUser)
  {
    $sql = 'select p.id ,p.title , p.id_category , p.content , p.price , od.amount , od.total_money , od.date_go , ip.image ,d.percent as percent
            from order_detail as od , product as p , image_product as ip, orders as o , discount as d
            where od.id_product = p.id and od.id_order = ' . $idOrder . ' and p.id = ip.id_product and ip.id_user = 1 and o.id  = ' . $idOrder . ' and d.id = o.id_discount ';
    $result = $this->execute($sql);
    return $result;
  }
  public function getTotalOrderByUser($email)
  {
    $sql = "SELECT COUNT(*) AS total FROM orders o, nguoidung u WHERE u.id = o.id_user and u.email like '$email'";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
  }
  public function getTotalRejectOrderByUser($email)
  {
    $sql = "SELECT COUNT(*) AS totalReject FROM orders o, nguoidung u WHERE u.id = o.id_user AND o.status = 5 AND u.email LIKE '$email'";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['totalReject'];
  }



  public function getSoLuong($table, $condi)
  {
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE $condi";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
  }

  public function getTongDoanhThu($table)
  {
    $sql = "SELECT SUM(total_money) AS SUM FROM $table";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['SUM'];
  }

  public function getCountYesterday($table, $date)
  {
    $yesterday = date("Y-m-d", strtotime("-1 day"));
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE DATE(DATE_FORMAT($date, '%Y-%m-%d')) = '$yesterday' && id > 0";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
  }

  public function getCountToday($table, $date)
  {
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE DATE(DATE_FORMAT($date, '%Y-%m-%d')) = CURDATE() && id > 0";
    $result = $this->execute($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
  }


  // thống kê: hàm lấy ra các tour bán và ngày bán
  public function getTourSellThisWeek()
  {
    $sql = "SELECT 
    DATE_FORMAT(orders.date_order, '%W') AS day_of_week,
    SUM(order_detail.amount) AS total_tours_sold
FROM 
    orders
JOIN 
    order_detail ON orders.id = order_detail.id_order
WHERE 
YEARWEEK(orders.date_order) = YEARWEEK(CURDATE())
    GROUP BY 
    DATE_FORMAT(orders.date_order, '%W')
ORDER BY 
    MIN(orders.date_order);
";
    return $this->execute($sql);
  }

  // Hàm để lấy dữ liệu cho mảng dataPoints2 từ cơ sở dữ liệu
  public function getTourSellLastWeek()
  {
    // Thực hiện truy vấn SQL để lấy số lượng tour bán được trong mỗi ngày trong tuần trước
    $sql = "SELECT 
    DATE_FORMAT(orders.date_order, '%W') AS day_of_week,
    SUM(order_detail.amount) AS total_tours_sold
FROM 
    orders
JOIN 
    order_detail ON orders.id = order_detail.id_order
WHERE 
YEARWEEK(orders.date_order) = YEARWEEK(CURDATE()) - 1
GROUP BY 
    DATE_FORMAT(orders.date_order, '%W')
ORDER BY 
    MIN(orders.date_order);
";

    // Thực hiện truy vấn và trả về kết quả
    return $this->execute($sql);
  }

  // lấy ra id sản phẩm bán được hôm nay
  public function getTourSellToday()
  {
    $sql = "SELECT 
    order_detail.id_product, 
    SUM(order_detail.amount) AS total_quantity, 
    product.title
FROM 
    orders
JOIN 
    order_detail ON orders.id = order_detail.id_order
JOIN 
    product ON order_detail.id_product = product.id
WHERE 
WEEK(orders.date_order) = WEEK(CURDATE())
GROUP BY 
    order_detail.id_product
ORDER BY 
    total_quantity DESC;";
    return $this->execute($sql);
  }
  // Hàm lấy dữ liệu số lượng tour bán được trong mỗi tháng của năm trước
  public function getMonthlySalesLastYear()
  {
    $sql = "SELECT 
                DATE_FORMAT(orders.date_order, '%Y-%m') AS month_year,
                SUM(order_detail.amount) AS total_quantity
            FROM 
                orders
            JOIN 
                order_detail ON orders.id = order_detail.id_order
            WHERE 
                YEAR(orders.date_order) = YEAR(CURDATE()) - 1
            GROUP BY 
                DATE_FORMAT(orders.date_order, '%Y-%m')
            ORDER BY 
                month_year";
    $result = $this->execute($sql);
    $sales_data = array();
    while ($row = $result->fetch_assoc()) {
      $sales_data[$row['month_year']] = $row['total_quantity'];
    }
    return $sales_data;
  }

  public function getTourHuy()
  {
    $sql = "SELECT 
      COUNT(CASE WHEN status = 5 THEN 1 END) AS tour_huy,
      COUNT(*) AS total_tours
      FROM 
      orders;";
    return $this->execute($sql);
  }
  public function getTourHuyAndUser()
  {
    $sql = "SELECT id_user, COUNT(*) AS tourhuy FROM orders WHERE status = 4 GROUP BY id_user";
    $this->execute($sql);
    if ($this->num_rows() == 0) {
      $data = 0;
    } else {
      while ($datas = $this->getData()) {
        $data[] = $datas;
      }
    }
    return $data;
  }

  public function updateNumTicketAvailable($idTicket, $numTicketAvai)
  {
    $sql = "update tickettour set numTicketAvailable = $numTicketAvai where id = $idTicket";
    return $this->execute($sql);
  }
}

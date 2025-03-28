<?php
include("../../../Model/DBConfig.php");
$db = new Database();
$db->connect();
$result = $db->execute("SELECT * FROM chucnang");
$rowsCN = array();
$result2 = $db->execute("SELECT * FROM role");
$rowsRole = array();

if ($result !== false && $result->num_rows > 0) {
    while ($row4 = $result->fetch_assoc()) {
        $rowsCN[] = $row4;
    }
}
//require_once('View/Admin/addNewRole.php');
if(isset($_REQUEST['addRole'])){
    if(isset($_REQUEST['name_role'])){
        $nameRole = $_REQUEST['name_role'];
    }
    $isSuccess = $db->InsertRole($nameRole);
    if($isSuccess){
        echo "<script> alert('Thêm thành công') </script>";
    } else echo "<script> alert('Thêm thất bại') </script>";
    foreach ($rowsCN as $rowCN) {
        $idCN = $rowCN['id'];
        $HD="null";
        // Lấy giá trị của các checkbox từ $_POST
        if(isset($_POST['view'][$idCN])){
            $HD = "View";
            $db->InsertRoleLinhDong($idCN, $HD);
        } 
        if(isset($_POST['add'][$idCN])){
            $HD = "Add";
            $db->InsertRoleLinhDong($idCN, $HD);
        } 
        if(isset($_POST['delete'][$idCN])){
            $HD = "Delete";
            $db->InsertRoleLinhDong($idCN, $HD);
        } 
        if(isset($_POST['edit'][$idCN])){
            $HD = "Edit";
            $db->InsertRoleLinhDong($idCN, $HD);
        }
    }
        
    
}
$db->disconnect();
?>
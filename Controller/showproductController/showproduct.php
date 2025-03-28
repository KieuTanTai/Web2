<?php 
    // include "../Model/DBConfig.php";
    // $db = new Database;
    // $db->connect();
    $table = 'product';
    $result = $db->getAllData($table);
    $listCategory = $db->getAllData('category');
    $page = 1;
    if(isset($_GET['keyword'])) {
        
    }
    require_once("View/showproductView/index.php");

    
?>
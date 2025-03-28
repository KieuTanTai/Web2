<?php
class Pagination {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'web2');
    }

    public function getRecords($table, $page, $recordsPerPage) {
        $startFrom = ($page - 1) * $recordsPerPage;
        $sql = "SELECT * FROM $table LIMIT $startFrom, $recordsPerPage";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getTotalPages($table, $recordsPerPage) {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $totalPages = ceil($row["total"] / $recordsPerPage);
        return $totalPages;
    }
}
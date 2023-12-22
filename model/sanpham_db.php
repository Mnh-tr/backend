<?php
    require_once 'db.php';
    class sanpham_db extends db(){
        // lay toan bo du lieu trong bang
        public function getAllSanPham()
        {
            $sql = self::$connection->prepare('SELECT * FROM tb_sanpham');
            $sql->execute();
            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return $items;
        }
    }
?>
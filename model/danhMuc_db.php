<?php
require_once 'db.php';
class DanhMuc extends db{
    public function getAllDanhMuc()
    {
        $sql = self::$connection->prepare('SELECT * FROM tb_danhmuc');
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
?>

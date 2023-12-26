<?php
require_once 'db.php';
class NguoiDungDB extends db{
    public function getAllNguoiDung($email, $pass)
    {
        $sql = self::$connection->prepare("SELECT * FROM tb_nguoidung where email = '$email' and matkhau = '$pass'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
?>

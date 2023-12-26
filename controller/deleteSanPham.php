<?php
require_once '../model/sanpham_db.php';
$spdb = new SanPhamDB();
if(isset($_GET['deleteID']) && !empty($_GET['deleteID']))
{
    $ma = $_GET['deleteID'];
    $spdb->xoaSanPham($ma);
}
header('location: ../view/quanlysp.php')
?>

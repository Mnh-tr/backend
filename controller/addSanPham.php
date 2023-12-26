<?php 
    require_once '../model/sanpham_db.php';
    $ma = $_POST['ma'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $madanhmuc = $_POST['madanhmuc'];
    //$hinh = $_POST['hinh'];

    $img = addslashes(file_get_contents($_FILES['hinh']['tmp_name']));
    $spdb = new SanPhamDB();
    $spdb->themSanPham($ma, $ten, $gia, $mota, $img, $madanhmuc);
    header('location: ../view/quanlysp.php')
    
?>
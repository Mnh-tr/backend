<?php
    session_start();
    if (isset($_GET['ma']) && !empty($_GET['ma'])) {
        $id = $_GET['ma'];
    
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
    }
    echo "Bạn vừa thêm sản phẩm ".$id." vào giỏ hàng";
    header("location: ../giaodien_be1/index.php");
?>

<?php
require_once 'db.php';
require_once 'sanPham.php';
class SanPhamDB extends db{
    public function getAllSanPham()
    {
        $sql = self::$connection->prepare("SELECT * FROM tb_sanpham");
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
       
        $arrSanPham = array();
        foreach($items as $key => $value){
            $arrSanPham[] = new sanPham($value['ma'], $value['ten'], $value['gia'], $value['mota'], $value['madanhmuc'], $value['image']);
        }

        return $arrSanPham; //return an array
    }
    public function getSanPhamByMaSP($maSP)
    {
        $sql = self::$connection->prepare("SELECT * FROM tb_sanpham WHERE ma = ?");
        $sql->bind_param("s", $maSP);
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
       
        $sanpham = "";
        foreach($items as $key => $value){
            $sanpham = new sanPham($value['ma'], $value['ten'], $value['gia'], $value['mota'], $value['madanhmuc'], $value['image']);
        }

        return $sanpham; 
    }
    public function getSanPhamByDanhMuc($ma)
    {
        $sql = self::$connection->prepare("SELECT * FROM tb_sanpham WHERE madanhmuc = '$ma'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function themSanPham($ma, $ten, $gia, $mota, $hinh, $madanhmuc)
    {
        $stmt = self::$connection->prepare("INSERT INTO tb_sanpham VALUES ('$ma', '$ten', '$gia','$mota','$hinh','$madanhmuc')");
        $stmt->execute();
    }
    public function xoaSanPham($ma)
    {
        $stmt = self::$connection->prepare("DELETE FROM tb_sanpham WHERE ma = '$ma'");
        $stmt->execute();
    }
    public function suaSanPham($ma, $ten, $gia, $mota, $hinh, $madanhmuc)
    {
        $stmt = self::$connection->prepare("UPDATE tb_sanpham SET ten = '$ten', gia = '$gia', mota = '$mota', hinh = '$hinh', madanhmuc = '$madanhmuc' WHERE ma = '$ma'");
        $stmt->execute();
    }

    //lấy số lượng sản phẩm theo từ khóa
    public function getSanPhamByKeyword($keyword)
    {
        $sql = self::$connection->prepare("SELECT COUNT(*) AS Total FROM tb_sanpham WHERE tb_sanpham.ten LIKE '%$keyword%' OR tb_sanpham.mota LIKE '%$keyword%'");
        $sql->execute();

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return $items[0]['Total'];
    }
    //tìm sản phẩm theo từ khóa, có sử dụng phân trang
    public function searchProductByKeyword($keyword, $page, $perPage)
    {
        $currentPage = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM tb_sanpham WHERE tb_sanpham.ten LIKE '%$keyword%' LIMIT $currentPage, $perPage");
        $sql->execute();

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return $items;
    }
    //lay so lượng sản phẩm có phân trang
    public function getAllProducts($page, $perPage)
    {
        $currentPage = ($page - 1) * $perPage;
        // 2. Tạo câu SQL
        $sql = self::$connection->prepare("SELECT * FROM tb_sanpham LIMIT $currentPage, $perPage");
        $sql->execute();

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return $items;
    }
    //lay so luong tat ca san pham
    public function getAllProductCount()
    {
        $sql = self::$connection->prepare("SELECT COUNT(*) AS Total FROM tb_sanpham");
        $sql->execute();

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return $items[0]['Total'];
    }
    //phân trang
    public function getPaginationBar($url, $total, $page, $perPage)
    {
        if($total <= 0) 
        {
            return "";
        }
        $totalLinks = ceil($total/$perPage);
        if($totalLinks <= 1) 
        {
            return "";
        }
        $link ="";
        for($j=1; $j <= $totalLinks ; $j++)
        {
            if($j == $page)
            {
                $link = $link."<span class ='lii' style= 'color: white; background-size: 40px;
                background-color: red; '>$j</span>";
            }
            else
            {
                $link = $link."<a class ='lii' href='$url&page=$j'> $j </a>";
            }
        }
         $firstLink = ""; $prevLink =""; $nextLink=""; $lastLink="";
        if ($page > 1) 
        {
            $firstLink = "<a class ='lii' href='$url'><<</a>";
            $prev = $page - 1;
            $prevLink = "<a class ='lii' href='$url?page=$prev'> <  </a>";
        }
        if ($page < $totalLinks) 
        {
            $lastLink = "<a class ='lii' href='url?page=$totalLinks'> >> </a>";
            $next = $page + 1;
            $nextLink = "<a class ='lii' href ='$url?page=$next'> > </a>";
        }
            return $firstLink.$prevLink.$link.$nextLink.$lastLink;
    }
}
?>

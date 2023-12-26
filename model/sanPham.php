<?php
class sanPham{
    public $ma;
    public $ten;
    public $gia;
    public $mota;
    public $madanhmuc;
    public $image;
    public function __construct($ma, $ten, $gia, $mota, $madanhmuc, $image){
        $this->ma = $ma;
        $this->ten = $ten;
        $this->gia = $gia;
        $this->mota = $mota;
        $this->madanhmuc = $madanhmuc;
        $this->image = $image;
    }
}
?>
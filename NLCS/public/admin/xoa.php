
<?php
if(isset($_GET['id'])){
    $xoa = mysqli_query($conn,"DELETE FROM `sanpham` WHERE `id_SP` =".$_GET['id']);
    header("location:admin.php?page_layout=danhsach");
}
if(isset($_GET['maloai'])){
    $xoa = mysqli_query($conn,"DELETE FROM `loaisanpham` WHERE `lsp_ma` ='".$_GET['maloai']."'");
    header("location:admin.php?page_layout=danhmuc");
}
if(isset($_GET['id_tintuc'])){
    $xoa = mysqli_query($conn,"DELETE FROM `tintuc` WHERE `id_tintuc` ='".$_GET['id_tintuc']."'");
    header("location:admin.php?page_layout=tintuc");
}
?>
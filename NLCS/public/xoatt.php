
<?php
if(isset($_GET['id_nhanhang'])){
    $xoa = mysqli_query($conn,"DELETE FROM `nhanhang` WHERE `id_nhanhang` =".$_GET['id_nhanhang']);
    header('location: taikhoan.php?page=diachi');
}
?>
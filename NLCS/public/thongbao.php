<?php 
ob_start();
include '../partials/header.php'; 
?>
<hr>
<div class="text-center">
    <h4>Bạn đăng ký thành công</h4>
    <a href="view_cart.php"><button type="button" class="btn btn-secondary">Quay về giỏ hàng</button></a>
    <a href="taikhoan.php?page=donmua"><button type="button" class="btn btn-primary">Xem đơn hàng</button></a>
</div>
<?php include '../partials/footer.php';?>

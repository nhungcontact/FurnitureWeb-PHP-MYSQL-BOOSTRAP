<?php 
ob_start();
include '../partials/header.php';
?>
<hr>
<div class="container" >
    <div class="row">
        <div class="col-3 border-end">
            <div class="row">
                <ul class="col-8">
                    <li><b class="text-nowrap"><?php echo $_SESSION['username']?></b></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <ul class="col-8 py-4">
                    <li class="py-2 border-bottom"><a class="text-dark" href="taikhoan.php?page=thongtin">Tài khoản</a></li>
                    <!-- <li class="py-2 border-bottom"><a class="text-dark" href="taikhoan.php?page=diachi">Địa chỉ</a></li> -->
                    <li class="py-2 border-bottom"><a class="text-dark" href="taikhoan.php?page=donmua">Đơn mua</a></li>
                </ul>
            </div>
            
        </div>
        <div class="col-9">
            <div class="container-fluid">
            <?php 
                    if(isset($_GET['page'])){
                        switch ($_GET['page']){
                            case 'thongtin':
                                require_once '../public/thongtin.php';
                                break;
                            case 'suathongtin':
                                require_once '../public/suathongtin.php';
                                break;
                            case 'donmua':
                                require_once '../public/donmua.php';
                                break;
                            default:
                                require_once '../public/thongtin.php';
                                break;
                        }
                    }else{
                        require_once '../public/thongtin.php';
                    }
                ?>
                
            </div>
        </div>
    </div>
</div>
<script>
    function Del(ten){
        return confirm("Bạn có chắc chắn muốn xóa địa chỉ: " + ten + "?");
    }
</script>
<?php 
include '../partials/footer.php';
?>
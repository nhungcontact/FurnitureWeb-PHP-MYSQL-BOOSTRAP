<div>
    <h1>Xóa màu sản phẩm</h1>
    <?php
    $error = false;
    if(isset($_GET['id_SP']) && !empty($_GET['id_SP'])){
        $xoa = mysqli_query($conn,"DELETE FROM `chitietsanpham` WHERE `id_SP` =".$_GET['id_SP']);
        if(!$xoa){
            $error = "Không thể xóa màu sản phẩm";
        }
        if($error !==false){?>
            <div>
                <h5>Thông báo</h5>
                <h4><?php echo $error ?></h4>
                <a href="admin.php?page_layout=sua&id=<?php echo $_GET['id_SP'] ?>">Quay lại</a>
            </div>
        

        <?php }else{?>
            <div>
                <h5>Xóa màu thành công</h5>
                <a href="admin.php?page_layout=sua&id=<?php echo $_GET['id_SP'] ?>">Quay lại</a>
            </div>
        <?php } ?>
    <?php }
    if(isset($_GET['id_ms']) && !empty($_GET['id_ms'])){
        $xoamau = mysqli_query($conn,"DELETE FROM `mausac` WHERE `id_mausac` = '".$_GET['id_ms']."' ");
        if(!$xoa){
            $error = "Không thể xóa màu sản phẩm";
        }
        if($error !==false){?>
            <div>
                <h5>Thông báo</h5>
                <h4><?php echo $error ?></h4>
                <a href="admin.php?page_layout=mausac">Quay lại</a>
            </div>
        <?php } ?>
    <?php } ?>
</div>
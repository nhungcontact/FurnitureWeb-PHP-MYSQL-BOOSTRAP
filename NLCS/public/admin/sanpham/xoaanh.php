<div>
    <h1>Xóa ảnh sản phẩm</h1>
    <?php
    $error = false;
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $xoa = mysqli_query($conn,"DELETE FROM `thuvienanh` WHERE `id_anh` =".$_GET['id']);
        if(!$xoa){
            $error = "Không thể xóa ảnh sản phẩm";
        }
        if($error !==false){?>
            <div>
                <h5>Thông báo</h5>
                <h4><?php echo $error ?></h4>
                <a href="javascript:history.go(-1)">Quay lại</a>
            </div>
        

        <?php }else{?>
            <div>
                <h5>Xóa ảnh thành công</h5>
                <a href="javascript:history.go(-1)">Quay lại</a>
            </div>
        <?php } ?>
    <?php } ?>
</div>
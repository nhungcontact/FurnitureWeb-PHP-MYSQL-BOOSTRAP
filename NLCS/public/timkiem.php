<?php
include '../partials/header.php';
?>
<hr>
<div class="container">
    <h3>Kết quả tìm kiếm</h3>
    <?php
        $tim = isset($_GET['search'])?$_GET['search']:"";
        if($tim){
            $where = "WHERE `tensanpham` LIKE '%".$tim."%'";
            $sanpham = mysqli_query($conn,"SELECT * FROM `sanpham`".$where);
            $rowp = mysqli_num_rows( $sanpham);
            if($rowp>0){?>
                <i>Có <?php echo $rowp ?> sản phẩm được tìm kiếm</i>
                <div class="row py-2">
                    <?php while($row = mysqli_fetch_array($sanpham)){?>
                        <div class="col-3">
                            <a href="view_products.php?id_SP=<?=$row['id_SP'] ?>">
                                <img src="hinh/<?php echo $row['hinh']?>" alt="" class="img-fluid">
                                <p class="pt-2 m-0 text-dark"><b><?php echo $row['tensanpham'] ?></b></p>
                            </a>
                            <p class="text-danger"><?php echo number_format($row['gia']) ?>đ<del class="card-price-old"><?php echo $row['giacu']?></del></p>
                        </div>
                    <?php } ?>
                </div>
            <?php }else{?>
                <p>Không tìm thấy sản phẩm : <?php echo $_GET['search'] ?></p>
        <?php } ?>
    <?php } ?>
</div>

<?php
include '../partials/footer.php';
?>
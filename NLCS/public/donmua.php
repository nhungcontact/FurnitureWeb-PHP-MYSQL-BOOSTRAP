
        <h4 class="">Đơn hàng của bạn</h5>
        <?php 
            $user=mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."' ");
            $row_users = mysqli_fetch_array($user);
            $tatca = mysqli_query($conn, "SELECT * FROM `donhang` WHERE `id` = '".$row_users['id']."' ");
            while($row_dh=mysqli_fetch_array($tatca)){

        ?>
        <div class="pb-3">
            <div class="border-bottom">
                <div class="row jusitify-content-between py-2 border-bottom">
                    <div class="col">
                        <b><?php echo date('d/m/Y H:i:m',$row_dh['ngaylap']) ?></b>
                    </div>
                    <div class="col text-end">
                        <?php 
                        if($row_dh['trangthai']==1){?>
                            <b class="text-success">Đang giao hàng</b>
                        <?php }else{ ?>
                            <b class="text-primary">Đã giao hàng</b>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    $i = 1 ;
                    $tongtien = 0;
                    $ct = mysqli_query($conn,"SELECT p.*, ct.*,d.* FROM `donhang` d INNER JOIN `chitietdonhang` ct ON d.id_DH = ct.id_DH INNER JOIN `sanpham` p ON p.id_SP=ct.id_SP WHERE d.`id_DH` = '".$row_dh['id_DH']."' ");
                    while ($value = mysqli_fetch_assoc($ct)){
                        $tong = $value['gia']*$value['soluong'];
                        $tongtien +=$tong;
                    ?>
                    <div class="border-bottom">
                        <div class="row align-items-center py-2">
                            <div class="col-2">
                                <img src="hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <p><?php echo $value['tensanpham']?></p>
                                <p style="color: rgba(0,0,0,.54);"><?php echo $value['mausac']?></p>
                                <p>x<?php echo $value['soluong']?></p>
                                <!-- <p><?php echo date('d/m/Y H:i',$row_dh['ngaylap'])?></p> -->
                            </div>
                            <div class="col-2">
                                <p class="m-0 text-danger"><?php echo number_format($value['gia']) ?>₫</p>
                                <del class="card-price-old"><?php echo $value['giacu']?></del>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row py-3 text-end">
                    <p class="pe-4"><b>Tổng tiền: <span class="text-danger" style="font-size:17px;"><?php echo number_format($tongtien) ?>₫</span></b></p>
                    <!-- <a href="view_sanpham.php?id_SP='.$value['id_SP'].'"><button type="button" class="btn btn-danger" >Mua lại</button></a> -->
                </div>
            </div>
        </div>           
        <?php } ?>

        
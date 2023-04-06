            
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <h5 class="">Địa chỉ nhận hàng</h5>
                        <a href="taikhoan.php?page=themdc"><button type="button" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i>Thêm điạ chỉ</button></a>
                    </div>
                    <hr>
                        <?php   
                            $i =0;
                            $result = mysqli_query($conn, "SELECT * FROM `users` INNER JOIN `nhanhang` ON users.id=nhanhang.id WHERE users.username='".$_SESSION['username']."'");
                            while($nhanhang = mysqli_fetch_assoc($result)){
                                $i++;?>
                                <div class="p-0 mb-3 row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label text-muted text-end">Họ và tên</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $nhanhang['name']?>">
                                    </div>
                                    <?php if($nhanhang['macdinh']==0){ ?>
                                        <p class="text-danger text-center col-sm-2">Mặc định</p>
                                    <?php }?>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label text-muted text-end">Số điện thoại</label>
                                    <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $nhanhang['sdt']?>">
                                    </div>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label text-muted text-end">Địa chỉ</label>
                                    <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $nhanhang['diachi']?>">
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-flex justify-content-end mb-2">
                                    <?php if($nhanhang['macdinh']!=0){ ?>
                                            <button class="btn btn-outline-dark" type="button">Mặc định</button>
                                    <?php }else{?>
                                        <button class="btn btn-outline-secondary" type="button">Mặc định</button>
                                    <?php } ?> 
                                    <button class="btn btn-primary" type="submit">Sửa</button>
                                    <?php 
                                        if($i>1){?>
                                            <a onclick="return Del('<?php echo $nhanhang['diachi'];?>')" href="taikhoan.php?page=xoatt&id_nhanhang=<?php echo $nhanhang['id_nhanhang']; ?>"><button class="btn btn-primary" type="button">Xóa</button></a>
                                    <?php } ?>                               
                                </div>
                            <hr>
                        <?php } ?>                    
                </div>
                
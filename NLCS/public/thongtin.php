            <?php        
                $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'");
                $user = mysqli_fetch_assoc($result);?>
                <form class="row" method="POST">
                    <h4 class="">Thông tin cá nhân</h5>
                    <hr>
                    <div class="p-0">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Tên đăng nhập</label>
                            <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $user['username']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Email</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="<?php echo $user['email']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Giới tính</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="<?php echo $user['gioitinh']?>">
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="taikhoan.php?page=suathongtin"><button class="btn btn-primary" type="button">Sửa thông tin</button></a>
                        </div>
                    </div>
                    <h4 class="">Thông tin đặt hàng</h5>
                    <hr>
                    <div class="p-0">
                        <?php 
                            $donhang = mysqli_query($conn,"SELECT * FROM `donhang` WHERE `id`= '".$user['id']."' ");
                            while($rowdh=mysqli_fetch_array($donhang)){
                        
                        ?>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Tên liên lạc</label>
                            <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $rowdh['hoten']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="<?php echo $rowdh['sdt']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Địa chỉ</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="<?php echo $rowdh['tinh'],", ",$rowdh['huyen'],", ",$rowdh['xa']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted text-end">Địa chỉ cụ thể</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="<?php echo $rowdh['diachi']?>">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Sửa thông tin</button>
                        </div>
                    </div>
                    
                </form>
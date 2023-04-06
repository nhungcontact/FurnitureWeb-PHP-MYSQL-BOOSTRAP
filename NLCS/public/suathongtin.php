<?php        
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'");
    $user = mysqli_fetch_assoc($result);
    if(isset($_POST['luu'])){
        $email=$_POST['email'];
        $gender = $_POST['gender'];
        $errors=[];
        if (empty($email)) { 
            $errors['email'] = "Lỗi: Bạn chưa nhập email đăng nhập!"; 
        }
        if (empty($gender)) { 
            $errors['gender'] = "Lỗi: Bạn chưa chọn giới tính!"; 
        }
        if(count($errors)==0){
            $suatt=mysqli_query($conn,"UPDATE `users` SET `username`='".$username."',`gioitinh`='".$gender."',`email`='".$email."',`ngaylap`='".time()."' WHERE `id`='".$user['id']."'");
            if($suatt){
                echo ' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                        </svg>
                        <div class="pt-3">
                        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                            Sửa thông tin thành công !<a href="taikhoan.php?page=thongtin">Quay về</a>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </div>';
            }
        }
    }
    ?>
    <form class="row" method="POST">
        <h4 class="">Thông tin cá nhân</h5>
        <hr>
        <div class="p-0">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-3 col-form-label text-muted text-end">Tên đăng nhập</label>
                <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" name="username" id="staticEmail" value="<?php echo $user['username']?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label text-muted text-end">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']?>">
                </div>
                
            </div>
            <div class="mb-3 row">
                <p class="col-sm-3 text-muted text-end">Giới tính</p>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Nam" <?php if($user['gioitinh']=="Nam"){
                                                                                                                                echo "checked";
                                                                                                                            }else{
                                                                                                                                "";
                                                                                                                            }?>>
                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Nữ" <?php if($user['gioitinh']=="Nữ"){
                                                                                                                                echo "checked";
                                                                                                                            }else{
                                                                                                                                "";
                                                                                                                            }?>>
                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Khác" <?php if($user['gioitinh']=="Khác"){
                                                                                                                                echo "checked";
                                                                                                                            }else{
                                                                                                                                "";
                                                                                                                            }?>>
                        <label class="form-check-label" for="inlineRadio2">Khác</label>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" type="submit" name="luu">Lưu thay đổi</button>
            </div>
        </div>
        
    </form>
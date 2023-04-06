<?php
if(isset($_POST['nutdiachi'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
    $diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'");
    $user = mysqli_fetch_assoc($result);
    $id = $user['id'];
    if (empty($name)) { 
        $errors['name'] = "Lỗi: Bạn chưa nhập họ tên!"; 
    }
    if (empty($sdt)) { 
        $errors['sdt'] = "Lỗi: Bạn chưa nhập số điện thoại!"; 
    }
    if (empty($diachi)) { 
        $errors['diachi'] = "Lỗi: Bạn chưa nhập tên địa chỉ!"; 
    }
    $themdiachi = mysqli_query($conn,"INSERT INTO `nhanhang`(`id`, `name`, `sdt`, `diachi`) VALUES ('$id','$name','$sdt','$diachi')");            
    header('location: trangchu.php');
}
?>

    <div class="login_background p-2">
            <form method="post" class="login_form">
                <h4 class="text-center">Địa chỉ nhận hàng</h4>
                <hr>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Họ và tên :</label>
                    <input class="form-control" type="text" name="name" id="_name"
                        value="<?php echo isset($name)?$name:""; ?>">
                    <span class="text-danger"><?php echo (isset($errors['name']))?$errors['name']:''?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Số điện thoại : </label>
                    <input class="form-control" type="text" name="sdt" id="floatingsdt"
                        value="<?php echo isset($sdt)?$sdt:""; ?>">
                    <span class="text-danger"><?php echo (isset($errors['sdt']))?$errors['sdt']:''?></span>

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Địa chỉ : </label>
                    <input class="form-control" type="text" name="diachi" id="floatingDiachi" value="<?php echo isset($diachi)?$diachi:""; ?>">
                    <span class="text-danger"><?php echo (isset($errors['diachi']))?$errors['diachi']:''?></span>
                </div>
                        
                <div class="form-floating mb-4 mt-4">
                    <button type="reset" class="btn btn-primary">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary"
                                        name="nutdiachi" value="Hoàn tất">
                        Hoàn Tất
                    </button>
                </div>
            </form>
    </div>

<h5 class="">Thêm địa chỉ nhận hàng</h5>
<hr>
<?php
$name = "";
$sdt = "";
$diachi ="";
$errors=[];
// $result = mysqli_query($conn,"SELECT * FROM `nhanhang`");
// $nhanhang = mysqli_fetch_assoc($result);
// var_dump($nhanhang);exit;
if(isset($_POST['themdc'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
    $diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'");
    $user = mysqli_fetch_assoc($result);
    $id = $user['id'];
    if (empty($name)) { 
        $errors['name'] = "Lỗi: Bạn chưa nhập họ và tên!"; 
    }
    if (empty($sdt)) { 
        $errors['sdt'] = "Lỗi: Bạn chưa nhập số điện thoại!"; 
    }
    if (empty($diachi)) { 
        $errors['diachi'] = "Lỗi: Bạn chưa nhập tên địa chỉ!"; 
    }
    if(empty($_POST['macdinh'])){
        $_POST['macdinh']="1";
    }else{
        $_POST['macdinh']="";
    }
    // var_dump("INSERT INTO `nhanhang`(`id`, `name`, `sdt`, `diachi`,`macdinh`) VALUES ('$id','$name','$sdt','$diachi','".$_POST['macdinh']."')");exit;
    if (count($errors) == 0) {
    $themdiachi = mysqli_query($conn,"INSERT INTO `nhanhang`(`id`, `name`, `sdt`, `diachi`,`macdinh`) VALUES ('$id','$name','$sdt','$diachi','".$_POST['macdinh']."')");            
    header('location: taikhoan.php?page=diachi');
    }
}
?>
<form class="pe-5" action="" method="POST">
    <div class="p-0 mb-3 row">
        <label for="hoten" class="col-sm-2 col-form-label text-muted text-end">Họ và tên </label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="hoten" value="<?php echo isset($name)?$name:""; ?>">
        <span class="text-danger"><?php echo (isset($errors['name']))?$errors['name']:''?></span>
        </div>
        
    </div>
    <div class="p-0 mb-3 row">
        <label for="sdt" class="col-sm-2 col-form-label text-muted text-end">Số điện thoại</label>
        <div class="col-sm-10">
        <input type="text" name="sdt" class="form-control" id="sdt" value="<?php echo isset($sdt)?$sdt:""; ?>">
        <span class="text-danger"><?php echo (isset($errors['sdt']))?$errors['sdt']:''?></span>
        </div>
        
    </div>
    <div class="p-0 mb-3 row">
        <label for="diachi" class="col-sm-2 col-form-label text-muted text-end">Địa chỉ</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="diachi" id="nhapmota" rows="3"><?php echo isset($diachi)?$diachi:"";?></textarea>
            <span class="text-danger"><?php echo (isset($errors['diachi']))?$errors['diachi']:''?></span>
        </div>
        
    </div>
    <div class="p-0 mb-3 row">
        <div class="col-sm-2"></div>
        <div class="form-check form-switch col-sm-10">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="macdinh">
            <label class="form-check-label" for="flexSwitchCheckDefault">Đặt làm địa chỉ mặc định</label>
        </div>
    </div>
    
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" type="submit" name="themdc" value="Thêm">Thêm địa chỉ</button>
    </div>
</form>
<?php 
ob_start();
include '../partials/header.php'; 
?>
<hr>
<?php
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"]=array();
    }
    if(!isset($_SESSION['mausac'])){
        $_SESSION['mausac']=array();
    }

    function capnhat($add=false){

        foreach ($_POST['quanlity'] as $id => $quanlity){

            if($quanlity == 0){
                unset($_SESSION['cart'][$id]);
            }else{
                if($add){
                    $_SESSION["cart"][$id] += $quanlity;

                }else{
                    $_SESSION["cart"][$id] = $quanlity;
                }
            }
            
        }
        
    }

    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case "add":
                echo "$_POST[mausac]";
                if($_POST['mausac'] !== ''){
                    foreach ($_POST['mausac'] as $id => $mausac){
                        $_SESSION["mausac"][$id] = $mausac;
                    }
                    capnhat(true);
                    header("location:javascript://history.go(-1)");
                }
                
                break;
            
            case "xoasanpham":
                if(isset($_GET['id'])){
                    unset($_SESSION["cart"][$_GET['id']]);
                    unset($_SESSION["mausac"][$_GET['id']]);
                }
                header('Location:./view_cart.php');
                break;
            case "xoatatca":
                unset($_SESSION["cart"]);
                unset($_SESSION["mausac"]);
                header('Location:./view_cart.php');
                break;
            case "submit":
                if(isset($_POST['capnhatmau'])){
                    foreach ($_POST['mausac'] as $id=>$mausac){
                        $_SESSION["mausac"][$id] = $mausac;
                    }
                    header('Location:./view_cart.php');
                }
                // cap nhat so luong
                elseif(isset($_POST['capnhat'])){
                    capnhat();
                    header('Location:./view_cart.php');
                // dathang
                }elseif(isset($_POST['dathang'])){
                    // da dang nhap
                    if (isset($_SESSION['username']) && $_SESSION['username']){
                        if(empty($_POST['quanlity']) && empty($_POST['mausac'])){
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Không thể thanh toán!</strong>Chưa có sản phẩm nào trong giỏ hàng!<a class="alert-link" href="sanpham.php">Nhấn vào đây để tiếp tục mua hàng.</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                        }else{
                            $errors=[];
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
                            
                            $idtinh =  isset($_POST['tinh'])?$_POST['tinh']:"";
                            $tentinh = mysqli_query($conn,"SELECT `ten_tinh` FROM `tinh` WHERE `id_tinh` = '".$_POST['tinh']."' ");
                            $tinh = mysqli_fetch_array($tentinh);

                            $idhuyen =  isset($_POST['huyen'])?$_POST['huyen']:"";
                            $tenhuyen = mysqli_query($conn,"SELECT `ten_huyen` FROM `quanhuyen` WHERE `id_huyen` = '".$_POST['huyen']."' ");
                            $huyen = mysqli_fetch_array($tenhuyen);

                            $idxa =  isset($_POST['xa'])?$_POST['xa']:"";
                            $tenxa = mysqli_query($conn,"SELECT `ten_xa` FROM `phuongxa` WHERE `id_xa` = '".$_POST['xa']."' ");
                            $xa = mysqli_fetch_array($tenxa);

                            $diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
                            $ghichu = mysqli_real_escape_string($conn, $_POST['ghichu']);


                            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'");
                            $user = mysqli_fetch_assoc($result);
                            $id = $user['id'];
                            if (empty($name)) { 
                                $errors['name'] = "Lỗi: Bạn chưa nhập họ và tên!"; 
                            }
                            if (empty($sdt)) { 
                                $errors['sdt'] = "Lỗi: Bạn chưa nhập số điện thoại!"; 
                            }
                            if (empty($tinh)) { 
                                $errors['tinh'] = "Lỗi: Bạn chưa nhập tên tỉnh!"; 
                            }
                            if (empty($huyen)) { 
                                $errors['huyen'] = "Lỗi: Bạn chưa nhập tên quận/huyện!"; 
                            }
                            if (empty($xa)) { 
                                $errors['xa'] = "Lỗi: Bạn chưa nhập tên phường/xã!"; 
                            }
                            if (empty($diachi)) { 
                                $errors['diachi'] = "Lỗi: Bạn chưa nhập tên địa chỉ!"; 
                            }
                            // khong loi 
                            if(count($errors) == 0){
                                $product = mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `id_SP` IN (".implode(",", array_keys($_POST['quanlity'])).")");
                                $tong =0;
                                $donhang = array();
                                // var_dump("SELECT * FROM `sanpham` WHERE `id_SP` IN (".implode(",", array_keys($_POST['quanlity'])).")");exit;
                                while($row = mysqli_fetch_array($product)){
                                    $donhang[] = $row; 
                                    $tong += $row['gia']*$_POST['quanlity'][$row['id_SP']];
                                    $soluong = $row['soluong']-$_POST['quanlity'][$row['id_SP']];
                                    $capnhatsl = mysqli_query($conn,"UPDATE `sanpham` SET `soluong` = '".$soluong."' WHERE `id_SP`= '".$row['id_SP']."' ");
                                }
                                // var_dump("INSERT INTO `donhang`(`id`, `hoten`, `sdt`, `tinh`, `huyen`, `xa`, `diachi`, `ghichu`, `tongtien`, `trangthai`, `ngaylap`) VALUES ('$id','$name','$sdt','$tinh','$huyen','$xa','$diachi','$ghichu','$tong',1,'".time()."')");exit;
                                $themdonhang = mysqli_query($conn,"INSERT INTO `donhang`(`id`, `hoten`, `sdt`, `tinh`, `huyen`, `xa`, `diachi`, `ghichu`, `tongtien`, `trangthai`, `ngaylap`) VALUES ('$id','$name','$sdt','".$tinh['ten_tinh']."','".$huyen['ten_huyen']."','".$xa['ten_xa']."','$diachi','$ghichu','$tong',1,'".time()."')");       
                                if($themdonhang){
                                    $idDH = $conn->insert_id;
                                    $themchuoi = "";
                                    foreach($donhang as $key => $product){
                                        $themchuoi .= "('".$idDH."','".$product['id_SP']."','".$_POST['quanlity'][$product['id_SP']]."','".$_POST['mausac'][$product['id_SP']]."','".$product['gia']."')";
                                        if($key != count($donhang)-1){
                                            $themchuoi .= ","; 
                                        }
                                    }
                                    $themchitiet = mysqli_query($conn,"INSERT INTO `chitietdonhang`(`id_DH`, `id_SP`, `soluong`,`mausac`, `gia`) VALUES ".$themchuoi.";");
                                    if($themchitiet){
                                        unset($_SESSION["cart"]);
                                        unset($_SESSION["mausac"]);
                                        header('Location:./thongbao.php');
                                    }
                                }
                            }

                        }

                    // chua dang nhap
                    }else{
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Không thể thanh toán! </strong>Bạn chưa đăng nhập tài khoản! <a class="alert-link" href="server.php?page=dangnhap">Đăng nhập tài khoản.</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
            break;     
        }        
    }


    if(!empty($_SESSION["cart"])){
        $result = mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `id_SP` IN (".implode(",", array_keys($_SESSION['cart'])).")");
    }
    if(!empty($result)){
        $soluong = $result->num_rows;
        $_SESSION['soluong']=$soluong;
    }
    // var_dump("SELECT * FROM `sanpham` WHERE `id_SP` IN (".implode(",", array_keys($_SESSION['cart'])).")");
    
?>
    <div class="container">
        <div class="row">
            <h2 class="py-2">Giỏ hàng</h2>
                <form action="view_cart.php?action=submit" method="POST" enctype="multipart/form-data">
                    <?php if(!empty($result)){?>
                    <div class="pb-4">
                        <div class="p-4 border border-dark" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-end">
                                    <a onclick="return xoatatca()" href="view_cart.php?action=xoatatca"><i style="font-size: 25px;color: #696969;" class="fa-solid fa-xmark"></i></a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-2 text-center align-middle" style="font-size:16px;white-space:nowrap;">Ảnh sản phẩm</th>
                                            <th colspan="2" class="col-3 text-center align-middle" style="font-size:16px;white-space:nowrap;">Tên sản phẩm</th>
                                            <th class="col-1 text-center align-middle" style="font-size:16px;white-space:nowrap;">Số lượng</th>
                                            <th class="col-2 text-center align-middle" style="font-size:16px;white-space:nowrap;">Giá</th>
                                            <th class="col-2 text-center align-middle" style="font-size:16px;white-space:nowrap;">Thành tiền</th>
                                            <th class="col-1 text-center align-middle" style="font-size:16px;white-space:nowrap;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tong=0;
                                        $tongsl=0;
                                        
                                        while ($value = mysqli_fetch_array($result)){
                                            $soluong = $value['soluong'];
                                            $tong+=$value['gia']*$_SESSION['cart'][$value['id_SP']];?>
                                        <tr>
                                            <td class="text-center align-middle" style="font-size:14px;"><a href="view_sanpham.php?id_SP=<?php echo $value['id_SP'] ?>"><img src="hinh/<?php echo $value['hinh']?>" class="img-fluid"></a></td>
                                            <td colspan="2" class="text-center align-middle" style="font-size:14px;">
                                                <a style="color:#575454;" href="view_sanpham.php?id_SP=<?php echo $value['id_SP'] ?>"><?php echo $value['tensanpham']?></a>
                                                <p><?php echo $_SESSION['mausac'][$value['id_SP']] ?>                                            
                                                <a href="/" class="text-dark" data-bs-toggle="collapse" data-bs-target="#demo<?php echo $value['id_SP'] ?>"><i onclick="myFunction(this)" class="fa-solid fa-caret-right"></i></a></p>
                                                <div style="border-color: rgba(0,0,0,.09);box-shadow: 0 5px 10px 0 rgb(0 0 0 / 9%);">
                                                    <div class="collapse px-4 py-2" id="demo<?php echo $value['id_SP'] ?>">
                                                        <div class="text-start">
                                                            <p class="p-0 m-0" style="color:rgba(0,0,0,.54);">Màu sắc : </p>
                                                            <?php 
                                                                $mausac = mysqli_query($conn,"SELECT * FROM `chitietsanpham` ct INNER JOIN `mausac` ms ON ct.`id_mausac`=ms.`id_mausac` WHERE ct.`id_SP`='".$value['id_SP']."'");
                                                                while($rowms=mysqli_fetch_array($mausac)){
                                                                    if($_SESSION['mausac'][$value['id_SP']]==$rowms['mausac']){
                                                                        $check = "checked";
                                                                    }else{
                                                                        $check = "";
                                                                    }
                                                            ?>
                                                            <div class="form-check form-check-inline" style="font-size:30px;margin-right:0px!important;">
                                                                <input class="form-check-input" style="border-radius:50%;background-color:<?php echo $rowms['mausac_css']?>!important;" type="radio" name="mausac[<?php echo $value['id_SP']?>]" value="<?php echo $rowms['mausac'] ?>" title="<?php echo $rowms['mausac'] ?>" <?php echo $check ?>/>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <hr>
                                                        <div class="justify-content-end d-flex">
                                                            <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-toggle="collapse" data-bs-target="#demo<?php echo $value['id_SP'] ?>">Thoát</button>
                                                            <button class="btn btn-sm" type="submit" name="capnhatmau" value="Cập nhật màu" style="color: #fff; background-color: #e74c3c; border-color: #e74c3c;">Cập nhật</button>
                                                        </div>
                                                        
                                                    </div>
                                                
                                                </div>
                                                
                                            </td>
                                            <td class="text-center align-middle" style="font-size:14px;"><input class="text-center" type="text" size=2 value="<?php echo $_SESSION['cart'][$value['id_SP']] ?>" name="quanlity[<?php echo $value['id_SP'] ?>]"></td>
                                            <td class="text-center align-middle text-danger" style="font-size:14px;"><?php echo number_format($value['gia'])?>₫</td>
                                            <td class="text-center align-middle text-danger" style="font-size:15px;"><b><?php echo number_format($value['gia']*$_SESSION['cart'][$value['id_SP']])?>₫</b></td>
                                            <td class="text-center align-middle" style="font-size:14px;"><a class="text-dark" onclick="return Del('<?php echo $value['tensanpham'];?>')" href="view_cart.php?action=xoasanpham&id=<?php echo $value['id_SP']?>"><i style="font-size:22px;color: #696969;" class="fa-solid fa-xmark"></i></a></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td style="white-space:nowrap;"><strong><h5>Tổng thành tiền:</h5></strong></td>
                                            <td class="text-end text-danger"><strong><h5><?php echo number_format($tong)?>₫ </h5></strong></td>
                                            <td class=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-grid gap-2 d-flex justify-content-end">
                                <button class="btn" style="color: #fff; background-color: #e74c3c; border-color: #e74c3c;" type="submit" name="capnhat" value="Cập nhật">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>
                    <p>Không có sản phẩm trong giỏ hàng</p>
                <?php } ?>
                    <hr>
                    <div class="pt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="py-2">Thông tin nhận hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="p-0 mb-3 row">
                                    <label for="hoten" class="col-sm-2 col-form-label text-end">Họ và tên : <b class="text-danger">(*)</b> </label>
                                    <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="hoten" value="<?php echo isset($name)?$name:""; ?>">
                                    <span class="text-danger"><?php echo (isset($errors['name']))?$errors['name']:''?></span>
                                    </div>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label for="sdt" class="col-sm-2 col-form-label text-end">Số điện thoại : <b class="text-danger">(*)</b>  </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sdt" class="form-control" id="sdt" value="<?php echo isset($sdt)?$sdt:""; ?>">
                                        <span class="text-danger"><?php echo (isset($errors['sdt']))?$errors['sdt']:''?></span>
                                    </div>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label class="col-sm-2 col-form-label text-end">Địa chỉ : <b class="text-danger">(*)</b>  </label>
                                    <div class="col-md">
                                        <select class="form-select js-example-basic-single mb-3" name="tinh" id="tinh" aria-label=".form-select-sm">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                            <?php 
                                                $tinh = mysqli_query($conn,"SELECT * FROM `tinh`");
                                                while($row_tinh = mysqli_fetch_array($tinh)){
                                            ?>
                                                <option value="<?php echo $row_tinh['id_tinh'] ?>"><?php echo $row_tinh['ten_tinh'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo (isset($errors['tinh']))?$errors['tinh']:''?></span>
                                    </div>
                                    
                                    <div class="col-md">
                                        <select class="form-select js-example-basic-single mb-3" name="huyen" id="huyen" aria-label=".form-select-sm">
                                            <option value="" selected>Chọn quận huyện</option>
                                            <?php 
                                                $huyen = mysqli_query($conn,"SELECT * FROM `quanhuyen`");
                                                while($row_huyen = mysqli_fetch_array($huyen)){
                                            ?>
                                                <option value="<?php echo $row_huyen['id_huyen'] ?>"><?php echo $row_huyen['ten_huyen'] ?></option>
                                            <?php } ?> 
                                        </select>
                                        <span class="text-danger"><?php echo (isset($errors['huyen']))?$errors['huyen']:''?></span>
                                    </div>
                                    <div class="col-md">
                                        <select class="form-select js-example-basic-single" name="xa" id="xa" aria-label=".form-select-sm">
                                            <option value="" selected>Chọn phường xã</option>
                                            <?php 
                                                $xa = mysqli_query($conn,"SELECT * FROM `phuongxa`");
                                                while($row_xa = mysqli_fetch_array($xa)){
                                            ?>
                                                <option value="<?php echo $row_xa['id_xa'] ?>"><?php echo $row_xa['ten_xa'] ?></option>
                                            <?php } ?> 
                                        </select>
                                        <span class="text-danger"><?php echo (isset($errors['xa']))?$errors['xa']:''?></span>
                                    </div>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label for="diachi" class="col-sm-2 col-form-label text-end">Địa chỉ cụ thể : <b class="text-danger">(*)</b> </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="diachi" id="nhapmota" rows="2"><?php echo isset($diachi)?$diachi:"";?></textarea>
                                        <span class="text-danger"><?php echo (isset($errors['diachi']))?$errors['diachi']:''?></span>
                                    </div>
                                </div>
                                <div class="p-0 mb-3 row">
                                    <label for="ghichu" class="col-sm-2 col-form-label text-end">Ghi chú : </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="ghichu" id="nhapmota" rows="3"><?php echo isset($ghichu)?$ghichu:"";?></textarea>
                                        <span class="text-danger"><?php echo (isset($errors['ghichu']))?$errors['ghichu']:''?></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button onclick="return thongbao()" class="btn btn-primary" type="submit" name="dathang" value="Thanh toán">Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>    
    <script>
        function Del(ten){
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm: " + ten + "?");
        }
    </script>
    <script>
        function myFunction(x) {
            x.classList.toggle("fa-sort-down");
        }
    </script>
    <script>
            function xoatatca(){
                return confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm không ?");
            }
        </script>
        <script>
        jQuery(document).ready(function($){
            $("#tinh").change(function(event) {
            idtinh = $("#tinh").val();
            $.post('huyen.php', {"idtinh":idtinh}, function(data){
                $("#huyen").html(data);
            });
            });

            $("#huyen").change(function(event) {
            idhuyen = $("#huyen").val();
            $.post('xa.php', {"idhuyen":idhuyen}, function(data){
                $("#xa").html(data);
            });
            });

        });
        </script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    
<?php include '../partials/footer.php';?>
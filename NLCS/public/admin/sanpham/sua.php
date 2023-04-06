
        <?php 
            $loaisp = mysqli_query($conn, "SELECT * FROM `loaisanpham`");
            $result = mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `id_SP` = '".$_GET['id']."' ");
            $sanpham = mysqli_fetch_assoc($result);
            $thuvienanh = mysqli_query($conn,"SELECT * FROM `thuvienanh` WHERE `id_SP`='".$_GET['id']."' ");
            $chitiet = mysqli_query($conn,"SELECT * FROM `chitietsanpham` ct INNER JOIN `mausac` ms ON ct.`id_mausac`= ms.`id_mausac` WHERE ct.`id_SP`='".$_GET['id']."' ");
            $sp=mysqli_query($conn,"SELECT `lsp_ma` FROM `sanpham` WHERE `lsp_ma`= '".$sanpham['lsp_ma']."' ");
            $row_sp = mysqli_fetch_array($sp);
            
            // var_dump("SELECT `lsp_ma` FROM `sanpham` WHERE `lsp_ma`= '".$sanpham['lsp_ma']."' ");

            if(!empty($thuvienanh) && !empty($thuvienanh->num_rows)){
                while($rowthuvien = mysqli_fetch_array($thuvienanh)){
                    $sanpham['thuvienanh'][] = array(
                        'id_anh' => $rowthuvien['id_anh'],
                        'path' => $rowthuvien['path'] 
                    );
                }
            }
            if (isset($_POST['btnsua'])) { 

                if($_FILES['hinh']['name'] == '' && $_FILES['hinh1']['name'] == ''){
                    $hinh=$sanpham['hinh'];
                    $hinh1=$sanpham['hinh1'];
                }else{
                    $hinh=$sanpham['hinh'];
                    $hinh1=$sanpham['hinh1'];
                }

                $thuvienanh = array();
                $maloai=$_POST['maloai'];
                $ten=$_POST['ten'];
                $soluong = $_POST['soluong'];
                $phantram=$_POST['phantram'];
                $giacu=$_POST['giacu'];
                $gia=$_POST['gia'];
                $mota=$_POST['mota'];
                $error=[];
                
                if(isset($_POST['mausac']) && !empty($_POST['mausac'][0])){
                    $mausac = $_POST['mausac'];
                }

                if(isset($_FILES['thuvienanh']) && !empty($_FILES['thuvienanh']['name'][0])){
                    $uploadedFiles = $_FILES['thuvienanh'];
                    $result = uploadFiles($uploadedFiles);
                    if (!empty($result['errors'])){
                        $error = $result['errors'];
                    }else{
                        $thuvienanh = $result['uploaded_files'];
                    }
                }
                if(empty($maloai)){
                    $error['maloai'] = "Lỗi: Bạn chưa mã loại sản phẩm !";
                }
                if(empty($ten)){
                    $error['ten'] = "Lỗi: Bạn chưa nhập tên sản phẩm !";
                }
                if(empty($gia)){
                    $error['gia'] = "Lỗi: Bạn chưa nhập giá sản phẩm !";
                }
                if(empty($soluong)){
                    $error['soluong'] = "Lỗi: Bạn chưa nhập số lượng sản phẩm !";
                }
                if(empty($mota)){
                    $error['mota'] = "Lỗi: Bạn chưa nhập mô tả sản phẩm !";
                }
                if(empty($hinh)){
                    $error['hinh'] = "Lỗi: Bạn chưa chọn hình sản phẩm !";
                }
                if(empty($hinh1)){
                    $error['hinh1'] = "Lỗi: Bạn chưa chọn hình sản phẩm !";
                }
                // if(empty($mausac)){
                //     $error['mausac'] = "Lỗi: Bạn chưa chọn màu sắc sản phẩm !";
                // }

                // $ma = mysqli_query($conn,"SELECT MAX(`id_SP`) id_SP FROM `sanpham` WHERE `lsp_ma`='".$maloai."'");
                // $row_ma = mysqli_fetch_array($ma);
                // $ma_next = $row_ma['id_SP'] + 1;
                
                if(empty($chitiet->num_rows)){
                    if(empty($mausac)){
                        $error['mausac'] = "Lỗi: Bạn chưa chọn màu sắc sản phẩm !";
                    }
                }

                if(count($error)==0){
                    $suasp = mysqli_query($conn,"UPDATE `sanpham` SET `hinh`='$hinh',`hinh1`='$hinh1',`tensanpham`='$ten',`phantram`='$phantram',`giacu`='$giacu',`gia`='$gia',`lsp_ma`='$maloai',`mota`='$mota',`soluong`='$soluong' WHERE `id_SP` = '".$_GET['id']."'");
                    if($suasp){
                        $trung="";
                        $themma = !empty($_GET['id']) ? $_GET['id']:$conn->$themma;
                        // them mau
                        if(empty($chitiet->num_rows)&&!empty($mausac)){
                            foreach($mausac as $key){
                                $themchitiet = mysqli_query($conn,"INSERT INTO `chitietsanpham`(`id_SP`, `id_mausac`) VALUES ('".$themma."','".$key."')");
                            }
                        }
                        // kiem tra trung mau
                        if(!empty($mausac) && !empty($chitiet->num_rows)){

                            while($row_ctsp = mysqli_fetch_array($chitiet)){
                                foreach ($mausac as $key){
                                    // giong mau
                                    if($row_ctsp['id_mausac']==$key){
                                        $trung = 1;
                                        break;
                                    }else{ // khong giong mau
                                        $trung = 0 ;
                                    }
                                    
                                }
                                if($trung==1){
                                    break;
                                }
                            }
                            if($trung == 1){
                                echo '<div class="pt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
                                        <div class="alert alert-warning d-flex alert-dismissible fade show" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                            Màu đã tồn tại trong sản phẩm ! <a href="admin.php?page_layout=danhsach">Quay về</a>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>';
                            }
                            
                            if($trung==0){
                                foreach($mausac as $key){
                                    // var_dump("INSERT INTO `chitietsanpham`(`id_SP`, `id_mausac`) VALUES ('".$themma."','".$key."')");
                                    $themchitiet = mysqli_query($conn,"INSERT INTO `chitietsanpham`(`id_SP`, `id_mausac`) VALUES ('".$themma."','".$key."')");
                                }
                            }
                        }  
                        
                        // var_dump($themma);exit;
                        
                        
                        if(!empty($thuvienanh)){
                            $themgiatri="";
                            foreach($thuvienanh as $path){
                                if(empty($themgiatri)){
                                    $themgiatri = "('".$themma."','".$path."')";
                                }else{
                                    $themgiatri .= ",('".$themma."','".$path."')";
                                }
                            }
                            $themthuvien = mysqli_query($conn,"INSERT INTO `thuvienanh`(`id_SP`, `path`) VALUES ".$themgiatri.";");                                                     
                        }
                        echo '<div class="pt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
                                <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                    Sửa sản phẩm thành công ! <a href="admin.php?page_layout=danhsach">Quay về</a>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>';
                    }
                }
            }  
        ?>
        <nav aria-label="breadcrumb" class="pt-3">
            <ol class="breadcrumb ps-3">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="admin.php?page_layout=danhsach">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
            </ol>
        </nav>
        <hr>
        <h3 class="text-center pt-3">Sửa sản phẩm</h3>
        <form id="sanpham_form" class="ps-4" method="POST" enctype="multipart/form-data">
            <!-- Ten loai san pham -->
            <div class="my-3 row">
                <label class="form-label col-sm-2 col-form-label" for="inputGroupSelect">Tên loại sản phẩm: </label>
                <div class="col-sm-6">
                    <select name="maloai" class="form-select">
                        <option value="">Chọn loại sản phẩm</option>
                        <?php 
                            while ($loai = mysqli_fetch_assoc($loaisp)) {?>
                        <option value="<?php echo $loai['lsp_ma'];?>" <?php if($row_sp['lsp_ma']==$loai['lsp_ma']){
                                                                                echo "selected";
                                                                            }else{
                                                                                "";
                                                                            }?>>
                            <?php echo $loai['lsp_ten']?>
                        </option>
                            <?php } ?>
                    </select>
                    <div class="text-danger"><?php echo (isset($error['maloai']))?$error['maloai']:''?></div>                           
                </div>
            </div>
            <!-- Ten san pham -->
            <div class="my-3 row">
                <label for="nhaptensp" class="col-sm-2 col-form-label">Tên sản phẩm: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ten" id="nhaptensp" value="<?php echo (!empty($sanpham['tensanpham'])?$sanpham['tensanpham']:"") ?>" >
                    <div class="text-danger"><?php echo (isset($error['ten']))?$error['ten']:''?></div>
                </div>
            </div>

            
                <!-- So luong -->
                <div class="mb-3 row align-items-center">
                <label for="nhapsoluong" class="col-sm-2 col-form-label">Số lượng: </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="soluong" id="nhapsoluong" value="<?php echo (!empty($sanpham['soluong'])?$sanpham['soluong']:"") ?>">
                    <div class="text-danger"><?php echo (isset($error['soluong']))?$error['soluong']:''?></div>

                </div>
            </div>
            <!-- Gia -->
            <div class="mb-3 row align-items-center">
                <label for="nhapgiasp" class="col-sm-2 col-form-label">Giá sản phẩm: </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="gia" id="nhapgiasp" value="<?php echo (!empty($sanpham['gia'])?$sanpham['gia']:"") ?>">
                    <div class="text-danger"><?php echo (isset($error['gia']))?$error['gia']:''?></div>
                </div>
            </div>
            <!-- Gia cu -->
            <div class="my-3 row">
                <label for="nhapgiacu" class="col-sm-2 col-form-label">Giá cũ sản phẩm: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="giacu" id="nhapgiacu" value="<?php echo (!empty($sanpham['giacu'])?$sanpham['giacu']:"") ?>">
                </div>
            </div>

            <!-- Phan tram -->
            <div class="my-3 row">
                <label for="nhapphantram" class="col-sm-2 col-form-label">Phần trăm: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phantram" id="nhapphantram" value="<?php echo (!empty($sanpham['phantram'])?$sanpham['phantram']:"") ?>">
                </div>
            </div>

            <!-- Anh -->
            <div class="mb-3 row align-items-center">
                <label for="nhapgiasp" class="col-sm-2 col-form-label">Ảnh 1: </label>
                <div class="col-sm-6">
                    <?php if(!empty($sanpham['hinh'])){ ?>
                        <img src="../hinh/<?php echo $sanpham['hinh'] ?>" class="img-fluid col-4 border border-1" alt=""><br/>
                    <?php } ?>
                    <input type="file" class="form-control mt-3" id="file-upload" name="hinh">
                    <div class="text-danger"><?php echo (isset($error['hinh']))?$error['hinh']:''?></div>

                </div>
            </div>

            <!-- Anh1 -->
            <div class="mb-3 row align-items-center">
                <label for="nhapgiasp" class="col-sm-2 col-form-label">Ảnh 2:</label>
                <div class="col-sm-6">
                    <?php if(!empty($sanpham['hinh1'])){ ?>
                        <img src="../hinh/<?php echo $sanpham['hinh1'] ?>" class="img-fluid col-4 border border-1" alt=""><br/>
                    <?php } ?>
                    <input type="file" class="form-control mt-3" id="file-upload" name="hinh1"/>
                    <div class="text-danger"><?php echo (isset($error['hinh1']))?$error['hinh1']:''?></div>

                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="nhapthuvienanh" class="col-sm-2 col-form-label">Thư viện ảnh:</label>
                <div class="col-sm-6">
                    <?php if(!empty($sanpham['thuvienanh'])){ ?>
                        <div class="row">
                            <?php foreach($sanpham['thuvienanh'] as $anh) {?>
                                <div class="col-4">
                                    <img src="/.<?php echo $anh['path'] ?>" alt="" class="img-fluid border border-1">
                                    <a href="admin.php?page_layout=xoaanh&id=<?php echo $anh['id_anh'] ?>">Xóa</a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <input name="thuvienanh[]" type="file" multiple="" class="form-control" />
                </div>
            </div>
             <!-- Mau sac -->
            <div class="mb-3 row align-items-center">
                <label for="nhapmota" class="col-sm-2 col-form-label">Màu sắc: </label>
                <?php if(!empty($chitiet->num_rows)){?>
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <?php 
                            while($row_chitiet = mysqli_fetch_array($chitiet)){?>
                                <div class="p-3 rounded-1" style="background-color:<?php echo $row_chitiet['mausac_css'] ?>;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;"></div>
                                <div class="ms-1 me-4"><?php echo $row_chitiet['mausac'] ?></div>
                            <?php } ?>
                            <a onclick="return xoaMau()" href="admin.php?page_layout=xoamau&id_SP=<?php echo $_GET['id'] ?>">Xóa</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mt-2">
                    <div class="col-sm-2"></div>
                    <select class="js-example-basic-multiple col-sm-6" name="mausac[]" multiple="multiple">
                        <?php 
                            $mausac=mysqli_query($conn,"SELECT * FROM `mausac`");
                            while($row_mausac = mysqli_fetch_array($mausac)){
                        ?>
                        <option value="<?php echo $row_mausac['id_mausac'] ?>"  >
                            <?php echo $row_mausac['mausac'] ?>
                        </option>
                        <?php } ?>
                    </select>
                    <div class="col-sm-2">
                        <a href="admin.php?page_layout=themmau"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm màu mới</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="text-danger col-sm-6"><?php echo (isset($error['mausac']))?$error['mausac']:''?></div>
                </div>
            </div>
            
            
            <!-- Mo ta -->
            <div class="mb-3 row align-items-center">
                <label for="nhapmota" class="col-sm-2 col-form-label">Mô tả: </label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="mota" id="nhapmota" rows="10"><?php echo (isset($sanpham['mota'])?$sanpham['mota']:"") ?></textarea>
                    <div class="text-danger"><?php echo (isset($error['mota']))?$error['mota']:''?></div>
                </div>
            </div>
            <!-- nut sua -->
            <div class="row py-3">
                <div class="col-sm-2"></div>
                <div class="col d-flex">
                    <a href="javascript:history.go(-1)"><button type="button" class="btn btn-danger me-2"><i class="fa-solid fa-chevron-left me-1"></i>Quay về</button></a>
                    <button type="submit" name="btnsua" class="btn btn-success">Sửa sản phẩm</button>
                </div>
            </div>
        </form>
        <script>
            function xoaMau(){
                return confirm("Bạn có chắc chắn muốn xóa màu sản phẩm không ?");
            }
        </script>
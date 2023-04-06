
<?php 
    function layAnh(){
        $allFiles = array();
        $allDirs = glob('hinh/tintuc/*');
        foreach ($allDirs as $dir) {
            $allFiles = array_merge($allFiles, glob($dir . "/*"));
        }
        return $allFiles;
    }

    function taiAnh($uploadedFiles){
        $files = array();
        $errors = array();
        $returnFiles=array();
        // Xu li gom du lieu vao tung file da load
        foreach($uploadedFiles as $key => $values){
            if(is_array($values)){
                foreach ($values as $index => $value){
                    $files[$index][$key] = $value;
                }
            }else{
                $files[$key]=$values;
            }
            
        }

        $uploadPath = "./hinh/tintuc/";
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,true);
        }
       if(is_array(reset($files))){ //nhieu anh
            foreach ($files as $file){
                $result = tientrinhUpanh($file,$uploadPath);
                if($result['error']){
                    $errors[]=$result['message'];
                }else{
                    $returnFiles[]=$result['path'];
                }
            }
       }else{   //1 ảnh
            $result = tientrinhUpanh($files,$uploadPath);
            if($result['error']){
                return array(
                    'errors' => $result['message']
                );
            }else{
                return array(
                    'path' => $result['path']
                );
            }
       }
       return array(
            'errors' => $errors,
            'uploaded_files' => $returnFiles
       );
        
    }
    // Check file hop le
    function kiemtraAnh($file, $uploadPath){
        //Kiem tra xem co vuot qua dung luong cho phep khong
        if($file['size'] > 2 * 1024 * 1024){
            return false;
        }

        // Kiem tra xem kieu file co hop le khong
        $validTypes = array("jpg","jpeg","png","bmp");
        $fileType = substr($file['name'], strrpos($file['name'], "." )+ 1);
        if(!in_array($fileType, $validTypes)){
            return false;
        }
        //Kiem tra xem file da ton tai chua? Neu ton tai thi doi ten
        $num=1;
        $fileName=substr($file['name'], 0, strrpos($file['name'], "."));
        while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)){
            $fileName = $fileName . "(" . $num . ")";
            $num++;
        }
        $file['name'] = $fileName . '.' . $fileType;
        return $file;

    }
    function tientrinhUpanh($file,$uploadPath){
        $file = kiemtraAnh($file, $uploadPath);
        if($file != false){
            $file['name'] = str_replace(' ','_',$file['name']);
            if(move_uploaded_file($file["tmp_name"], $uploadPath . '/' .$file["name"])){
                return array(
                    'error' => false,
                    'path' => str_replace('../','/',$uploadPath) . '/' . $file['name']
                );
            }
        }else{
            return array(
                'error' => false,
                'message' => "The file ". basename($file["name"]) . " isn't valid."
            );
        }
    }
?>
        <?php 
            $tt=mysqli_query($conn,"SELECT * FROM `tintuc` WHERE `id_tintuc`= '".$_GET['id_tintuc']."' ");
            $tintuc=mysqli_fetch_array($tt);

            if (isset($_POST['suatt'])) {
                $tentt= $_POST['ten'];
                $noidung=$_POST['noidung'];
                $nguoiviet = $_POST['nguoiviet'];
                $trangthai=$_POST['trangthai'];
                $hienthi = $_POST['hienthi'];
                $error = [];
                
                if(isset($_FILES['hinh']) && !empty($_FILES['hinh']['name'][0])){
                    $uploadedFiles = $_FILES['hinh'];
                    $result = taiAnh($uploadedFiles);
                    if (!empty($result['errors'])){
                        $error = $result['errors'];
                    }else{
                        $hinh = $result['path'];
                    }
                }
                if(!isset($hinh) && !empty($tintuc['hinhtintuc'])){
                    $hinh = $tintuc['hinhtintuc'];
                }
               
                if(empty($tentt)){
                    $error['ten'] = "Lỗi: Bạn chưa tên tin tức !";
                }
                if(empty($noidung)){
                    $error['noidung'] = "Lỗi: Bạn chưa nhập nội dung tin tức !";
                }
                if(empty($nguoiviet)){
                    $error['nguoiviet'] = "Lỗi: Bạn chưa nhập người viết !";
                }
                if(empty($trangthai)){
                    $error['trangthai'] = "Lỗi: Bạn chưa chọn trạng thái !";
                }
                if(empty($hienthi)){
                    $error['hienthi'] = "Lỗi: Bạn chưa chọn hiển thị !";
                }
                

                if(count($error)==0){
                    // var_dump("UPDATE `tintuc` SET `tintuc`='".$tentt."',`ngaylap`='".time()."',`noidung`='".$noidung."',`nguoiviet`='".$nguoiviet."',`hinhtintuc`='".$hinh."',`trangthai`='".$trangthai."',`hienthi`='".$hienthi."' WHERE `id_tintuc`='".$_GET['id_tintuc']."' ");exit;
                    $suasp = mysqli_query($conn,"UPDATE `tintuc` SET `tintuc`='".$tentt."',`ngaylap`='".time()."',`noidung`='".$noidung."',`nguoiviet`='".$nguoiviet."',`hinhtintuc`='".$hinh."',`trangthai`='".$trangthai."',`hienthi`='".$hienthi."' WHERE `id_tintuc`='".$_GET['id_tintuc']."' ");
                    if($suasp){
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
                                    Thêm tin tức thành công !<a href="admin.php?page_layout=tintuc">Quay về</a>
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
                <li class="breadcrumb-item"><a href="admin.php?page_layout=tintuc_admin">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm tin tức</li>
            </ol>
        </nav>
        <h3 class="text-center py-3">Thêm tin tức</h3>
        <form class="ps-4" method="POST" enctype="multipart/form-data">
            <div class="align-items-center mb-3 row">
                <label class="col-sm-2 col-form-label">Tên tin tức: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ten" value="<?php echo (isset($tintuc['tintuc']))?$tintuc['tintuc']:''?>">
                    <span class="text-danger"><?php echo (isset($error['ten']))?$error['ten']:''?></span>
                </div>
            </div>
            <div class="align-items-center mb-3 row">
                <label class="col-sm-2 col-form-label">Người viết: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nguoiviet" value="<?php echo (isset($tintuc['nguoiviet']))?$tintuc['nguoiviet']:''?>">
                    <span class="text-danger"><?php echo (isset($error['nguoiviet']))?$error['nguoiviet']:''?></span>
                </div>
            </div>
            <div class="align-items-center mb-3 row">
                <label class="col-sm-2 col-form-label">Nội dung: </label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="noidung" rows="20"><?php echo (isset($tintuc['noidung']))?$tintuc['noidung']:''?></textarea>
                    <span class="text-danger"><?php echo (isset($error['noidung']))?$error['noidung']:''?></span>

                </div>
            </div>
           
           
            <div class="align-items-center mb-3 row">
                <label for="nhapanh" class="col-sm-2 col-form-label">Hình ảnh: </label>
                <div class="col-sm-6">
                    <?php if(!empty($tintuc['hinhtintuc'])){ ?>
                        <img src="<?php echo $tintuc['hinhtintuc'] ?>" class="img-fluid border border-1" alt=""><br/>
                    <?php } ?>
                    <input type="file" class="form-control" name="hinh">
                    <span class="text-danger"><?php echo (isset($error['hinh']))?$error['hinh']:''?></span>
                </div>
            </div>
            <div class="align-items-center mb-3 row">
                <label for="nhapanh" class="col-sm-2 col-form-label">Trạng thái: </label>
                <div class="col-sm-6">
                    <select class="form-select" name="trangthai" aria-label="Default select example">
                        <option value="">Chọn trạng thái</option>
                        <option value="1" <?php if($tintuc['trangthai']==1){
                                                    echo "selected";
                                                }else{
                                                    "";
                                                }?>>Tin tức hằng ngày</option>
                        <option value="2" <?php if($tintuc['trangthai']==2){
                                                    echo "selected";
                                                }else{
                                                    "";
                                                }?>>Tin tức mới</option>
                    </select>
                    <span class="text-danger"><?php echo (isset($error['trangthai']))?$error['trangthai']:''?></span>
                </div>
            </div>
            <div class="align-items-center mb-3 row">
                <label for="nhapanh" class="col-sm-2 col-form-label">Hiển thị: </label>
                <div class="col-sm-6">
                    <select class="form-select" name="hienthi" aria-label="Default select example">
                        <option value="">Chọn hiển thị</option>
                        <option value="1" <?php if($tintuc['hienthi']==1){
                                                    echo "selected";
                                                }else{
                                                    "";
                                                }?>>Hiện</option>
                        <option value="2" <?php if($tintuc['hienthi']==2){
                                                    echo "selected";
                                                }else{
                                                    "";
                                                }?>>Ẩn</option>
                    </select>
                    <span class="text-danger"><?php echo (isset($error['hienthi']))?$error['hienthi']:''?></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col d-flex">
                    <a href="javascript:history.go(-1)"><button type="button" class="btn btn-danger me-2"><i class="fa-solid fa-chevron-left me-1"></i>Quay về</button></a>
                    <button type="submit" name="suatt" value="Sửa tin tức" class="btn btn-success">Sửa tin tức</button>
                </div>
            </div>
        </form>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
            

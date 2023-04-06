
        <?php             
            if (isset($_POST['btnthemloai'])) {

                $maloai=$_POST['maloai'];
                $tenloai=$_POST['tenloai'];
                $error=[];
                if(empty($maloai)){
                    $error['maloai'] = "Lỗi: Bạn chưa nhập mã loại sản phẩm!";
                }
                if(empty($tenloai)){
                    $error['tenloai'] = "Lỗi: Bạn chưa nhập tên loại sản phẩm!";
                }
                if(count($error)==0){
                    $themloai = mysqli_query($conn,"INSERT INTO `loaisanpham`(`lsp_ma`, `lsp_ten`) VALUES ('".$maloai."','".$tenloai."')");
                    if($themloai){
                        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
                            Thêm danh mục thành công ! <a href="admin.php?page_layout=danhmuc">Quay về</a>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
            } 
        ?>
                <nav aria-label="breadcrumb" class="pt-3">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?page_layout=danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
                    </ol>
                </nav>
                <h3 class="text-center pt-3">Thêm danh mục</h3>
                <form id="products_form" class="ps-4" method="POST" enctype="multipart/form-data">

                    <div class="my-3 row">
                        <label for="nhaptensp" class="col-sm-2 col-form-label">Mã loại sản phẩm: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="maloai" id="nhaptensp" >
                            <span class="text-danger"><?php echo (isset($error['maloai']))?$error['maloai']:''?></span>
                        </div>
                    </div>
                    <div class="my-3 row">
                        <label for="nhaptensp" class="col-sm-2 col-form-label">Tên loại sản phẩm: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="tenloai" id="nhaptensp" >
                            <span class="text-danger"><?php echo (isset($error['tenloai']))?$error['tenloai']:''?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col d-flex">
                            <a href="admin.php?page_layout=danhmuc"><button type="button" class="btn btn-danger me-2"><i class="fa-solid fa-chevron-left me-1"></i>Quay về</button></a>
                            <button type="submit" name="btnthemloai" value="Thêm danh mục" class="btn btn-success">Thêm danh mục</button>
                        </div>
                    </div>
                </form>
            


        <?php       
          $result = mysqli_query($conn,"SELECT * FROM `loaisanpham` WHERE `lsp_ma` = '".$_GET['maloai']."' ");
          $product = mysqli_fetch_assoc($result);      
            if (isset($_POST['btnsualoai'])) {

                $maloai=$_POST['maloai'];
                $tenloai=$_POST['tenloai'];

                if(empty($maloai)){
                    $error = "Bạn chưa nhập mã loại sản phẩm";
                }elseif(empty($tenloai)){
                    $error = "Bạn chưa nhập tên loại sản phẩm";
                }
                if(!isset($error)){
                    $sualoai = mysqli_query($conn,"UPDATE `loaisanpham` SET `lsp_ma`='".$maloai."',`lsp_ten`='".$tenloai."' WHERE `lsp_ma` ='".$_GET['maloai']."'");
                }  
        ?>
        <div>
            <h5><?php echo isset($error) ? $error : "Sửa loại sản phẩm thành công" ?></h5>
            <a href="admin.php?page_layout=danhmuc">Quay lại danh mục</a>
        </div>
        <?php }else {?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?page_layout=danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sửa loại sản phẩm</li>
                    </ol>
                </nav>
                <h3 class="text-center pt-3">Thêm loại sản phẩm</h3>
                <form id="products_form" class="ps-4" method="POST" enctype="multipart/form-data">

                    <div class="my-3 row">
                        <label for="nhaptensp" class="col-sm-2 col-form-label">Mã loại sản phẩm: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="maloai" id="nhaptensp" value="<?php echo (!empty($product['lsp_ma'])?$product['lsp_ma']:"") ?>">
                        </div>
                    </div>
                    <div class="my-3 row">
                        <label for="nhaptensp" class="col-sm-2 col-form-label">Tên loại sản phẩm: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="tenloai" id="nhaptensp" value="<?php echo (!empty($product['lsp_ten'])?$product['lsp_ten']:"") ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3">
                            <button type="submit" name="btnsualoai" value="Sửa loại sản phẩm" class="btn btn-primary">Sửa loại sản phẩm</button>
                        </div>
                    </div>
                </form>
            <?php  } ?>
            

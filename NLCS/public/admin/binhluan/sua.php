<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb ps-3">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bình luận</li>
    </ol>
</nav>
<hr>
<h3 class="text-center py-3">Bình luận</h3>
<?php
    $binhluan = mysqli_query($conn,"SELECT * FROM `binhluan` bl INNER JOIN `users` u ON bl.`id`=u.`id` WHERE `id_binhluan`= '".$_GET['id_binhluan']."' ");
    $value=mysqli_fetch_array($binhluan);
    if(isset($_POST['luutt'])){
        if(empty($_POST['trangthai'])){
            echo '<p class="text-danger">Bạn chưa chọn trạng thái bình luận!</p>';
        }else{
            if($_POST['trangthai']!=$value['trangthai']){
                $tt = $_POST['trangthai'];
            }else{
                $tt=$value['trangthai'];
            }
        }
        if(isset($tt)){
            var_dump("UPDATE `binhluan` SET `trangthai`='".$tt."' WHERE `id_binhluan`= '".$_GET['id_binhluan']."' ");
            $suabl=mysqli_query($conn,"UPDATE `binhluan` SET `trangthai`='".$tt."' WHERE `id_binhluan`= '".$_GET['id_binhluan']."' ");
            if($suabl){
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
                            Sửa trạng thái thành công !<a href="admin.php?page_layout=binhluan">Quay về</a>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </div>';
            }
        }
        
    }


?>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-light table-sm">
            <thead>
                <tr>
                    <th class="text-center">Mã bình luận</th>
                    <th class="text-center">Tên người dùng</th>
                    <th class="text-center">Mã tin tức</th>
                    <th class="text-center">Bình luận</th>
                    <th class="text-center">Ngày gửi</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-1 align-middle text-center">
                        <?php echo $value['id_binhluan']?>
                    </td>
                    <td class="col-2 align-middle text-center">
                        <?php echo $value['username']?>
                    </td>
                    <td class="col-1 align-middle text-center">
                        <?php echo $value['id_tintuc']?>
                    </td>
                    <td class="col-3 align-middle text-center">
                        <?php echo $value['binhluan']?>
                    </td>
                    <td class="col-2 align-middle text-center">
                    <?php echo date('d/m/Y H:m:s',$value['ngayviet'])?>
                    </td>
                    <td class="col-2 align-middle text-center">
                        <select class="form-select col-2" name="trangthai" aria-label="Default select example">
                            <option value="">Chọn trạng thái</option>
                            <option value="1" <?php if($value['trangthai']==1){
                                                        echo "selected";
                                                    }else{
                                                        "";
                                                    }?>>Chưa duyệt</option>
                            <option value="2" <?php if($value['trangthai']==2){
                                                        echo "selected";
                                                    }else{
                                                        "";
                                                    }?>>Đã duyệt</option>
                        </select>                    
                    </td>
                </tr>
            </tbody>
    </table>
    <div class="d-grid gap-2 d-flex justify-content-end">
        <button class="btn btn-success" type="submit" name="luutt" value="Lưa trạng thái">Lưa trạng thái</button>
    </div>
    </form>
<script>
    function Del(ten){
        return confirm("Bạn có chắc chắn muốn xóa tin tức: " + ten + "?");
    }
</script>
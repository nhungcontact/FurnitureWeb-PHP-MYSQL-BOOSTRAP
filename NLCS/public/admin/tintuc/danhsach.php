<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb ps-3">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
    </ol>
</nav>
<hr>
<h3 class="text-center py-3">Tin tức</h3>
<!-- nut them loai san pham -->
<div class="text-end">
    <a href="admin.php?page_layout=themtintuc" class="tablinks"><button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-plus me-2"></i>Thêm tin tức</button></a>
</div>
<?php
    $tintuc = mysqli_query($conn,"SELECT * FROM `tintuc`");
    $count_row = mysqli_num_rows($tintuc);
?>
<p>Tổng tin tức : <?php echo $count_row ?></p>
<table class="table table-bordered table-light table-sm">
    <thead>
        <tr>
            <th class="text-center">Mã tin tức</th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Tên tin tức</th>
            <th class="text-center">Nội dung</th>
            <th class="text-center">Người viết</th>
            <th class="text-center">Ngày gửi</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Hiển thị</th>
            <th class="text-center">Quản lý</th>
        </tr>
    </thead>
    <?php 
        while ($value = mysqli_fetch_array($tintuc)) {
    ?>
    <tbody>
        <tr>
            <td class="col-1 align-middle text-center">
                <?php echo $value['id_tintuc']?>
            </td>
            <td class="col align-middle text-center">
                <img class="img-fluid" src="<?php echo $value['hinhtintuc']?>" alt="">
            </td>
            <td class="col-2 align-middle text-center">
                <?php echo $value['tintuc']?>
            </td>
            <td class="col-3 align-middle text-center">
                <div style="width: 220px;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 25px;
                            -webkit-line-clamp: 3;
                            height: 75px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;">
                        <?php echo $value['noidung']?>
                </div>
            </td>
            <td class="col align-middle text-center">
                <?php echo $value['nguoiviet']?>
            </td>
            <td class="col align-middle text-center">
            <?php echo date('d/m/Y',$value['ngaylap'])?>
            </td>
            
            <td class="col align-middle text-center">
                <?php if($value['trangthai']==1){
                    echo "Tin tức hằng ngày";
                }else{
                    echo "Tin tức mới";
                }
                
                ?>
            </td>
            <td class="col align-middle text-center">
                <?php if($value['hienthi']==1){
                    echo '<p class="m-0 text-success">Hiện</p>';
                }else{
                    echo '<p class="m-0 text-danger">Ẩn</p>';
                }
                
                ?>
            </td>
            <td class="col align-middle text-center">
                <p><a href="admin.php?page_layout=suatt&id_tintuc=<?php echo $value['id_tintuc']; ?>"><i class="fa-solid fa-pen"></i></a></p>
                <p><a onclick="return Del('<?php echo $value['tintuc'];?>')" href="admin.php?page_layout=xoa&id_tintuc=<?php echo $value['id_tintuc']; ?>"><i class="fa-solid fa-trash"></i></a></p>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
<script>
    function Del(ten){
        return confirm("Bạn có chắc chắn muốn xóa tin tức: " + ten + "?");
    }
</script>
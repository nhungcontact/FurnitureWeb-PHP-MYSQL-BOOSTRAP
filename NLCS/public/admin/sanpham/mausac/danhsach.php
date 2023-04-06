<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb ps-3">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
    </ol>
</nav>
<hr>
<h3 class="text-center py-3">Danh sách màu sản phẩm</h3>
<!-- nut them loai san pham -->
<div class="text-end">
    <a href="admin.php?page_layout=themmau" class="tablinks"><button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-plus me-2"></i>Thêm màu</button></a>
</div>
<?php
    $mausac = mysqli_query($conn,"SELECT * FROM `mausac`");
    $count_ms = mysqli_num_rows($mausac);
?>
<p>Tổng loại sản phẩm : <?php echo $count_ms ?></p>
<table class="table table-bordered table-light table-sm">
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Tên màu</th>
            <th class="text-center">Mã màu css</th>
            <th class="text-center">Hình màu</th>
            <th class="text-center">Xóa</th>
        </tr>
    </thead>
    <?php 
        $i=1;
        while ($value = mysqli_fetch_array($mausac)) {
    ?>
    <tbody>
        <tr>
            <td class="col-1 align-middle text-center">
                <?php echo $i++ ?>
            </td>
            <td class="col-2 align-middle text-center">
                <?php echo $value['mausac']?>
            </td>
            <td class="col-2 align-middle text-center">
                <?php echo $value['mausac_css']?>
            </td>                            
            <td class="col-1 align-middle text-center">
                <img src="hinh/mausac/<?php echo $value['hinhmau']?>" alt="" class="img-fluid" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
            </td>
            <td class="col-1 align-middle text-center">
                <p><a onclick="return Del('<?php echo $value['mausac'];?>')" href="admin.php?page_layout=xoamau&id_ms=<?php echo $value['id_mausac'] ?>"><i class="fa-solid fa-trash"></i></a></p>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
<script>
    function Del(ten){
        return confirm("Bạn có chắc chắn muốn xóa màu: " + ten + "?");
    }
</script>
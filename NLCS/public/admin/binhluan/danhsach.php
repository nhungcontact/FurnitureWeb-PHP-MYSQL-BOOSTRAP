<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb ps-3">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bình luận</li>
    </ol>
</nav>
<hr>
<h3 class="text-center py-3">Bình luận</h3>

<?php
    $binhluan = mysqli_query($conn,"SELECT bl.* , `username` FROM `binhluan` bl INNER JOIN `users` u ON bl.`id`=u.`id` ");
    $count_row = mysqli_num_rows($binhluan);
?>
<p>Tổng bình luận : <?php echo $count_row ?></p>
<table class="table table-bordered table-light table-sm">
    <thead>
        <tr>
            <th class="text-center">Mã bình luận</th>
            <th class="text-center">Tên người dùng</th>
            <th class="text-center">Mã tin tức</th>
            <th class="text-center">Bình luận</th>
            <th class="text-center">Ngày gửi</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Quản lý</th>
        </tr>
    </thead>
    <?php 
        while ($value = mysqli_fetch_array($binhluan)) {
    ?>
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
            <td class="col-2 align-middle text-center">
                <?php echo $value['binhluan']?>
            </td>
            <td class="col-2 align-middle text-center">
            <?php echo date('d/m/Y H:m:s',$value['ngayviet'])?>
            </td>
            <td class="col-2 align-middle text-center">
                <?php if($value['trangthai']==1){
                    echo '<p class="text-danger m-0">Chưa duyệt</p>';
                }else{
                    echo '<p class="text-success m-0">Đã duyệt</p>';
                }
                
                ?>
            </td>
            
            <td class="col align-middle text-center">
                <p><a href="admin.php?page_layout=suabinhluan&id_binhluan=<?php echo $value['id_binhluan']; ?>"><i class="fa-solid fa-pen"></i></a></p>
                <!-- <p><a onclick="return Del('<?php echo $value['tintuc'];?>')" href="admin.php?page_layout=xoa&id_tintuc=<?php echo $value['id_tintuc']; ?>"><i class="fa-solid fa-trash"></i></a></p> -->
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
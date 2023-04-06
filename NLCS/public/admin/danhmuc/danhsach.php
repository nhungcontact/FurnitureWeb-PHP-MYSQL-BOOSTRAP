                <nav aria-label="breadcrumb" class="pt-3">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                    </ol>
                </nav>
                <hr>
                <h3 class="text-center py-3">Danh mục</h3>
                <!-- nut them loai san pham -->
                <div class="text-end">
                    <a href="admin.php?page_layout=themloai" class="tablinks"><button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-plus me-2"></i>Thêm loại</button></a>
                </div>
                <?php
                    $loai = mysqli_query($conn,"SELECT * FROM `loaisanpham`");
                    $count_row = mysqli_num_rows($loai);
                ?>
                <p>Tổng loại sản phẩm : <?php echo $count_row ?></p>
                <table class="table table-bordered table-light table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Mã loại sản phẩm</th>
                            <th class="text-center">Tên loại sản phẩm</th>
                            <th class="text-center">Sửa</th>
                            <th class="text-center">Xóa</th>
                        </tr>
                    </thead>
                    <?php 
                        $i=1;
                        while ($value = mysqli_fetch_array($loai)) {
                    ?>
                    <tbody>
                        <tr>
                            <td class="col-2 align-middle text-center">
                                <?php echo $i++ ?>
                            </td>
                            <td class="col-3 align-middle text-center">
                                <?php echo $value['lsp_ma']?>
                            </td>
                            <td class="col align-middle text-center">
                                <?php echo $value['lsp_ten']?>
                            </td>                            
                            <td class="col align-middle text-center">
                                <p><a href="admin.php?page_layout=sualoai&maloai=<?php echo $value['lsp_ma']; ?>"><i class="fa-solid fa-pen"></i></a></p>
                            </td>
                            <td class="col align-middle text-center">
                                <p><a onclick="return Del('<?php echo $value['lsp_ten'];?>')" href="admin.php?page_layout=xoa&maloai=<?php echo $value['lsp_ma']; ?>"><i class="fa-solid fa-trash"></i></a></p>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
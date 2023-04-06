
            <?php
                $tim = isset($_GET['search'])?$_GET['search']:"";

                if($tim){
                    $where = "WHERE `tensanpham` LIKE '%".$tim."%'";
                }
                $lsp_ma = isset($_GET['lsp_ma'])?$_GET['lsp_ma']:"";

                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 5 ; //hien thi 1 trang 6 san pham
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
                $offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi
                
                if($tim){
                    $sanpham = mysqli_query($conn, "SELECT * from `sanpham` ".$where." ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `sanpham` ".$where." ");
                }elseif(!empty($lsp_ma)){
                    $sanpham = mysqli_query($conn, "SELECT * from `sanpham` WHERE `lsp_ma` = '".$lsp_ma."' ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `sanpham` WHERE `lsp_ma` = '".$lsp_ma."'");
                }else{
                    $sanpham = mysqli_query($conn, "SELECT * from `sanpham` ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `sanpham`");
                }
                
                $totalRecords = $totalRecords->num_rows; // lay so dong
                $totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)
                ?>
                
                <nav aria-label="breadcrumb" class="pt-3">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                    </ol>
                </nav>
                <hr>
                <h3 class="text-center py-3">Danh sách sản phẩm</h3>
                
                <!-- tim kiem -->
                <div class="d-flex">
                    <form method="GET" class="d-flex" action="">
                        <button class="btn btn-primary" type="submit">Tìm</button>
                        <input class="form-control ms-2 search_text" type="text" name="search" placeholder="Nhập tên sản phẩm" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
                    </form>
                    <select class="form-select ms-2" aria-label="Default select example" style="max-width:15%;" onchange=" this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        <option selected>Chọn hiển thị</option>
                        <option value="?page_layout=danhsach&lsp=none">Tất cả</option>
                        <?php $result = mysqli_query($conn,"SELECT * FROM `loaisanpham`");
                            while($loaisp=mysqli_fetch_array($result)){?>
                        <option value="?page_layout=danhsach&lsp_ma=<?php echo $loaisp['lsp_ma']?>"><?php echo $loaisp['lsp_ten'] ?></option>
                        <?php } ?>
                    </select>                                               
                </div>
                <!-- nut them san pham -->
                <div class="text-end">
                    <a href="admin.php?page_layout=them" class="tablinks"><button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-plus me-2"></i>Thêm sản phẩm</button></a>
                </div>
                <p>Tổng sản phẩm : <?php echo $totalRecords ?></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Ảnh 1</th>
                            <th class="text-center">Ảnh 2</th>
                            <th class="text-center">Tên sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Phần trăm</th>
                            <th class="text-center">Giá cũ</th>
                            <th class="text-center">Giá mới</th>
                            <th class="text-center">Màu sắc</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Quản lí</th>
                        </tr>
                    </thead>
                    <?php 
                        while ($value = mysqli_fetch_array($sanpham)) {
                    ?>
                    <tbody>
                        <tr>
                            <td class="col-4 align-middle">
                                <img src="../hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                            </td>
                            <td class="col-4 align-middle">
                                <img src="../hinh/<?php echo $value['hinh1']?>" alt="" class="img-fluid">
                            </td>
                            <td class="col-2 align-middle">
                                <p ><?php echo $value['tensanpham']?></p>
                            </td>                            
                            <td class="col align-middle text-center">
                                <p><?php echo $value['soluong']?></p>
                            </td>
                            <td class="col align-middle text-center">
                                <p><?php echo $value['phantram']?></p>                        
                            </td>
                            <td class="col align-middle text-center">
                                <p><?php echo $value['giacu']?></p>                        
                            </td>
                            <td class="col align-middle text-center">
                                <p><?php echo number_format($value['gia']) ?>đ</p>
                            </td>
                            <td class="col-2 align-middle">
                            <?php 
                            $ctsp=mysqli_query($conn,"SELECT * FROM `chitietsanpham` ct INNER JOIN `mausac` ms ON ct.`id_mausac`=ms.`id_mausac` WHERE `id_SP` = '".$value['id_SP']."' ");
                            while ($row_ctsp = mysqli_fetch_array($ctsp) ){?> 
                                <p><?php echo "- ",$row_ctsp['mausac']?></p>
                            <?php } ?>
                            </td>
                            <td class="col-3 align-middle">
                                <p style="width: 220px;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 25px;
                            -webkit-line-clamp: 3;
                            height: 75px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;"><?php echo $value['mota']?></p>
                            </td>
                            <td class="col align-middle text-center">
                                <p><a href="admin.php?page_layout=sua&id=<?php echo $value['id_SP']; ?>"><i class="fa-solid fa-pen"></i></a></p>
                                <p><a onclick="return Del('<?php echo $value['tensanpham'];?>')" href="admin.php?page_layout=xoa&id=<?php echo $value['id_SP']; ?>"><i class="fa-solid fa-trash"></i></a></p>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                <?php include '../pagination.php';?>
                <script>
                    function Del(ten){
                        return confirm("Bạn có chắc chắn muốn xóa sản phẩm: " + ten + "?");
                    }
                </script>
                <?php
                $tim = isset($_GET['search'])?$_GET['search']:"";
                if($tim){
                    $where = "WHERE `hoten` LIKE '%".$tim."%'";
                }
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 6 ; //hien thi 1 trang 6 san pham
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
                $offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi
                if($tim){
                    $donhang = mysqli_query($conn, "SELECT * from `donhang` INNER JOIN `chitietdonhang` ON donhang.id_DH=chitietdonhang.id_DH ".$where." ORDER BY id_DH ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `donhang` ".$where." ");
                }else{
                    $donhang = mysqli_query($conn, "SELECT * from `donhang` ORDER BY id_DH ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `donhang`");
                }

                $totalRecords = $totalRecords->num_rows; // lay so dong
                $totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)
                ?>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                    </ol>
                </nav>
                <hr>
                <h3 class="text-center py-3">Danh sách đơn hàng</h3>
                <!-- tim kiem -->
                <form method="GET" class="w-25 d-flex">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                    <input class="form-control ms-2" type="text" name="search" placeholder="Nhập tên người nhận" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
                </form>
                <div class="pt-2">
                    <span>Có tất cả <strong><?php echo $totalRecords ?></strong> đơn hàng </span>
                </div>
                <div class="py-2">
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Mã hàng</th>
                                <th class="text-center align-middle">Tên khách hàng</th>
                                <th class="text-center align-middle">Ngày đặt</th>
                                <th class="text-center align-middle">Tổng tiền</th>
                                <th class="text-center align-middle">Ghi chú</th>
                                <th class="text-center align-middle">Trạng thái</th>
                                <th class="text-center align-middle">Xem chi tiết</th>
                            </tr>
                        </thead>
                        <?php while ($value = mysqli_fetch_array($donhang)){?>
                            <tbody>
                                <tr>
                                    <td class="col-1 align-middle text-center">
                                        <p><?php echo $value['id_DH']?></p>
                                    </td>                            
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo $value['hoten']?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo date('d/m/Y H:i:m',$value['ngaylap'])?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo number_format($value['tongtien']) ?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo $value['ghichu'] ?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <?php if($value['trangthai']==1){?>
                                            <p class="text-info"><i class="fa-solid fa-exclamation me-1 text-info"></i> Đang giao hàng</p>
                                        <?php }elseif($value['trangthai']==0) {?>
                                            <p class="text-success"><i class="fa-solid fa-check text-success me-1"></i>Đã giao hàng</p>
                                        <?php }elseif($value['trangthai']==2) {?>
                                            <p class="text-danger"><i class="fa-solid fa-xmark text-danger me-1"></i> Hủy</p>
                                        <?php } ?>
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><a href="admin.php?page_layout=xemchitiet&id_DH=<?php echo $value['id_DH']?>" >Xem chi tiết</a></p>                     
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>